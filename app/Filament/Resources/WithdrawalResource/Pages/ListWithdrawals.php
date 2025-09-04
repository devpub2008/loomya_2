<?php

namespace App\Filament\Resources\WithdrawalResource\Pages;

use App\Filament\Resources\WithdrawalResource;
use App\Model\Withdrawal;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListWithdrawals extends ListRecords
{
    protected static string $resource = WithdrawalResource::class;

    public function getTabs(): array
    {
        return [
            null => Tab::make(__('admin.resources.withdrawal.tabs.all')),
            'requested' => Tab::make(__('admin.resources.withdrawal.tabs.requested'))
                ->query(fn ($query) => $query->where('status', Withdrawal::REQUESTED_STATUS)),
            'approved' => Tab::make(__('admin.resources.withdrawal.tabs.approved'))
                ->query(fn ($query) => $query->where('status', Withdrawal::APPROVED_STATUS)),
            'rejected' => Tab::make(__('admin.resources.withdrawal.tabs.rejected'))
                ->query(fn ($query) => $query->where('status', Withdrawal::REJECTED_STATUS)),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
