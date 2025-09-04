<?php

namespace App\Filament\Resources\PollAnswerResource\Pages;

use App\Filament\Resources\PollAnswerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPollAnswers extends ListRecords
{
    protected static string $resource = PollAnswerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
