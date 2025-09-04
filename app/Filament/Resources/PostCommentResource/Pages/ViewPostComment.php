<?php

namespace App\Filament\Resources\PostCommentResource\Pages;

use App\Filament\Resources\PostCommentResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPostComment extends ViewRecord
{
    protected static string $resource = PostCommentResource::class;

    protected function getActions(): array
    {
        return [EditAction::make()];
    }
}
