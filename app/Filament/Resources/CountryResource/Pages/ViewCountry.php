<?php

namespace App\Filament\Resources\CountryResource\Pages;

use App\Filament\Resources\CountryResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCountry extends ViewRecord
{
    protected static string $resource = CountryResource::class;

    protected function getActions(): array
    {
        return [EditAction::make()];
    }
}
