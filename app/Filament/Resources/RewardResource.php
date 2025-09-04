<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RewardResource\Pages;
use App\Filament\Traits\HasShieldPermissions;
use App\Model\Reward;
use App\Model\User;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Symfony\Component\Console\Input\Input;

class RewardResource extends Resource
{
    use HasShieldPermissions;

    protected static ?string $model = Reward::class;

    protected static ?string $navigationGroup = 'Referrals';

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?int $navigationSort = 0;

    public static function getModelLabel(): string
    {
        return __('admin.resources.reward.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.reward.plural');
    }

    protected static function rewardTypeOptions(): array
    {
        return [
            Reward::FEE_PERCENTAGE_REWARD_TYPE => __('admin.resources.reward.label'),
        ];
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make(__('admin.resources.reward.sections.referral_info'))
                ->description(__('admin.resources.reward.sections.referral_info_descr'))
                ->columns(2)
                ->schema(components: [
                    Select::make('from_user_id')
                        ->label(__('admin.resources.reward.fields.from_user_id'))
                        ->relationship('fromUser', 'username')
                        ->searchable()
                        ->required()
                        ->preload(),

                    Select::make('to_user_id')
                        ->label(__('admin.resources.reward.fields.to_user_id'))
                        ->relationship('toUser', 'username')
                        ->searchable()
                        ->required()
                        ->preload(),

                    Select::make('referral_code_usage_id')
                        ->label(__('admin.resources.reward.fields.referral_code_usage_id'))
                        ->searchable()
                        ->required()
                        ->options(function () {
                            return User::query()
                                ->whereNotNull('referral_code')
                                ->pluck('referral_code', 'id')
                                ->toArray();
                        }),

                    TextInput::make('amount')
                        ->label(__('admin.resources.reward.fields.amount'))
                        ->numeric()
                        ->required(),

                    Select::make('transaction_id')
                        ->label(__('admin.resources.reward.fields.transaction_id'))
                        ->relationship('transaction', 'id')
                        ->searchable()
                        ->required()
                        ->preload(),

                    Select::make('reward_type')
                        ->label(__('admin.resources.reward.fields.reward_type'))
                        ->options(static::rewardTypeOptions())
                        ->required()
                        ->default(Reward::FEE_PERCENTAGE_REWARD_TYPE)
                        ->helperText(__('admin.resources.reward.help.reward_type')),

                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('admin.common.id'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('transaction_id')
                    ->label(__('admin.resources.reward.fields.transaction_id'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('fromUser.username')
                    ->label(__('admin.resources.reward.fields.from_user_id'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('toUser.username')
                    ->label(__('admin.resources.reward.fields.to_user_id'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('amount')
                    ->label(__('admin.resources.reward.fields.amount'))
                    ->numeric()
                    ->sortable()
                    ->color('gray')
                ->badge(),

                Tables\Columns\TextColumn::make('reward_type')
                    ->label(__('admin.resources.reward.fields.reward_type'))
                    ->formatStateUsing(fn ($state) => static::rewardTypeOptions()[$state] ?? $state)
                    ->badge()
                    ->color('gray')
                    ->sortable(),

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
            ->filters([
                QueryBuilder::make()
                    ->constraints([
                        TextConstraint::make('fromUser.username')->label(__('admin.resources.reward.fields.from_user_id')),
                        TextConstraint::make('toUser.username')->label(__('admin.resources.reward.fields.to_user_id')),
                        DateConstraint::make('created_at')->label(__('admin.common.created_at')),
                        DateConstraint::make('updated_at')->label(__('admin.common.updated_at')),
                    ])
                    ->constraintPickerColumns(2),
            ], layout: Tables\Enums\FiltersLayout::Dropdown)
            ->deferFilters()
            ->actions([
//                Tables\Actions\EditAction::make(),
//                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
//                Tables\Actions\DeleteBulkAction::make()
//                    ->visible(fn () => static::canBulkDelete()),
            ])
//            ->recordUrl(fn ($record) => static::resolveRecordUrl($record))
            ->defaultSort('created_at', 'desc')
            ->paginated([10, 25, 50]);

    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReward::route('/'),
//            'create' => Pages\CreateReward::route('/create'),
//            'edit' => Pages\EditReward::route('/{record}/edit'),
            'view' => Pages\ViewReward::route('/{record}'),
        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
//            Pages\ViewReward::class,
//            Pages\EditReward::class,
        ]);
    }
}
