<?php

namespace App\Filament\Resources\PollResource\Pages;

use App\Filament\Resources\PollAnswerResource\Forms\CreatePollAnswerForm;
use App\Filament\Resources\PollResource;
use App\Filament\Traits\HasShieldChildResource;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;

class ManagePollAnswers extends ManageRelatedRecords
{
    use HasShieldChildResource;

    public static function canAccess(array $parameters = []): bool
    {
        return static::hasPermissionTo('view_any');
    }

    protected static string $resource = PollResource::class;

    protected static string $relationship = 'answers';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public function getTitle(): string | Htmlable
    {
        return __('admin.resources.poll.poll_answers.poll_choices');
    }

    public function getBreadcrumb(): string
    {
        return __('admin.resources.poll.poll_answers.choices');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.resources.poll.poll_answers.poll_choices');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema(CreatePollAnswerForm::schema($this->record->id))
            ->columns(1);
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->columns(1)
            ->schema([
                TextEntry::make('answer')
                    ->label(__('admin.resources.poll.fields.answer')),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->label(__('admin.common.created_at')),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->label(__('admin.common.updated_at')),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('admin.resources.poll.fields.id'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('answer')
                    ->label(__('admin.resources.poll.fields.answer'))
                    ->limit(50)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin.common.created_at'))
                    ->dateTime()
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label(__('admin.resources.poll.poll_answers.actions.create'))
                    ->modalHeading(__('admin.resources.poll.poll_answers.actions.create'))
                    ->visible(fn () => static::hasPermissionTo('create')),

            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalHeading(__('admin.resources.poll.poll_answers.actions.edit'))
                    ->visible(fn () => static::hasPermissionTo('update')),

                Tables\Actions\DeleteAction::make()
                    ->modalHeading(__('admin.resources.poll.poll_answers.actions.delete'))
                    ->visible(fn () => static::hasPermissionTo('delete')),

            ])
            ->groupedBulkActions([
                Tables\Actions\DeleteBulkAction::make()->visible(fn () => static::hasPermissionTo('delete')),
            ])
            ->paginated([10, 25, 50]);
    }
}
