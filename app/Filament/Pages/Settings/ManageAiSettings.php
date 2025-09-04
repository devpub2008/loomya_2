<?php

namespace App\Filament\Pages\Settings;

use App\Filament\Traits\HasShieldPageAccess;
use App\Settings\AiSettings;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageAiSettings extends SettingsPage
{
    use HasShieldPageAccess;

    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';

    protected static ?string $slug = 'settings/ai';

    protected static string $settings = AiSettings::class;

    protected static ?string $title = 'AI Settings';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->columns(2)
                    ->schema([
                        Toggle::make('open_ai_enabled')
                            ->label('Enable OpenAI')
                            ->columnSpanFull(),

                        Select::make('open_ai_model')
                            ->label('OpenAI Model')
                            ->options([
                                'o3' => 'OpenAI o3',
                                'o4-mini' => 'OpenAI o4-mini',
                                'gpt-4o' => 'GPT-4o',
                                'gpt-3.5-turbo' => 'GPT-3.5 Turbo',
                            ])
                            ->required()
                        ->helperText("Select the OpenAI model to be used. For more details and pricing, check OpenAi docs."),

                        TextInput::make('open_ai_api_key')
                            ->label('OpenAI API Key')
                            ->required(),

                        TextInput::make('open_ai_completion_max_tokens')
                            ->label('Max Tokens')
                            ->numeric()
                            ->required()
                        ->helperText("Dictates how long the suggestion should be. E.g. 1000 tokens is about 750 words. (shouldn`t exceed 2048 tokens)."),

                        TextInput::make('open_ai_completion_temperature')
                            ->label('Temperature')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(2)
                            ->step(0.1)
                            ->required()
                        ->helperText("What sampling temperature to use, between 0 and 2. Higher values like 0.8 will make the output more random, while lower values like 0.2 will make it more focused and deterministic."),
                    ]),
            ]);
    }
}
