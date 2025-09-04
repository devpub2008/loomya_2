<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Filament\Traits\HasShieldPermissions;
use App\Model\ContactMessage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;

class ContactMessageResource extends Resource
{
    use HasShieldPermissions;

    protected static ?string $model = ContactMessage::class;

    protected static ?int $navigationSort = 22;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $navigationGroup = 'ContactMessages';

    public static function getModelLabel(): string
    {
        return __('admin.resources.contact_message.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.contact_message.plural');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make()
                    ->schema([

                        Forms\Components\TextInput::make('email')
                            ->label(__('admin.resources.contact_message.fields.email'))
                            ->email()
                            ->required()
                            ->maxLength(191),
                        Forms\Components\TextInput::make('subject')
                            ->label(__('admin.resources.contact_message.fields.subject'))
                            ->required()
                            ->maxLength(191),
                        Forms\Components\Textarea::make('message')
                            ->label(__('admin.resources.contact_message.fields.message'))
                            ->required()
                            ->columnSpanFull()
                            ->rows(4),

                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('email')
                    ->label(__('admin.resources.contact_message.fields.email'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject')
                    ->label(__('admin.resources.contact_message.fields.subject'))
                    ->searchable()
                    ->limit(50),
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
                        TextConstraint::make('email')->label(__('admin.resources.contact_message.fields.email')),
                        TextConstraint::make('subject')->label(__('admin.resources.contact_message.fields.subject')),
                        TextConstraint::make('message')->label(__('admin.resources.contact_message.fields.message')),
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
            'index' => Pages\ListContactMessages::route('/'),
            'create' => Pages\CreateContactMessage::route('/create'),
            'edit' => Pages\EditContactMessage::route('/{record}/edit'),
            'view' => Pages\ViewContactMessage::route('/{record}'),
        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
//            Pages\ViewContactMessage::class,
//            Pages\EditContactMessage::class,
        ]);
    }
}
