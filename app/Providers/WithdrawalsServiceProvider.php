<?php

namespace App\Providers;

use App\Model\Wallet;
use App\Model\User;
use App\Model\Withdrawal;
use Exception;
use Illuminate\Support\ServiceProvider;
use Stripe\Payout;

class WithdrawalsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public static function createStripeAccountForUser($user) {
        $stripeAccount = StripeServiceProvider::createStripeCustomAccount($user);
        $user->stripe_account_id = $stripeAccount->id;
        $user->save();
    }

    public static function userDoneStripeOnboarding($user): bool {
        $account = StripeServiceProvider::retrieveStripeCustomAccount($user->stripe_account_id);

        if($account->charges_enabled && $account->payouts_enabled) {
            return true;
        }

        return false;
    }

    /**
     * Restoring the money to the user.
     * @param $withdrawal
     */
    public static function creditUserForRejectedWithdrawal($withdrawal) {
        // Restoring the money to the user
        $userId = $withdrawal->user_id;
        $wallet = Wallet::where('user_id', $userId)->first();
        $wallet->update(['total' => $wallet->total + floatval($withdrawal->amount)]);
    }

    public static function processNewWithdrawalEmailNotification() {
        // Sending out admin email
        $adminEmails = User::where('role_id', 1)->select(['email', 'name'])->get();
        foreach ($adminEmails as $user) {
            EmailsServiceProvider::sendGenericEmail(
                [
                    'email' => $user->email,
                    'subject' => __('Action required | New withdrawal request'),
                    'title' => __('Hello, :name,', ['name' => $user->name]),
                    'content' => __('There is a new withdrawal request on :siteName that requires your attention.', ['siteName' => getSetting('site.name')]),
                    'button' => [
                        'text' => __('Go to admin'),
                        'url' => url()->route('filament.admin.resources.withdrawals.index'),
                    ],
                ]
            );
        }
    }

    public static function approve(int $withdrawalId): array
    {
        $withdrawal = Withdrawal::query()->where('id', $withdrawalId)->with('user')->first();

        if (!$withdrawal) {
            return ['success' => false, 'error' => __('Withdrawal not found')];
        }

        if ($withdrawal->status !== Withdrawal::REQUESTED_STATUS) {
            return ['success' => false, 'error' => __('Withdrawal already processed')];
        }

        try {
            $payoutSucceeded = true;

            if ($withdrawal->payment_method === 'Stripe Connect') {
                $payoutSucceeded = false;

                if (!$withdrawal->stripe_transfer_id) {
                    $transfer = StripeServiceProvider::createConnectedAccountTransfer(
                        $withdrawal,
                        $withdrawal->user->stripe_account_id
                    );
                    $withdrawal->stripe_transfer_id = $transfer->id;
                    $withdrawal->save(); // save after transfer
                }

                $payout = StripeServiceProvider::createManualPayout($withdrawal->user->stripe_account_id);
                $withdrawal->stripe_payout_id = $payout->id;

                if ($payout->status === Payout::STATUS_PAID) {
                    $payoutSucceeded = true;
                } elseif ($payout->status === Payout::STATUS_FAILED) {
                    $withdrawal->status = Withdrawal::REJECTED_STATUS;
                }

                $withdrawal->save();
            }

            if ($payoutSucceeded) {
                $withdrawal->status = Withdrawal::APPROVED_STATUS;
                $withdrawal->save();
            }

            $message = $payoutSucceeded
                ? __("Withdrawal approved successfully")
                : __("Withdrawal payout initiated");

            return ['success' => true, 'message' => $message];
        } catch (Exception $e) {
            return ['success' => false, 'error' => 'Error: "'.$e->getMessage().'"'];
        }
    }

    public static function reject(int $withdrawalId): array
    {
        $withdrawal = Withdrawal::query()->where('id', $withdrawalId)->first();

        if (!$withdrawal) {
            return ['success' => false, 'error' => __('Withdrawal not found')];
        }

        if ($withdrawal->status !== Withdrawal::REQUESTED_STATUS) {
            return ['success' => false, 'error' => __('Withdrawal already processed')];
        }

        try {
            $withdrawal->status = Withdrawal::REJECTED_STATUS;
            $withdrawal->save();

            return ['success' => true, 'message' => __('Withdrawal rejected successfully')];
        } catch (Exception $e) {
            return ['success' => false, 'error' => 'Error: "'.$e->getMessage().'"'];
        }
    }
}
