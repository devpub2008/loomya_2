<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use App\Filament\Traits\HasShieldPermissions;
use App\Model\Invoice;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Pages\Page;
use Filament\Tables\Actions\Action;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;

class InvoiceResource extends Resource
{
    use HasShieldPermissions;

    protected static ?string $model = Invoice::class;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $navigationGroup = 'Invoices';

    protected static ?int $navigationSort = 0;

    public static function getModelLabel(): string
    {
        return __('admin.resources.invoice.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.invoice.plural');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('admin.resources.invoice.sections.invoice_info'))
                    ->description(__('admin.resources.invoice.sections.invoice_info_descr'))
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('invoice_id')
                            ->label(__('admin.resources.invoice.fields.invoice_id'))
                            ->required()
                            ->maxLength(191),
                        Forms\Components\Textarea::make('data')
                            ->label(__('admin.resources.invoice.fields.data'))
                            ->required()
                            ->columnSpanFull(),
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('invoice_id')
                    ->label(__('admin.resources.invoice.fields.invoice_id'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('transaction.id')
                    ->label(__('admin.resources.invoice.fields.transaction_id'))
                    ->sortable()
                    ->searchable(),
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
                        TextConstraint::make('transaction.id')->label(__('admin.resources.invoice.fields.transaction_id')),
                        DateConstraint::make('updated_at')->label(__('admin.common.updated_at')),
                        DateConstraint::make('created_at')->label(__('admin.common.created_at')),
                    ])
                    ->constraintPickerColumns(2),
            ], layout: Tables\Enums\FiltersLayout::Dropdown)
            ->deferFilters()
            ->actions([
                Action::make('invoice_url')
                    ->label(__('admin.resources.invoice.actions.invoice_url'))
                    ->icon('heroicon-o-globe-alt')
                    ->url(fn ($record) => route('invoices.get', ['id' => $record->id]))
                    ->openUrlInNewTab()
                    ->color('info'),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->visible(fn () => static::canBulkDelete()),
            ])
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
            'index' => Pages\ListInvoices::route('/'),
//            'create' => Pages\CreateInvoice::route('/create'),
//            'edit' => Pages\EditInvoice::route('/{record}/edit'),
            'view' => Pages\ViewInvoice::route('/{record}'),
        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
//            Pages\ViewInvoice::class,
//            Pages\EditInvoice::class,
        ]);
    }
}
