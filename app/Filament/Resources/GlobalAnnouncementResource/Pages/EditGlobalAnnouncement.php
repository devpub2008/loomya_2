<?php

namespace App\Filament\Resources\GlobalAnnouncementResource\Pages;

use App\Filament\Resources\GlobalAnnouncementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGlobalAnnouncement extends EditRecord
{
    protected static string $resource = GlobalAnnouncementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
