<?php

namespace App\Filament\Resources\ReactionResource\Pages;

use App\Filament\Resources\ReactionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewReaction extends ViewRecord
{
    protected static string $resource = ReactionResource::class;

    protected function getActions(): array
    {
        return [EditAction::make()];
    }
}
