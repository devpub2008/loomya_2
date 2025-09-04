<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserTaxResource\Pages;
use App\Filament\Traits\HasShieldPermissions;
use App\Model\UserTax;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class UserTaxResource extends Resource
{
    use HasShieldPermissions;

    protected static ?string $model = UserTax::class;

    protected static ?int $navigationSort = 18;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $navigationGroup = 'FeaturedUsers';

    public static function getModelLabel(): string
    {
        return __('admin.resources.user_tax.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.user_tax.plural');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make(__('admin.resources.user_tax.sections.user'))
                ->description(__('admin.resources.user_tax.sections.user_descr'))
                ->schema([
                    Select::make('user_id')
                        ->label(__('admin.resources.user_tax.fields.user_id'))
                        ->relationship('user', 'username')
                        ->searchable()
                        ->required()
                        ->placeholder(__('admin.resources.user_tax.placeholders.user_id'))
                        ->preload(true),

                    Select::make('issuing_country_id')
                        ->label(__('admin.resources.user_tax.fields.issuing_country_id'))
                        ->relationship('issuingCountry', 'name')
                        ->searchable()
                        ->required()
                        ->placeholder(__('admin.resources.user_tax.placeholders.issuing_country_id'))
                        ->preload(true),
                ])
                ->columns(2),

            Section::make(__('admin.resources.user_tax.sections.tax'))
                ->description(__('admin.resources.user_tax.sections.tax_descr'))
                ->schema([
                    TextInput::make('legal_name')
                        ->label(__('admin.resources.user_tax.fields.legal_name'))
                        ->required()
                        ->maxLength(191),

                    TextInput::make('tax_identification_number')
                        ->label(__('admin.resources.user_tax.fields.tax_identification_number'))
                        ->required()
                        ->maxLength(191),

                    TextInput::make('vat_number')
                        ->label(__('admin.resources.user_tax.fields.vat_number'))
                        ->maxLength(191)
                        ->default(null),

                    Select::make('tax_type')
                        ->label(__('admin.resources.user_tax.fields.tax_type'))
                        ->required()
                        ->options([
                            UserTax::DAC7_TYPE => __('admin.resources.user_tax.options.types.dac7'),
                        ])
                        ->default(UserTax::DAC7_TYPE),
                ])
                ->columns(2),

            Section::make(__('admin.resources.user_tax.sections.personal'))
                ->description(__('admin.resources.user_tax.sections.personal_descr'))
                ->schema([
                    DateTimePicker::make('date_of_birth')
                        ->label(__('admin.resources.user_tax.fields.date_of_birth'))
                        ->required(),

                    Textarea::make('primary_address')
                        ->label(__('admin.resources.user_tax.fields.primary_address'))
                        ->required()
                        ->placeholder(__('admin.resources.user_tax.descriptions.primary_address'))
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
                    ->label(__('admin.resources.user_tax.fields.user_id'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tax_type')
                    ->label(__('admin.resources.user_tax.fields.tax_type'))
                    ->badge()
                    ->color('primary')
                    ->searchable()
                    ->formatStateUsing(fn (string $state) => strtoupper($state)),

                Tables\Columns\TextColumn::make('legal_name')
                    ->label(__('admin.resources.user_tax.fields.legal_name'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('issuingCountry.name')
                    ->label(__('admin.resources.user_tax.fields.issuing_country_id'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('tax_identification_number')
                    ->label(__('admin.resources.user_tax.fields.tax_identification_number'))
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
            ])
            ->filters([
                QueryBuilder::make()
                    ->constraints([
                        TextConstraint::make('user.username')->label(__('admin.resources.user_tax.fields.user_id')),
                        TextConstraint::make('issuingCountry.name')->label(__('admin.resources.user_tax.fields.issuing_country_id')),
                        TextConstraint::make('legal_name')->label(__('admin.resources.user_tax.fields.legal_name')),
                        TextConstraint::make('tax_identification_number')->label(__('admin.resources.user_tax.fields.tax_identification_number')),
                        TextConstraint::make('vat_number')->label(__('admin.resources.user_tax.fields.vat_number')),
                        TextConstraint::make('tax_type')->label(__('admin.resources.user_tax.fields.tax_type')),
                        TextConstraint::make('primary_address')->label(__('admin.resources.user_tax.fields.primary_address')),
                        DateConstraint::make('date_of_birth')->label(__('admin.resources.user_tax.fields.date_of_birth')),
                        DateConstraint::make('created_at')->label(__('admin.common.created_at')),
                    ])
                    ->constraintPickerColumns(2),
            ], layout: Tables\Enums\FiltersLayout::Dropdown)
            ->deferFilters()
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                ExportBulkAction::make()->exports([
                    ExcelExport::make('table')->fromTable(),
                    ExcelExport::make('form')->fromForm(),
                ]),
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
            'index' => Pages\ListUserTaxes::route('/'),
            'create' => Pages\CreateUserTax::route('/create'),
            'edit' => Pages\EditUserTax::route('/{record}/edit'),
            'view' => Pages\ViewUserTax::route('/{record}'),
        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([]);
    }
}
