<?php

namespace App\Filament\Widgets;

use App\Filament\Traits\HasShieldWidgetAccess;
use App\Model\Stream;
use App\Model\StreamMessage;
use Illuminate\Support\Carbon;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class StreamsChart extends ChartWidget
{
    use InteractsWithPageFilters;

    use HasShieldWidgetAccess;

    protected static ?string $heading;

    protected static ?int $sort = 4;

    protected static ?string $pollingInterval = '10s';

    public ?string $filter = 'year'; // default to YTD

    public function __construct()
    {
        self::$heading = __('admin.widgets.streams_chart.title');
    }

    protected function getFilters(): ?array
    {
        return [
            'today' => __('admin.filters.today'),
            'week'  => __('admin.filters.week'),
            'month' => __('admin.filters.month'),
            'year'  => __('admin.filters.year'), // YTD
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    // Keep a single y-axis so smaller lines stay proportional to the largest
    protected function getOptions(): array
    {
        return [
            'maintainAspectRatio' => true,
            'interaction' => ['mode' => 'index', 'intersect' => false],
            'plugins' => [
                'legend' => ['position' => 'bottom'],
            ],
            'elements' => [
                'line' => ['tension' => 0.4],
                'point' => ['radius' => 0, 'hoverRadius' => 3],
            ],
        ];
    }

    protected function getData(): array
    {
        // Default to YTD, ending "now" (avoid padding future months with zeros)
        $startDate = now()->startOfYear();
        $endDate = now();
        $intervalMethod = 'perMonth';

        // Override with custom date range if set
        if (!empty($this->filters['startDate'])) {
            $startDate = Carbon::createFromFormat('Y-m-d', $this->filters['startDate'])->startOfDay();
        }

        if (!empty($this->filters['endDate'])) {
            $endDate = Carbon::createFromFormat('Y-m-d', $this->filters['endDate'])->endOfDay();
        }

        // Apply predefined quick filter if selected (overrides custom range)
        if (!empty($this->filter)) {
            switch ($this->filter) {
                case 'today':
                    $startDate = now()->startOfDay();
                    $endDate = now();
                    $intervalMethod = 'perHour';
                    break;

                case 'week':
                    $startDate = now()->startOfWeek();
                    $endDate = now();
                    $intervalMethod = 'perDay';
                    break;

                case 'month':
                    $startDate = now()->startOfMonth();
                    $endDate = now();
                    $intervalMethod = 'perDay';
                    break;

                case 'year': // YTD
                    $startDate = now()->startOfYear();
                    $endDate = now();
                    $intervalMethod = 'perMonth';
                    break;
            }
        }

        // Safety clamp if endDate drifts into the future (e.g., custom ranges)
        if ($endDate->gt(now())) {
            $endDate = now();
        }

        // Build the trend queries without dynamic method call syntax for clarity
        $streamsQuery = Trend::model(Stream::class)->between($startDate, $endDate);
        $messagesQuery = Trend::model(StreamMessage::class)->between($startDate, $endDate);

        if ($intervalMethod === 'perHour') {
            $streams = $streamsQuery->perHour()->count();
            $messages = $messagesQuery->perHour()->count();
        } elseif ($intervalMethod === 'perDay') {
            $streams = $streamsQuery->perDay()->count();
            $messages = $messagesQuery->perDay()->count();
        } else { // perMonth
            $streams = $streamsQuery->perMonth()->count();
            $messages = $messagesQuery->perMonth()->count();
        }

        return [
            'datasets' => [
                [
                    'label' => __('admin.widgets.streams_chart.datasets.streams'),
                    'data' => $streams->map(function (TrendValue $v) { return $v->aggregate; }),
                    'fill' => false,
                    'borderWidth' => 2,
                    'order' => 1,
                ],
                [
                    'label' => __('admin.widgets.streams_chart.datasets.stream_messages'),
                    'data' => $messages->map(function (TrendValue $v) { return $v->aggregate; }),
                    'fill' => false,
                    'borderColor' => '#10b981', // green
                    'borderWidth' => 2,
                    'order' => 2,
                ],
            ],
            'labels' => $streams->map(function (TrendValue $v) { return $v->date; }),
        ];
    }
}
