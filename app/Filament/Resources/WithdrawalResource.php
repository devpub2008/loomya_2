<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WithdrawalResource\Forms\CreateWithdrawalForm;
use App\Filament\Resources\WithdrawalResource\Pages;
use App\Filament\Traits\HasShieldPermissions;
use App\Model\Withdrawal;
use App\Providers\WithdrawalsServiceProvider;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\BooleanConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\NumberConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\SelectConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class WithdrawalResource extends Resource
{
    use HasShieldPermissions;

    protected static ?string $model = Withdrawal::class;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $navigationGroup = 'Withdrawals';

    protected static ?int $navigationSort = 0;

    public static function getModelLabel(): string
    {
        return __('admin.resources.withdrawal.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.withdrawal.plural');
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return __('admin.resources.withdrawal.navigation_badge_tooltip');
    }

    public static function getNavigationBadge(): ?string
    {
        $count = Withdrawal::where('status', Withdrawal::REQUESTED_STATUS)->count();
        return $count > 0 ? $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'primary';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make(__('admin.resources.withdrawal.sections.details'))
                ->description(__('admin.resources.withdrawal.sections.details_descr'))
                ->schema(CreateWithdrawalForm::schema())
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('admin.resources.withdrawal.fields.id'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.username')
                    ->label(__('admin.resources.withdrawal.fields.username'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->label(__('admin.resources.withdrawal.fields.amount'))
                    ->badge()
                    ->money(getSetting('payments.currency_code'))
                    ->color('gray')
                    ->sortable(),
                Tables\Columns\TextColumn::make('fee')
                    ->label(__('admin.resources.withdrawal.fields.fee'))
                    ->badge()
                    ->money(getSetting('payments.currency_code'))
                    ->color('gray')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('admin.resources.withdrawal.fields.status'))
                    ->badge()
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn ($state) => __('admin.resources.withdrawal.status_labels.'.strtolower($state)))
                    ->color(fn ($state) => match ($state) {
                        'approved' => 'success',
                        'requested' => 'warning',
                        'rejected' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\IconColumn::make('processed')
                    ->label(__('admin.resources.withdrawal.fields.processed'))
                    ->sortable()
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin.common.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('admin.common.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([

                QueryBuilder::make()
                    ->constraints([
                        SelectConstraint::make('status')
                            ->label(__('admin.resources.withdrawal.fields.status'))
                            ->options(CreateWithdrawalForm::getTranslatedStatuses()),

                        TextConstraint::make('user.username')->label(__('admin.resources.withdrawal.fields.username')),
                        NumberConstraint::make('amount')->label(__('admin.resources.withdrawal.fields.amount')),
                        NumberConstraint::make('fee')->label(__('admin.resources.withdrawal.fields.fee')),
                        BooleanConstraint::make('processed')->label(__('admin.resources.withdrawal.fields.processed')), TextConstraint::make('payment_method')->label(__('admin.resources.withdrawal.fields.payment_method')),
                        TextConstraint::make('payment_identifier')->label(__('admin.resources.withdrawal.fields.payment_identifier')),
                        TextConstraint::make('stripe_payout_id')->label(__('admin.resources.withdrawal.fields.stripe_payout_id')),
                        TextConstraint::make('stripe_transfer_id')->label(__('admin.resources.withdrawal.fields.stripe_transfer_id')),
                        DateConstraint::make('created_at')->label(__('admin.common.created_at')),
                        DateConstraint::make('updated_at')->label(__('admin.common.updated_at')),
                    ])
                    ->constraintPickerColumns(2),
            ], layout: Tables\Enums\FiltersLayout::Dropdown)
            ->deferFilters()
            ->actions([
//                Tables\Actions\EditAction::make(),
                ActionGroup::make([
                    Action::make('approve_withdrawal')
                        ->label(__('admin.resources.withdrawal.actions.approve'))
                        ->icon('heroicon-o-check-circle')
                        ->action(function ($record, $livewire) {
                            $response = WithdrawalsServiceProvider::approve($record->id);

                            Notification::make()
                                ->title($response['message'] ?? $response['error'])
                                ->{ $response['success'] ? 'success' : 'danger' }()
                                ->send();
                        })
                        ->requiresConfirmation()
                        ->color('success'),

                    Action::make('reject_withdrawal')
                        ->label(__('admin.resources.withdrawal.actions.reject'))
                        ->icon('heroicon-o-x-circle')
                        ->action(function ($record, $livewire) {
                            $response = WithdrawalsServiceProvider::reject($record->id);

                            Notification::make()
                                ->title($response['message'] ?? $response['error'])
                                ->{ $response['success'] ? 'success' : 'danger' }()
                                ->send();
                        })
                        ->requiresConfirmation()
                        ->color('danger'),

                    Tables\Actions\DeleteAction::make(),
                ])
                    ->icon('heroicon-o-ellipsis-horizontal')
                    ->visible(fn () => Auth::user()?->hasRole('admin')),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWithdrawals::route('/'),
            'create' => Pages\CreateWithdrawal::route('/create'),
            'edit' => Pages\EditWithdrawal::route('/{record}/edit'),
            'view' => Pages\ViewWithdrawal::route('/{record}'),
        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([]);
    }
}
