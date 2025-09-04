<?php

namespace App\Filament\Resources\StreamResource\Pages;

use App\Filament\Resources\StreamResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewStream extends ViewRecord
{
    protected static string $resource = StreamResource::class;

    protected function getActions(): array
    {
        return [EditAction::make()];
    }
}
