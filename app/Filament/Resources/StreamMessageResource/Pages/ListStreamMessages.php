<?php

namespace App\Filament\Resources\StreamMessageResource\Pages;

use App\Filament\Resources\StreamMessageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStreamMessages extends ListRecords
{
    protected static string $resource = StreamMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
