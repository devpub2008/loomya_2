<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserReportResource\Pages;
use App\Filament\Traits\HasShieldPermissions;
use App\Model\UserReport;
use App\Providers\GenericHelperServiceProvider;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\SelectConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;

class UserReportResource extends Resource
{
    use HasShieldPermissions;

    protected static ?string $model = UserReport::class;

    protected static ?int $navigationSort = 16;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $navigationGroup = 'UserReports';

    public static function getModelLabel(): string
    {
        return __('admin.resources.user_report.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.user_report.plural');
    }

    public static function getNavigationBadge(): ?string
    {
        $count = UserReport::where('status', UserReport::RECEIVED_STATUS)->count();
        return $count > 0 ? $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'primary';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make(__('admin.resources.user_report.sections.reporter_reported'))
                ->description(__('admin.resources.user_report.sections.reporter_reported_descr'))
                ->schema([
                    Select::make('from_user_id')
                        ->label(__('admin.resources.user_report.fields.from_user_id'))
                        ->relationship('reporterUser', 'username')
                        ->searchable()
                        ->required()
                        ->placeholder(__('admin.resources.user_report.fields.from_user_id'))
                        ->preload(true),

                    Select::make('user_id')
                        ->label(__('admin.resources.user_report.fields.user_id'))
                        ->relationship('reportedUser', 'username')
                        ->searchable()
                        ->required()
                        ->placeholder(__('admin.resources.user_report.fields.user_id'))
                        ->preload(true),
                ])
                ->columns(2),

            Section::make(__('admin.resources.user_report.sections.reported_content'))
                ->description(__('admin.resources.user_report.sections.reported_content_descr'))
                ->schema([
                    Select::make('post_id')
                        ->label(__('admin.resources.user_report.fields.post_id'))
                        ->relationship('reportedPost', 'id')
                        ->searchable()
                        ->placeholder(__('admin.resources.user_report.fields.post_id'))
                        ->preload(true),

                    Select::make('message_id')
                        ->label(__('admin.resources.user_report.fields.message_id'))
                        ->relationship('reportedMessage', 'id')
                        ->searchable()
                        ->placeholder(__('admin.resources.user_report.fields.message_id'))
                        ->preload(true),

                    Select::make('stream_id')
                        ->label(__('admin.resources.user_report.fields.stream_id'))
                        ->relationship('reportedStream', 'id')
                        ->searchable()
                        ->placeholder(__('admin.resources.user_report.fields.stream_id'))
                        ->preload(true),
                ])
                ->columns(3),

            Section::make(__('admin.resources.user_report.sections.report_details'))
                ->schema([
                    Select::make('type')
                        ->label(__('admin.resources.user_report.fields.type'))
                        ->required()
                        ->options([
                            UserReport::I_DONT_LIKE_TYPE => __('admin.resources.user_report.types.i_dont_like'),
                            UserReport::SPAM_TYPE => __('admin.resources.user_report.types.spam'),
                            UserReport::DMCA_TYPE => __('admin.resources.user_report.types.dmca'),
                            UserReport::OFFENSIVE_CONTENT_TYPE => __('admin.resources.user_report.types.offensive_content'),
                            UserReport::ABUSE_TYPE => __('admin.resources.user_report.types.abuse'),
                        ])
                        ->default(UserReport::I_DONT_LIKE_TYPE),

                    Select::make('status')
                        ->label(__('admin.resources.user_report.fields.status'))
                        ->options([
                            UserReport::RECEIVED_STATUS => __('admin.resources.user_report.statuses.received'),
                            UserReport::SEEN_STATUS => __('admin.resources.user_report.statuses.seen'),
                            UserReport::SOLVED_STATUS => __('admin.resources.user_report.statuses.solved'),
                        ])
                        ->placeholder(__('admin.resources.user_report.fields.status'))
                        ->required(),

                    Textarea::make('details')
                        ->label(__('admin.resources.user_report.fields.details'))
                        ->placeholder(__('admin.resources.user_report.fields.details'))
                        ->rows(5)
                        ->columnSpanFull(),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reporterUser.username')
                    ->label(__('admin.resources.user_report.fields.from_user_id'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->label(__('admin.resources.user_report.fields.type'))
                    ->badge()
                    ->color('gray')
                    ->formatStateUsing(fn ($state, $record) => GenericHelperServiceProvider::resolveReportType($record)),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('admin.resources.user_report.fields.status'))
                    ->sortable()
                    ->badge()
                    ->formatStateUsing(fn ($state) => __("admin.resources.user_report.statuses.".$state))
                    ->color(fn ($state) => match ($state) {
                        UserReport::SOLVED_STATUS => 'success',
                        UserReport::RECEIVED_STATUS => 'warning',
                        UserReport::SEEN_STATUS => 'danger',
                        default => 'gray',
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin.common.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('admin.common.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                QueryBuilder::make()
                    ->constraints([
                        TextConstraint::make('reporterUser.username')->label(__('admin.resources.user_report.fields.from_user_id')),
                        TextConstraint::make('reportedUser.username')->label(__('admin.resources.user_report.fields.user_id')),
                        TextConstraint::make('reportedPost.id')->label(__('admin.resources.user_report.fields.post_id')),
                        TextConstraint::make('reportedMessage.id')->label(__('admin.resources.user_report.fields.message_id')),
                        TextConstraint::make('reportedStream.id')->label(__('admin.resources.user_report.fields.stream_id')),
                        TextConstraint::make('details')->label(__('admin.resources.user_report.fields.details')),
                        SelectConstraint::make('status')
                            ->label(__('admin.resources.user_report.fields.status'))
                            ->options([
                                UserReport::RECEIVED_STATUS => __('admin.resources.user_report.statuses.received'),
                                UserReport::SEEN_STATUS => __('admin.resources.user_report.statuses.seen'),
                                UserReport::SOLVED_STATUS => __('admin.resources.user_report.statuses.solved'),
                            ]),
                        DateConstraint::make('created_at')->label(__('admin.common.created_at')),
                    ])
                    ->constraintPickerColumns(2),
            ], layout: Tables\Enums\FiltersLayout::Dropdown)
            ->deferFilters()
            ->actions([
//                Tables\Actions\EditAction::make(),
                ActionGroup::make([
                    Action::make('view_admin')
                        ->label(__('admin.resources.user_report.actions.view_admin'))
                        ->icon('heroicon-o-shield-check')
                        ->url(fn ($record) => GenericHelperServiceProvider::getReportLinks($record)['admin'] ?? '#')
                        ->openUrlInNewTab()
                        ->color('primary')
                        ->visible(fn ($record) => !empty(GenericHelperServiceProvider::getReportLinks($record)['admin'])),

                    Action::make('view_public')
                        ->label(__('admin.resources.user_report.actions.view_public'))
                        ->icon('heroicon-o-globe-alt')
                        ->url(fn ($record) => GenericHelperServiceProvider::getReportLinks($record)['public'] ?? '#')
                        ->openUrlInNewTab()
                        ->color('success')
                        ->visible(fn ($record) => !empty(GenericHelperServiceProvider::getReportLinks($record)['public'])),

                    Tables\Actions\DeleteAction::make(),
                ])->icon('heroicon-o-ellipsis-horizontal'),
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
            'index' => Pages\ListUserReports::route('/'),
            'create' => Pages\CreateUserReport::route('/create'),
            'edit' => Pages\EditUserReport::route('/{record}/edit'),
            'view' => Pages\ViewUserReport::route('/{record}'),
        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([]);
    }
}
