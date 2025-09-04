<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PollResource\Pages;
use App\Filament\Traits\HasShieldPermissions;
use App\Model\Poll;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;

class PollResource extends Resource
{
    use HasShieldPermissions;

    protected static ?string $model = Poll::class;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $navigationGroup = 'Polls';

    protected static ?int $navigationSort = 0;

    public static function getModelLabel(): string
    {
        return __('admin.resources.poll.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.poll.plural');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('admin.resources.poll.sections.post_details'))
                    ->description(__('admin.resources.poll.sections.post_details_descr'))
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label(__('admin.resources.poll.fields.user_id'))
                            ->relationship('user', 'username')
                            ->searchable()
                            ->required()
                            ->preload(true),
                        Forms\Components\Select::make('post_id')
                            ->label(__('admin.resources.poll.fields.post_id'))
                            ->relationship('post', 'id')
                            ->searchable()
                            ->required()
                            ->preload(true),
                        Forms\Components\DateTimePicker::make('ends_at')
                            ->label(__('admin.resources.poll.fields.ends_at')),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.username')
                    ->label(__('admin.resources.poll.fields.user_id'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('post.id')
                    ->label(__('admin.resources.poll.fields.post_id'))
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('ends_at')
                    ->label(__('admin.resources.poll.fields.ends_at'))
                    ->dateTime()
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
                        TextConstraint::make('poll.id')->label(__('admin.resources.poll.filters.poll.id')),
                        TextConstraint::make('user.username')->label(__('admin.resources.poll.filters.user.username')),
                        DateConstraint::make('ends_at')->label(__('admin.resources.poll.fields.ends_at')),
                        DateConstraint::make('created_at')->label(__('admin.common.created_at')),
                        DateConstraint::make('updated_at')->label(__('admin.common.updated_at')),
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
            'index' => Pages\ListPolls::route('/'),
            'create' => Pages\CreatePoll::route('/create'),
            'edit' => Pages\EditPoll::route('/{record}/edit'),
            'view' => Pages\ViewPoll::route('/{record}'),
            'choices' => Pages\ManagePollAnswers::route('/{record}/choices'),
            'answers' => Pages\ManageUserPollAnswers::route('/{record}/responses'),
        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\ManagePollAnswers::class,
            Pages\ManageUserPollAnswers::class,
        ]);
    }
}
