<?php

namespace App\Filament\Pages\Settings;

use App\Filament\Traits\HasShieldPageAccess;
use App\Providers\AttachmentServiceProvider;
use App\Settings\GeneralSettings;
use Illuminate\Support\Facades\File;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Pages\SettingsPage;
use Filament\Forms\Form;

class ManageGeneralSettings extends SettingsPage
{
    use HasShieldPageAccess;

    protected static string $settings = GeneralSettings::class;

    protected static ?string $slug = 'settings/general';

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $title = 'General Settings';

    public function form(Form $form): Form
    {
        return $form
            ->columns(2)
            ->schema([
                Tabs::make('General Settings')
                    ->columnSpanFull()
                    ->tabs([
                        Tabs\Tab::make('Site')
                            ->schema([
                                TextInput::make('name')->label('Site Name')->required(),
                                TextInput::make('app_url')->label('App URL')->required(),
                                TextInput::make('description')->label('Site Description'),
                                TextInput::make('slogan')->label('Site Slogan'),

                                Toggle::make('enforce_user_identity_checks')
                                    ->label('Enforce ID Check')
                                ->helperText('If enabled, users will only be able to post content & start streams if ID is verified.'),

                                Toggle::make('hide_identity_checks')
                                    ->label('Hide Identity Checks')
                                ->helperText('If enabled, the ID check module link will be hidden from the menus. Useful for one-creator mode.'),

                                Toggle::make('enforce_email_validation')
                                    ->label('Enforce Email Validation')
                                    ->helperText('If enabled, users will be blocked from accessing the site until they verify their email.'),

                                Toggle::make('hide_create_post_menu')
                                    ->label('Hide Create Post')
                                ->helperText('If enabled, the create post module link will be hidden from the menus. Useful for one-creator mode.'),

                                Toggle::make('allow_pwa_installs')
                                    ->label('Allow PWA Installs')
                                ->helperText('Allows users to install the site as a Progressive Web App (PWA) on supported devices.'),

                                Toggle::make('hide_stream_create_menu')
                                    ->label('Hide Create Stream')
                                ->helperText('If enabled, the create stream module link will be hidden from the menus. Useful for one-creator mode.'),

                            ])
                            ->columns(2),

                        Tabs\Tab::make('Branding')
                            ->schema([
                                FileUpload::make('light_logo')
                                    ->label('Light Logo')
                                    ->directory('assets')
                                    ->multiple(false)
                                    ->visibility(AttachmentServiceProvider::getAdminFileUploadVisibility())
                                    ->image()
                                    ->imagePreviewHeight(80)
                                    ->maxSize(AttachmentServiceProvider::getUploadMaxFilesize())
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml']),

                                FileUpload::make('dark_logo')
                                    ->label('Upload Light Logo')
                                    ->directory('assets')
                                    ->multiple(false)
                                    ->visibility(AttachmentServiceProvider::getAdminFileUploadVisibility())
                                    ->image()
                                    ->imagePreviewHeight(80)
                                    ->maxSize(AttachmentServiceProvider::getUploadMaxFilesize())
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml']),

                                FileUpload::make('favicon')
                                    ->label('Upload Favicon')
                                    ->directory('assets')
                                    ->multiple(false)
                                    ->visibility(AttachmentServiceProvider::getAdminFileUploadVisibility())
                                    ->image()
                                    ->imagePreviewHeight(60)
                                    ->maxSize(AttachmentServiceProvider::getUploadMaxFilesize())
                                    ->acceptedFileTypes(['image/png', 'image/x-icon', 'image/svg+xml']),

                                FileUpload::make('default_og_image')
                                    ->label('Upload OG Image')
                                    ->directory('assets')
                                    ->multiple(false)
                                    ->visibility(AttachmentServiceProvider::getAdminFileUploadVisibility())
                                    ->image()
                                    ->imagePreviewHeight(80)
                                    ->maxSize(AttachmentServiceProvider::getUploadMaxFilesize())
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),

                                FileUpload::make('login_page_background_image')
                                    ->label('Upload Login Background')
                                    ->directory('assets')
                                    ->multiple(false)
                                    ->visibility(AttachmentServiceProvider::getAdminFileUploadVisibility())
                                    ->image()
                                    ->imagePreviewHeight(80)
                                    ->maxSize(AttachmentServiceProvider::getUploadMaxFilesize())
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),

                            ])
                            ->columns(2),

                        Tabs\Tab::make('Appearance')
                            ->schema([
                                Toggle::make('allow_theme_switch')
                                    ->label('Allow Theme Switch')
                                    ->helperText('Lets users toggle between light and dark mode manually.'),

                                Radio::make('default_user_theme')
                                    ->label('Default Theme')
                                    ->options([
                                        'light' => 'Light',
                                        'dark' => 'Dark',
                                    ])
                                    ->helperText('The default appearance theme for new visitors and users.'),

                                Toggle::make('allow_direction_switch')
                                    ->label('Allow Direction Switch')
                                    ->helperText('Let users switch between left-to-right (LTR) and right-to-left (RTL) layout.'),

                                Radio::make('default_site_direction')
                                    ->label('Default Direction')
                                    ->options([
                                        'ltr' => 'Left to Right',
                                        'rtl' => 'Right to Left',
                                    ])
                                    ->helperText('The default text direction for the site. RTL is used for Arabic, Hebrew, etc.'),

                                Toggle::make('enable_smooth_page_change_transitions')
                                    ->label('Smooth Page Transitions')
                                    ->helperText('Enable visual fade/slide animations when navigating between pages.'),

                            ])
                            ->columns(2),

                        Tabs\Tab::make('Localization')
                            ->schema([
                                Toggle::make('allow_language_switch')
                                    ->label('Allow Language Switch')
                                    ->helperText('Let users choose their preferred language from the available options.'),

                                Select::make('default_site_language')
                                    ->label('Default Language')
                                    ->options(function () {
                                        $files = File::files(base_path('lang'));
                                        $languages = [];
                                        foreach ($files as $file) {
                                            if ($file->getExtension() === 'json') {
                                                $locale = $file->getFilenameWithoutExtension();
                                                $languages[$locale] = strtoupper($locale); // e.g., 'en' => 'EN'
                                            }
                                        }
                                        return $languages;
                                    })
                                    ->required()
                                    ->searchable()
                                    ->placeholder('Select a language')
                                    ->helperText('The default website language, shown to users by default.'),

                                Toggle::make('use_browser_language_if_available')
                                    ->label('Use Browser Language')
                                    ->helperText('Automatically set the language based on the user’s browser preference.'),

                                Select::make('timezone')
                                    ->label('Timezone')
                                    ->options(
                                        collect(timezone_identifiers_list())
                                            ->mapWithKeys(fn ($tz) => [$tz => $tz])
                                            ->toArray()
                                    )
                                    ->searchable()
                                    ->helperText('Set the default timezone for your site.'),

                            ])
                            ->columns(2),

                        Tabs\Tab::make('Homepage')
                            ->schema([
                                Radio::make('homepage_type')
                                    ->label('Homepage Type')
                                    ->options([
                                        'landing' => 'Landing Page',
                                        'login' => 'Login Page',
                                    ])
                                    ->helperText('Choose what visitors see first when visiting the site without being logged in.'),

                                Radio::make('redirect_page_after_register')
                                    ->label('Redirect After Register')
                                    ->options([
                                        'feed' => 'Feed Page',
                                        'settings' => 'User Settings',
                                    ])
                                    ->helperText('Select where new users are taken immediately after signing up.'),

                                TextInput::make('homepage_redirect')
                                    ->label('Homepage Redirect URL')
                                    ->helperText('Optional: override the default homepage with a custom URL.'),

                            ])
                            ->columns(2),

                    ]),
            ]);
    }
}
