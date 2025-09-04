<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentRequestResource\Pages;
use App\Filament\Traits\HasShieldPermissions;
use App\Model\PaymentRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\NumberConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\SelectConstraint;
use Filament\Tables\Table;

class PaymentRequestResource extends Resource
{
    use HasShieldPermissions;

    protected static ?string $model = PaymentRequest::class;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $navigationGroup = 'PaymentRequests';

    protected static ?int $navigationSort = 0;

    public static function getModelLabel(): string
    {
        return __('admin.resources.payment_request.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.payment_request.plural');
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return __('The number of pending payment requests');
    }

    public static function getNavigationBadge(): ?string
    {
        $count = PaymentRequest::where('status', PaymentRequest::PENDING_STATUS)->count();
        return $count > 0 ? $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'primary';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('admin.resources.payment_request.sections.payment_request'))
                    ->description(__('Deposit request details'))
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label(__('admin.resources.payment_request.fields.user_id'))
                            ->relationship('user', 'username')
                            ->searchable()
                            ->required()
                            ->preload(true),

                        Forms\Components\TextInput::make('amount')
                            ->label(__('admin.resources.payment_request.fields.amount'))
                            ->numeric()
                            ->default(null)
                            ->required(),

                        Forms\Components\Select::make('status')
                            ->label(__('admin.resources.payment_request.fields.status'))
                            ->required()
                            ->options([
                                PaymentRequest::APPROVED_STATUS => __('admin.resources.payment_request.status_labels.approved'),
                                PaymentRequest::REJECTED_STATUS => __('admin.resources.payment_request.status_labels.rejected'),
                                PaymentRequest::PENDING_STATUS => __('admin.resources.payment_request.status_labels.pending'),
                            ])
                            ->default(PaymentRequest::PENDING_STATUS),

                        Forms\Components\Select::make('transaction_id')
                            ->relationship('transaction', 'id')
                            ->searchable()
                            ->label(__('admin.resources.payment_request.fields.transaction_id'))
                            ->required()
                            ->preload(true),

                        Forms\Components\Select::make('type')
                            ->label(__('admin.resources.payment_request.fields.type'))
                            ->required()
                            ->options([
                                PaymentRequest::DEPOSIT_TYPE => __('admin.resources.payment_request.type_labels.deposit'),
                            ])
                            ->default(PaymentRequest::DEPOSIT_TYPE),

                        Forms\Components\TextInput::make('reason')
                            ->label(__('admin.resources.payment_request.fields.reason'))
                            ->maxLength(191)
                            ->default(null),

                        Forms\Components\Textarea::make('message')
                            ->label(__('admin.resources.payment_request.fields.message'))
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.username')
                    ->label(__('admin.resources.payment_request.fields.user_id'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('transaction.id')
                    ->label(__('admin.resources.payment_request.fields.transaction_id'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->label(__('admin.resources.payment_request.fields.amount'))
                    ->money(getSetting('payments.currency_code'))
                    ->badge()
                    ->color('gray')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('admin.resources.payment_request.fields.status'))
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                        default => 'gray',
                    })
                    ->searchable()
                    ->formatStateUsing(fn ($state) => __('admin.resources.payment_request.status_labels.'.$state)),

                Tables\Columns\TextColumn::make('type')
                    ->label(__('admin.resources.payment_request.fields.type'))
                    ->sortable()
                    ->badge()
                    ->color('warning')
                    ->searchable()
                    ->formatStateUsing(fn ($state) => __('admin.resources.payment_request.type_labels.'.$state)),

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
                            ->label(__('admin.resources.payment_request.fields.status'))
                            ->options([
                                'pending' => __('admin.resources.payment_request.status_labels.pending'),
                                'approved' => __('admin.resources.payment_request.status_labels.approved'),
                                'rejected' => __('admin.resources.payment_request.status_labels.rejected'),
                            ]),

                        SelectConstraint::make('type')
                            ->label(__('admin.resources.payment_request.fields.type'))
                            ->options([
                                'deposit' => __('admin.resources.payment_request.type_labels.deposit'),
                            ]),

                        NumberConstraint::make('amount')
                            ->label(__('admin.resources.payment_request.fields.amount'))
                            ->icon('heroicon-m-currency-dollar'),
                        DateConstraint::make('created_at')->label(__('admin.common.created_at')),
                        DateConstraint::make('updated_at')->label(__('admin.common.updated_at')),
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
            'index' => Pages\ListPaymentRequests::route('/'),
            'create' => Pages\CreatePaymentRequest::route('/create'),
            'edit' => Pages\EditPaymentRequest::route('/{record}/edit'),
            'view' => Pages\ViewPaymentRequest::route('/{record}'),
            'attachments' => Pages\ViewPaymentRequestAttachments::route('/{record}/attachments'),
        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\ViewPaymentRequestAttachments::class,
        ]);
    }
}
