<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GlobalAnnouncementResource\Pages;
use App\Filament\Traits\HasShieldPermissions;
use App\Model\GlobalAnnouncement;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\BooleanConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;

class GlobalAnnouncementResource extends Resource
{
    use HasShieldPermissions;

    protected static ?string $model = GlobalAnnouncement::class;

    protected static ?string $modelLabel = 'Announcement';

    protected static ?int $navigationSort = 23;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $navigationGroup = 'Announcements';

    public static function getModelLabel(): string
    {
        return __('admin.resources.global_announcement.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.global_announcement.plural');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Grid::make(3) // desktop = 3 columns
                ->schema([

                    Section::make(__('admin.resources.global_announcement.sections.content'))
                        ->description(__('admin.resources.global_announcement.sections.content_descr'))
                        ->schema([

                            RichEditor::make('content')
                                ->label(__('admin.resources.global_announcement.fields.content'))
                                ->columnSpanFull()
                                ->toolbarButtons([
                                    'h3', 'bold', 'italic', 'underline', 'strike', 'link', 'bulletList', 'orderedList', 'blockquote', 'codeBlock',
                                ]),

                            Forms\Components\Select::make('size')
                                ->label(__('admin.resources.global_announcement.fields.size'))
                                ->required()
                                ->options([
                                    GlobalAnnouncement::REGULAR_SIZE => __('admin.resources.global_announcement.size_labels.regular'),
                                    GlobalAnnouncement::SMALL_SIZE => __('admin.resources.global_announcement.size_labels.small'),
                                ]),

                            Forms\Components\DateTimePicker::make('expiring_at')
                                ->label(__('admin.resources.global_announcement.fields.expiring_at')),
                        ])
                        ->columnSpan(2),

                    Section::make(__('admin.resources.global_announcement.sections.visibility'))
                        ->description(__('admin.resources.global_announcement.sections.visibility_descr'))
                        ->schema([
                            Forms\Components\Toggle::make('is_published')
                                ->label(__('admin.resources.global_announcement.fields.is_published')),
                            Forms\Components\Toggle::make('is_dismissible')
                                ->label(__('admin.resources.global_announcement.fields.is_dismissible')),
                            Forms\Components\Toggle::make('is_sticky')
                                ->label(__('admin.resources.global_announcement.fields.is_sticky')),
                            Forms\Components\Toggle::make('is_global')
                                ->label(__('admin.resources.global_announcement.fields.is_global')),
                        ])
                        ->columnSpan(1),

                ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('content')
                    ->label(__('admin.resources.global_announcement.fields.content'))
                    ->markdown()
                    ->limit(10),
                Tables\Columns\IconColumn::make('is_published')
                    ->label(__('admin.resources.global_announcement.fields.is_published'))
                    ->boolean()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_global')
                    ->label(__('admin.resources.global_announcement.fields.is_global'))
                    ->boolean()
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('size')
                    ->label(__('admin.resources.global_announcement.fields.size'))
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn ($state) => __('admin.resources.global_announcement.size_labels.'.$state)),
                Tables\Columns\TextColumn::make('expiring_at')
                    ->label(__('admin.resources.global_announcement.fields.expiring_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                        TextConstraint::make('content')->label(__('admin.resources.global_announcement.fields.content')),
                        TextConstraint::make('size')->label(__('admin.resources.global_announcement.fields.size')),
                        BooleanConstraint::make('is_published')->label(__('admin.resources.global_announcement.fields.is_published')),
                        BooleanConstraint::make('is_dismissible')->label(__('admin.resources.global_announcement.fields.is_dismissible')),
                        BooleanConstraint::make('is_sticky')->label(__('admin.resources.global_announcement.fields.is_sticky')),
                        BooleanConstraint::make('is_global')->label(__('admin.resources.global_announcement.fields.is_global')),
                        DateConstraint::make('created_at')->label(__('admin.common.created_at')),
                        DateConstraint::make('expiring_at')->label(__('admin.common.expiring_at')),
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
            'index' => Pages\ListGlobalAnnouncements::route('/'),
            'create' => Pages\CreateGlobalAnnouncement::route('/create'),
            'edit' => Pages\EditGlobalAnnouncement::route('/{record}/edit'),
            'view' => Pages\ViewGlobalAnnouncement::route('/{record}'),
        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
//            Pages\ViewGlobalAnnouncement::class,
//            Pages\EditGlobalAnnouncement::class,
        ]);
    }
}
