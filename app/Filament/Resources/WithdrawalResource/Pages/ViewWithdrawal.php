<?php

namespace App\Filament\Resources\WithdrawalResource\Pages;

use App\Filament\Resources\WithdrawalResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewWithdrawal extends ViewRecord
{
    protected static string $resource = WithdrawalResource::class;

    protected function getActions(): array
    {
        return [EditAction::make()];
    }
}
