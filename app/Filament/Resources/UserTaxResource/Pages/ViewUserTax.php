<?php

namespace App\Filament\Resources\UserTaxResource\Pages;

use App\Filament\Resources\UserTaxResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewUserTax extends ViewRecord
{
    protected static string $resource = UserTaxResource::class;

    protected function getActions(): array
    {
        return [
            EditAction::make(),
//            ExportAction::make()
        ];
    }
}
