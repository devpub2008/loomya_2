<?php

namespace App\Filament\Pages\Settings;

use App\Filament\Traits\HasShieldPageAccess;
use App\Settings\ProfilesSettings;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageProfilesSettings extends SettingsPage
{
    use HasShieldPageAccess;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $slug = 'settings/profiles';

    protected static string $settings = ProfilesSettings::class;

    protected static ?string $title = 'Profiles Settings';

    public function form(Form $form): Form
    {
        return $form
            ->columns(2)
            ->schema([
                Tabs::make('Profile Settings')
                    ->columnSpanFull()
                    ->tabs([
                        Tabs\Tab::make('General')
                            ->schema([

                                Toggle::make('allow_users_enabling_open_profiles')
                                    ->label('Allow Open Profiles')
                                    ->helperText('Allows users to set their profiles "open", making non-PPV content visible to everyone.'),

                                Toggle::make('allow_profile_qr_code')
                                    ->label('Allow Profile QR Code')
                                    ->helperText("Displays a QR code button on profiles for easy sharing."),

                                Toggle::make('allow_gender_pronouns')
                                    ->label('Allow Gender Pronouns')
                                    ->helperText('Enable users to set gender pronouns on their profile.'),

                                Toggle::make('allow_hyperlinks')
                                    ->label('Allow Hyperlinks in Bio')
                                    ->helperText('Enable links to be clickable in user profile bios.'),

                                Toggle::make('disable_website_link_on_profile')
                                    ->label('Disable Website Link')
                                    ->helperText('Removes the external website link field from user profiles.'),

                                Toggle::make('allow_profile_bio_markdown')
                                    ->label('Enable Markdown in Bio')
                                    ->helperText('Allow users to use Markdown formatting in their profile bio.'),

                                Toggle::make('disable_profile_offers')
                                    ->label('Disable Profile Offers')
                                    ->helperText('Turns off the ability for users to set promotional profile offers.'),

                                Toggle::make('disable_profile_bio_excerpt')
                                    ->label('Disable Bio Excerpt')
                                    ->helperText('If enabled, bio previews/excerpts will not be shown.'),

                                TextInput::make('max_profile_bio_length')
                                    ->label('Max Bio Length')
                                    ->numeric()
                                    ->helperText('Maximum number of chars allowed in the profile bio. If set to 0, no limit will be set.')
                                ->columnSpanFull(),

                            ])
                            ->columns(2),

                        Tabs\Tab::make('Registration')
                            ->schema([
                                Select::make('default_profile_type_on_register')
                                    ->options([
                                        'paid' => 'Paid',
                                        'free' => 'Free',
                                        'open' => 'Open',
                                    ])
                                    ->label('Default Profile Type on Register')
                                    ->required()
                                    ->helperText('Profile type assigned automatically to new users.'),

                                Select::make('default_user_privacy_setting_on_register')
                                    ->options([
                                        'public' => 'Public',
                                        'private' => 'Private',
                                    ])
                                    ->label('Default Privacy Setting')
                                    ->required()
                                    ->helperText('Determines if user profiles are public or private by default.'),

                                TextInput::make('default_users_to_follow')
                                    ->label('Default Users to Follow')
                                    ->helperText('Comma-separated list of usernames to follow automatically on registration.'),

                                TextInput::make('default_wallet_balance_on_register')
                                    ->label('Initial Wallet Balance')
                                    ->numeric()
                                    ->helperText('Virtual currency amount given to users upon sign-up.'),

                            ])
                            ->columns(2),

                        Tabs\Tab::make('Visibility & Tracking')
                            ->schema([

                                Toggle::make('show_online_users_indicator')
                                    ->label('Show Online Status')
                                    ->helperText('Display a real-time online indicator on profiles. WebSockets must be set up.'),

                                Toggle::make('record_users_last_activity_time')
                                    ->label('Track Last Activity Timestamp')
                                    ->helperText('Log the most recent activity time for each user.'),

                                Toggle::make('record_users_last_ip_address')
                                    ->label('Track Last IP Address')
                                    ->helperText('Store the last known IP address for audit or security.'),
                            ])
                            ->columns(2),

                        Tabs\Tab::make('Notifications')
                            ->schema([
                                Toggle::make('enable_new_post_notification_setting')
                                    ->label('Enable Post Notifications')
                                    ->helperText('If enabled, creators can choose whether to send notifications when publishing new posts. Subscribers can also manage their preferences.'),

                                Toggle::make('default_new_post_notification_setting')
                                    ->label('Default Post Notification Setting')
                                    ->helperText('Whether new post notifications are enabled by default on registration.'),
                            ])
                            ->columns(2),
                    ]),
            ]);
    }
}
