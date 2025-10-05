{{-- resources/views/components/challenge-card.blade.php --}}
@props(['challenge', 'isSolved'])

<div
    class="flex flex-col rounded-lg shadow-lg h-full bg-white dark:bg-zinc-800 ring-2 {{ $isSolved ? 'ring-green-500' : 'ring-gray-200 dark:ring-zinc-700' }} transition-transform duration-200 hover:-translate-y-1">
    <div class="flex-1 px-6 py-4">
        <div class="flex justify-between items-center mb-2">
            <p class="text-sm font-semibold text-blue-500 dark:text-blue-400">
                {{ $challenge->category->name }}
            </p>
            {{-- Badge ini sudah ada dari permintaan sebelumnya, kita pastikan lagi --}}
            <flux:badge color="{{ $isSolved ? 'green' : 'gray' }}">
                {{ $isSolved ? 'Selesai' : 'Kerjakan' }}
            </flux:badge>
        </div>
        <p class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">
            {{ $challenge->name }}
        </p>
        <p class="text-sm text-gray-700 dark:text-gray-400">
            {!! $challenge->short_description !!}
        </p>
    </div>
    <div class="border-t border-gray-200 dark:border-zinc-700 px-6 py-4">
        <div class="flex justify-between items-center">
            @php
                $difficultyColors = [ 'easy' => 'green', 'medium' => 'yellow', 'hard' => 'red', 'insane' => 'purple' ];
            @endphp
            <flux:badge color="{{ $difficultyColors[$challenge->difficulty] ?? 'gray' }}">
                {{ ucfirst($challenge->difficulty) }}
            </flux:badge>
            <flux:badge icon="star">{{ $challenge->points }} Poin</flux:badge>
        </div>
    </div>
</div>