<?php

namespace App\Filament\Resources\StreamMessageResource\Pages;

use App\Filament\Resources\StreamMessageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStreamMessage extends EditRecord
{
    protected static string $resource = StreamMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
