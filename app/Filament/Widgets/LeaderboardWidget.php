<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LeaderboardWidget extends BaseWidget
{
    protected static ?string $heading = 'Papan Peringkat (Top 10)';

    /**
     * FIX: Tipe data diubah dari ?int menjadi ?string karena 'points' adalah sebuah string.
     */
    protected static ?string $defaultSortColumn = 'points';

    protected static ?string $defaultSortDirection = 'desc';
    
    protected int | string | array $columnSpan = 1;


    public function table(Table $table): Table
    {
        return $table
            ->query(
                User::query()->orderBy('points', 'desc')->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('rank')
                    ->label('Peringkat')
                    ->rowIndex(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama User')
                    ->searchable(),

                Tables\Columns\TextColumn::make('points')
                    ->label('Poin')
                    ->sortable()
                    ->badge()
                    ->color('success'),
            ])
            ->paginated(false);
    }
}