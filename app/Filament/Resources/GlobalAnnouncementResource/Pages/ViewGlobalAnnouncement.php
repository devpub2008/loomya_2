<?php

namespace App\Filament\Resources\GlobalAnnouncementResource\Pages;

use App\Filament\Resources\GlobalAnnouncementResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewGlobalAnnouncement extends ViewRecord
{
    protected static string $resource = GlobalAnnouncementResource::class;

    protected function getActions(): array
    {
        return [EditAction::make()];
    }
}
