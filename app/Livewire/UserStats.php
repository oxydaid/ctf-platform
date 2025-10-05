<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Challenge;
use Illuminate\Support\Facades\Auth;

class UserStats extends Component
{
    // Properti untuk menyimpan data statistik
    public int $totalChallenges;
    public int $solvedChallenges;
    public int $userPoints;
    public int $userRank;

    /**
     * Method mount dijalankan sekali saat komponen di-load.
     * Tempat yang sempurna untuk menghitung statistik.
     */
    public function mount(): void
    {
        $user = Auth::user();

        // 1. Hitung total soal yang aktif
        $this->totalChallenges = Challenge::where('is_active', true)->count();

        // 2. Hitung total soal yang sudah diselesaikan user
        $this->solvedChallenges = $user->submissions()->count();

        // 3. Ambil poin user saat ini
        $this->userPoints = $user->points;

        // 4. Hitung peringkat user
        // Peringkat adalah jumlah user yang punya poin lebih tinggi, ditambah 1.
        $this->userRank = User::where('points', '>', $user->points)->count() + 1;
    }

    public function render()
    {
        return view('livewire.user-stats');
    }
}