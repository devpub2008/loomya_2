<?php

namespace App\Filament\Pages\Settings;

use App\Filament\Traits\HasShieldPageAccess;
use App\Settings\CodeAndAdsSettings;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageCodeAndAdsSettings extends SettingsPage
{
    use HasShieldPageAccess;

    protected static ?string $navigationIcon = 'heroicon-o-code-bracket';

    protected static ?string $slug = 'settings/custom-code-ads';

    protected static string $settings = CodeAndAdsSettings::class;

    protected static ?string $title = 'Code & Ads Settings';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->columns(1)
                    ->schema([
                        Textarea::make('custom_css')
                            ->label('Custom CSS Code')
                            ->rows(6)
                            ->hint('Paste raw <style> code or rules.'),

                        Textarea::make('custom_js')
                            ->label('Custom JS Code')
                            ->rows(6)
                            ->hint('Paste raw <script> code or JavaScript.'),

                        Textarea::make('sidebar_ad_spot')
                            ->label('Sidebar Ad HTML')
                            ->rows(6)
                            ->hint('Will be shown on user feed & profile sidebars.'),
                    ]),
            ]);
    }
}
