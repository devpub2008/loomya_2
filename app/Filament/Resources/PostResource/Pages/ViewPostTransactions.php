<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use App\Filament\Resources\TransactionResource\Forms\CreateTransactionForm;
use App\Filament\Traits\HasShieldChildResource;
use App\Model\Transaction;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;

class ViewPostTransactions extends ManageRelatedRecords
{
    use HasShieldChildResource;

    public static function canAccess(array $parameters = []): bool
    {
        return static::hasPermissionTo('view_any');
    }

    protected static string $resource = PostResource::class;

    protected static string $relationship = 'transactions';

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public function getTitle(): string | Htmlable
    {
        return __('admin.resources.transaction.plural');
    }

    public function getBreadcrumb(): string
    {
        return __('admin.resources.transaction.plural');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.resources.transaction.plural');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema(CreateTransactionForm::schema($this->record->id))
            ->columns(1);
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->columns(1)
            ->schema([
                TextEntry::make('id')->label(__('admin.resources.transaction.fields.id')),
                TextEntry::make('sender.username')->label(__('admin.resources.transaction.fields.sender')),
                TextEntry::make('status')
                    ->label(__('admin.resources.transaction.fields.status'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        Transaction::APPROVED_STATUS, Transaction::PARTIALLY_PAID_STATUS, Transaction::REFUNDED_STATUS => 'success',
                        Transaction::INITIATED_STATUS => 'gray',
                        Transaction::DECLINED_STATUS, Transaction::CANCELED_STATUS => 'danger',
                        Transaction::PENDING_STATUS => 'warning',
                        default => 'secondary'
                    }),
                TextEntry::make('payment_provider')
                    ->label(__('admin.resources.transaction.fields.payment_provider'))
                    ->badge()
                    ->color('success'),
                TextEntry::make('type')
                    ->label(__('admin.resources.transaction.fields.type'))
                    ->badge()
                    ->color('warning'),
                TextEntry::make('amount')
                    ->label(__('admin.resources.transaction.fields.amount'))
                    ->money()
                    ->formatStateUsing(fn ($state, $record) => number_format($state, 2).strtoupper($record->currency)),
                TextEntry::make('created_at')->dateTime()->label(__('admin.common.created_at')),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('payment')
            ->columns([
                TextColumn::make('id')
                    ->label(__('admin.resources.transaction.fields.id'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('sender.username')
                    ->label(__('admin.resources.transaction.fields.sender_user_id'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('receiver.username')
                    ->label(__('admin.resources.transaction.fields.receiver_user_id'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('amount')
                    ->label(__('admin.resources.transaction.fields.amount'))
                    ->money(getSetting('payments.currency_code'))
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('gray')
                    ->summarize([
                        Sum::make()->money(getSetting('payments.currency_code')),
                    ]),

                TextColumn::make('status')
                    ->label(__('admin.resources.transaction.fields.status'))
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->formatStateUsing(fn ($state) => __('admin.resources.transaction.status_labels.'.str_replace('-', '_', $state)))
                    ->color(fn ($state) => match ($state) {
                        'approved' => 'success',
                        'pending' => 'warning',
                        'initiated', 'partially-paid' => 'gray',
                        'declined', 'canceled' => 'danger',
                        'refunded' => 'info',
                        default => 'secondary',
                    }),

                TextColumn::make('type')
                    ->label(__('admin.resources.transaction.fields.type'))
                    ->searchable()
                    ->badge()
                    ->color('primary')
                    ->formatStateUsing(fn ($state) => __('admin.resources.transaction.type_labels.'.str_replace('-', '_', $state))),

                TextColumn::make('payment_provider')
                    ->label(__('admin.resources.transaction.fields.payment_provider'))
                    ->searchable()
                    ->badge()
                    ->formatStateUsing(fn ($state) => ucfirst($state))
                    ->color('warning'),

                TextColumn::make('created_at')
                    ->label(__('admin.common.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label(__('admin.common.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label(__('admin.common.create'))
                    ->modalHeading(__('admin.common.create'))
                    ->visible(fn () => static::hasPermissionTo('create')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label(__('admin.common.view'))
                    ->modalHeading(__('admin.common.view'))
                    ->visible(fn () => static::hasPermissionTo('view')),
                Tables\Actions\EditAction::make()
                    ->label(__('admin.common.edit'))
                    ->modalHeading(__('admin.common.edit'))
                    ->visible(fn () => static::hasPermissionTo('update')),
                Tables\Actions\DeleteAction::make()
                    ->label(__('admin.common.delete'))
                    ->modalHeading(__('admin.common.delete'))
                    ->visible(fn () => static::hasPermissionTo('delete')),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()->visible(fn () => static::hasPermissionTo('delete')),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated([10, 25, 50]);
    }
}
