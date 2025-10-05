<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class RecentUserSubmissions extends Component
{
    // Properti untuk menampung data submission
    public $submissions;

    public function mount()
    {
        // Ambil 5 submission terakhir dari user yang sedang login
        // 'with()' digunakan agar data relasi (soal dan kategori) ikut terambil
        // Ini lebih efisien daripada query berulang (N+1 problem)
        $this->submissions = Auth::user()
            ->submissions()
            ->with(['challenge', 'challenge.category'])
            ->latest() // Urutkan dari yang terbaru
            ->take(5)  // Ambil 5 data saja
            ->get();
    }

    public function render()
    {
        return view('livewire.recent-user-submissions');
    }
}