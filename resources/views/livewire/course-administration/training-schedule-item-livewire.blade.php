<div class="mx-auto max-w-full">
    <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">

        {{-- Header --}}
        <div class="border-b border-gray-100 bg-gradient-to-r from-indigo-50 to-white px-6 py-5 dark:border-gray-800 dark:from-indigo-500/10 dark:to-gray-900">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                <div class="flex items-start gap-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>

                    <div>
                        <h1 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                            Training Schedule Items
                        </h1>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Manage and monitor all training schedule items
                        </p>
                    </div>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z" />
                            </svg>
                        </div>
                        <input
                            type="text"
                            placeholder="Search schedule item..."
                            wire:model.live="search"
                            class="block w-full rounded-2xl border border-gray-200 bg-white py-2.5 pl-10 pr-4 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100 dark:border-gray-700 dark:bg-gray-900 dark:text-white dark:placeholder:text-gray-500 dark:focus:border-indigo-500 dark:focus:ring-indigo-500/10 sm:w-64">
                    </div>

                    <a href="{{ route('training_schedule_items.create') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-2xl bg-indigo-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-indigo-700">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        New Schedule Item
                    </a>
                </div>
            </div>
        </div>

        <div class="space-y-6 px-6 py-6">

            {{-- Alerts --}}
            @if(session()->has('success'))
            <div class="flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-800 shadow-sm dark:border-emerald-900/40 dark:bg-emerald-500/10 dark:text-emerald-300">
                <div class="mt-0.5 flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-100 dark:bg-emerald-500/10">
                    <svg class="h-4 w-4 text-emerald-600 dark:text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold">Success</p>
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
            </div>
            @endif

            @if(session()->has('error'))
            <div class="flex items-start gap-3 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-red-800 shadow-sm dark:border-red-900/40 dark:bg-red-500/10 dark:text-red-300">
                <div class="mt-0.5 flex h-9 w-9 items-center justify-center rounded-xl bg-red-100 dark:bg-red-500/10">
                    <svg class="h-4 w-4 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold">Error</p>
                    <p class="text-sm">{{ session('error') }}</p>
                </div>
            </div>
            @endif

            {{-- Table Card --}}
            <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
                <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800">
                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h2 class="text-sm font-semibold text-gray-800 dark:text-gray-100">
                                Schedule Directory
                            </h2>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                View schedule name, description, assigned days, and time range.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="border-b border-gray-100 bg-gray-50/80 dark:bg-gray-800/40">
                                <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">#</th>
                                <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Name</th>
                                <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Description</th>
                                <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Schedule Days</th>
                                <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Time</th>
                                <th class="px-5 py-3"></th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @forelse ($scheduleItems as $scheduleItem)
                            <tr class="hover:bg-gray-50/80 transition-colors duration-150 dark:hover:bg-gray-800/40">

                                {{-- # --}}
                                <td class="px-5 py-4">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-xs font-semibold text-gray-600 dark:bg-gray-800 dark:text-gray-300">
                                        {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                    </div>
                                </td>

                                {{-- Name --}}
                                <td class="px-5 py-4">
                                    <div class="font-semibold text-gray-800 text-sm dark:text-gray-100">{{ $scheduleItem->name }}</div>
                                </td>

                                {{-- Description --}}
                                <td class="px-5 py-4 max-w-xs">
                                    <p class="text-xs text-gray-500 leading-relaxed line-clamp-2 dark:text-gray-400">
                                        {{ $scheduleItem->description ?? '—' }}
                                    </p>
                                </td>

                                {{-- Schedule Days --}}
                                <td class="px-5 py-4">
                                    <div class="flex flex-wrap gap-1">
                                        @foreach ($scheduleItem->schedule_days ?? [] as $day)
                                        @php
                                        $short = strtoupper(substr($day, 0, 3));
                                        $colors = [
                                        'MON' => 'bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-300',
                                        'TUE' => 'bg-violet-50 text-violet-600 dark:bg-violet-500/10 dark:text-violet-300',
                                        'WED' => 'bg-green-50 text-green-600 dark:bg-green-500/10 dark:text-green-300',
                                        'THU' => 'bg-amber-50 text-amber-600 dark:bg-amber-500/10 dark:text-amber-300',
                                        'FRI' => 'bg-rose-50 text-rose-600 dark:bg-rose-500/10 dark:text-rose-300',
                                        'SAT' => 'bg-orange-50 text-orange-600 dark:bg-orange-500/10 dark:text-orange-300',
                                        'SUN' => 'bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-300',
                                        ];
                                        $color = $colors[$short] ?? 'bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-300';
                                        @endphp
                                        <span class="inline-block text-xs font-semibold font-mono px-2 py-0.5 rounded {{ $color }}">
                                            {{ $short }}
                                        </span>
                                        @endforeach
                                    </div>
                                </td>

                                {{-- Time --}}
                                <td class="px-5 py-4">
                                    <div class="inline-flex items-center gap-1.5 rounded-xl border border-gray-100 bg-gray-50 px-2.5 py-1.5 dark:border-gray-700 dark:bg-gray-800">
                                        <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="10" />
                                            <path stroke-linecap="round" d="M12 6v6l4 2" />
                                        </svg>
                                        <span class="text-xs font-mono text-gray-600 dark:text-gray-300">
                                            {{ date('g:i A', strtotime($scheduleItem->start_time)) }}
                                        </span>
                                        <span class="text-xs text-gray-300 dark:text-gray-500">→</span>
                                        <span class="text-xs font-mono text-gray-600 dark:text-gray-300">
                                            {{ date('g:i A', strtotime($scheduleItem->end_time)) }}
                                        </span>
                                    </div>
                                </td>

                                {{-- Action --}}
                                <td class="px-5 py-4 text-right">
                                    <a href="{{ route('training_schedule_items.show', $scheduleItem->uuid) }}"
                                        class="inline-flex items-center gap-1.5 rounded-xl border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700 transition hover:bg-emerald-100 dark:border-emerald-900/40 dark:bg-emerald-500/10 dark:text-emerald-300 dark:hover:bg-emerald-500/20">
                                        View
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-5 py-16 text-center">
                                    <div class="mx-auto flex max-w-sm flex-col items-center">
                                        <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-gray-100 text-gray-400 dark:bg-gray-800 dark:text-gray-500">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 9v7.5" />
                                            </svg>
                                        </div>
                                        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">No schedule items found</h3>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Add a schedule to get started</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Pagination --}}
            @if ($scheduleItems->hasPages())
            <div class="rounded-2xl border border-gray-200 bg-white px-4 py-3 shadow-sm dark:border-gray-800 dark:bg-gray-900">
                {{ $scheduleItems->links() }}
            </div>
            @endif
        </div>
    </div>
</div>