<?php

namespace App\Filament\Resources\UserListResource\Pages;

use App\Filament\Resources\UserListMemberResource\Forms\CreateUserListMemberForm;
use App\Filament\Resources\UserListResource;
use App\Filament\Resources\UserMessageResource;
use App\Filament\Traits\HasShieldChildResource;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;

class ViewUserListMembers extends ManageRelatedRecords
{
    use HasShieldChildResource;

    protected static string $resource = UserListResource::class;

    protected static string $relationship = 'members';

    protected static ?string $navigationIcon = 'heroicon-s-user-circle';

    public static function canAccess(array $parameters = []): bool
    {
        return static::hasPermissionTo('view_any');
    }

    public function getTitle(): string | Htmlable
    {
        return __('admin.resources.user_list_member.plural');
    }

    public function getBreadcrumb(): string
    {
        return __('admin.resources.user_list.members.breadcrumb');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.resources.user_list.members.navigation_label');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema(CreateUserListMemberForm::schema($this->record->id))
            ->columns(1);
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->columns(1)
            ->schema([
                TextEntry::make('id')
                    ->label(__('admin.resources.user_list.members.fields.id')),
                TextEntry::make('user.username')
                    ->label(__('admin.resources.user_list.members.fields.username')),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->label(__('admin.resources.user_list.members.fields.created_at')),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('member')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('admin.resources.user_list.members.fields.id'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.username')
                    ->label(__('admin.resources.user_list.members.fields.username'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label(__('admin.resources.user_list.members.fields.created_at'))
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label(__('admin.resources.user_list_member.actions.create'))
                    ->modalHeading(__('admin.resources.user_list_member.actions.create'))
                    ->visible(fn () => static::hasPermissionTo('create')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                ->visible(fn () => static::hasPermissionTo('view')),
                Tables\Actions\EditAction::make()
                ->visible(fn () => static::hasPermissionTo('update')),
                Tables\Actions\DeleteAction::make()
                ->visible(fn () => static::hasPermissionTo('delete')),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                ->visible(fn () => static::hasPermissionTo('delete')),
            ])
            ->paginated([10, 25, 50]);
    }
}
