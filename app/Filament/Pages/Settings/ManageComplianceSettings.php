<?php

namespace App\Filament\Pages\Settings;

use App\Filament\Traits\HasShieldPageAccess;
use App\Settings\ComplianceSettings;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageComplianceSettings extends SettingsPage
{
    use HasShieldPageAccess;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    protected static ?string $slug = 'settings/compliance';

    protected static string $settings = ComplianceSettings::class;

    protected static ?string $title = 'Compliance Settings';

    public function form(Form $form): Form
    {
        return $form
            ->columns(2)
            ->schema([
                Tabs::make('Compliance Settings')
                    ->columnSpanFull()
                    ->tabs([

                        Tabs\Tab::make('General')
                            ->columns(2)
                            ->schema([
                                Toggle::make('enable_age_verification_dialog')
                                    ->label('Enable Age Verification Dialog')
                                ->helperText("Site entry consent dialog, to be used for NSWF content."),
                                TextInput::make('age_verification_cancel_url')
                                    ->label('Cancel Redirect URL')
                                ->helperText("The cancel button URL for the entry consent dialog."),
                                Toggle::make('enable_cookies_box')
                                    ->label('Enable Cookies Box')
                                    ->helperText("Cookies consent dialog box to be used for GDPR.")
                                    ->columnSpanFull(),
                            ]),

                        Tabs\Tab::make('Post & Creator Limits')
                            ->columns(2)
                            ->schema([
                                TextInput::make('admin_approved_posts_limit')
                                    ->numeric()
                                    ->label('Admin Approved Posts Limit')
                                ->helperText("The number of posts that needs admin approval. After this number of posts has been reached, the creator can post freely (value = 0 means no limit)."),
                                TextInput::make('minimum_posts_until_creator')
                                    ->numeric()
                                    ->label('Posts Before Monetization')
                                ->helperText("The minimum number of posts for users to be able to earn money. Users won`t be able to receive money until they reach this limit (value = 0 means no limit)."),
                                TextInput::make('minimum_posts_deletion_limit')
                                    ->numeric()
                                    ->label('Minimum Deletion Limit')
                                ->helperText("The minimum posts deletion limit for creators. Enforce them to have a minimum number of posts on their accounts (value = 0 means no limit)."),
                                TextInput::make('monthly_posts_before_inactive')
                                    ->numeric()
                                    ->label('Monthly Post Requirement')
                                ->helperText("The minimum monthly posts number a creator must publish before having his account marked as inactive. If value = 0, no inactivity rule will be applied."),
                                Toggle::make('disable_creators_ppv_delete')
                                    ->label('Prevent Deletion of Purchased PPV')
                                    ->helperText("If enabled, creators won't be able to delete paid PPV content (paid posts/messages) if already paid by a customer."),
                                Toggle::make('allow_text_only_ppv')
                                    ->label('Allow Text-only PPV')
                                    ->helperText("If enabled, creators will be allowed to sell text-only PPV messages & posts (no media requirements)."),
                                ]),

//                        Tabs\Tab::make('Content Restrictions')
//                            ->columns(2)
//                            ->schema([
//
//                            ]),

                        Tabs\Tab::make('Verification Requirements')
                            ->columns(2)
                            ->schema([
                                Toggle::make('enforce_tos_check_on_id_verify')
                                    ->label('TOS Agreement on ID Verify')
                                ->helperText("If enabled, a TOS & Creator agreement checkbox will be shown on ID-verify page. CCBill compliance requirement."),
                                Toggle::make('enforce_media_agreement_on_id_verify')->label('Media Agreement on ID Verify')
                                ->helperText("If enabled, a media-agreement checkbox will be shown on ID-verify page. CCBill compliance requirement."),

                            ]),
                    ]),
            ]);
    }
}
