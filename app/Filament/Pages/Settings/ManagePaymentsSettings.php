<?php

namespace App\Filament\Pages\Settings;

use App\Filament\Traits\HasShieldPageAccess;
use App\Settings\PaymentsSettings;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Pages\SettingsPage;
use Filament\Forms\Form;

class ManagePaymentsSettings extends SettingsPage
{
    use HasShieldPageAccess;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $slug = 'settings/payments';

    protected static string $settings = PaymentsSettings::class;

    protected static ?string $navigationGroup = 'Settings';

    protected static ?string $title = 'Payments Settings';

    public function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([

                Tabs::make()
                    ->columnSpanFull()
                    ->tabs([

                        Tab::make('General')
                            ->columns(2)
                            ->schema([

                            Placeholder::make('cron_warning')
                                ->label('') // No helperText needed; actual message is rendered via Blade view
                                ->columnSpanFull()
                                ->content(
                                    file_exists(storage_path('logs/cronjobs.log'))
                                        ? ''
                                        : new HtmlString(view('filament.partials.webhooks.crons-warning')->render())
                                ),

                            TextInput::make('currency_code')
                                ->label('Currency Code')
                                ->helperText('The ISO currency code (e.g. USD, EUR, GBP) used across the platform.')
                                ->required(),

                            TextInput::make('currency_symbol')
                                ->label('Currency Symbol')
                                ->helperText('The symbol shown next to prices (e.g. $, €, £).')
                                ->required(),

                            Select::make('currency_position')
                                ->label('Currency Position')
                                ->options([
                                    'left' => 'Left ($99.99)',
                                    'right' => 'Right (99.99$)',
                                ])
                                ->helperText('Choose whether the currency symbol appears before or after the amount.')
                                ->required(),

                            Toggle::make('disable_local_wallet_for_subscriptions')
                                ->label('Disable Local Wallet for Subscriptions')
                                ->helperText('Prevents users from using their internal wallet balance to pay for subscriptions.'),

                            ]),

                        Tab::make('Limits')
                            ->columns(2)
                            ->schema([

                                TextInput::make('default_subscription_price')
                                    ->label('Default Subscription Price')
                                    ->numeric()
                                    ->helperText('Default monthly price for new user subscriptions.')
                                    ->columnSpanFull()
                                    ->required(),

                                TextInput::make('minimum_subscription_price')
                                    ->label('Min Subscription Price')
                                    ->numeric()
                                    ->helperText('Lowest amount users can charge for subscriptions.')
                                    ->required(),

                                TextInput::make('maximum_subscription_price')
                                    ->label('Max Subscription Price')
                                    ->numeric()
                                    ->helperText('Maximum amount users can charge for subscriptions.')
                                    ->required(),

                                TextInput::make('deposit_min_amount')
                                    ->label('Min Deposit Amount')
                                    ->numeric()
                                    ->helperText('Smallest amount users can add to their wallet.')
                                    ->required(),

                                TextInput::make('deposit_max_amount')
                                    ->label('Max Deposit Amount')
                                    ->numeric()
                                    ->helperText('Largest amount users can deposit in a single transaction.')
                                    ->required(),

                                TextInput::make('min_tip_value')
                                    ->label('Min Tip Value')
                                    ->numeric()
                                    ->helperText('Minimum value allowed when tipping other users.')
                                    ->required(),

                                TextInput::make('max_tip_value')
                                    ->label('Max Tip Value')
                                    ->numeric()
                                    ->helperText('Maximum value allowed when tipping other users.')
                                    ->required(),

                                TextInput::make('min_ppv_post_price')
                                    ->label('Min PPV Post Price')
                                    ->numeric()
                                    ->helperText('Minimum price to unlock pay-per-view posts.')
                                    ->required(),

                                TextInput::make('max_ppv_post_price')
                                    ->label('Max PPV Post Price')
                                    ->numeric()
                                    ->helperText('Maximum price to unlock pay-per-view posts.')
                                    ->required(),

                                TextInput::make('min_ppv_message_price')
                                    ->label('Min PPV Message Price')
                                    ->numeric()
                                    ->helperText('Minimum price to unlock pay-per-view messages.')
                                    ->required(),

                                TextInput::make('max_ppv_message_price')
                                    ->label('Max PPV Message Price')
                                    ->numeric()
                                    ->helperText('Maximum price to unlock pay-per-view messages.')
                                    ->required(),

                                TextInput::make('min_ppv_stream_price')
                                    ->label('Min PPV Stream Price')
                                    ->numeric()
                                    ->helperText('Minimum price to access pay-per-view streams.')
                                    ->required(),

                                TextInput::make('max_ppv_stream_price')
                                    ->label('Max PPV Stream Price')
                                    ->numeric()
                                    ->helperText('Maximum price to access pay-per-view streams.')
                                    ->required(),

                            ]),

                        Tab::make('Processors')->schema([

                            Tabs::make('Payment Providers')
                                ->contained(false)
                                ->columnSpanFull()
                                ->tabs([
                                    Tab::make('Stripe')->schema([
                                        Section::make()->columns(2)->schema([

                                            Placeholder::make('stripe_webhook_info')
                                                ->label('')
                                                ->columnSpanFull()
                                                ->content(new HtmlString(view('filament.partials.webhooks.stripe')->render())),

                                            TextInput::make('stripe_public_key')
                                                ->label('Stripe Public Key')
                                                ->helperText('Your Stripe public key.'),

                                            TextInput::make('stripe_secret_key')
                                                ->label('Stripe Secret Key')
                                                ->helperText('Private API key used to securely talk to Stripe.'),

                                            TextInput::make('stripe_webhooks_secret')
                                                ->label('Stripe Webhook Secret')
                                                ->helperText('Required to validate webhook requests from Stripe.')
                                            ->columnSpanFull(),

                                            Toggle::make('stripe_checkout_disabled')
                                                ->label('Disable Stripe Checkout')
                                                ->helperText('Won\'t be shown on checkout, but still available for deposits page.'),

                                            Toggle::make('stripe_recurring_disabled')
                                                ->label('Disable Recurring Payments')
                                                ->helperText('Prevents use of subscriptions or recurring billing in Stripe.'),

                                            Toggle::make('stripe_oxxo_provider_enabled')
                                                ->label('Enable OXXO')
                                                ->helperText('OXXO is a cash-based payment method in Mexico.'),

                                            Toggle::make('stripe_ideal_provider_enabled')
                                                ->label('Enable iDEAL')
                                                ->helperText('iDEAL is a payment method commonly used in the Netherlands.'),

                                            Toggle::make('stripe_blik_provider_enabled')
                                                ->label('Enable Blik')
                                                ->helperText('Blik is a Polish payment method that supports instant transfers.'),

                                            Toggle::make('stripe_bancontact_provider_enabled')
                                                ->label('Enable Bancontact')
                                                ->helperText('Bancontact is a Belgian payment method used for local transactions.'),

                                            Toggle::make('stripe_eps_provider_enabled')
                                                ->label('Enable EPS')
                                                ->helperText('EPS is a bank transfer payment method used in Austria.'),

                                            Toggle::make('stripe_giropay_provider_enabled')
                                                ->label('Enable Giropay')
                                                ->helperText('Giropay is a widely used online banking payment method in Germany.'),

                                            Toggle::make('stripe_przelewy_provider_enabled')
                                                ->label('Enable Przelewy24')
                                                ->helperText('Przelewy24 is a Polish payment method supporting multiple banks.'),

                                        ]),
                                    ]),
                                    Tab::make('PayPal')->schema([
                                        Section::make()->columns(2)->schema([

                                            Placeholder::make('stripe_webhook_info')
                                                ->label('')
                                                ->columnSpanFull()
                                                ->content(new HtmlString(view('filament.partials.webhooks.paypal')->render())),

                                            TextInput::make('paypal_client_id')
                                                ->label('PayPal Client ID')
                                                ->helperText('Found in your PayPal Developer Dashboard under REST API credentials.'),

                                            TextInput::make('paypal_secret')
                                                ->label('PayPal Secret')
                                                ->helperText('Private API key used for authenticating with PayPal’s API.'),

                                            Toggle::make('paypal_checkout_disabled')
                                                ->label('Disable PayPal Checkout')
                                                ->helperText('Won\'t be shown on checkout, but still available for deposits page.'),

                                            Toggle::make('paypal_recurring_disabled')
                                                ->label('Disable Recurring Payments')
                                                ->helperText('Stops users from starting subscriptions via PayPal.'),

                                            Toggle::make('paypal_live_mode')
                                                ->label('Live Mode')
                                                ->helperText('Enable this to use real transactions. Turn off to use sandbox for testing.'),

                                        ]),
                                    ]),
                                    Tab::make('Coinbase')->schema([
                                        Section::make()->columns(2)->schema([

                                            Placeholder::make('stripe_webhook_info')
                                                ->label('')
                                                ->columnSpanFull()
                                                ->content(new HtmlString(view('filament.partials.webhooks.coinbase')->render())),

                                            TextInput::make('coinbase_api_key')
                                                ->label('Coinbase API Key')
                                                ->helperText('Used to authorize payment requests through Coinbase Commerce.'),

                                            TextInput::make('coinbase_webhook_key')
                                                ->label('Coinbase Webhook Secret')
                                                ->helperText('Verifies incoming webhook events from Coinbase to ensure authenticity.'),

                                            Toggle::make('coinbase_checkout_disabled')
                                                ->label('Disable Coinbase Checkout')
                                                ->helperText('Won\'t be shown on checkout, but still available for deposits page.'),

                                        ]),
                                    ]),
                                    Tab::make('NowPayments')->schema([
                                        Section::make()->columns(2)->schema([

                                            Placeholder::make('stripe_webhook_info')
                                                ->label('')
                                                ->columnSpanFull()
                                                ->content(new HtmlString(view('filament.partials.webhooks.nowpayments')->render())),

                                            TextInput::make('nowpayments_api_key')
                                                ->label('NowPayments API Key')
                                                ->helperText('Used to authenticate API requests to NowPayments for crypto processing.'),

                                            TextInput::make('nowpayments_ipn_secret_key')
                                                ->label('IPN Secret Key')
                                                ->helperText('Used to validate Instant Payment Notifications (IPNs) from NowPayments.'),

                                            Toggle::make('nowpayments_checkout_disabled')
                                                ->label('Disable NowPayments Checkout')
                                                ->helperText('Won\'t be shown on checkout, but still available for deposits page.'),

                                        ]),
                                    ]),
                                    Tab::make('CCBill')->schema([
                                        Section::make()->columns(2)->schema([

                                            Placeholder::make('stripe_webhook_info')
                                                ->label('')
                                                ->columnSpanFull()
                                                ->content(new HtmlString(view('filament.partials.webhooks.ccbill')->render())),

                                            TextInput::make('ccbill_account_number')
                                                ->label('Account Number')
                                                ->helperText('Your main CCBill account number used to identify your integration.'),

                                            TextInput::make('ccbill_subaccount_number_recurring')
                                                ->label('Recurring Subaccount Number')
                                                ->helperText('Used for processing recurring billing via CCBill.'),

                                            TextInput::make('ccbill_subaccount_number_one_time')
                                                ->label('One-Time Subaccount Number')
                                                ->helperText('Used for one-time payments processed through CCBill.'),

                                            TextInput::make('ccbill_flex_form_id')
                                                ->label('FlexForm ID')
                                                ->helperText('ID of the CCBill FlexForm configured for your payment flow.'),

                                            TextInput::make('ccbill_salt_key')
                                                ->label('Salt Key')
                                                ->helperText('Security key used for validating incoming CCBill responses.'),

                                            TextInput::make('ccbill_datalink_username')
                                                ->label('Datalink Username')
                                                ->helperText('Username for CCBill Datalink API access (used for status syncs, etc.).'),

                                            TextInput::make('ccbill_datalink_password')
                                                ->label('Datalink Password')
                                                ->helperText('Password for authenticating Datalink API requests.'),

                                            Toggle::make('ccbill_skip_subaccount_from_cancellations')
                                                ->label('Skip Subaccount on Cancellations')
                                                ->helperText('Avoids using subaccount information when cancelling subscriptions.'),

                                            Toggle::make('ccbill_checkout_disabled')
                                                ->label('Disable CCBill Checkout')
                                                ->helperText('Won\'t be shown on checkout, but still available for deposits page.'),

                                            Toggle::make('ccbill_recurring_disabled')
                                                ->label('Disable CCBill Recurring')
                                                ->helperText('Prevent users from starting recurring subscriptions via CCBill.'),

                                        ]),
                                    ]),
                                    Tab::make('Verotel')->schema([
                                        Section::make()->columns(2)->schema([

                                            Placeholder::make('verotel_webhook_info')
                                                ->label('')
                                                ->columnSpanFull()
                                                ->content(new HtmlString(view('filament.partials.webhooks.verotel')->render())),

                                            TextInput::make('verotel_merchant_id')
                                                ->label('Merchant ID')
                                                ->helperText('Your Verotel Merchant ID.'),

                                            TextInput::make('verotel_shop_id')
                                                ->label('Shop ID')
                                                ->helperText('A Shop ID is generated after you complete the website setup on their platform.'),

                                            TextInput::make('verotel_signature_key')
                                                ->label('Signature Key')
                                                ->helperText('A Signature Key is generated after you complete the website setup on their platform and is used to sign their hooks and requests.'),

                                            TextInput::make('verotel_control_center_api_user')
                                                ->label('ControlCenter API Username')
                                                ->helperText('You can obtain your username in Control center on a "Setup Control Center API" page'),

                                            TextInput::make('verotel_control_center_api_password')
                                                ->label('ControlCenter API Password')
                                                ->helperText('You can obtain your password in Control center on a "Setup Control Center API" page.'),

                                            Toggle::make('verotel_checkout_disabled')
                                                ->label('Disable Verotel Checkout')
                                                ->helperText('Won\'t be shown on checkout, but still available for deposits page.'),

                                            Toggle::make('verotel_recurring_disabled')
                                                ->label('Disable Verotel Recurring')
                                                ->helperText('Prevent users from starting recurring subscriptions via Verotel.'),
                                        ]),
                                    ]),
                                    Tab::make('Paystack')->schema([
                                        Section::make()->columns(2)->schema([

                                            Placeholder::make('stripe_webhook_info')
                                                ->label('')
                                                ->columnSpanFull()
                                                ->content(new HtmlString(view('filament.partials.webhooks.paystack')->render())),

                                            TextInput::make('paystack_secret_key')
                                                ->label('Paystack Secret Key')
                                                ->helperText('Used to authenticate API requests with Paystack.'),

                                            Toggle::make('paystack_checkout_disabled')
                                                ->label('Disable Paystack Checkout')
                                                ->helperText('Won\'t be shown on checkout, but still available for deposits page.'),

                                        ]),
                                    ]),
                                    Tab::make('MercadoPago')->schema([
                                        Section::make()->columns(2)->schema([
                                            Placeholder::make('stripe_webhook_info')
                                                ->label('')
                                                ->columnSpanFull()
                                                ->content(new HtmlString(view('filament.partials.webhooks.mercado')->render())),

                                            TextInput::make('mercado_access_token')
                                                ->label('MercadoPago Access Token')
                                                ->helperText('Used to authenticate requests to MercadoPago’s API.'),

                                            Toggle::make('mercado_checkout_disabled')
                                                ->label('Disable MercadoPago Checkout')
                                                ->helperText('Won\'t be shown on checkout, but still available for deposits page.'),

                                        ]),
                                    ]),
                                    Tab::make('Offline')->schema([
                                        Section::make()->columns(2)->schema([

                                            Toggle::make('allow_manual_payments')
                                                ->label('Enable Manual Payments')
                                                ->helperText('Allow users to make manual/offline payments, such as via bank transfer.')->columnSpanFull(),

                                            TextInput::make('offline_payments_owner')
                                                ->label('Account Owner')
                                                ->helperText('Name of the account holder where offline payments should be sent.'),

                                            TextInput::make('offline_payments_account_number')
                                                ->label('Account Number')
                                                ->helperText('Bank account number for receiving offline payments.'),

                                            TextInput::make('offline_payments_bank_name')
                                                ->label('Bank Name')
                                                ->helperText('Name of the bank associated with the provided account.'),

                                            TextInput::make('offline_payments_routing_number')
                                                ->label('Routing Number')
                                                ->helperText('Used in some countries to identify the receiving bank.'),

                                            TextInput::make('offline_payments_iban')
                                                ->label('IBAN')
                                                ->helperText('International Bank Account Number (used in EU/UK transfers).'),

                                            TextInput::make('offline_payments_swift')
                                                ->label('SWIFT/BIC Code')
                                                ->helperText('SWIFT or BIC code used for international transfers.'),

                                            Toggle::make('offline_payments_make_notes_field_mandatory')
                                                ->label('Require Notes Field')
                                                ->helperText('Force users to write a note when submitting an offline payment.'),

                                            TextInput::make('offline_payments_minimum_attachments_required')
                                                ->label('Minimum Attachments')
                                                ->helperText('Minimum number of required files (e.g. receipts or transfer proof).'),

                                            Textarea::make('offline_payments_custom_message_box')
                                                ->label('Custom Instructions')
                                                ->helperText('Show extra instructions to users (e.g. bank hours, contact email).')
                                                ->columnSpanFull(),

                                        ]),
                                    ]),
                                ]),
                        ]),

                        Tab::make('Invoices')
                            ->columns(2)
                            ->schema([
                                Toggle::make('invoices_enabled')
                                    ->label('Enable Invoices')
                                    ->columnSpanFull()
                                    ->helperText('Turn this on to automatically generate downloadable invoices for purchases.'),

                                TextInput::make('invoices_sender_name')
                                    ->label('Sender Name')
                                    ->helperText('The name that will appear as the sender on all invoices.'),

                                TextInput::make('invoices_sender_country_name')
                                    ->label('Country')
                                    ->helperText('Country name included in the sender address block.'),

                                TextInput::make('invoices_sender_street_address')
                                    ->label('Street Address')
                                    ->helperText('Street and number used as the invoice sender’s location.'),

                                TextInput::make('invoices_sender_state_name')
                                    ->label('State/Province')
                                    ->helperText('Region or administrative area for the sender’s address.'),

                                TextInput::make('invoices_sender_city_name')
                                    ->label('City')
                                    ->helperText('City name listed in the invoice sender’s address.'),

                                TextInput::make('invoices_sender_postcode')
                                    ->label('Postcode')
                                    ->helperText('Postal or ZIP code for the sender address.'),

                                TextInput::make('invoices_sender_company_number')
                                    ->label('Company Number (Optional)')
                                    ->helperText('Optional. Used for tax or business registry info in some regions.'),

                                TextInput::make('invoices_prefix')
                                    ->label('Invoice Prefix')
                                    ->helperText('Prefix added to invoice numbers (e.g. INV-1001). Helps differentiate invoice types.'),

                        ]),

                        Tab::make('Withdrawals')
                            ->columns(2)
                            ->schema([

                                TextInput::make('withdrawal_payment_methods')
                                    ->label('Available Payment Methods')
                                    ->columnSpanFull()
                                    ->helperText('Comma-separated list of allowed methods (e.g. bank, paypal, crypto).'),

                                Toggle::make('withdrawal_allow_fees')
                                    ->label('Enable Withdrawal Fees')
                                    ->helperText('If enabled, a fee will be applied to each withdrawal request.'),

                                TextInput::make('withdrawal_default_fee_percentage')
                                    ->label('Default Fee Percentage')
                                    ->helperText('Percentage deducted from each withdrawal (e.g. 5 for 5%).'),

                                Toggle::make('withdrawal_enable_stripe_connect')
                                    ->label('Enable Stripe Connect')
                                    ->helperText('Allow users to withdraw via their own Stripe account using Connect.'),

                                TextInput::make('withdrawal_stripe_connect_webhooks_secret')
                                    ->label('Stripe Connect Webhook Secret')
                                    ->helperText('Used to verify secure events from Stripe Connect.'),

                                Toggle::make('withdrawal_allow_only_for_verified')
                                    ->label('Only Allow Withdrawals for Verified Users')
                                    ->columnSpanFull()
                                    ->helperText('Restricts withdrawals to users who have verified their identity.'),

                                TextInput::make('withdrawal_min_amount')
                                    ->label('Minimum Withdrawal Amount')
                                    ->helperText('The smallest balance a user needs to request a payout.'),

                                TextInput::make('withdrawal_max_amount')
                                    ->label('Maximum Withdrawal Amount')
                                    ->helperText('The largest payout allowed in a single withdrawal request.'),

                                Textarea::make('withdrawal_custom_message_box')
                                    ->label('Custom Withdrawal Message')
                                    ->helperText('Optional: show notes or reminders near the withdrawal form.')
                                    ->columnSpanFull(),

                        ]),

                        Tab::make('Tax information')
                            ->columns(2)
                            ->schema([
                                Toggle::make('tax_info_dac7_enabled')
                                    ->label('Enable DAC7 Compliance')
                                    ->helperText('Turn on DAC7 reporting support for EU-based platforms and sellers.')->columnSpanFull(),

                                Toggle::make('tax_info_dac7_withdrawals_enforced')
                                    ->label('Enforce DAC7 for Withdrawals')
                                    ->helperText('Require DAC7 information from users before allowing withdrawals.')->columnSpanFull(),

                        ]),
                    ]),
            ]);
    }
}
