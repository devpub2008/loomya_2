<?php

namespace App\Filament\Resources\UserVerifyResource\Pages;

use App\Filament\Resources\UserVerifyResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewUserVerify extends ViewRecord
{
    protected static string $resource = UserVerifyResource::class;

    protected function getActions(): array
    {
        return [EditAction::make()];
    }
}
