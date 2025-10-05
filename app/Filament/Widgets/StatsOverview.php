<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Challenge;
use App\Models\Submission;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // Logika untuk mengambil data Top User
        $topUser = User::orderBy('points', 'desc')->first();

        return [
            // Kartu 1: Total User
            Stat::make('Total User', User::count())
                ->description('Jumlah user terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('success'),

            // Kartu 2: Total Soal
            Stat::make('Total Soal', Challenge::count())
                ->description('Jumlah seluruh soal terdaftar')
                ->descriptionIcon('heroicon-m-puzzle-piece')
                ->color('warning'),

            // Kartu 3: Total Submission
            Stat::make('Total Submission', Submission::count())
                ->description('Jumlah seluruh submit')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('info'),

            // Kartu 4: Top User
            Stat::make('Top User', $topUser ? $topUser->name : 'Belum Ada')
                ->description($topUser ? $topUser->points . ' Poin' : '0 Poin')
                ->descriptionIcon('heroicon-m-trophy')
                ->color('danger'),
        ];
    }
}