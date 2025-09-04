<?php

namespace App\Filament\Resources\UserMessageResource\Pages;

use App\Filament\Resources\TransactionResource\Forms\CreateTransactionForm;
use App\Filament\Resources\UserMessageResource;
use App\Filament\Traits\HasShieldChildResource;
use App\Model\Transaction;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;

class ViewUserMessageTransactions extends ManageRelatedRecords
{
    use HasShieldChildResource;

    protected static string $resource = UserMessageResource::class;

    protected static string $relationship = 'transactions';

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function canAccess(array $parameters = []): bool
    {
        return static::hasPermissionTo('view_any');
    }

    public function getTitle(): string | Htmlable
    {
        return __('admin.resources.transaction.plural');
    }

    public function getBreadcrumb(): string
    {
        return __('admin.resources.user_message.transactions.breadcrumb');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.resources.user_message.transactions.nav_label');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema(CreateTransactionForm::schema(null, null, null, $this->record->id))
            ->columns(1);
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->columns(1)
            ->schema([
                TextEntry::make('id'),
                TextEntry::make('sender.email')->label(__('admin.resources.user_message.transactions.fields.payer')),
                TextEntry::make('status')
                    ->label(__('admin.resources.user_message.transactions.fields.status'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        Transaction::APPROVED_STATUS, Transaction::PARTIALLY_PAID_STATUS, Transaction::REFUNDED_STATUS => 'success',
                        Transaction::INITIATED_STATUS => 'gray',
                        Transaction::DECLINED_STATUS, Transaction::CANCELED_STATUS => 'danger',
                        Transaction::PENDING_STATUS => 'warning',
                    }),
                TextEntry::make('payment_provider')
                    ->label(__('admin.resources.user_message.transactions.fields.payment_provider'))
                    ->badge()
                    ->color('success'),
                TextEntry::make('type')
                    ->label(__('admin.resources.user_message.transactions.fields.type'))
                    ->badge()
                    ->color('warning'),
                TextEntry::make('amount')
                    ->label(__('admin.resources.user_message.transactions.fields.amount'))
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
                Tables\Columns\TextColumn::make('id')
                    ->label(__('admin.resources.user_message.transactions.fields.id'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sender.username')
                    ->label(__('admin.resources.user_message.transactions.fields.sender'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('admin.resources.user_message.transactions.fields.status'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        Transaction::APPROVED_STATUS, Transaction::PARTIALLY_PAID_STATUS, Transaction::REFUNDED_STATUS => 'success',
                        Transaction::INITIATED_STATUS => 'gray',
                        Transaction::DECLINED_STATUS, Transaction::CANCELED_STATUS => 'danger',
                        Transaction::PENDING_STATUS => 'warning',
                    })
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn ($state) => ucfirst($state)),
                Tables\Columns\TextColumn::make('type')
                    ->label(__('admin.resources.user_message.transactions.fields.type'))
                    ->badge()
                    ->color('warning')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn ($state) => ucfirst($state)),
                Tables\Columns\TextColumn::make('payment_provider')
                    ->label(__('admin.resources.user_message.transactions.fields.payment_provider'))
                    ->badge()
                    ->color('success')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn ($state) => ucfirst($state)),
                Tables\Columns\TextColumn::make('amount')
                    ->label(__('admin.resources.user_message.transactions.fields.amount'))
                    ->badge()
                    ->money()
                    ->color('gray')
                    ->searchable()
                    ->sortable()
                    ->summarize([
                        Tables\Columns\Summarizers\Sum::make()
                            ->money(),
                    ]),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label(__('admin.common.created_at'))
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label(__('admin.resources.user_message.transactions.actions.create'))
                    ->modalHeading(__('admin.resources.user_message.transactions.actions.create'))
                    ->visible(fn () => static::hasPermissionTo('create')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                ->visible(fn () => static::hasPermissionTo('view')),
                Tables\Actions\EditAction::make()
                ->visible(fn () => static::hasPermissionTo('update')),
                Tables\Actions\DeleteAction::make()
                ->visible(fn () => static::hasPermissionTo('delete')),
            ])
            ->groupedBulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->paginated([10, 25, 50]);
    }
}
