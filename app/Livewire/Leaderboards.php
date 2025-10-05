<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination; // 1. Import trait untuk paginasi
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;

#[Title('Leaderboards')]
class Leaderboards extends Component
{
    use WithPagination; // 2. Gunakan trait di dalam class

    public string $sortBy = 'points';
    public string $search = ''; // 3. Tambahkan properti untuk menampung query pencarian

    /**
     * Method untuk mengubah mode pengurutan.
     * Kita juga mereset halaman ke 1 setiap kali sorting diubah.
     */
    public function setSortBy(string $sort): void
    {
        $this->sortBy = $sort;
        $this->resetPage();
    }

    /**
     * Method ini akan dijalankan setiap kali properti $search diperbarui.
     * Fungsinya untuk mereset paginasi ke halaman pertama.
     */
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    #[Computed]
    public function users()
    {
        $query = User::query()
            // 4. Tambahkan filter pencarian berdasarkan nama user
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });

        if ($this->sortBy === 'solves') {
            return $query->withCount('submissions')
                ->orderBy('submissions_count', 'desc')
                ->orderBy('points', 'desc')
                // 5. Ganti take() menjadi paginate()
                ->paginate(15); // Tampilkan 15 user per halaman
        }

        return $query->orderBy('points', 'desc')
            ->orderBy('updated_at', 'asc')
            // 5. Ganti take() menjadi paginate()
            ->paginate(15);
    }

    public function render()
    {
        return view('livewire.leaderboards');
    }
}