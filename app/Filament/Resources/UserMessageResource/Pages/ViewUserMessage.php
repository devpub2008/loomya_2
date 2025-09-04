<?php

namespace App\Filament\Resources\UserMessageResource\Pages;

use App\Filament\Resources\UserMessageResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewUserMessage extends ViewRecord
{
    protected static string $resource = UserMessageResource::class;

    protected function getActions(): array
    {
        return [EditAction::make()];
    }
}
