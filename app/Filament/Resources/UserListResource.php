<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserListResource\Pages;
use App\Filament\Traits\HasShieldPermissions;
use App\Model\UserList;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;

class UserListResource extends Resource
{
    use HasShieldPermissions;

    protected static ?string $model = UserList::class;

    protected static ?int $navigationSort = 13;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $navigationGroup = 'UserLists';

    public static function getModelLabel(): string
    {
        return __('admin.resources.user_list.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.user_list.plural');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make(__('admin.resources.user_list.sections.list_details'))
                ->description(__('admin.resources.user_list.sections.list_details_descr'))
                ->schema([
                    TextInput::make('name')
                        ->label(__('admin.resources.user_list.fields.name'))
                        ->placeholder(__('admin.resources.user_list.placeholders.name'))
                        ->required()
                        ->maxLength(100),

                    Select::make('type')
                        ->label(__('admin.resources.user_list.fields.type'))
                        ->required()
                        ->options([
                            UserList::BLOCKED_TYPE => __('admin.resources.user_list.types.blocked'),
                            UserList::FOLLOWING_TYPE => __('admin.resources.user_list.types.following'),
                            UserList::FOLLOWERS_TYPE => __('admin.resources.user_list.types.followers'),
                            UserList::CUSTOM_TYPE => __('admin.resources.user_list.types.custom'),
                        ])
                        ->default(UserList::CUSTOM_TYPE),
                ])
                ->columns(2),

            Section::make(__('admin.resources.user_list.sections.owner'))
                ->description(__('admin.resources.user_list.sections.owner_descr'))
                ->schema([
                    Select::make('user_id')
                        ->label(__('admin.resources.user_list.fields.user_id'))
                        ->relationship('user', 'username')
                        ->searchable()
                        ->required()
                        ->preload(true),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.username')
                    ->label(__('admin.resources.user_list.fields.user_id'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('admin.resources.user_list.fields.name'))
                    ->badge()
                    ->sortable()
                    ->searchable(),
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
                        TextConstraint::make('user.username')->label(__('admin.resources.user_list.fields.user_id')),
                        TextConstraint::make('type')->label(__('admin.resources.user_list.fields.type')),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUserLists::route('/'),
            'create' => Pages\CreateUserList::route('/create'),
            'edit' => Pages\EditUserList::route('/{record}/edit'),
            'view' => Pages\ViewUserList::route('/{record}'),
            'members' => Pages\ViewUserListMembers::route('/{record}/members'),
        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            // Pages\ViewUserList::class,
            // Pages\EditUserList::class,
            Pages\ViewUserListMembers::class,
        ]);
    }
}
