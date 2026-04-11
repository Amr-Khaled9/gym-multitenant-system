<?php

namespace App\Filament\Widgets;

use App\Models\Member;
use App\Models\Subscription;
use App\Models\Trainer;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Trainers', Trainer::count())
                ->description()
                ->icon('heroicon-o-user'),

            Stat::make('Total Members', Member::count())
                ->description()
                ->icon('heroicon-o-users'),

            Stat::make('Active Subscriptions', 
                Subscription::where('status', 'active')->count()
            )
                ->description()
                ->icon('heroicon-o-check-circle'),

            Stat::make('Revenue', 
                Subscription::where('status', 'active')->sum('price')
            )
                ->description()
                ->icon('heroicon-o-currency-dollar'),
        ];
    }
    protected int|string|array $columnSpan = 6;
}
