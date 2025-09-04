<?php

namespace App\Filament\Pages\Settings;

use App\Filament\Traits\HasShieldPageAccess;
use App\Settings\LicenseSettings;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Illuminate\Support\HtmlString;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;

class ManageLicenseSettings extends SettingsPage
{
    use HasShieldPageAccess;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $slug = 'settings/license';

    protected static ?string $title = 'License Settings';

    protected static string $settings = LicenseSettings::class;

    public function beforeSave(): void
    {
        $licenseCode = $this->data['product_license_key'] ?? null;

        if (!$licenseCode) {
            return; // Let Filament handle required field
        }

        $license = \App\Providers\InstallerServiceProvider::gld($licenseCode);

        if (isset($license->error)) {
            throw ValidationException::withMessages([
                'data.product_license_key' => $license->error,
            ]);
        }

        // Valid license — save to installed file
        Storage::disk('local')->put('installed', json_encode(array_merge((array) $license, ['code' => $licenseCode])));

        Notification::make()
            ->title('License verified successfully.')
            ->success()
            ->send();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('License code setup')
                    ->description('Here you can activate the product, according to your license.')
                    ->columns(2)
                    ->schema([

                        Placeholder::make('stripe_webhook_info')
                            ->label('')
                            ->columnSpanFull()
                            ->content(new HtmlString(view('filament.partials.license')->render())),

                        TextInput::make('product_license_key')
                            ->label('Product license code')
                            ->helperText('Your product license key. Can be taken out of your Codecanyon downloads page. ')
                            ->required()
                            ->columnSpanFull(),

                    ]),
            ]);
    }
}
