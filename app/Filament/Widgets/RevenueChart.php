<?php

namespace App\Filament\Widgets;

use App\Models\Subscription;
use Filament\Widgets\ChartWidget;

class RevenueChart extends ChartWidget
{
    protected ?string $heading = 'Revenue';

    protected function getData(): array
    {
        $data = Subscription::selectRaw('MONTH(start_date) as month, SUM(price) as total')
            ->groupBy('month')
            ->pluck('total', 'month');

        return [
            'datasets' => [
                [
                    'label' => 'Revenue',
                    'data' => $data->values(),
                ],
            ],
            'labels' => $data->keys(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
    protected int|string|array $columnSpan = 1;
}
