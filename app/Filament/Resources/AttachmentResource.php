<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttachmentResource\Forms\CreateAttachmentForm;
use App\Filament\Resources\AttachmentResource\Pages;
use App\Filament\Traits\HasShieldPermissions;
use App\Model\Attachment;
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

class AttachmentResource extends Resource
{
    use HasShieldPermissions;

    protected static ?string $model = Attachment::class;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $navigationGroup = 'Attachments';

    protected static ?int $navigationSort = 0;

    public static function getModelLabel(): string
    {
        return __('admin.resources.attachment.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.attachment.plural');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make(__('admin.resources.attachment.sections.attachment_details'))
                ->description(__('admin.resources.attachment.sections.attachment_details_descr'))
                ->schema(CreateAttachmentForm::schema())
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('admin.resources.attachment.fields.id'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('user.username')
                    ->label(__('admin.resources.attachment.fields.user_id'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('path')
                    ->label(__('admin.resources.attachment.fields.file'))
                    ->url(fn ($record) => $record->path)
                    ->icon('heroicon-m-arrow-top-right-on-square')
                    ->openUrlInNewTab()
                    ->formatStateUsing(fn ($state) => __('admin.resources.attachment.fields.open')),
                Tables\Columns\TextColumn::make('driver')
                    ->label(__('admin.resources.attachment.fields.driver'))
                    ->formatStateUsing(fn ($state) => Attachment::getDriverName($state))
                    ->badge()
                    ->color('success')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->label(__('admin.resources.attachment.fields.type'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin.resources.attachment.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                QueryBuilder::make()
                    ->constraints([
                        TextConstraint::make('id')->label(__('admin.resources.attachment.fields.id')),
                        TextConstraint::make('type')->label(__('admin.resources.attachment.fields.type')),
                        TextConstraint::make('user.username')->label(__('admin.resources.attachment.fields.user')),
                        TextConstraint::make('message.id')->label(__('admin.resources.attachment.fields.message')),
                        TextConstraint::make('post.id')->label(__('admin.resources.attachment.fields.post')),
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
                Tables\Actions\DeleteBulkAction::make(),
            ])
//            ->recordUrl(function ($record) {
//                return AttachmentResource::getUrl('view', ['record' => $record]);
//            })
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
            'index' => Pages\ListAttachments::route('/'),
            'create' => Pages\CreateAttachment::route('/create'),
            'edit' => Pages\EditAttachment::route('/{record}/edit'),
            'view' => Pages\ViewAttachment::route('/{record}'),
        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
//            Pages\ViewAttachment::class,
//            Pages\EditAttachment::class,
        ]);
    }
}
