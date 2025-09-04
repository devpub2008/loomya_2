<?php

namespace App\Observers;

use App\Helpers\PaymentHelper;
use App\Model\Attachment;
use App\Model\ReferralCodeUsage;
use App\Providers\AttachmentServiceProvider;
use App\Providers\AuthServiceProvider;
use App\Providers\GenericHelperServiceProvider;
use App\Providers\ListsHelperServiceProvider;
use App\Model\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UsersObserver
{
    /**
     * Listen to the User deleting event.
     *
     * @param User $user
     * @return void
     */
    public function deleting(User $user)
    {
        // Cancelling all user subscriptions
        $paymentHelper = new PaymentHelper();
        foreach ($user->activeSubscriptions()->get() as $subscription) {
            try {
                $cancelSubscription = $paymentHelper->cancelSubscription($subscription);
                if (!$cancelSubscription) {
                    Log::error("Failed cancelling subscription for id: ".$subscription->id);
                }
            } catch (\Exception $exception) {
                Log::error("Failed cancelling subscription for id: ".$subscription->id." error: ".$exception->getMessage());
            }
        }

        // Removing user avatar/cover / current driver assuming
        try {
            $data = User::where('id', $user->id)->selectRaw('cover as cleanCover, avatar as cleanAvatar')->first();
            $data = $data->getOriginal();
            $storage = Storage::disk(config('filesystems.defaultFilesystemDriver'));
            if($data['cleanCover']) $storage->delete($data['cleanCover']);
            if($data['cleanAvatar']) $storage->delete($data['cleanAvatar']);
        } catch (\Exception $exception) {
            Log::error("Failed deleting avatar or cover for: ".$user->id.", cover:{$user->cover}, avatar:{$user->avatar},  e: ".$exception->getMessage());
        }

        // Removing all attachments of the user / per driver
        $userAttachments = Attachment::where('user_id', $user->id)->get();
        foreach($userAttachments as $attachment){
            try {
                AttachmentServiceProvider::removeAttachment($attachment);
            } catch (\Exception $exception) {
                Log::error("Failed deleting files for attachment: ".$attachment->id.", e: ".$exception->getMessage());
            }
        }

    }

    /**
     * Listen to the User created event.
     *
     * @param User $user
     * @return void
     */
    public function created(User $user) {
        if ($user != null) {
            GenericHelperServiceProvider::createUserWallet($user);
            ListsHelperServiceProvider::createUserDefaultLists($user->id);
            if(getSetting('security.default_2fa_on_register')) {
                AuthServiceProvider::addNewUserDevice($user->id, true);
            }
            if(getSetting('profiles.default_users_to_follow')){
                $usersToFollow = explode(',', getSetting('profiles.default_users_to_follow'));
                if(count($usersToFollow)){
                    foreach($usersToFollow as $userID){
                        ListsHelperServiceProvider::managePredefinedUserMemberList($user->id, $userID, 'follow');
                    }
                }
            }
            if(getSetting('referrals.enabled')) {
                // Saving the referral even if the case
                if(Cookie::has('referral')){
                    $referralID = User::where('referral_code', Cookie::get('referral'))->first();
                    if($referralID){
                        $existing = ReferralCodeUsage::where(['used_by' => $user->id, 'referral_code' => $referralID->referral_code])->first();
                        if(!$existing) {
                            ReferralCodeUsage::create(['used_by' => $user->id, 'referral_code' => $referralID->referral_code]);
                            Cookie::queue(Cookie::forget('referral'));
                            if(getSetting('referrals.auto_follow_the_user')){
                                ListsHelperServiceProvider::managePredefinedUserMemberList($user->id, $referralID->id, 'follow');
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * Listen to the User updating event.
     *
     * @param User $user
     * @return void
     */
    public function updating(User $user) {
        // fixes the problem with admin panel saving invalid paths for user avatar and cover
        if($user->isDirty('avatar') && $user->getOriginal('avatar')) {
            // make sure we don't use the same files
            if(basename($user->avatar) === basename($user->getOriginal('avatar'))) {
                unset($user->avatar);
            }

            // Presigned urls workaround
            if (getSetting('storage.driver') == 's3') {
                if (getSetting('storage.aws_cdn_enabled') && getSetting('storage.aws_cdn_presigned_urls_enabled')) {
                    if(!AttachmentServiceProvider::getFileNameFromUrl($user->avatar)){
                        unset($user->avatar);
                    }
                }
            }

        }
        if($user->isDirty('cover') && $user->getOriginal('cover')) {

            if(basename($user->cover) === basename($user->getOriginal('cover'))) {
                unset($user->cover);
            }

            // Presigned urls workaround
            if (getSetting('storage.driver') == 's3') {
                if (getSetting('storage.aws_cdn_enabled') && getSetting('storage.aws_cdn_presigned_urls_enabled')) {
                    if(!AttachmentServiceProvider::getFileNameFromUrl($user->cover)){
                        unset($user->cover);
                    }
                }
            }

        }
    }

    /**
     * @param User $user
     * @return void
     */
    public function saved(User $user): void
    {
        // Syncing role_id column to spatie roles
        if (config('settings.admin_version') !== 'v2') {
            return; // still using legacy, skip
        }

        $roleName = $user->getRoleNames()->first();

        if (!$roleName) {
            return;
        }

        $legacyRole = Role::where('name', $roleName)->first();

        if ($legacyRole && $user->role_id !== $legacyRole->id) {
            $user->updateQuietly(['role_id' => $legacyRole->id]);
        }
    }
}
