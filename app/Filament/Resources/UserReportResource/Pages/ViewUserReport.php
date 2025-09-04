<?php

namespace App\Filament\Resources\UserReportResource\Pages;

use App\Filament\Resources\UserReportResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewUserReport extends ViewRecord
{
    protected static string $resource = UserReportResource::class;

    protected function getActions(): array
    {
        return [EditAction::make()];
    }
}
