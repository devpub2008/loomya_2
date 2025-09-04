<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Traits\HasShieldPermissions;
use App\Model\Country;
use App\Model\User;
use App\Model\UserGender;
use App\Providers\AttachmentServiceProvider;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\Action;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\NumberConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\SelectConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\HtmlString;
use Rawilk\FilamentPasswordInput\Password;
use Spatie\Permission\Models\Role;

class UserResource extends Resource
{
    use HasShieldPermissions;

    protected static ?string $model = User::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'Users';

    public static function getModelLabel(): string
    {
        return __('admin.resources.user.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.user.plural');
    }

    public static function getRecordTitle(?Model $record): string
    {
        return $record?->name ?? '-';
    }

    public static function form(Form $form): Form
    {
        $isCreate = $form->getOperation() === 'create';
        $price = str_replace(',', '.', getSetting('payments.default_subscription_price'));

        return $form->schema([

            Section::make(__('admin.resources.user.sections.account_info'))
                ->schema([
                    Grid::make(2)->schema([
                        // can also use ->columnSpan(2)
                        Forms\Components\TextInput::make('name')
                            ->label(__('admin.resources.user.fields.name'))
                            ->required(),
                        Forms\Components\TextInput::make('email')
                            ->label(__('admin.resources.user.fields.email'))
                            ->required(),
                        Forms\Components\TextInput::make('username')
                            ->label(__('admin.resources.user.fields.username'))
                            ->required(),
                        Password::make('password')
                            ->label(__('admin.resources.user.fields.password'))
                            ->autocomplete('new-password')
                            ->required($isCreate)
                            ->dehydrated(fn ($state) => filled($state))
                            ->maxLength(255)
                            ->afterStateHydrated(fn (Password $component, $state) => $component->state(''))
                            ->live()
                            ->rules($isCreate ? ['required', 'min:8'] : ['nullable', 'min:8'])
                            ->regeneratePassword()
                            ->newPasswordLength(16)
                            ->copyable()
                            ->required($isCreate)
                            ->mutateDehydratedStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null),

                        Select::make('roles')
                            ->label(__('admin.resources.user.fields.roles'))
                            ->relationship('roles', 'name')
                            ->preload()
                            ->getOptionLabelFromRecordUsing(fn ($record) => ucfirst($record->name)),

                        Forms\Components\DateTimePicker::make('email_verified_at')
                            ->label(__('admin.resources.user.fields.email_verified_at'))
                            ->seconds(false),
                        Forms\Components\DateTimePicker::make('identity_verified_at')
                            ->label(__('admin.resources.user.fields.identity_verified_at'))
                            ->seconds(false),
                        Forms\Components\DateTimePicker::make('birthdate')
                            ->label(__('admin.resources.user.fields.birthdate'))
                            ->seconds(false),
                    ]),
                ]),

            Section::make(__('admin.resources.user.sections.paywall_info'))
                ->schema([
                    Grid::make(2)->schema([
                        Grid::make(3)->schema([
                            Forms\Components\Toggle::make('paid_profile')
                                ->label(__('admin.resources.user.fields.paid_profile'))
                                ->default(getSetting('profiles.default_profile_type_on_register') == 'paid'),
                            Forms\Components\Toggle::make('public_profile')
                                ->label(__('admin.resources.user.fields.public_profile'))
                                ->default(getSetting('profiles.default_user_privacy_setting_on_register') == 'public'),
                            Forms\Components\Toggle::make('open_profile')
                                ->label(__('admin.resources.user.fields.open_profile'))
                                ->default(getSetting('profiles.default_profile_type_on_register') == 'open'),
                        ]),
                        Forms\Components\TextInput::make('profile_access_price')
                            ->label(__('admin.resources.user.fields.profile_access_price'))
                            ->default($price)->required()->numeric(),
                        Forms\Components\TextInput::make('profile_access_price_3_months')
                            ->label(__('admin.resources.user.fields.profile_access_price_3_months'))
                            ->default($price)->numeric(),
                        Forms\Components\TextInput::make('profile_access_price_6_months')
                            ->label(__('admin.resources.user.fields.profile_access_price_6_months'))
                            ->default($price)->numeric(),
                        Forms\Components\TextInput::make('profile_access_price_12_months')
                            ->label(__('admin.resources.user.fields.profile_access_price_12_months'))
                            ->default($price)->numeric(),
                    ]),
                ]),

            Section::make(__('admin.resources.user.sections.profile_info'))
                ->schema([
                    Grid::make(2)->schema([
                        // Avatar Preview (circular)
                        Placeholder::make('avatar_preview')
                            ->label(__('admin.resources.user.fields.current_avatar'))
                            ->content(fn ($record) => $record && $record->avatar
                                ? new HtmlString('<div class="flex items-center justify-start">
                                    <img src="'.$record->avatar.'" class="rounded-full object-cover border" style="width: 70px; height: 70px;" />
                                </div>')
                                : 'No avatar uploaded')
                            ->visibleOn('edit'),

                        // Avatar Upload
                        FileUpload::make('avatar')
                            ->label(__('admin.resources.user.fields.avatar'))
                            ->directory('users/avatar')
                            ->image()
                            ->imagePreviewHeight(80)
                            ->visibility(AttachmentServiceProvider::getAdminFileUploadVisibility())
                            ->maxSize(getSetting('media.max_avatar_cover_file_size') ? (int)getSetting('media.max_avatar_cover_file_size') * 1024 : 2048)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->multiple(false)
                            ->dehydrated(fn ($state) => filled($state)),

                        // Cover Preview (panoramic)
                        Placeholder::make('cover_preview')
                            ->label(__('admin.resources.user.fields.current_cover'))
                            ->content(fn ($record) => $record && $record->cover
                                ? new HtmlString('<div class="flex items-center justify-start">
                                    <img src="'.$record->cover.'" class="w-full max-w-xl object-cover rounded-md border" style="height: 79px" />
                                </div>')
                                : 'No cover uploaded')
                            ->visibleOn('edit'),

                        // Cover Upload
                        FileUpload::make('cover')
                            ->label(__('admin.resources.user.fields.cover'))
                            ->directory('users/cover')
                            ->image()
                            ->imagePreviewHeight(80) // Optional, for inline preview
                            ->visibility(AttachmentServiceProvider::getAdminFileUploadVisibility())
                            ->maxSize(getSetting('media.max_avatar_cover_file_size') ? (int)getSetting('media.max_avatar_cover_file_size') * 1024 : 2048)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->multiple(false)
                            ->dehydrated(fn ($state) => filled($state)),

                        Forms\Components\Textarea::make('bio')
                            ->label(__('admin.resources.user.fields.bio'))
                            ->rows(3)
                            ->maxLength(500),
                        Forms\Components\TextInput::make('location'),
                        // Gender -- relation
                        Select::make('gender_id')
                            ->label(__('admin.resources.user.fields.location'))
                            ->options(UserGender::all()->pluck('gender_name', 'id')),
                        Forms\Components\TextInput::make('gender_pronoun')
                        ->label(__('admin.resources.user.fields.gender_pronoun')),
                        Forms\Components\TextInput::make('website')
                        ->label(__('admin.resources.user.fields.website')),
                        Forms\Components\TextInput::make('referral_code')
                        ->label(__('admin.resources.user.fields.referral_code')),

                    ]),
                ]),

            Section::make(__('admin.resources.user.sections.withdrawals_info'))
                ->schema([
                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('stripe_account_id')
                            ->label(__('admin.resources.user.fields.stripe_account_id')),
                        //country_id -- relation (stripe connect related)
                        Select::make('country_id')
                            ->label(__('admin.resources.user.fields.country_id'))
                            ->options(Country::where('id', '!=', 1)->pluck('name', 'id'))
                            ->searchable(true),
                        Forms\Components\Toggle::make('stripe_onboarding_verified')
                            ->label(__('admin.resources.user.fields.stripe_onboarding_verified')),

                    ]),
                ]),

            Section::make(__('admin.resources.user.sections.security_info'))
                ->schema([
                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('last_ip')
                        ->label(__('admin.resources.user.fields.last_ip')),
                        Forms\Components\DateTimePicker::make('last_active_at')->seconds(false)
                        ->label(__('admin.resources.user.fields.last_active_at')),
                        Forms\Components\Toggle::make('enable_geoblocking')
                        ->label(__('admin.resources.user.fields.enable_geoblocking')),
                        Forms\Components\Toggle::make('enable_2fa')
                        ->label(__('admin.resources.user.fields.enable_2fa')),

                    ]),
                ]),

