<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CountryResource\Pages;
use App\Filament\Traits\HasShieldPermissions;
use App\Model\Country;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;

class CountryResource extends Resource
{
    use HasShieldPermissions;

    protected static ?string $model = Country::class;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $navigationGroup = 'Countries';

    protected static ?int $navigationSort = 0;

    public static function getModelLabel(): string
    {
        return __('admin.resources.country.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.country.plural');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make(__('admin.resources.country.sections.country_details'))
                ->description(__('admin.resources.country.sections.country_details_descr'))
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label(__('admin.resources.country.fields.name'))
                        ->required()
                        ->maxLength(191),
                    Forms\Components\TextInput::make('country_code')
                        ->label(__('admin.resources.country.fields.country_code'))
                        ->maxLength(191)
                        ->default(null),
                    Forms\Components\TextInput::make('phone_code')
                        ->label(__('admin.resources.country.fields.phone_code'))
                        ->tel()
                        ->maxLength(191)
                        ->default(null),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('admin.resources.country.fields.name'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('country_code')
                    ->label(__('admin.resources.country.fields.country_code'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_code')
                    ->label(__('admin.resources.country.fields.phone_code'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin.resources.country.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('admin.resources.country.fields.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                QueryBuilder::make()
                    ->constraints([
                        TextConstraint::make('name')->label(__('admin.resources.country.fields.name')),
                        TextConstraint::make('country_code')->label(__('admin.resources.country.fields.country_code')),
                        TextConstraint::make('phone_code')->label(__('admin.resources.country.fields.phone_code')),
                        DateConstraint::make('created_at')->label(__('admin.resources.country.fields.created_at')),
                        DateConstraint::make('updated_at')->label(__('admin.resources.country.fields.updated_at')),
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
            'index' => Pages\ListCountries::route('/'),
            'create' => Pages\CreateCountry::route('/create'),
            'edit' => Pages\EditCountry::route('/{record}/edit'),
            'view' => Pages\ViewCountry::route('/{record}'),
        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
//            Pages\ViewCountry::class,
//            Pages\EditCountry::class,
        ]);
    }
}
