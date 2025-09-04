<?php

namespace App\Filament\Pages\Settings;

use App\Filament\Traits\HasShieldPageAccess;
use App\Settings\StreamsSettings;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Pages\SettingsPage;
use Filament\Forms\Form;

class ManageStreamsSettings extends SettingsPage
{
    use HasShieldPageAccess;

    protected static ?string $navigationIcon = 'heroicon-o-video-camera';

    protected static ?string $slug = 'settings/streams';

    protected static string $settings = StreamsSettings::class;

    protected static ?string $title = 'Streams Settings';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
//                    ::make('Streaming') Section title if desired
                    ->columns(2)
                    ->schema([
                        Select::make('streaming_driver')
                            ->label('Streaming Driver')
                            ->options([
                                'none' => 'None',
                                'pushr' => 'PushrCDN',
                                'livekit' => 'LiveKit',
                            ])
                            ->default('none')         // ✅ auto-selects “None” so no empty placeholder
                            ->required()              // ✅ makes it a required field
                            ->reactive()
                        ->helperText("Select which streaming driver to use.")
                        ->columnSpanFull(),

                        // === Pushr ===
                        TextInput::make('pushr_key')->label('Pushr Key')
                            ->visible(fn ($get) => $get('streaming_driver') === 'pushr')
                        ->helperText("The PushrCDN API Key.")->required(),
                        TextInput::make('pushr_zone_id')->label('Pushr Zone ID')
                            ->visible(fn ($get) => $get('streaming_driver') === 'pushr')
                        ->helperText("The PushrCDN Zone (bucket) ID.")->required(),
                        Select::make('pushr_encoder')
                            ->label('Pushr Encoder Region')
                            ->options([
                                'eu' => 'eu (Europe)',
                            ])
                            ->helperText("Pushr stream encoder. For now, only `eu` (Europe) is available.")
                            ->required()
                            ->visible(fn ($get) => $get('streaming_driver') === 'pushr')
                        ->default('eu')->columnSpanFull(),

                        Toggle::make('pushr_allow_dvr')->label('Enable VODs')->visible(fn ($get) => $get('streaming_driver') === 'pushr'),

                        Toggle::make('pushr_allow_360p')->label('Allow 360p')->visible(fn ($get) => $get('streaming_driver') === 'pushr'),
                        Toggle::make('pushr_allow_mux')->label('Enable MUX')->visible(fn ($get) => $get('streaming_driver') === 'pushr'),
                        Toggle::make('pushr_allow_480p')->label('Allow 480p')->visible(fn ($get) => $get('streaming_driver') === 'pushr'),
                        Toggle::make('pushr_allow_576p')->label('Allow 576p')->visible(fn ($get) => $get('streaming_driver') === 'pushr'),
                        Toggle::make('pushr_allow_720p')->label('Allow 720p')->visible(fn ($get) => $get('streaming_driver') === 'pushr'),
                        Toggle::make('pushr_allow_1080p')->label('Allow 1080p')->visible(fn ($get) => $get('streaming_driver') === 'pushr'),

                        // === LiveKit ===
                        TextInput::make('livekit_api_key')->label('LiveKit API Key')->visible(fn ($get) => $get('streaming_driver') === 'livekit')->required(),
                        TextInput::make('livekit_api_secret')->label('LiveKit API Secret')->visible(fn ($get) => $get('streaming_driver') === 'livekit')->required(),
                        TextInput::make('livekit_ws_url')->label('LiveKit WS URL')->visible(fn ($get) => $get('streaming_driver') === 'livekit')->required(),

                        Toggle::make('allow_free_streams')
                            ->label('Allow Free Streams')
                            ->helperText('If disabled, PPV only streams will be allowed.')
                            ->visible(fn ($get) => in_array($get('streaming_driver'), ['pushr', 'livekit'])),

                        TextInput::make('max_live_duration')
                            ->label('Max Live Duration (hours)')
                            ->numeric()
                            ->minValue(1)
                            ->helperText("The maximum live stream duration (in hours).")
                            ->visible(fn ($get) => in_array($get('streaming_driver'), ['pushr', 'livekit']))
                            ->columnSpanFull()
                            ->required(),

                    ]),
            ]);
    }
}
