<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StreamMessageResource\Pages;
use App\Filament\Traits\HasShieldPermissions;
use App\Model\StreamMessage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;

class StreamMessageResource extends Resource
{
    use HasShieldPermissions;

    protected static ?string $model = StreamMessage::class;

    protected static ?string $navigationGroup = 'Streams';

    protected static ?int $navigationSort = 2;

    public static function getModelLabel(): string
    {
        return __('admin.resources.stream_message.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.stream_message.plural');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('admin.resources.stream_message.sections.message_details'))
                    ->description(__('admin.resources.stream_message.sections.message_details'))
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label(__('admin.resources.stream_message.fields.user_id'))
                            ->relationship('user', 'username')
                            ->searchable()
                            ->required()
                            ->helperText(__('admin.resources.stream_message.help.user_id'))
                            ->preload(true),

                        Forms\Components\Select::make('stream_id')
                            ->label(__('admin.resources.stream_message.fields.stream_id'))
                            ->relationship('stream', 'name')
                            ->searchable()
                            ->required()
                            ->helperText(__('admin.resources.stream_message.help.stream_id'))
                            ->preload(true),

                        Forms\Components\Textarea::make('message')
                            ->label(__('admin.resources.stream_message.fields.message'))
                            ->required()
                            ->autosize()
                            ->maxLength(2000)
                            ->columnSpanFull()
                            ->helperText(__('admin.resources.stream_message.help.message')),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.username')
                    ->label(__('admin.resources.stream_message.fields.user_id'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('stream.name')
                    ->label(__('admin.resources.stream_message.fields.stream_id'))
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('message')
                    ->label(__('admin.resources.stream_message.fields.message'))
                    ->wrap()
                    ->limit(50)
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin.resources.stream_message.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('admin.resources.stream_message.fields.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([
                QueryBuilder::make()
                    ->constraints([
                        TextConstraint::make('user.username')->label(__('admin.resources.stream_message.fields.user_id')),
                        TextConstraint::make('stream.name')->label(__('admin.resources.stream_message.fields.stream_id')),
                        DateConstraint::make('created_at')->label(__('admin.resources.stream_message.fields.created_at')),
                    ]),
            ])
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
            'index' => Pages\ListStreamMessages::route('/'),
            'create' => Pages\CreateStreamMessage::route('/create'),
            'edit' => Pages\EditStreamMessage::route('/{record}/edit'),
            'view' => Pages\ViewStreamMessage::route('/{record}'),
        ];
    }
}
