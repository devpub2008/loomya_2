<?php

namespace App\Filament\Resources\SubscriptionResource\Pages;

use App\Filament\Resources\SubscriptionResource;
use App\Model\Subscription;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListSubscriptions extends ListRecords
{
    protected static string $resource = SubscriptionResource::class;

    protected function getHeaderWidgets(): array
    {
        return SubscriptionResource::getWidgets();
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make(__('admin.resources.subscription.tabs.all')),
            'pending' => Tab::make(__('admin.resources.subscription.tabs.pending'))
                ->query(fn ($query) => $query->where('status', Subscription::PENDING_STATUS)),
            'active' => Tab::make(__('admin.resources.subscription.tabs.active'))
                ->query(fn ($query) => $query->where('status', Subscription::ACTIVE_STATUS)->where('expires_at', '>', now())),
            'canceled' => Tab::make(__('admin.resources.subscription.tabs.canceled'))
                ->query(fn ($query) => $query->where('status', Subscription::CANCELED_STATUS)),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