            Section::make(__('admin.resources.user.sections.billing_info'))
                ->schema([
                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('billing_address')
                        ->label(__('admin.resources.user.fields.billing_address')),
                        Forms\Components\TextInput::make('first_name')
                        ->label(__('admin.resources.user.fields.first_name')),
                        Forms\Components\TextInput::make('last_name')
                        ->label(__('admin.resources.user.fields.last_name')),
                        Forms\Components\TextInput::make('city')
                        ->label(__('admin.resources.user.fields.city')),
                        Select::make('country')
                            ->label(__('admin.resources.user.fields.country'))
                            ->options(Country::where('id', '!=', 1)->pluck('name', 'name'))
                            ->searchable(true),
                        Forms\Components\TextInput::make('state')
                        ->label(__('admin.resources.user.fields.state')),
                        Forms\Components\TextInput::make('postcode')
                        ->label(__('admin.resources.user.fields.postcode')),
                    ]),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('id')->searchable()->sortable(),
            Tables\Columns\ImageColumn::make('avatar')
                ->label(__('admin.resources.user.fields.avatar'))
                ->circular()
                ->height(40)
                ->width(40),

            Tables\Columns\TextColumn::make('name')
                ->label(__('admin.resources.user.fields.name'))
                ->searchable()->sortable(),
            Tables\Columns\TextColumn::make('email')
                ->label(__('admin.resources.user.fields.email'))
                ->searchable()->sortable(),
            Tables\Columns\TextColumn::make('username')
                ->label(__('admin.resources.user.fields.username'))
                ->searchable()->sortable(),

