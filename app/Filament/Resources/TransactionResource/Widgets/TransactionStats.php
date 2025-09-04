<?php

namespace App\Filament\Resources\TransactionResource\Widgets;

use App\Filament\Resources\TransactionResource\Pages\ListTransactions;
use App\Model\Transaction;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class TransactionStats extends BaseWidget
{
    use InteractsWithPageTable;

    protected static ?string $pollingInterval = null;

    public array $tableColumnSearches = [];

    protected function getTablePage(): string
    {
        return ListTransactions::class;
    }

    protected function getHeading(): ?string
    {
        return __('admin.widgets.transaction_stats.heading');
    }

    protected function getStats(): array
    {
        $orderData = Trend::model(Transaction::class)
            ->between(
                start: now()->subYear(),
                end: now(),
            )
            ->perMonth()
            ->count();

        return [
            Stat::make(__('admin.widgets.transaction_stats.total'), Transaction::query()->count())
                ->chart(
                    collect($orderData)
                        ->map(fn (TrendValue $value) => (float) $value->aggregate)
                        ->toArray()
                ),
            Stat::make(__('admin.widgets.transaction_stats.completed'), Transaction::query()->where('status', Transaction::APPROVED_STATUS)->count()),
            Stat::make(__('admin.widgets.transaction_stats.average'), number_format(Transaction::query()->avg('amount'), 2)),
        ];
    }
}
