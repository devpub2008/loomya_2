<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeaturedUserResource\Pages;
use App\Filament\Traits\HasShieldPermissions;
use App\Model\FeaturedUser;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;

class FeaturedUserResource extends Resource
{
    use HasShieldPermissions;

    protected static ?string $model = FeaturedUser::class;

    protected static ?int $navigationSort = 17;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $navigationGroup = 'FeaturedUsers';

    public static function getModelLabel(): string
    {
        return __('admin.resources.featured_user.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.featured_user.plural');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make(__('admin.resources.featured_user.sections.main'))
                ->description(__('admin.resources.featured_user.sections.main_descr'))
                ->schema([
                    Select::make('user_id')
                        ->label(__('admin.resources.featured_user.fields.user_id'))
                        ->relationship('user', 'username')
                        ->searchable()
                        ->required()
                        ->placeholder(__('admin.resources.featured_user.fields.user_id'))
                        ->preload(true),
                ])
                ->columns(1),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.username')
                    ->label(__('admin.resources.featured_user.fields.username'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin.common.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('admin.resources.featured_user.fields.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                QueryBuilder::make()
                    ->constraints([
                        TextConstraint::make('username')->label(__('admin.resources.featured_user.fields.username')),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFeaturedUsers::route('/'),
            'create' => Pages\CreateFeaturedUser::route('/create'),
            'edit' => Pages\EditFeaturedUser::route('/{record}/edit'),
            'view' => Pages\ViewFeaturedUser::route('/{record}'),
        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([]);
    }
}