            Tables\Columns\TextColumn::make('profile_access_price')
                ->label(__('admin.resources.user.fields.profile_access_price'))
                ->searchable()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),

            Tables\Columns\IconColumn::make('email_verified_at')
                ->label(__('admin.resources.user.fields.email_verified_at'))
                ->getStateUsing(fn ($record) => filled($record->email_verified_at))
                ->trueIcon('heroicon-o-check-circle')
                ->falseIcon('heroicon-o-x-circle')
            ->toggleable(isToggledHiddenByDefault: true),

            Tables\Columns\IconColumn::make('identity_verified_at')
                ->label(__('admin.resources.user.fields.identity_verified_at'))
                ->getStateUsing(fn ($record) => filled($record->identity_verified_at))
                ->trueIcon('heroicon-o-check-circle')
                ->falseIcon('heroicon-o-x-circle')
            ->toggleable(isToggledHiddenByDefault: true),

            Tables\Columns\TextColumn::make('created_at')
                ->label(__('admin.common.created_at'))
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),

            Tables\Columns\TextColumn::make('updated_at')
                ->label(__('admin.common.updated_at'))
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),

        ])
            ->actions([
                ActionGroup::make([
                    Action::make('impersonate')
                        ->label(__('admin.resources.user.actions.impersonate'))
                        ->icon('heroicon-o-user')
                        ->url(fn ($record) => route('admin.impersonate', ['id' => $record->id]))
                        ->openUrlInNewTab()
                        ->color('info')
                        ->visible(fn () => Auth::user()?->hasRole('admin')),
                    Action::make('profile_url')
                        ->label(__('admin.resources.user.actions.profile_url'))
                        ->icon('heroicon-o-globe-alt')
                        ->url(fn ($record) => route('profile', ['username'=>$record->username]))
                        ->openUrlInNewTab()
                        ->color('info'),
                    Tables\Actions\DeleteAction::make(),
                ])
                    ->icon('heroicon-o-ellipsis-horizontal')
                    ->iconSize('lg'),
            ])
            ->filters([
                QueryBuilder::make()
                    ->constraints([
                        TextConstraint::make('id')
                        ->label(__('admin.resources.user.fields.id')),
                        TextConstraint::make('username')
                        ->label(__('admin.resources.user.fields.username')),
                        TextConstraint::make('email')
                        ->label(__('admin.resources.user.fields.email')),
                        TextConstraint::make('name')
                        ->label(__('admin.resources.user.fields.name')),
                        SelectConstraint::make('role_id')
                            ->label('Role')
                            ->options(Role::all()->pluck('name', 'id')->toArray()),
                        TextConstraint::make('referral_code')
                        ->label(__('admin.resources.user.fields.referral_code')),
                        NumberConstraint::make('profile_access_price')
                        ->label(__('admin.resources.user.fields.profile_access_price')),
                        TextConstraint::make('gender_pronoun')
                        ->label(__('admin.resources.user.fields.gender_pronoun')),
                        TextConstraint::make('website')
                        ->label(__('admin.resources.user.fields.website')),
                        TextConstraint::make('last_ip')
                        ->label(__('admin.resources.user.fields.last_ip')),
                        DateConstraint::make('email_verified_at')
                        ->label(__('admin.resources.user.fields.email_verified_at')),
                        DateConstraint::make('identity_verified_at')
                        ->label(__('admin.resources.user.fields.identity_verified_at')),
                        DateConstraint::make('birthdate')
                        ->label(__('admin.resources.user.fields.birthdate')),
                        DateConstraint::make('last_active_at')
                        ->label(__('admin.resources.user.fields.last_active_at')),
                        DateConstraint::make('created_at')->label(__('admin.common.created_at')),
                    ])
                    ->constraintPickerColumns(2),
            ], layout: Tables\Enums\FiltersLayout::Dropdown)
            ->deferFilters()
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->visible(fn () => static::canBulkDelete()),
            ])
            ->recordUrl(fn ($record) => static::resolveRecordUrl($record))
            ->defaultSort('created_at', 'desc')
            ->paginated([10, 25, 50]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
            'view' => Pages\ViewUser::route('/{record}'),
        ];
    }
}
