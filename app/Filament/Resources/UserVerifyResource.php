<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserVerifyResource\Pages;
use App\Filament\Traits\HasShieldPermissions;
use App\Model\UserVerify;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\View;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;

class UserVerifyResource extends Resource
{
    use HasShieldPermissions;

    protected static ?string $model = UserVerify::class;

    protected static ?int $navigationSort = 9;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $navigationGroup = 'UserVerifies';

    public static function getModelLabel(): string
    {
        return __('admin.resources.user_verify.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.user_verify.plural');
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return __('admin.resources.user_verify.navigation_badge_tooltip');
    }

    public static function getNavigationBadge(): ?string
    {
        $count = UserVerify::where('status', UserVerify::REQUESTED_STATUS)->count();

        return $count > 0 ? $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'primary';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('admin.resources.user_verify.sections.verification_details'))
                    ->description(__('admin.resources.user_verify.sections.verification_details_descr'))
                    ->schema([

                        View::make('filament.partials.file-preview-wrapper')
                            ->label(__('admin.resources.user_verify.fields.files'))
                            ->columnSpanFull()
                            ->viewData([
                                'record' => UserVerify::find(
                                    request()->route('record')
                                ),
                            ]),

                        Select::make('user_id')
                            ->label(__('admin.resources.user_verify.fields.user_id'))
                            ->relationship('user', 'username')
                            ->searchable()
                            ->required()
                            ->preload(true),
                        Select::make('status')
                            ->label(__('admin.resources.user_verify.fields.status'))
                            ->required()
                            ->options([
                                UserVerify::REQUESTED_STATUS => ucfirst(UserVerify::REQUESTED_STATUS),
                                UserVerify::REJECTED_STATUS => ucfirst(UserVerify::REJECTED_STATUS),
                                UserVerify::APPROVED_STATUS => ucfirst(UserVerify::APPROVED_STATUS),
                            ])
                            ->default(UserVerify::REQUESTED_STATUS),
                        TextInput::make('rejectionReason')
                            ->label(__('admin.resources.user_verify.fields.rejectionReason'))
                            ->maxLength(191)
                            ->columnSpanFull()
                            ->default(null),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.username')
                    ->label(__('admin.resources.user_verify.fields.user_id'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('admin.resources.user_verify.fields.status'))
                    ->badge()
                    ->color('success')
                    ->formatStateUsing(fn ($state) => ucfirst($state))
                    ->color(fn ($state) => match ($state) {
                        UserVerify::APPROVED_STATUS => 'success',
                        UserVerify::REQUESTED_STATUS => 'warning',
                        UserVerify::REJECTED_STATUS => 'danger',
                        default => 'gray',
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('rejectionReason')
                    ->label(__('admin.resources.user_verify.fields.rejectionReason'))
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
                        TextConstraint::make('user.username')->label(__('admin.resources.user_verify.fields.user_id')),
                        TextConstraint::make('status')->label(__('admin.resources.user_verify.fields.status')),
                        TextConstraint::make('rejectionReason')->label(__('admin.resources.user_verify.fields.rejectionReason')),
                        DateConstraint::make('created_at')->label(__('admin.common.created_at')),
                    ])
                    ->constraintPickerColumns(2),
            ], layout: Tables\Enums\FiltersLayout::Dropdown)
            ->deferFilters()
            ->actions([
//                Tables\Actions\EditAction::make(),
                ActionGroup::make([
                    Action::make('profile_url')
                        ->label(__('admin.resources.user_verify.actions.profile_url'))
                        ->icon('heroicon-o-globe-alt')
                        ->url(fn ($record) => route('profile', ['username' => $record->user->username]))
                        ->openUrlInNewTab()
                        ->color('info'),
                    Tables\Actions\DeleteAction::make(),
                ])
                    ->icon('heroicon-o-ellipsis-horizontal')
                    ->iconSize('lg'),

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
            'index' => Pages\ListUserVerifies::route('/'),
            'create' => Pages\CreateUserVerify::route('/create'),
            'edit' => Pages\EditUserVerify::route('/{record}/edit'),
            'view' => Pages\ViewUserVerify::route('/{record}'),
        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
//            Pages\ViewUserVerify::class,
//            Pages\EditUserVerify::class,
//            Pages\ViewUserVerifyAttachments::class,
        ]);
    }
}
