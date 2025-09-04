<?php

namespace App\Filament\Resources\UserListResource\Pages;

use App\Filament\Resources\UserListResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewUserList extends ViewRecord
{
    protected static string $resource = UserListResource::class;

    protected function getActions(): array
    {
        return [EditAction::make()];
    }
}
