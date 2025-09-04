<?php

namespace App\Filament\Resources\PollResource\Pages;

use App\Filament\Resources\PollResource;
use App\Filament\Traits\HasShieldChildResource;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;

class ManageUserPollAnswers extends ManageRelatedRecords
{
    use HasShieldChildResource;

    public static function canAccess(array $parameters = []): bool
    {
        return static::hasPermissionTo('view_any');
    }

    protected static string $resource = PollResource::class;

    protected static string $relationship = 'userAnswers';

    protected static ?string $navigationIcon = 'heroicon-o-check';

    public function getTitle(): string | Htmlable
    {
        return __('admin.resources.poll.user_poll_answers.label');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.resources.poll.user_poll_answers.label');
    }

    public function getBreadcrumb(): string
    {
        return __('admin.resources.poll.user_poll_answers.label');
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Select::make('user_id')
                ->label(__('admin.resources.poll.user_poll_answers.fields.user_id'))
                ->relationship('user', 'username')
                ->required()
                ->searchable()
                ->preload(true),

            Select::make('answer_id')
                ->label(__('admin.resources.poll.user_poll_answers.fields.answer_id'))
                ->relationship('answer', 'answer')
                ->required()
                ->searchable()
                ->preload(true),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('user.username')
                    ->label(__('admin.resources.poll.user_poll_answers.fields.user_id'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('answer.answer')
                    ->label(__('admin.resources.poll.user_poll_answers.fields.answer'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin.common.created_at'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label(__('admin.resources.poll.user_poll_answers.actions.create'))
                    ->modalHeading(__('admin.resources.poll.user_poll_answers.actions.create'))
                    ->visible(fn () => static::hasPermissionTo('create')),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalHeading(__('admin.resources.poll.user_poll_answers.actions.edit'))
                    ->visible(fn () => static::hasPermissionTo('update')),
                Tables\Actions\DeleteAction::make()
                    ->modalHeading(__('admin.resources.poll.user_poll_answers.actions.delete'))
                    ->visible(fn () => static::hasPermissionTo('delete')),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()->visible(fn () => static::hasPermissionTo('delete')),
            ])
            ->paginated([10, 25, 50]);
    }
}
