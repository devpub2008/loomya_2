<?php

namespace App\Filament\Resources\SubscriptionResource\Widgets;

use App\Filament\Resources\SubscriptionResource\Pages\ListSubscriptions;
use App\Model\Subscription;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class SubscriptionStats extends BaseWidget
{
    use InteractsWithPageTable;

    protected static ?string $pollingInterval = null;

    public array $tableColumnSearches = [];

    protected function getTablePage(): string
    {
        return ListSubscriptions::class;
    }

    protected function getHeading(): ?string
    {
        return __('admin.widgets.subscription_stats.heading');
    }

    protected function getStats(): array
    {
        $orderData = Trend::model(Subscription::class)
            ->between(
                start: now()->subYear(),
                end: now(),
            )
            ->perMonth()
            ->count();

        return [
            Stat::make(__('admin.widgets.subscription_stats.total'), Subscription::query()->count())
                ->chart(
                    collect($orderData)
                        ->map(fn (TrendValue $value) => (float) $value->aggregate)
                        ->toArray()
                ),
            Stat::make(
                __('admin.widgets.subscription_stats.active'),
                Subscription::query()
                    ->where('status', Subscription::ACTIVE_STATUS)
                    ->where('expires_at', '>', now())
                    ->count()
            ),
            Stat::make(
                __('admin.widgets.subscription_stats.average_price'),
                number_format(Subscription::query()->avg('amount'), 2)
            ),
        ];
    }
}
