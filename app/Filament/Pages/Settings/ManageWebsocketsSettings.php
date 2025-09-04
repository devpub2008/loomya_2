<?php

namespace App\Filament\Pages\Settings;

use App\Filament\Traits\HasShieldPageAccess;
use App\Settings\WebsocketsSettings;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Pages\SettingsPage;
use Filament\Forms\Form;

class ManageWebsocketsSettings extends SettingsPage
{
    use HasShieldPageAccess;

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    protected static ?string $slug = 'settings/websockets';

    protected static string $settings = WebsocketsSettings::class;

    protected static ?string $title = 'Websockets Settings';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->columns(2)
                    ->schema([
                        Select::make('driver')
                            ->label('Websockets Driver')
                            ->options([
                                'pusher' => 'Pusher',
                                'soketi' => 'Soketi',
                            ])
                            ->required()
                            ->reactive()
                            ->helperText("Select which the websockets driver to use.")
                            ->columnSpanFull(),

                        // === Pusher ===
                        TextInput::make('pusher_app_id')->label('Pusher App ID')->visible(fn ($get) => $get('driver') === 'pusher')->required(),
                        TextInput::make('pusher_app_key')->label('Pusher App Key')->visible(fn ($get) => $get('driver') === 'pusher')->required(),
                        TextInput::make('pusher_app_secret')->label('Pusher App Secret')->visible(fn ($get) => $get('driver') === 'pusher')->required(),
                        Select::make('pusher_app_cluster')
                            ->label('Pusher App Cluster')
                            ->options([
                                'mt1' => 'mt1 (N. Virginia)',
                                'us2' => 'us2 (Ohio)',
                                'us3' => 'us3 (Oregon)',
                                'eu'  => 'eu (Ireland)',
                                'ap1' => 'ap1 (Singapore)',
                                'ap2' => 'ap2 (Mumbai)',
                                'ap3' => 'ap3 (Tokyo)',
                                'ap4' => 'ap4 (Sydney)',
                                'sa1' => 'sa1 (São Paulo)',
                            ])
                            ->searchable()
                            ->required()
                            ->visible(fn ($get) => $get('driver') === 'pusher'),

                        // === Soketi ===
                        TextInput::make('soketi_host_address')->label('Soketi Host Address')->visible(fn ($get) => $get('driver') === 'soketi')->required(),
                        TextInput::make('soketi_host_port')->label('Soketi Host Port')->visible(fn ($get) => $get('driver') === 'soketi')->required(),
                        TextInput::make('soketi_app_id')->label('Soketi App ID')->visible(fn ($get) => $get('driver') === 'soketi')->required(),
                        TextInput::make('soketi_app_key')->label('Soketi App Key')->visible(fn ($get) => $get('driver') === 'soketi')->required(),
                        TextInput::make('soketi_app_secret')->label('Soketi App Secret')->visible(fn ($get) => $get('driver') === 'soketi')->required(),
                        Toggle::make('soketi_use_TSL')->label('Use TSL')->visible(fn ($get) => $get('driver') === 'soketi'),
                    ]),
            ]);
    }
}
