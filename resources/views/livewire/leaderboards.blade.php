<div class="container mx-auto px-4 py-8">
    <!-- Header dan Tombol Filter -->
    <div class="mb-6">
        <flux:heading size="xl" level="1">Papan Peringkat</flux:heading>
        <flux:subheading size="lg" class="mb-4">Lihat peringkat para peserta berdasarkan poin atau jumlah soal yang diselesaikan.</flux:subheading>

        <!-- Container untuk filter dan search bar -->
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
            <!-- Tombol untuk beralih mode sort -->
            <div class="inline-flex rounded-md shadow-sm" role="group">
                <button wire:click="setSortBy('points')" type="button"
                    class="px-4 py-2 text-sm font-medium rounded-l-lg transition-colors
                    {{ $sortBy === 'points' ? 'bg-blue-600 text-white border-blue-600' : 'bg-white dark:bg-zinc-700 text-gray-900 dark:text-gray-200 border border-gray-200 dark:border-zinc-600 hover:bg-gray-100 dark:hover:bg-zinc-600' }}">
                    Berdasarkan Poin
                </button>
                <button wire:click="setSortBy('solves')" type="button"
                    class="px-4 py-2 text-sm font-medium rounded-r-md transition-colors
                    {{ $sortBy === 'solves' ? 'bg-blue-600 text-white border-blue-600' : 'bg-white dark:bg-zinc-700 text-gray-900 dark:text-gray-200 border border-gray-200 dark:border-zinc-600 hover:bg-gray-100 dark:hover:bg-zinc-600' }}">
                    Berdasarkan Solves
                </button>
            </div>
            
            <!-- 1. Input Pencarian -->
            <div class="w-full sm:w-auto sm:max-w-xs">
                <flux:input wire:model.live.debounce.300ms="search" icon="magnifying-glass" placeholder="Cari nama user..." />
            </div>
        </div>
    </div>

    <!-- Tabel Leaderboard -->
    <div class="bg-white dark:bg-zinc-800 rounded-lg shadow overflow-hidden border dark:border-zinc-700">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
                <thead class="bg-gray-50 dark:bg-zinc-900/50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider w-16">Peringkat</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">User</th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Poin</th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Soal Selesai</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-zinc-800 divide-y divide-gray-200 dark:divide-zinc-700">
                    @forelse ($this->users as $index => $user)
                        <tr class="dark:hover:bg-zinc-700/50">
                            <td class="px-6 py-4 whitespace-nowrap text-center font-bold text-lg">
                                {{-- 2. Logika peringkat yang benar untuk paginasi --}}
                                @php
                                    $rank = ($this->users->currentPage() - 1) * $this->users->perPage() + $index + 1;
                                @endphp

                                @if ($sortBy === 'points' || $sortBy === 'solves')
                                    @if ($rank == 1) <span class="text-yellow-400">🥇</span>
                                    @elseif ($rank == 2) <span class="text-gray-400">🥈</span>
                                    @elseif ($rank == 3) <span class="text-orange-400">🥉</span>
                                    @else {{ $rank }}
                                    @endif
                                @else
                                    {{ $rank }}
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-200 dark:bg-zinc-700 text-gray-600 dark:text-gray-300 flex items-center justify-center font-bold">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-900 dark:text-white">
                                {{ $user->points }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500 dark:text-gray-400">
                                {{ $user->submissions_count ?? $user->submissions->count() }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                Tidak ada user yang cocok dengan pencarian Anda.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- 3. Link Paginasi -->
         @if ($this->users->hasPages())
        <div class="p-4 border-t border-gray-200 dark:border-zinc-700">
            {{ $this->users->links() }}
        </div>
        @endif
    </div>
</div>