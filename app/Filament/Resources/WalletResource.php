<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WalletResource\Pages;
use App\Filament\Traits\HasShieldPermissions;
use App\Model\Wallet;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\NumberConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class WalletResource extends Resource
{
    use HasShieldPermissions;

    protected static ?string $model = Wallet::class;

    protected static ?int $navigationSort = 10;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $navigationGroup = 'Wallets';

    public static function getModelLabel(): string
    {
        return __('admin.resources.wallet.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.wallet.plural');
    }

    public static function form(Form $form): Form
    {
        $uuid = Str::uuid()->toString();
        return $form
            ->schema([
                Section::make(__('admin.resources.wallet.sections.wallet_details'))
                    ->schema([
                        TextInput::make('id')
                            ->label(__('admin.resources.wallet.fields.id'))
                            ->helperText(__('admin.resources.wallet.helper_texts.id'))
                            ->required()
                            ->default($uuid),
                        Select::make('user_id')
                            ->relationship('user', 'username')
                            ->label(__('admin.resources.wallet.fields.user_id'))
                            ->searchable()
                            ->required()
                            ->preload(true),
                        TextInput::make('total')
                            ->label(__('admin.resources.wallet.fields.total'))
                            ->numeric()
                            ->prefix('$')
                            ->default(0)
                            ->required(),
                    ])
                    ->columns(1), // You can change to 2 if you'd like fields side by side
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.username')
                    ->label(__('admin.resources.wallet.fields.user_id'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total')
                    ->label(__('admin.resources.wallet.fields.total'))
                    ->numeric()
                    ->money(getSetting('payments.currency_code'))
                    ->badge()
                    ->color('gray')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin.common.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('admin.common.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                QueryBuilder::make()
                    ->constraints([
                        TextConstraint::make('id')->label(__('admin.resources.wallet.fields.id')),
                        TextConstraint::make('user.username')->label(__('admin.resources.wallet.fields.user_id')),
                        NumberConstraint::make('total')->label(__('admin.resources.wallet.fields.total')),
                        DateConstraint::make('created_at')->label(__('admin.common.created_at')),
                    ])
                    ->constraintPickerColumns(2),
            ], layout: Tables\Enums\FiltersLayout::Dropdown)
            ->deferFilters()
            ->actions([
//                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->visible(fn () => static::canBulkDelete()),
            ])
            ->recordUrl(fn ($record) => static::resolveRecordUrl($record))
            ->defaultSort('created_at', 'desc')
            ->paginated([10, 25, 50]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWallets::route('/'),
            'create' => Pages\CreateWallet::route('/create'),
            'edit' => Pages\EditWallet::route('/{record}/edit'),
            'view' => Pages\ViewWallet::route('/{record}'),
        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
//            Pages\ViewWallet::class,
//            Pages\EditWallet::class,
        ]);
    }
}
