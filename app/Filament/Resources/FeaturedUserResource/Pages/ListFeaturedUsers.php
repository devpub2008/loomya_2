<?php

namespace App\Filament\Resources\FeaturedUserResource\Pages;

use App\Filament\Resources\FeaturedUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFeaturedUsers extends ListRecords
{
    protected static string $resource = FeaturedUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
