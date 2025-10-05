<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\LeaderboardWidget;
use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Widgets\RecentSubmissionsWidget;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    public function getWidgets(): array
    {
        return [
            // Daftarkan widget Anda di sini
            StatsOverview::class,
            LeaderboardWidget::class,
            RecentSubmissionsWidget::class
        ];
    }
}