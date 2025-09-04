<?php

namespace App\Filament\Resources\FeaturedUserResource\Pages;

use App\Filament\Resources\FeaturedUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFeaturedUser extends EditRecord
{
    protected static string $resource = FeaturedUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
