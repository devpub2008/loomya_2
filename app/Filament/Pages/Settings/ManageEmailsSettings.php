<?php

namespace App\Filament\Pages\Settings;

use App\Filament\Traits\HasShieldPageAccess;
use App\Providers\EmailsServiceProvider;
use App\Providers\SettingsServiceProvider;
use App\Settings\EmailsSettings;
use Filament\Notifications\Notification;
use Illuminate\Validation\ValidationException;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;
use Filament\Forms\Form;

class ManageEmailsSettings extends SettingsPage
{
    use HasShieldPageAccess;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $slug = 'settings/emails';

    protected static string $settings = EmailsSettings::class;

    protected static ?string $title = 'Emails Settings';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
//                    ::make('Email Configuration')
                    ->columns(2)
                    ->schema([
                        Select::make('driver')
                            ->label('Email Driver')
                            ->options([
                                'log' => 'Log',
                                'sendmail' => 'Sendmail',
                                'smtp' => 'SMTP',
                                'mailgun' => 'Mailgun',
                            ])
                            ->required()
                            ->reactive()
                            ->helperText('Select which email driver to use for transactional emails.')
                        ->columnSpanFull(),

                        TextInput::make('from_name')->label('From Name')->required(),
                        TextInput::make('from_address')->label('From Address')->required(),

                        // === Mailgun ===
                        TextInput::make('mailgun_domain')->label('Mailgun Domain')
                    ->helperText("Do not include https://")
                            ->visible(fn ($get) => $get('driver') === 'mailgun')
                            ->required(),
                        TextInput::make('mailgun_secret')->label('Mailgun Secret')->visible(fn ($get) => $get('driver') === 'mailgun')->required(),
                        Select::make('mailgun_endpoint')
                            ->label('Mailgun Endpoint')
                            ->options([
                                'api.mailgun.net'     => 'US: api.mailgun.net',
                                'api.eu.mailgun.net' => 'EU:  api.eu.mailgun.net',
                            ])
                            ->required()
                            ->visible(fn ($get) => $get('driver') === 'mailgun'),

                        // === SMTP ===
                        TextInput::make('smtp_host')->label('SMTP Host')->visible(fn ($get) => $get('driver') === 'smtp')->required(),
                        TextInput::make('smtp_port')->label('SMTP Port')->visible(fn ($get) => $get('driver') === 'smtp')->required(),
                        Select::make('smtp_encryption')
                            ->label('SMTP Encryption')
                            ->options([
                                'tls' => 'TLS',
                                'ssl' => 'SSL',
                            ])
                            ->visible(fn ($get) => $get('driver') === 'smtp')
                            ->default('tls')
                        ->columnSpanFull()->required(),

                        TextInput::make('smtp_username')->label('SMTP Username')->visible(fn ($get) => $get('driver') === 'smtp')->required(),
                        TextInput::make('smtp_password')->label('SMTP Password')->visible(fn ($get) => $get('driver') === 'smtp')->required(),
                    ]),
            ]);
    }

    protected string $previousDriver = 'log';

    protected function beforeSave(): void
    {
        $this->previousDriver = app(EmailsSettings::class)->driver;
    }

    protected function afterSave(): void
    {
        try {
//            var_dump(getSetting('emails.driver'));die();
            SettingsServiceProvider::setUpEmailCredentials();

            EmailsServiceProvider::sendGenericEmail([
                'email' => 'smtp-test-'.rand(1000, 9999).'@mailinator.com',
                'subject' => 'SMTP Test',
                'title' => 'SMTP Test',
                'content' => 'Testing SMTP',
                'button' => [
                    'text' => 'Docs',
                    'url' => 'https://example.com',
                ],
            ]);

//            Notification::make()
//                ->title('Email driver updated and tested successfully.')
//                ->success()
//                ->send();

        } catch (\Throwable $e) {
            // Revert config and settings
            config(['mail.default' => $this->previousDriver]);

            app(EmailsSettings::class)->driver = $this->previousDriver;
            app(EmailsSettings::class)->save();

            $this->driver = $this->previousDriver;

            $this->addError('driver', 'Email test failed: '.$e->getMessage());

            Notification::make()
                ->title('Error')
                ->body($e->getMessage())
                ->danger()
                ->send();

            return;
        }
    }

    protected function getSavedNotificationMessage(): ?string
    {
        return null; // Prevent duplicate toast from Filament
    }
}
