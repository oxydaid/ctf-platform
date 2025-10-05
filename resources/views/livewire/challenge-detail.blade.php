@php
    $difficultyColors = [
        'easy' => 'accent',
        'medium' => 'yellow',
        'hard' => 'red',
        'insane' => 'purple',
    ];
    $difficulty = [
        'easy' => 'Mudah',
        'medium' => 'Sedang',
        'hard' => 'Sulit',
        'insane' => 'Sangat Sulit',
    ];
@endphp
<div>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ $challenge->name }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ $challenge->short_description }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 pb-6">
        {{-- kartu kategori --}}
        <div class="bg-white dark:bg-zinc-700 rounded-lg shadow-lg p-6 ring-1 ring-gray-200 dark:ring-zinc-700">
            <div class="flex flex-col gap-4">
                <h2 class="text-md text-gray-900 dark:text-white">Kategori</h2>
                <h1 class="text-3xl font-semibold text-gray-900 dark:text-white">{{ $challenge->category->name }}</h1>
            </div>
        </div>
        {{-- kartu tingkat kesulitan --}}
        <div class="bg-white dark:bg-zinc-700 rounded-lg shadow-lg p-6 ring-1 ring-gray-200 dark:ring-zinc-700">
            <div class="flex flex-col gap-4">
                <h2 class="text-md text-gray-900 dark:text-white">Tingkat Kesulitan</h2>
                <h1 class="text-3xl font-semibold text-gray-900 dark:text-white">
                    {{ $difficulty[$challenge->difficulty] }}</h1>
            </div>
        </div>
        {{-- Kartu Total Solver --}}
        <div class="bg-white dark:bg-zinc-700 rounded-lg shadow-lg p-6 ring-1 ring-gray-200 dark:ring-zinc-700">
            <div class="flex flex-col gap-4">
                <h2 class="text-md text-gray-900 dark:text-white">Total Solver</h2>
                <h1 class="text-3xl font-semibold text-gray-900 dark:text-white">{{ count($solvers) }}</h1>
            </div>
        </div>
        {{-- Solver Terakhir --}}
        <div class="bg-white dark:bg-zinc-700 rounded-lg shadow-lg p-6 ring-1 ring-gray-200 dark:ring-zinc-700">
            <div class="flex flex-col gap-4">
                <h2 class="text-md text-gray-900 dark:text-white">First Solver</h2>
                <h1 class="text-3xl font-semibold text-gray-900 dark:text-white">{{ $solvers->first()->user->name ?? '-' }}
                </h1>
            </div>
        </div>

    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        {{-- Kartu Soal --}}
        <div class="col-span-2">
            <div class="bg-white dark:bg-zinc-700 rounded-lg shadow-lg p-6 ring-1 ring-gray-200 dark:ring-zinc-600">
                <div class="flex flex-col gap-4">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $challenge->name }}</h2>
                    <p class="text-sm text-gray-700 dark:text-gray-400">{!! $challenge->description !!}</p>
                    <div>
                        <flux:badge icon="star">{{ $challenge->points }} Poin</flux:badge>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-200 dark:border-zinc-500">
                    <form wire:submit.prevent="submitFlag">
                        <div class="flex gap-2">
                            <flux:input wire:model="flag" placeholder="Masukkan flag..." />
                            <flux:button type="submit" variant="primary">Submit</flux:button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- Kartu 10 Solver --}}
        <div class="col-span-1">
            <div class="bg-white dark:bg-zinc-700 rounded-lg shadow-lg p-6 ring-1 ring-gray-200 dark:ring-zinc-600">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Top 10 Solvers</h2>

                {{-- Ganti <ul> dengan <div> atau <ol> untuk daftar --}}
                <ul class="space-y-3">
                    {{-- Gunakan @forelse untuk menangani kasus jika tidak ada solver --}}
                    @forelse ($this->topSolver() as $topsolver)
                        <li class="flex items-center gap-3 text-gray-700 dark:text-gray-300">
                            {{-- Wadah untuk nomor atau ikon mahkota --}}
                            <div class="w-6 text-center font-bold flex-shrink-0">
                                @if ($loop->first)
                                    {{-- Tampilkan ikon mahkota untuk nomor 1 --}}
                                    👑
                                @else
                                    {{-- Tampilkan nomor untuk sisanya --}}
                                    {{ $loop->iteration }}
                                @endif
                            </div>
                            <span>{{ $topsolver->user->name }}</span>
                        </li>
                    @empty
                        {{-- Tampilan jika belum ada yang menyelesaikan soal --}}
                        <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada yang menyelesaikan soal ini.</p>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
