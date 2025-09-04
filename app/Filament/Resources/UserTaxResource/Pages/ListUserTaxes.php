<?php

namespace App\Filament\Resources\UserTaxResource\Pages;

use App\Filament\Resources\UserTaxResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserTaxes extends ListRecords
{
    protected static string $resource = UserTaxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
