<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\AttachmentResource\Forms\CreateAttachmentForm;
use App\Filament\Resources\PostResource;
use App\Filament\Traits\HasShieldChildResource;
use App\Model\Attachment;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;

class ViewPostAttachments extends ManageRelatedRecords
{
    use HasShieldChildResource;

    public static function canAccess(array $parameters = []): bool
    {
        return static::hasPermissionTo('view_any');
    }

    protected static string $resource = PostResource::class;

    protected static string $relationship = 'attachments';

    protected static ?string $navigationIcon = 'heroicon-o-paper-clip';

    public function getTitle(): string | Htmlable
    {
        return __('admin.resources.attachment.plural');
    }

    public function getBreadcrumb(): string
    {
        return __('admin.resources.attachment.plural');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.resources.attachment.plural');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema(CreateAttachmentForm::schema($this->record->id))
            ->columns(2);
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->columns(1)
            ->schema([
                TextEntry::make('path')
                    ->label(__('admin.resources.attachment.fields.open'))
                    ->url(fn ($record) => $record->path)
                    ->openUrlInNewTab()
                    ->icon('heroicon-m-arrow-top-right-on-square')
                    ->formatStateUsing(fn ($state) => __('admin.resources.attachment.fields.open')),
                TextEntry::make('user.email')
                    ->label(__('admin.resources.attachment.fields.user_id')),
                TextEntry::make('driver')
                    ->label(__('admin.resources.attachment.fields.driver'))
                    ->formatStateUsing(fn ($state) => Attachment::getDriverName($state))
                    ->badge()
                    ->color('success'),
                TextEntry::make('type')
                    ->label(__('admin.resources.attachment.fields.type')),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->label(__('admin.common.created_at')),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('message')
            ->columns([
                Tables\Columns\TextColumn::make('path')
                    ->label(__('admin.resources.attachment.fields.open'))
                    ->url(fn ($record) => $record->path)
                    ->icon('heroicon-m-arrow-top-right-on-square')
                    ->openUrlInNewTab()
                    ->formatStateUsing(fn ($state) => __('admin.resources.attachment.fields.open')),
                Tables\Columns\TextColumn::make('user.username')
                    ->label(__('admin.resources.attachment.fields.user_id'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('driver')
                    ->label(__('admin.resources.attachment.fields.driver'))
                    ->formatStateUsing(fn ($state) => Attachment::getDriverName($state))
                    ->badge()
                    ->color('success'),
                Tables\Columns\TextColumn::make('type')
                    ->label(__('admin.resources.attachment.fields.type'))
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
