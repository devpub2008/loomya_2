<?php

namespace App\Filament\Pages\Settings;

use App\Filament\Traits\HasShieldPageAccess;
use App\Settings\SecuritySettings;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Pages\SettingsPage;
use Filament\Forms\Form;
use Filament\Forms\Components\Grid;

class ManageSecuritySettings extends SettingsPage
{
    use HasShieldPageAccess;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    protected static ?string $slug = 'settings/security';

    protected static string $settings = SecuritySettings::class;

    protected static ?string $title = 'Security Settings';

    public function form(Form $form): Form
    {
        return $form
            ->columns(2)
            ->schema([
                Tabs::make('Security Settings')
                    ->columnSpanFull()
                    ->tabs([
                        Tabs\Tab::make('General')
                            ->columns(2)
                            ->schema([

                                Toggle::make('enable_2fa')
                                    ->label('Enable 2FA (Email)')
                                    ->helperText('Adds a 2FA step via email when users log in.')
                                ->columnSpanFull(),

                                Toggle::make('default_2fa_on_register')
                                    ->label('2FA Enabled by Default')
                                    ->helperText('Automatically enable 2FA for new registrations.')
                                ->columnSpanFull(),

                                Toggle::make('allow_users_2fa_switch')
                                    ->label('Allow Users to Disable 2FA')
                                    ->helperText('Allowing users to be able to change their 2FA settings.')
                                ->columnSpanFull(),

                                Toggle::make('enforce_app_ssl')
                                    ->label('Enforce SSL')
                                    ->helperText('Redirect all traffic to HTTPS.')
                                ->columnSpanFull(),

                            ]),

                        Tabs\Tab::make('Captcha')
                            ->columns(2)
                            ->schema([
                                Select::make('captcha_driver')
                                    ->label('Captcha Driver')
                                    ->options([
                                        'none' => 'None',
                                        'turnstile' => 'Cloudflare Turnstile',
                                        'hcaptcha' => 'hCaptcha',
                                        'recaptcha' => 'Google reCAPTCHA',
                                    ])
                                    ->default('none')
                                    ->reactive()
                                    ->helperText('Select which captcha system to use for authentication forms.')
                                ->columnSpanFull(),

                                // === reCAPTCHA ===
                                TextInput::make('recaptcha_site_key')
                                    ->label('reCAPTCHA Site Key')
                                    ->visible(fn ($get) => $get('captcha_driver') === 'recaptcha'),

                                TextInput::make('recaptcha_site_secret_key')
                                    ->label('reCAPTCHA Secret Key')
                                    ->visible(fn ($get) => $get('captcha_driver') === 'recaptcha'),

                                // === Turnstile ===
                                TextInput::make('turnstile_site_key')
                                    ->label('Turnstile Site Key')
                                    ->visible(fn ($get) => $get('captcha_driver') === 'turnstile'),

                                TextInput::make('turnstile_site_secret_key')
                                    ->label('Turnstile Secret Key')
                                    ->visible(fn ($get) => $get('captcha_driver') === 'turnstile'),

                                // === hCaptcha ===
                                TextInput::make('hcaptcha_site_key')
                                    ->label('hCaptcha Site Key')
                                    ->visible(fn ($get) => $get('captcha_driver') === 'hcaptcha'),

                                TextInput::make('hcaptcha_site_secret_key')
                                    ->label('hCaptcha Secret Key')
                                    ->visible(fn ($get) => $get('captcha_driver') === 'hcaptcha'),
                            ]),

                        Tabs\Tab::make('Geo-blocking')
                            ->columns(2)
                            ->schema([
                                Toggle::make('allow_geo_blocking')
                                    ->label('Enable Geo-blocking')
                                ->helperText("If enabled, users will be able to disallow certain countries to access their content."),

                                TextInput::make('abstract_api_key')
                                    ->label('Geo IP API Key')
                                    ->helperText('Used to detect and block users by region (via Abstract API).')
                                    ->placeholder('Your Abstract API Key'),

                            ]),

                        Tabs\Tab::make('Email deliverability')
                            ->columns(2)
                            ->schema([
                                Toggle::make('enforce_email_valid_check')
                                    ->label('Validate Emails on Register')
                                    ->helperText('Requires valid, deliverable email during registration.'),

                                TextInput::make('email_abstract_api_key')
                                    ->label('Email Abstract API Key')
                                    ->helperText('Used for validating email addresses on signup (via Abstract API).')
                                    ->placeholder('Your Abstract API Key'),

                            ]),

                    ]),
            ]);
    }
}
