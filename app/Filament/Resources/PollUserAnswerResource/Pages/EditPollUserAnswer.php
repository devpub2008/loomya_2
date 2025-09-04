<?php

namespace App\Filament\Resources\PollUserAnswerResource\Pages;

use App\Filament\Resources\PollUserAnswerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPollUserAnswer extends EditRecord
{
    protected static string $resource = PollUserAnswerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
