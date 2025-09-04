<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserMessageResource\Pages;
use App\Filament\Traits\HasShieldPermissions;
use App\Model\UserMessage;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\BooleanConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\NumberConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;

class UserMessageResource extends Resource
{
    use HasShieldPermissions;

    protected static ?string $model = UserMessage::class;

    protected static ?int $navigationSort = 11;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $navigationGroup = 'UserMessages';

    public static function getModelLabel(): string
    {
        return __('admin.resources.user_message.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.user_message.plural');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('admin.resources.user_message.sections.user_message_details'))
                    ->description(__('admin.resources.user_message.sections.user_message_details_descr'))
                    ->schema([
                        Select::make('sender_id')
                            ->label(__('admin.resources.user_message.fields.sender_id'))
                            ->relationship('sender', 'username')
                            ->searchable()
                            ->required()
                            ->preload(true),

                        Select::make('receiver_id')
                            ->label(__('admin.resources.user_message.fields.receiver_id'))
                            ->relationship('receiver', 'username')
                            ->searchable()
                            ->required()
                            ->preload(true),

                        Textarea::make('message')
                            ->label(__('admin.resources.user_message.fields.message'))
                            ->rows(4)
                            ->columnSpanFull()
                            ->required(),

                        TextInput::make('price')
                            ->label(__('admin.resources.user_message.fields.price'))
                            ->numeric()
                            ->prefix('$')
                            ->nullable(),

                        TextInput::make('replyTo')
                            ->label(__('admin.resources.user_message.fields.replyTo'))
                            ->numeric()
                            ->nullable()
                            ->default(0)
                            ->required(),

                        Toggle::make('isSeen')
                            ->label(__('admin.resources.user_message.fields.isSeen'))
                            ->inline(false)
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sender.username')
                    ->label(__('admin.resources.user_message.fields.sender_id'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('receiver.username')
                    ->label(__('admin.resources.user_message.fields.receiver_id'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('message')
                    ->label(__('admin.resources.user_message.fields.message'))
                    ->searchable()
                    ->limit(50)
                    ->sortable(),
                Tables\Columns\IconColumn::make('isSeen')
                    ->label(__('admin.resources.user_message.fields.isSeen'))
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
                        TextConstraint::make('id')->label('Id'),
                        TextConstraint::make('sender.username')->label(__('admin.resources.user_message.fields.sender_id')),
                        TextConstraint::make('receiver.username')->label(__('admin.resources.user_message.fields.receiver_id')),
                        NumberConstraint::make('price')->label(__('admin.resources.user_message.fields.price')),
                        NumberConstraint::make('replyTo')->label(__('admin.resources.user_message.fields.replyTo')),
                        BooleanConstraint::make('isSeen')->label(__('admin.resources.user_message.fields.isSeen')),
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUserMessages::route('/'),
            'create' => Pages\CreateUserMessage::route('/create'),
            'edit' => Pages\EditUserMessage::route('/{record}/edit'),
            'view' => Pages\ViewUserMessage::route('/{record}'),
            'payments' => Pages\ViewUserMessageTransactions::route('/{record}/payments'),
            'attachments' => Pages\ViewUserMessageAttachments::route('/{record}/attachments'),
        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\ViewUserMessageTransactions::class,
            Pages\ViewUserMessageAttachments::class,
        ]);
    }
}
