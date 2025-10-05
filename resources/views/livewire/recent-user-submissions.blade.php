{{-- resources/views/livewire/recent-user-submissions.blade.php --}}
<div class="bg-white dark:bg-zinc-800 rounded-lg shadow p-6 border-2 dark:border-zinc-700 mt-6">
    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
        Riwayat Penyelesaian Terakhir
    </h3>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
            <thead class="bg-gray-50 dark:bg-zinc-900/50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Soal</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Kategori</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Waktu</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-zinc-800 divide-y divide-gray-200 dark:divide-zinc-700">
                @forelse ($submissions as $submission)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('challenges.detail', $submission->challenge) }}" class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:underline">
                                {{ $submission->challenge->name }}
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300">
                                {{ $submission->challenge->category->name }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ $submission->created_at->diffForHumans() }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                            Anda belum menyelesaikan soal apapun. Ayo mulai kerjakan!
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>