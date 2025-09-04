<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostCommentResource\Forms\CreatePostCommentForm;
use App\Filament\Resources\PostResource;
use App\Filament\Traits\HasShieldChildResource;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;

class ViewPostComments extends ManageRelatedRecords
{
    use HasShieldChildResource;

    public static function canAccess(array $parameters = []): bool
    {
        return static::hasPermissionTo('view_any');
    }

    protected static string $resource = PostResource::class;

    protected static string $relationship = 'comments';

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    public function getTitle(): string | Htmlable
    {
        return __('admin.resources.post_comment.plural');
    }

    public function getBreadcrumb(): string
    {
        return __('admin.resources.post_comment.plural');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.resources.post_comment.plural');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema(CreatePostCommentForm::schema($this->record->id))
            ->columns(1);
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->columns(1)
            ->schema([
                TextEntry::make('message')
                    ->label(__('admin.resources.post_comment.fields.message')),
                TextEntry::make('author.email')
                    ->label(__('admin.resources.post_comment.fields.author')),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->label(__('admin.common.created_at')),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('admin.resources.post_comment.fields.id'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('message')
                    ->label(__('admin.resources.post_comment.fields.message'))
                    ->limit(50)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('author.username')
                    ->label(__('admin.resources.post_comment.fields.author'))
                    ->searchable()
                    ->sortable(),
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
            ->paginated([10, 25, 50]);
    }
}
