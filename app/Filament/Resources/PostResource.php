<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Traits\HasShieldPermissions;
use App\Model\Post;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\NumberConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;

class PostResource extends Resource
{
    use HasShieldPermissions;

    protected static ?string $model = Post::class;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $navigationGroup = 'Posts';

    protected static ?int $navigationSort = 0;

    public static function getModelLabel(): string
    {
        return __('admin.resources.post.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.post.plural');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('admin.resources.post.sections.details'))
                    ->description(__('admin.resources.post.sections.details_descr'))
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label(__('admin.resources.post.fields.user_id'))
                            ->relationship('user', 'username')
                            ->searchable()
                            ->required()
                            ->preload()
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('text')
                            ->label(__('admin.resources.post.fields.text'))
                            ->columnSpanFull()
                            ->nullable(),
                    ])
                    ->columns(2),

                Section::make(__('admin.resources.post.sections.settings'))
                    ->description(__('admin.resources.post.sections.settings_descr'))
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->label(__('admin.resources.post.fields.price'))
                            ->numeric()
                            ->default(0)
                            ->prefix('$'),

                        Forms\Components\Select::make('status')
                            ->label(__('admin.resources.post.fields.status'))
                            ->required()
                            ->options([
                                '0' => __('admin.resources.post.status_labels.0'),
                                '1' => __('admin.resources.post.status_labels.1'),
                                '2' => __('admin.resources.post.status_labels.2'),
                            ])
                            ->default(0),

                        Forms\Components\DateTimePicker::make('release_date')
                            ->label(__('admin.resources.post.fields.release_date')),

                        Forms\Components\DateTimePicker::make('expire_date')
                            ->label(__('admin.resources.post.fields.expire_date')),

                        Forms\Components\Toggle::make('is_pinned')
                            ->label(__('admin.resources.post.fields.is_pinned'))
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->numeric()
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.username')
                    ->label(__('admin.resources.post.fields.user_id'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('text')
                    ->label(__('admin.resources.post.fields.text'))
                    ->searchable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('price')
                    ->label(__('admin.resources.post.fields.price'))
                    ->money(getSetting('payments.currency_code'))
                    ->badge()
                    ->color('gray')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label(__('admin.resources.post.fields.status'))
                    ->badge()
                    ->formatStateUsing(fn ($state) => ucfirst(Post::getStatusName($state)))
                    ->color(fn (string $state): string => match ($state) {
                        '0' => 'gray',
                        '1' => 'success',
                        '2' => 'danger',
                    })
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin.common.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('admin.common.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                QueryBuilder::make()
                    ->constraints([
                        TextConstraint::make('text')->label(__('admin.resources.post.fields.text')),
                        TextConstraint::make('status')->label(__('admin.resources.post.fields.status')),
                        NumberConstraint::make('price')->label(__('admin.resources.post.fields.price'))->icon('heroicon-m-currency-dollar'),
                        DateConstraint::make('release_date')->label(__('admin.resources.post.fields.release_date')),
                        DateConstraint::make('expire_date')->label(__('admin.resources.post.fields.expire_date')),
                        DateConstraint::make('created_at')->label(__('admin.common.created_at')),
                    ])
                    ->constraintPickerColumns(2),
            ], layout: Tables\Enums\FiltersLayout::Dropdown)
            ->deferFilters()
            ->actions([
//                Tables\Actions\EditAction::make(),
                ActionGroup::make([
                    Action::make('post_url')
                        ->label(__('admin.resources.post.actions.post_url'))
                        ->icon('heroicon-o-globe-alt')
                        ->url(fn ($record) => route('posts.get', ['post_id' => $record->id, 'username' => $record->user->username]))
                        ->openUrlInNewTab()
                        ->color('info'),
                    Tables\Actions\DeleteAction::make(),

                ])->icon('heroicon-o-ellipsis-horizontal'),

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

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\ViewPostComments::class,
            Pages\ViewPostAttachments::class,
            Pages\ViewPostTransactions::class,
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
            'view' => Pages\ViewPost::route('/{record}'),
            'comments' => Pages\ViewPostComments::route('/{record}/comments'),
            'attachments' => Pages\ViewPostAttachments::route('/{record}/attachments'),
            'transactions' => Pages\ViewPostTransactions::route('/{record}/payments'),
        ];
    }
}
