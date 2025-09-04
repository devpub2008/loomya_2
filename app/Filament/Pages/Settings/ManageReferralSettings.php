<?php

namespace App\Filament\Pages\Settings;

use App\Filament\Traits\HasShieldPageAccess;
use App\Settings\ReferralsSettings;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageReferralSettings extends SettingsPage
{
    use HasShieldPageAccess;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';

    protected static ?string $slug = 'settings/referrals';

    protected static string $settings = ReferralsSettings::class;

    protected static ?string $title = 'Referrals Settings';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->columns(2)
                    ->schema([
                        Toggle::make('enabled')
                            ->label('Enable referral system')
                            ->helperText('Allows users to earn rewards by referring others to the platform.')
                            ->columnSpanFull(),

                        Toggle::make('disable_for_non_verified')
                            ->label('Disable for non-verified users')
                            ->columnSpanFull()
                        ->helperText("If this option is enabled, the referral system will only be available to ID-verified users."),

                        Toggle::make('auto_follow_the_user')
                            ->label('Auto-follow the referrer')
                            ->columnSpanFull()
                        ->helperText("If this option is enabled, the newly created accounts will auto-follow the user that have referred them."),

                        Select::make('referrals_default_link_page')
                            ->label('Default Referral Page')
                            ->options([
                                'profile' => 'User profile page',
                                'register' => 'Register page',
                                'home' => 'Homepage',
                            ])
                        ->required()
                        ->helperText("The default page for which the referral link will be created for."),

                        TextInput::make('apply_for_months')
                            ->label('Apply For (Months)')
                            ->numeric()
                        ->helperText("Represents the number of months since users created their accounts so people who referred them earn a fee from their total earnings."),

                        TextInput::make('fee_percentage')
                            ->label('Fee Percentage')
                            ->numeric()
                        ->helperText("Payout percentage given to users from their referred people total earnings. If set to 0, referred users will generate no income."),

                        TextInput::make('fee_limit')
                            ->label('Fee Limit')
                            ->numeric()
                        ->helperText("Allows users to earn up to the specified limit per referred user."),

                    ]),
            ]);
    }
}
