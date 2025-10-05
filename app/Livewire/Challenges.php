<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Challenge;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\Submission; 
use Illuminate\Database\Eloquent\Collection;

class Challenges extends Component
{
    use WithPagination, WithoutUrlPagination;
    
    public Collection $categories;
    public array $solvedChallengeIds = [];

    // --- Properti untuk mengelola Modal ---
    public bool $showModal = false;
    public ?Challenge $selectedChallenge = null;
    public string $flag = '';
    public string $search = '';
    public array $category = [];
    public array $difficulty = [];


    public function mount(): void
    {
        $this->categories = Category::where('is_active', true)->orderBy('name')->get();
        if (Auth::check()) {
            $this->solvedChallengeIds = Auth::user()
                ->submissions()
                ->pluck('challenge_id')
                ->toArray();
        }
    }
    
    public function clearFilters(): void
    {
        $this->reset(['search', 'category', 'difficulty']);
    }

    // --- Logika Modal sekarang ada di sini ---
    /**
     * Method ini sekarang langsung menampilkan modal.
     */
    public function showChallengeModal(int $challengeId): void
    {
        $this->selectedChallenge = Challenge::find($challengeId);
        $this->showModal = true;
    }

    /**
     * Method untuk menutup modal.
     */
    public function closeModal(): void
    {
        $this->showModal = false;
        $this->selectedChallenge = null;
        $this->reset('flag');
        session()->forget(['success', 'error']); // Hapus notifikasi
    }

    /**
     * Method untuk memproses submit flag.
     */
    public function submitFlag(): void
    {
        $this->validate(['flag' => 'required']);

        if (!$this->selectedChallenge) {
            return;
        }

        if ($this->flag === $this->selectedChallenge->flag) {
            // Cek apakah soal sudah pernah diselesaikan
            $isAlreadySolved = in_array($this->selectedChallenge->id, $this->solvedChallengeIds);

            if (!$isAlreadySolved) {
                Submission::create([
                    'user_id' => auth()->id(),
                    'challenge_id' => $this->selectedChallenge->id,
                ]);

                auth()->user()->increment('points', $this->selectedChallenge->points);

                // Perbarui daftar solved challenges
                $this->solvedChallengeIds[] = $this->selectedChallenge->id;

                session()->flash('success', 'Selamat! Flag benar.');
            } else {
                session()->flash('success', 'Flag benar, tapi Anda sudah menyelesaikan soal ini.');
            }
        } else {
            session()->flash('error', 'Maaf, flag yang Anda masukkan salah.');
        }

        $this->reset('flag');
    }

    #[Computed]
    public function challenges()
    {
        // FIX: Gunakan when() untuk menerapkan filter secara kondisional
        return Challenge::query()
            ->where('is_active', true)
            ->with('category')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->when($this->category, function ($query) {
                $query->whereIn('category_id', $this->category);
            })
            // FIX: Gunakan whereIn untuk filter difficulty
            ->when($this->difficulty, function ($query) {
                $query->whereIn('difficulty', $this->difficulty);
            })
            ->paginate(12);
    }

    public function render()
    {

        return view('livewire.challenges');
    }
}
