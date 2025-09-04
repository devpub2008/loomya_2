<?php

namespace App\Filament\Resources\PublicPageResource\Pages;

use App\Filament\Resources\PublicPageResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPublicPage extends ViewRecord
{
    protected static string $resource = PublicPageResource::class;

    protected function getActions(): array
    {
        return [EditAction::make()];
    }
}
