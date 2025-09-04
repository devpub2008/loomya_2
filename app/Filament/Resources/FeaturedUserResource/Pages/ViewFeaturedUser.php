<?php

namespace App\Filament\Resources\FeaturedUserResource\Pages;

use App\Filament\Resources\FeaturedUserResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewFeaturedUser extends ViewRecord
{
    protected static string $resource = FeaturedUserResource::class;

    protected function getActions(): array
    {
        return [EditAction::make()];
    }
}
