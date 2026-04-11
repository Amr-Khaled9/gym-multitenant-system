<?php

namespace App\Filament\Widgets;

use App\Models\Subscription;
use Filament\Widgets\ChartWidget;

class MembersChart extends ChartWidget
{
    protected ?string $heading = 'Subscriptions Status';

    protected function getData(): array
    {
        $data = [
            Subscription::where('status', 'active')->count(),
            Subscription::where('status', 'expired')->count(),
            Subscription::where('status', 'cancelled')->count(),
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Subscriptions',
                    'data' => $data,
                ],
            ],
            'labels' => ['Active', 'Expired', 'Cancelled'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
    protected int|string|array $columnSpan = 1;
}
