<?php

namespace App\Filament\Resources\UserMessageResource\Pages;

use App\Filament\Resources\AttachmentResource\Forms\CreateAttachmentForm;
use App\Filament\Resources\UserMessageResource;
use App\Filament\Traits\HasShieldChildResource;
use App\Filament\Traits\HasShieldPermissions;
use App\Model\Attachment;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;

class ViewUserMessageAttachments extends ManageRelatedRecords
{
    use HasShieldChildResource;

    public static function canAccess(array $parameters = []): bool
    {
        return static::hasPermissionTo('view_any');
    }

    protected static string $resource = UserMessageResource::class;

    protected static string $relationship = 'attachments';

    protected static ?string $navigationIcon = 'heroicon-o-paper-clip';

    public function getTitle(): string | Htmlable
    {
        return __('admin.resources.attachment.plural');

    }

    public function getBreadcrumb(): string
    {
        return __('admin.resources.user_message.attachments.breadcrumb');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.resources.user_message.attachments.nav_label');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema(CreateAttachmentForm::schema(null, $this->record->id))
            ->columns(1);
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->columns(1)
            ->schema([
                TextEntry::make('path')
                    ->label(__('admin.resources.attachment.fields.file'))
                    ->url(fn ($record) => $record->path)
                    ->openUrlInNewTab()
                    ->icon('heroicon-m-arrow-top-right-on-square')
                    ->formatStateUsing(fn ($state) => __('admin.resources.user_message.attachments.file_link')),
                TextEntry::make('user.email'),
                TextEntry::make('driver')
                    ->formatStateUsing(fn ($state) => Attachment::getDriverName($state))
                    ->badge()
                    ->color('success'),
                TextEntry::make('type')->label(__('admin.resources.attachment.fields.type')),
                TextEntry::make('created_at')->dateTime()->label(__('admin.common.created_at')),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('message')
            ->columns([
                Tables\Columns\TextColumn::make('path')
                    ->label(__('admin.resources.attachment.fields.file'))
                    ->url(fn ($record) => $record->path)
                    ->icon('heroicon-m-arrow-top-right-on-square')
                    ->openUrlInNewTab()
                    ->formatStateUsing(fn ($state) => __('admin.resources.user_message.attachments.file_link')),
                Tables\Columns\TextColumn::make('user.username')
                    ->label(__('admin.resources.user_message.fields.sender_id'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('driver')
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
                    ->label(__('admin.resources.user_message.attachments.actions.create'))
                    ->modalHeading(__('admin.resources.user_message.attachments.actions.create'))
                    ->visible(fn () => static::hasPermissionTo('create')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                ->visible(fn () => static::hasPermissionTo('view')),
                Tables\Actions\DeleteAction::make()
                ->visible(fn () => static::hasPermissionTo('delete')),
            ])
            ->groupedBulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->paginated([10, 25, 50]);
    }
}
