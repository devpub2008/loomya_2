<?php

namespace App\Filament\Resources\AttachmentResource\Pages;

use App\Filament\Resources\AttachmentResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAttachment extends ViewRecord
{
    protected static string $resource = AttachmentResource::class;

    protected function getActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
