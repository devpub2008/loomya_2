<?php

namespace App\Filament\Resources\PostCommentResource\Pages;

use App\Filament\Resources\PostCommentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPostComment extends EditRecord
{
    protected static string $resource = PostCommentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
