<?php

namespace App\Filament\Resources\UserVerifyResource\Pages;

use App\Filament\Resources\UserVerifyResource;
use App\Model\UserVerify;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListUserVerifies extends ListRecords
{
    protected static string $resource = UserVerifyResource::class;

    public function getTabs(): array
    {
        return [
            null => Tab::make(__('admin.resources.user_verify.tabs.all')),
            'pending' => Tab::make()->label(__('admin.resources.user_verify.tabs.pending'))->query(fn ($query) => $query->where('status', UserVerify::REQUESTED_STATUS)),
            'approved' => Tab::make()->label(__('admin.resources.user_verify.tabs.approved'))->query(fn ($query) => $query->where('status', UserVerify::APPROVED_STATUS)),
            'rejected' => Tab::make()->label(__('admin.resources.user_verify.tabs.rejected'))->query(fn ($query) => $query->where('status', UserVerify::REJECTED_STATUS)),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
