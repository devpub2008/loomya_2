<?php

namespace App\Filament\Resources\PaymentRequestResource\Pages;

use App\Filament\Resources\PaymentRequestResource;
use App\Model\PaymentRequest;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListPaymentRequests extends ListRecords
{
    protected static string $resource = PaymentRequestResource::class;

    public function getTabs(): array
    {
        return [
            null => Tab::make(__('admin.resources.payment_request.tabs.all')),
            'pending' => Tab::make(__('admin.resources.payment_request.tabs.pending'))
                ->query(fn ($query) => $query->where('status', PaymentRequest::PENDING_STATUS)),
            'approved' => Tab::make(__('admin.resources.payment_request.tabs.approved'))
                ->query(fn ($query) => $query->where('status', PaymentRequest::APPROVED_STATUS)),
            'rejected' => Tab::make(__('admin.resources.payment_request.tabs.rejected'))
                ->query(fn ($query) => $query->where('status', PaymentRequest::REJECTED_STATUS)),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
