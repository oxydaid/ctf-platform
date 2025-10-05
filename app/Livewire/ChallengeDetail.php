<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Challenge;
use App\Models\Submission;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

#[Title('Challenge Detail')]
class ChallengeDetail extends Component
{

    public Challenge $challenge;
    public string $flag = '';
    public bool $isSolved = false;
    public $solvers;

    public function mount(Challenge $challenge): void
    {
        $this->challenge = $challenge;

        // Cek apakah soal ini sudah diselesaikan oleh user yang login
        if (Auth::check()) {
            $this->isSolved = Submission::where('user_id', auth()->id())
                ->where('challenge_id', $this->challenge->id)
                ->exists();
        }

        $this->solvers = $this->challenge->submissions()->get();
    }

    // Top 10 solver
    public function topSolver()
    {
        return Submission::where('challenge_id', $this->challenge->id)
            ->orderBy('created_at', 'asc')
            ->limit(10)
            ->get();
    }

    public function submitFlag(): void
    {
        $this->validate(['flag' => 'required']);

        // Jika sudah selesai, hentikan proses
        if ($this->isSolved) {
            return;
        }

        if ($this->flag === $this->challenge->flag) {
            // Simpan ke tabel submission
            Submission::create([
                'user_id' => auth()->id(),
                'challenge_id' => $this->challenge->id,
            ]);

            // Update poin user
            auth()->user()->increment('points', $this->challenge->points);

            // Set status menjadi solved dan tampilkan notifikasi
            $this->isSolved = true;
            session()->flash('success', 'Selamat! Flag benar dan poin telah ditambahkan.');
        } else {
            session()->flash('error', 'Maaf, flag yang Anda masukkan salah.');
        }

        $this->reset('flag');
    }

    public function render()
    {
        return view('livewire.challenge-detail');
    }
}
