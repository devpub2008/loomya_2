<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaxResource\Pages;
use App\Filament\Traits\HasShieldPermissions;
use App\Model\Tax;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\BooleanConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\SelectConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;

class TaxResource extends Resource
{
    use HasShieldPermissions;

    protected static ?string $model = Tax::class;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $navigationGroup = 'Taxes';

    protected static ?int $navigationSort = 0;

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function getModelLabel(): string
    {
        return __('admin.resources.tax.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.tax.plural');
    }

    public static function getAvailableTypes(): array
    {
        return [
            Tax::FIXED_TYPE,
            Tax::EXCLUSIVE_TYPE,
            Tax::INCLUSIVE_TYPE,
        ];
    }

    public static function getTypeOptions(): array
    {
        return collect(self::getAvailableTypes())
            ->mapWithKeys(fn ($type) => [
                $type => __('admin.resources.tax.type_labels.'.$type),
            ])
            ->toArray();
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make(__('admin.resources.tax.sections.details'))
                ->description(__('admin.resources.tax.sections.details_descr'))
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label(__('admin.resources.tax.fields.name'))
                        ->required()
                        ->maxLength(191),
                    Forms\Components\TextInput::make('percentage')
                        ->label(__('admin.resources.tax.fields.percentage'))
                        ->required()
                        ->numeric()
                        ->hintIcon('heroicon-o-question-mark-circle', tooltip: __('If tax type is \'Fixed\' this value represents a fixed amount, otherwise it is a percentage from the payment amount')),
                    Forms\Components\Select::make('countries.name')
                        ->relationship('countries', 'name')
                        ->label(__('admin.resources.tax.fields.countries_name'))
                        ->multiple()
                        ->searchable()
                        ->required()
                        ->preload(true),
                    Forms\Components\Select::make('type')
                        ->label(__('admin.resources.tax.fields.type'))
                        ->required()
                        ->options(self::getTypeOptions()),
                    Forms\Components\Toggle::make('hidden')
                        ->label(__('admin.resources.tax.fields.hidden'))
                        ->required(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('admin.resources.tax.fields.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label(__('admin.resources.tax.fields.type'))
                    ->badge()
                    ->color('gray')
                    ->formatStateUsing(fn ($state) => ucfirst($state))
                    ->searchable(),
                Tables\Columns\TextColumn::make('percentage')
                    ->label(__('admin.resources.tax.fields.percentage'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('countries.name')
                    ->label(__('admin.resources.tax.fields.countries_name'))
                    ->limit(50)
                    ->sortable()
                    ->searchable(),
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
                Tables\Columns\IconColumn::make('hidden')
                    ->label(__('admin.resources.tax.fields.hidden'))
                    ->boolean(),
            ])
            ->filters([
                QueryBuilder::make()
                    ->constraints([
                        SelectConstraint::make('type')
                            ->label(__('admin.resources.tax.fields.type'))
                            ->options(self::getTypeOptions()),

                        TextConstraint::make('name')->label(__('admin.resources.tax.fields.name')),
                        TextConstraint::make('percentage')->label(__('admin.resources.tax.fields.percentage')),
                        TextConstraint::make('countries.name')->label(__('admin.resources.tax.fields.countries_name')),
                        BooleanConstraint::make('hidden')->label(__('admin.resources.tax.fields.hidden')),
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
            'index' => Pages\ListTaxes::route('/'),
            'create' => Pages\CreateTax::route('/create'),
            'edit' => Pages\EditTax::route('/{record}/edit'),
            'view' => Pages\ViewTax::route('/{record}'),
        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
//            Pages\ViewTax::class,
//            Pages\EditTax::class,
        ]);
    }
}
