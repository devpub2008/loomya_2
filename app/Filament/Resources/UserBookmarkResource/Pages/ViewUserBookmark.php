<?php

namespace App\Filament\Resources\UserBookmarkResource\Pages;

use App\Filament\Resources\UserBookmarkResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewUserBookmark extends ViewRecord
{
    protected static string $resource = UserBookmarkResource::class;

    protected function getActions(): array
    {
        return [EditAction::make()];
    }
}
