<div class="container mx-auto px-4 py-8">
    <!-- Header Halaman menggunakan Flux UI -->
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Challenges') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">
            {{ __('Pilih soal CTF yang ingin kamu kerjakan. Sesuaikan dengan kemampuanmu.') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <!-- Filter dan Search Bar -->
    <div class="mb-6 flex w-full items-center gap-2">
        <flux:dropdown>
            <flux:button icon:trailing="chevron-down">Filter</flux:button>

            <flux:menu>
                <!-- Filter Kategori -->
                <flux:menu.submenu heading="Kategori">
                    <flux:menu.checkbox.group wire:model.live="category">
                        @foreach ($categories as $category)
                            <flux:menu.checkbox value="{{ $category->id }}">
                                {{ $category->name }}</flux:menu.checkbox>
                        @endforeach
                    </flux:menu.checkbox.group>
                </flux:menu.submenu>

                <!-- Filter Tingkat Kesulitan -->
                <!-- FIX: Typo pada heading diperbaiki -->
                <flux:menu.submenu heading="Tingkat Kesulitan">
                    <flux:menu.checkbox.group wire:model.live="difficulty">
                        <!-- FIX: wire:model menunjuk ke selectedDifficulty -->
                        <flux:menu.checkbox value="easy">Easy</flux:menu.checkbox>
                        <flux:menu.checkbox value="medium">Medium</flux:menu.checkbox>
                        <flux:menu.checkbox value="hard">Hard</flux:menu.checkbox>
                        <flux:menu.checkbox value="insane">Insane</flux:menu.checkbox>
                    </flux:menu.checkbox.group>
                </flux:menu.submenu>

                <flux:menu.separator />

                <flux:menu.item wire:click="clearFilters" variant="danger" icon="trash">Hapus Filter</flux:menu.item>
            </flux:menu>
        </flux:dropdown>

        <flux:input wire:model.live.debounce.300ms="search" icon="magnifying-glass" placeholder="Cari soal..." />
    </div>

    <!-- Grid untuk Kartu Soal (Tidak ada perubahan di bagian ini) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse ($this->challenges as $challenge)
            @php
                // 1. Definisikan variabel $isSolved di sini
                // Logika ini memeriksa apakah ID soal saat ini ada di dalam array soal yang sudah selesai.
                $isSolved = in_array($challenge->id, $solvedChallengeIds);
            @endphp

            <div wire:click="showChallengeModal({{ $challenge->id }})" wire:key="{{ $challenge->id }}"
                class="cursor-pointer">

                {{-- 2. Pastikan Anda melewatkan variabel $isSolved ke dalam komponen --}}
                <x-challenge-card :challenge="$challenge" :isSolved="$isSolved" />

            </div>
        @empty
            <div class="md:col-span-2 lg:col-span-3 text-center py-12">
                <p class="text-gray-500 dark:text-gray-400 text-lg">
                    Belum ada soal yang tersedia.
                </p>
            </div>
        @endforelse
    </div>
        <div class="mt-6">
            {{ $this->challenges->links() }}
        </div>
    <div x-data="{ show: @entangle('showModal') }" x-show="show" x-on:keydown.escape.window="show = false" style="display: none;"
        class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true">

        <div class="fixed inset-0 bg-[#000000bb]" @click="show = false" x-show="show"
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        </div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div x-show="show" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="relative transform overflow-hidden rounded-lg bg-white dark:bg-zinc-800 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl">
                    @if ($selectedChallenge)
                        @php
                            // 1. Cek status soal menggunakan data yang sudah ada
                            $isSolved = in_array($selectedChallenge->id, $solvedChallengeIds);
                        @endphp

                        <div
                            class="px-6 py-4 border-b border-gray-200 dark:border-zinc-700 flex justify-between items-center">
                            <div class="flex items-center gap-3">
                                <h2 id="modal-title" class="text-xl font-bold text-gray-900 dark:text-white">
                                    {{ $selectedChallenge->name }}</h2>

                                <flux:badge color="{{ $isSolved ? 'green' : 'gray' }}">
                                    {{ $isSolved ? 'Selesai' : 'Belum Dikerjakan' }}
                                </flux:badge>
                            </div>
                            <button @click="show = false"
                                class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 text-2xl">&times;</button>
                        </div>

                        <div class="p-6">
                            <div class="prose dark:prose-invert max-w-none">{!! $selectedChallenge->description !!}</div>
                            <a href="{{ route('challenges.detail', $selectedChallenge) }}" wire:key="{{ $selectedChallenge->id }}" class="text-sm text-gray-600 dark:text-gray-400 block mt-4 hover:underline">Detail</a>

                            @if (session()->has('success'))
                                <div class="mt-4 p-3 bg-green-100 text-green-800 rounded-md">{{ session('success') }}
                                </div>
                            @endif
                            @if (session()->has('error'))
                                <div class="mt-4 p-3 bg-red-100 text-red-800 rounded-md">{{ session('error') }}</div>
                            @endif
                            @error('flag')
                                <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="px-6 py-4 bg-gray-50 dark:bg-zinc-900 rounded-b-lg">
                            @if (!$isSolved)
                                <form wire:submit.prevent="submitFlag" class="flex items-center gap-2">
                                    <div class="flex-grow">
                                        <flux:input wire:model="flag" placeholder="Masukkan flag..." />
                                    </div>
                                    <flux:button type="submit">Submit</flux:button>
                                </form>
                            @else
                                <div class="text-center text-green-600 dark:text-green-400 font-semibold">
                                    ✓ Anda sudah menyelesaikan soal ini.
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
