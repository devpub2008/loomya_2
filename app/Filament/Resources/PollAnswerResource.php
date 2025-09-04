<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PollAnswerResource\Forms\CreatePollAnswerForm;
use App\Filament\Resources\PollAnswerResource\Pages;
use App\Filament\Traits\HasShieldPermissions;
use App\Model\PollAnswer;
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

class PollAnswerResource extends Resource
{
    use HasShieldPermissions;

    protected static ?string $model = PollAnswer::class;

    protected static ?string $navigationIcon = 'heroicon-o-check';

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $navigationGroup = 'PollAnswers';

    protected static ?string $modelLabel = 'Poll Choices';

    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Answer Details')
                    ->description('Set up the poll choice.')
                    ->schema(CreatePollAnswerForm::schema())
                    ->columns(2), // Optional: layout
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('poll.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('answer')->label('Choice')
                    ->searchable()
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
                        TextConstraint::make('poll.id')->label('Poll ID'),
                        TextConstraint::make('answer')->label('Choice'),
                        DateConstraint::make('updated_at'),
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
            'index' => Pages\ListPollAnswers::route('/'),
            'create' => Pages\CreatePollAnswer::route('/create'),
            'edit' => Pages\EditPollAnswer::route('/{record}/edit'),
//            'view' => Pages\ViewPollAnswer::route('/{record}'),
        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
//            Pages\ViewPollAnswer::class,
//            Pages\EditPollAnswer::class,
        ]);
    }
}
