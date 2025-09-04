<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostCommentResource\Forms\CreatePostCommentForm;
use App\Filament\Resources\PostCommentResource\Pages;
use App\Filament\Traits\HasShieldPermissions;
use App\Model\PostComment;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;

class PostCommentResource extends Resource
{
    use HasShieldPermissions;

    protected static ?string $model = PostComment::class;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $navigationGroup = 'Attachments';

    protected static ?int $navigationSort = 0;

    public static function getModelLabel(): string
    {
        return __('admin.resources.post_comment.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.post_comment.plural');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make(__('admin.resources.post_comment.sections.post_comment_details'))
                ->description(__('admin.resources.post_comment.sections.post_comment_details_descr'))
                ->schema(CreatePostCommentForm::schema()),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('author.username')
                    ->label(__('admin.resources.post_comment.fields.author'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('message')
                    ->label(__('admin.resources.post_comment.fields.message'))
                    ->limit(50),
                Tables\Columns\TextColumn::make('post_id')
                    ->label(__('admin.resources.post_comment.fields.post_id'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin.common.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('admin.common.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                QueryBuilder::make()
                    ->constraints([
                        TextConstraint::make('id')->label(__('admin.resources.post_comment.fields.id')),
                        TextConstraint::make('author.username')->label(__('admin.resources.post_comment.fields.author')),
                        TextConstraint::make('message')->label(__('admin.resources.post_comment.fields.message')),
                        TextConstraint::make('post_id')->label(__('admin.resources.post_comment.fields.post_id')),
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPostComments::route('/'),
            'create' => Pages\CreatePostComment::route('/create'),
            'edit' => Pages\EditPostComment::route('/{record}/edit'),
            'view' => Pages\ViewPostComment::route('/{record}'),
        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
//            Pages\ViewPostComment::class,
//            Pages\EditPostComment::class,
        ]);
    }
}
