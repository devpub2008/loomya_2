<?php

namespace App\Filament\Resources\UserReportResource\Pages;

use App\Filament\Resources\UserReportResource;
use App\Model\UserReport;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListUserReports extends ListRecords
{
    protected static string $resource = UserReportResource::class;

    public function getTabs(): array
    {
        return [
            null => Tab::make(__('admin.resources.user_report.tabs.all')),
            'received' => Tab::make(__('admin.resources.user_report.tabs.received'))
                ->query(fn ($query) => $query->where('status', UserReport::RECEIVED_STATUS)),
            'seen' => Tab::make(__('admin.resources.user_report.tabs.seen'))
                ->query(fn ($query) => $query->where('status', UserReport::SEEN_STATUS)),
            'solved' => Tab::make(__('admin.resources.user_report.tabs.solved'))
                ->query(fn ($query) => $query->where('status', UserReport::SOLVED_STATUS)),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
