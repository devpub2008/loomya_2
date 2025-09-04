<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserBookmarkResource\Pages;
use App\Filament\Traits\HasShieldPermissions;
use App\Model\UserBookmark;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;

class UserBookmarkResource extends Resource
{
    use HasShieldPermissions;

    protected static ?string $model = UserBookmark::class;

    protected static ?int $navigationSort = 15;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $navigationGroup = 'UserBookmarks';

    public static function getModelLabel(): string
    {
        return __('admin.resources.user_bookmark.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.user_bookmark.plural');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make(__('admin.resources.user_bookmark.sections.bookmark_details'))
                ->description(__('admin.resources.user_bookmark.sections.bookmark_details_descr'))
                ->schema([
                    Select::make('user_id')
                        ->label(__('admin.resources.user_bookmark.fields.user_id'))
                        ->relationship('user', 'username')
                        ->searchable()
                        ->placeholder(__('admin.resources.user_bookmark.fields.user_id'))
                        ->required()
                        ->preload(true),

                    Select::make('post_id')
                        ->label(__('admin.resources.user_bookmark.fields.post_id'))
                        ->relationship('post', 'id')
                        ->searchable()
                        ->placeholder(__('admin.resources.user_bookmark.fields.post_id'))
                        ->required()
                        ->preload(true),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.username')
                    ->label(__('admin.resources.user_bookmark.fields.username'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('post.id')
                    ->label(__('admin.resources.user_bookmark.fields.post_id'))
                    ->searchable()
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
                        TextConstraint::make('user.username')->label(__('admin.resources.user_bookmark.fields.username')),
                        TextConstraint::make('post.id')->label(__('admin.resources.user_bookmark.fields.post_id')),
                        DateConstraint::make('created_at')->label(__('admin.resources.user_bookmark.fields.created_at')),
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
            'index' => Pages\ListUserBookmarks::route('/'),
            'create' => Pages\CreateUserBookmark::route('/create'),
            'edit' => Pages\EditUserBookmark::route('/{record}/edit'),
            'view' => Pages\ViewUserBookmark::route('/{record}'),
        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            // Pages\ViewUserBookmark::class,
            // Pages\EditUserBookmark::class,
        ]);
    }
}
