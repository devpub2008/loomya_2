<?php

namespace App\Filament\Pages\Settings;

use App\Filament\Traits\HasShieldPageAccess;
use App\Settings\SocialSettings;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageSocialSettings extends SettingsPage
{
    use HasShieldPageAccess;

    protected static ?string $navigationIcon = 'heroicon-o-share';

    protected static ?string $slug = 'settings/social';

    protected static string $settings = SocialSettings::class;

    protected static ?string $title = 'Social Media Settings';

    public function form(Form $form): Form
    {
        return $form
            ->columns(2)
            ->schema([
                Tabs::make('Social Settings')
                    ->columnSpanFull()
                    ->tabs([
                        Tabs\Tab::make('Social Login')
                            ->columns(2)
                            ->schema([

                                \Filament\Forms\Components\Placeholder::make('social_login_info')
                                    ->columnSpanFull()
                                    ->label('')
                                    ->content(new \Illuminate\Support\HtmlString(view('filament.partials.social-login-info-box')->render())),

                                TextInput::make('facebook_client_id')->label('Facebook Client ID'),
                                TextInput::make('facebook_secret')->label('Facebook Client Secret'),

                                TextInput::make('twitter_client_id')->label('Twitter Client ID'),
                                TextInput::make('twitter_secret')->label('Twitter Client Secret'),

                                TextInput::make('google_client_id')->label('Google Client ID'),
                                TextInput::make('google_secret')->label('Google Client Secret'),
                            ]),

                        Tabs\Tab::make('Social Links')
                            ->columns(2)
                            ->schema([
                                TextInput::make('facebook_url')->label('Facebook URL'),
                                TextInput::make('instagram_url')->label('Instagram URL'),
                                TextInput::make('twitter_url')->label('Twitter URL'),
                                TextInput::make('whatsapp_url')->label('WhatsApp URL'),
                                TextInput::make('tiktok_url')->label('TikTok URL'),
                                TextInput::make('youtube_url')->label('YouTube URL'),
                                TextInput::make('telegram_link')->label('Telegram URL'),
                                TextInput::make('reddit_url')->label('Reddit URL'),
                            ]),
                    ]),
            ]);
    }
}
