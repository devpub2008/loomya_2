<?php

namespace App\Filament\Resources\StreamMessageResource\Pages;

use App\Filament\Resources\StreamMessageResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewStreamMessage extends ViewRecord
{
    protected static string $resource = StreamMessageResource::class;

    protected function getActions(): array
    {
        return [EditAction::make()];
    }
}
