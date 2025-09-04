<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PublicPageResource\Pages;
use App\Filament\Traits\HasShieldPermissions;
use App\Model\PublicPage;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\BooleanConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\NumberConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class PublicPageResource extends Resource
{
    use HasShieldPermissions;

    protected static ?string $model = PublicPage::class;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $navigationGroup = 'PublicPages';

    protected static ?int $navigationSort = 0;

    public static function getModelLabel(): string
    {
        return __('admin.resources.public_page.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.public_page.plural');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)->schema([
                    Section::make(__('admin.resources.public_page.sections.page_details'))
                        ->description(__('admin.resources.public_page.sections.page_details_descr'))
                        ->schema([
                            TextInput::make('title')
                                ->label(__('admin.resources.public_page.fields.title'))
                                ->required()
                                ->maxLength(191)
                                ->helperText(__('admin.resources.public_page.fields.title_helper')),

                            TextInput::make('short_title')
                                ->label(__('admin.resources.public_page.fields.short_title'))
                                ->maxLength(191)
                                ->default('')
                                ->hintIcon('heroicon-o-question-mark-circle', tooltip: __('admin.resources.public_page.fields.short_title_helper')),

                            TextInput::make('slug')
                                ->label(__('admin.resources.public_page.fields.slug'))
                                ->required()
                                ->maxLength(191)
                                ->helperText(__('admin.resources.public_page.fields.slug_helper')),

                            RichEditor::make('content')
                                ->columnSpanFull()
                                ->toolbarButtons([
                                    'h3', 'bold', 'italic', 'underline', 'strike', 'link', 'bulletList', 'orderedList', 'blockquote', 'codeBlock',
                                ]),
                        ])
                        ->columnSpan(2),

                    Section::make(__('admin.resources.public_page.sections.display_settings'))
                        ->description(__('admin.resources.public_page.sections.display_settings_descr'))
                        ->schema([
                            Toggle::make('shown_in_footer')
                                ->label(__('admin.resources.public_page.fields.shown_in_footer'))
                                ->helperText(__('admin.resources.public_page.fields.shown_in_footer_helper')),

                            Toggle::make('is_tos')
                                ->label(__('admin.resources.public_page.fields.is_tos'))
                                ->helperText(__('admin.resources.public_page.fields.is_tos_helper')),

                            Toggle::make('is_privacy')
                                ->label(__('admin.resources.public_page.fields.is_privacy'))
                                ->helperText(__('admin.resources.public_page.fields.is_privacy_helper')),

                            Toggle::make('show_last_update_date')
                                ->label(__('admin.resources.public_page.fields.show_last_update_date'))
                                ->helperText(__('admin.resources.public_page.fields.show_last_update_date_helper')),

                            TextInput::make('page_order')
                                ->label(__('admin.resources.public_page.fields.page_order'))
                                ->required()
                                ->numeric()
                                ->default(0)
                                ->helperText(__('admin.resources.public_page.fields.page_order_helper')),
                        ])
                        ->columnSpan(1),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('admin.resources.public_page.fields.title'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label(__('admin.resources.public_page.fields.slug'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('page_order')
                    ->label(__('admin.resources.public_page.fields.page_order'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('shown_in_footer')
                    ->label(__('admin.resources.public_page.fields.shown_in_footer'))
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_tos')
                    ->label(__('admin.resources.public_page.fields.is_tos'))
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_privacy')
                    ->label(__('admin.resources.public_page.fields.is_privacy'))
                    ->boolean(),
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
                        TextConstraint::make('slug')->label(__('admin.resources.public_page.fields.slug')),
                        TextConstraint::make('title')->label(__('admin.resources.public_page.fields.title')),
                        TextConstraint::make('short_title')->label(__('admin.resources.public_page.fields.short_title')),
                        NumberConstraint::make('page_order')->label(__('admin.resources.public_page.fields.page_order')),
                        BooleanConstraint::make('shown_in_footer')->label(__('admin.resources.public_page.fields.shown_in_footer')),
                        BooleanConstraint::make('is_tos')->label(__('admin.resources.public_page.fields.is_tos')),
                        BooleanConstraint::make('is_privacy')->label(__('admin.resources.public_page.fields.is_privacy')),
                        BooleanConstraint::make('show_last_update_date')->label(__('admin.resources.public_page.fields.show_last_update_date')),
                        DateConstraint::make('created_at')->label(__('admin.common.created_at')),
                    ])
                    ->constraintPickerColumns(2),
            ], layout: Tables\Enums\FiltersLayout::Dropdown)
            ->deferFilters()
            ->actions([
//                Tables\Actions\EditAction::make(),
                ActionGroup::make([
                    Action::make('page_url')
                        ->label(__('admin.common.page_url'))
                        ->icon('heroicon-o-globe-alt')
                        ->url(fn ($record) => route('pages.get', ['slug' => $record->slug]))
                        ->openUrlInNewTab()
                        ->color('info'),
                    Tables\Actions\DeleteAction::make(),
                ]),
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
            'index' => Pages\ListPublicPages::route('/'),
            'create' => Pages\CreatePublicPage::route('/create'),
            'edit' => Pages\EditPublicPage::route('/{record}/edit'),
            'view' => Pages\ViewPublicPage::route('/{record}'),
        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
//            Pages\ViewPublicPage::class,
//            Pages\EditPublicPage::class,
        ]);
    }
}
