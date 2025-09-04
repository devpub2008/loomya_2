<?php

namespace App\Filament\Pages\Settings;

use App\Filament\Traits\HasShieldPageAccess;
use App\Providers\AttachmentServiceProvider;
use App\Settings\AdminSettings;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageAdminSettings extends SettingsPage
{
    use HasShieldPageAccess;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $slug = 'settings/admin';

    protected static string $settings = AdminSettings::class;

    protected static ?string $title = 'Admin Settings';

    public function form(Form $form): Form
    {
        return $form
            ->columns(2)
            ->schema([
                Tabs::make('Admin Settings')
                    ->columnSpanFull()
                    ->tabs([
                        Tabs\Tab::make('Appearance')
                            ->columns(2)
                            ->schema([
                                TextInput::make('title')->label('Admin Title')->columnSpanFull(),

                                FileUpload::make('light_logo')
                                    ->label('Admin light logo')
                                    ->directory('assets')
                                    ->multiple(false)
                                    ->visibility(AttachmentServiceProvider::getAdminFileUploadVisibility())
                                    ->image()
                                    ->imagePreviewHeight(80)
                                    ->maxSize(AttachmentServiceProvider::getUploadMaxFilesize())
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml']),

                                FileUpload::make('dark_logo')
                                    ->label('Admin dark logo')
                                    ->directory('assets')
                                    ->multiple(false)
                                    ->visibility(AttachmentServiceProvider::getAdminFileUploadVisibility())
                                    ->image()
                                    ->imagePreviewHeight(80)
                                    ->maxSize(AttachmentServiceProvider::getUploadMaxFilesize())
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml']),
                            ]),

                        Tabs\Tab::make('Notifications')
                            ->columns(2)
                            ->schema([
                                Toggle::make('send_notifications_on_contact')
                                    ->label('Notify on contact messages')
                                ->columnSpanFull()
                                    ->helperText('If enabled, the admin users will receive an email with the contents of the contact message.'),

                                Toggle::make('send_notifications_on_pending_posts')
                                    ->label('Notify on pending post approvals')
                                ->columnSpanFull()
                                    ->helperText('If enabled, the admin users will receive an email whenever a post is pending approval.'),

                            ]),
                    ]),
            ]);
    }
}
