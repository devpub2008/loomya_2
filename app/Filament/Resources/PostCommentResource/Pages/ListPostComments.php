<?php

namespace App\Filament\Resources\PostCommentResource\Pages;

use App\Filament\Resources\PostCommentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPostComments extends ListRecords
{
    protected static string $resource = PostCommentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
