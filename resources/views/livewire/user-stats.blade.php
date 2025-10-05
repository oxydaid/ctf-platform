{{-- resources/views/livewire/user-stats.blade.php --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    
    <!-- Kartu 1: Total Soal -->
    {{-- FIX: Tambahkan kelas border di sini --}}
    <div class="bg-white dark:bg-zinc-800 rounded-lg shadow p-6 border-2 dark:border-zinc-700">
        <div class="flex items-center">
            <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-1.125 0-2.062.938-1.976 2.062a48.427 48.427 0 002.122 10.375c.178.577.502 1.075.925 1.44a3 3 0 002.069.865h4.916a3 3 0 002.07-.865c.422-.365.746-.863.925-1.44a48.427 48.427 0 002.122-10.375c.086-1.125-.852-2.062-1.976-2.062H15.75m0 0v-2.142m0 0a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 6.108v2.142" />
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Soal</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalChallenges }}</p>
            </div>
        </div>
    </div>

    <!-- Kartu 2: Soal Selesai -->
    {{-- FIX: Tambahkan kelas border di sini --}}
    <div class="bg-white dark:bg-zinc-800 rounded-lg shadow p-6 border-2 dark:border-zinc-700">
        <div class="flex items-center">
            <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Soal Selesai</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $solvedChallenges }}</p>
            </div>
        </div>
    </div>

    <!-- Kartu 3: Poin Anda -->
    {{-- FIX: Tambahkan kelas border di sini --}}
    <div class="bg-white dark:bg-zinc-800 rounded-lg shadow p-6 border-2 dark:border-zinc-700">
        <div class="flex items-center">
            <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Poin Anda</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $userPoints }}</p>
            </div>
        </div>
    </div>

    <!-- Kartu 4: Peringkat -->
    {{-- FIX: Tambahkan kelas border di sini --}}
    <div class="bg-white dark:bg-zinc-800 rounded-lg shadow p-6 border-2 dark:border-zinc-700">
        <div class="flex items-center">
            <div class="flex-shrink-0 bg-red-500 rounded-md p-3">
                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-6.75c-.622 0-1.125.504-1.125 1.125V18.75m9 0h-9" />
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Peringkat</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">#{{ $userRank }}</p>
            </div>
        </div>
    </div>

</div>