<div>
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
        <div>
            <h1 class="text-xl font-semibold text-gray-800">Training Schedule Items</h1>
            <p class="text-sm text-gray-400 mt-0.5">Manage and monitor all training schedule items</p>
        </div>
        <div class="flex items-center gap-3">
            <!-- Search -->
            <div class="relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 11 5 11a6 6 0 0112 0z" />
                </svg>
                <input
                    type="text"
                    placeholder="Search schedule item..."
                    wire:model.live="search"
                    class="pl-9 pr-4 py-2 text-sm border border-gray-200 rounded-lg w-64 bg-white text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
            </div>
            <!-- Create Button -->
            <a href="{{ route('training_schedule_items.create') }}"
                class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-white bg-indigo-500 hover:bg-indigo-600 rounded-lg shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                New Schedule Item
            </a>
        </div>
    </div>

    @if(session()->has('success'))
    <div class="m-4 md:m-5 p-4 text-green-800 bg-green-50 rounded-lg border border-green-200 dark:bg-green-900 dark:text-green-200" role="alert">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            {{ session('success') }}
        </div>
    </div>
    @endif

    @if(session()->has('error'))
    <div class="m-4 md:m-5 p-4 text-red-800 bg-red-50 rounded-lg border border-red-200 dark:bg-red-900 dark:text-red-200" role="alert">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
            </svg>
            {{ session('error') }}
        </div>
    </div>
    @endif

    <!-- Table -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50">
                        <th class="px-5 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">#</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Description</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Schedule Days</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Start Time</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">End Time</th>
                        <th class="px-5 py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($scheduleItems as $scheduleItem)
                    <tr class="border-b border-gray-100 last:border-0 hover:bg-gray-50 transition">
                        <td class="px-5 py-3.5 text-gray-400 font-medium">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-5 py-3.5 text-gray-800 font-semibold">
                            {{ $scheduleItem->name }}
                        </td>
                        <td class="px-5 py-3.5 text-gray-600">
                            {{ $scheduleItem->description }}
                        </td>
                        <td class="px-5 py-3.5 text-gray-600">
                            {{ implode(', ', $scheduleItem->schedule_days ?? []) }}
                        </td>
                        <td class="px-5 py-3.5 text-gray-500 font-mono text-xs">
                            {{ date('g:i A', strtotime($scheduleItem->start_time)) }}
                        </td>
                        <td class="px-5 py-3.5 text-gray-500 font-mono text-xs">
                            {{ date('g:i A', strtotime($scheduleItem->end_time)) }}
                        </td>
                        <td class="px-5 py-3.5 text-right">
                            <a href="{{ route('training_schedule_items.show', $scheduleItem->uuid) }}"
                                class="text-indigo-500 hover:text-indigo-700 font-medium text-sm transition">
                                View →
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-5 py-4 text-center">
                            <svg class="mx-auto w-10 h-10 text-gray-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-400">No training schedule items found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if ($scheduleItems->hasPages())
    <div class="mt-4">
        {{ $scheduleItems->links() }}
    </div>
    @endif
</div>