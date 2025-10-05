<?php

namespace App\Filament\Widgets;

use App\Models\Submission;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentSubmissionsWidget extends BaseWidget
{
    protected static ?string $heading = 'Riwayat Penyelesaian Terakhir';

    /**
     * Widget ini akan menempati 1 kolom di grid dashboard.
     */
    protected int | string | array $columnSpan = 1;

    public function table(Table $table): Table
    {
        return $table
            // Query untuk mengambil 10 submission terakhir, dengan relasi user dan challenge
            ->query(
                Submission::query()
                    ->with(['user', 'challenge'])
                    ->latest() // Mengurutkan berdasarkan 'created_at' (terbaru dulu)
                    ->limit(10)
            )
            ->columns([
                // Kolom Nama Soal
                Tables\Columns\TextColumn::make('challenge.name')
                    ->label('Nama Soal')
                    ->url(fn (Submission $record) => $record->challenge ? route('filament.admin.resources.challenges.edit', $record->challenge) : null)
                    ->searchable(),

                // Kolom Nama Solver
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Diselesaikan Oleh')
                    ->url(fn (Submission $record) => $record->user ? route('filament.admin.resources.users.edit', $record->user) : null)
                    ->searchable(),

                // Kolom Waktu
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu')
                    ->since(), // Tampil dalam format "x menit yang lalu"
            ])
            ->paginated(false);
    }
}