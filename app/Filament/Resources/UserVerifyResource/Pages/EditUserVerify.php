<?php

namespace App\Filament\Resources\UserVerifyResource\Pages;

use App\Filament\Resources\UserVerifyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserVerify extends EditRecord
{
    protected static string $resource = UserVerifyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
