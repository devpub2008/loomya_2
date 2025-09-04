<?php

namespace App\Filament\Pages\Settings;

use App\Filament\Traits\HasShieldPageAccess;
use App\Settings\ColorsSettings;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Pages\SettingsPage;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Filament\Notifications\Notification;
use Illuminate\Support\HtmlString;

class ManageColorsSettings extends SettingsPage
{
    use HasShieldPageAccess;

    protected static ?string $navigationIcon = 'heroicon-o-paint-brush';

    protected static ?string $slug = 'settings/colors';

    protected static string $settings = ColorsSettings::class;

    protected static ?string $title = 'Theme Settings';

    public bool $includeRtlVersion = false;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Customize your theme colors')
                    ->description('Customize your branding by adjusting theme colors.')
                    ->schema([

                        Placeholder::make('stripe_webhook_info')
                            ->label('')
                            ->columnSpanFull()
                            ->content(new HtmlString(view('filament.partials.colors')->render())),

                        ColorPicker::make('theme_color_code')
                            ->label('Primary Theme Color')
                            ->helperText('Used for buttons, accents, and highlights.')
                        ->required(),

                        ColorPicker::make('theme_gradient_from')
                            ->label('Gradient Start Color')
                            ->helperText('Starting color for gradients and background transitions.')
                        ->required(),

                        ColorPicker::make('theme_gradient_to')
                            ->label('Gradient End Color')
                            ->helperText('Ending color for gradients and background transitions.')
                        ->required(),

                        Toggle::make('include_rtl_version')
                            ->label('Include RTL Version')
                            ->helperText('Includes a right-to-left CSS file in the generated theme.')
                            ->live()
                            ->afterStateUpdated(fn ($state) => $this->includeRtlVersion = $state)
                            ->dehydrated(false)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }

    protected function afterSave(): void
    {
        try {
            $state = $this->form->getState();

            $payload = [
                'product' => 'fans',
                'skip_rtl' => !$this->includeRtlVersion,
                'color_code' => ltrim($state['theme_color_code'], '#'),
                'gradient_from' => ltrim($state['theme_gradient_from'], '#'),
                'gradient_to' => ltrim($state['theme_gradient_to'], '#'),
                'code' => getSetting('license.product_license_key'),
            ];

            $response = Http::timeout(300)->get('https://themes-v2.qdev.tech', $payload);
            $json = $response->json();

            if (!$json['success'] ?? false) {
                throw new \Exception($json['error'] ?? 'Theme generation failed.');
            }

            $themePath = $json['path'] ?? null;

            if (!$themePath) {
                throw new \Exception('Theme path missing from server response.');
            }

            if (extension_loaded('zip')) {
                $themeFileUrl = "https://themes-v2.qdev.tech/{$themePath}";
                $zipBinary = file_get_contents($themeFileUrl);

                Storage::disk('local')->put('tmp/theme.zip', $zipBinary);
                $zip = new \ZipArchive;

                $zipPath = storage_path('app/tmp/theme.zip');
                $extractPath = public_path('css/theme');

                if ($zip->open($zipPath) === true) {
                    File::ensureDirectoryExists($extractPath);
                    $zip->extractTo($extractPath);
                    $zip->close();
                }

                Storage::delete('tmp/theme.zip');

                Notification::make()
                    ->title('Theme generated & applied.')
                    ->success()
                    ->send();
            } else {
                $downloadUrl = "https://themes-v2.qdev.tech/{$themePath}";

                Notification::make()
                    ->title('Theme ready for download')
                    ->body("Download from <a href=\"{$downloadUrl}\" class=\"underline\" target=\"_blank\">{$downloadUrl}</a>")
                    ->success()
                    ->send();
            }
        } catch (\Throwable $e) {
            Notification::make()
                ->title('Theme generation failed')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }
}
