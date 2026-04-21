<div class="mx-auto max-w-full">
    <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">

        {{-- Header --}}
        <div class="border-b border-gray-100 bg-gradient-to-r from-indigo-50 to-white px-6 py-5 dark:border-gray-800 dark:from-indigo-500/10 dark:to-gray-900">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                <div class="flex items-start gap-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>

                    <div>
                        <h1 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                            Training Batches
                        </h1>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Manage and monitor all training batches
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
                            placeholder="Search batch..."
                            wire:model.live="search"
                            class="block w-full rounded-2xl border border-gray-200 bg-white py-2.5 pl-10 pr-4 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100 dark:border-gray-700 dark:bg-gray-900 dark:text-white dark:placeholder:text-gray-500 dark:focus:border-indigo-500 dark:focus:ring-indigo-500/10 sm:w-64">
                    </div>

                    <a href="{{ route('training_batches.create') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-2xl bg-indigo-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-indigo-700">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        New Training Batch
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
                        <path fill-rule="evenodd" d="M18 10A8 8 0 11 2 10a8 8 0 0116 0zm-7-4a1 1 0 10-2 0v4a1 1 0 102 0V6zm-1 8a1.25 1.25 0 100-2.5A1.25 1.25 0 0010 14z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold">Error</p>
                    <p class="text-sm">{{ session('error') }}</p>
                </div>
            </div>
            @endif

            {{-- Stats --}}
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-800 dark:bg-gray-900">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-indigo-500 dark:text-indigo-400">
                                Total Batches
                            </p>
                            <p class="mt-3 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $trainingBatches->total() }}
                            </p>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Registered training batches
                            </p>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-5 h-1.5 rounded-full bg-indigo-50 dark:bg-indigo-500/10">
                        <div class="h-1.5 w-3/4 rounded-full bg-indigo-500"></div>
                    </div>
                </div>

                <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-800 dark:bg-gray-900">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-emerald-500 dark:text-emerald-400">
                                Open / Ongoing
                            </p>
                            <p class="mt-3 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $trainingBatches->filter(fn($b) => in_array($b->status, ['open', 'ongoing']))->count() }}
                            </p>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Currently active batches
                            </p>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9Z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-5 h-1.5 rounded-full bg-emerald-50 dark:bg-emerald-500/10">
                        <div class="h-1.5 w-2/3 rounded-full bg-emerald-500"></div>
                    </div>
                </div>

                <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-800 dark:bg-gray-900">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-violet-500 dark:text-violet-400">
                                With Trainer
                            </p>
                            <p class="mt-3 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $trainingBatches->filter(fn($b) => !empty($b->trainer_name))->count() }}
                            </p>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Assigned batches
                            </p>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-violet-50 text-violet-600 dark:bg-violet-500/10 dark:text-violet-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75a17.933 17.933 0 01-7.499-1.632z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-5 h-1.5 rounded-full bg-violet-50 dark:bg-violet-500/10">
                        <div class="h-1.5 w-1/2 rounded-full bg-violet-500"></div>
                    </div>
                </div>

                <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-800 dark:bg-gray-900">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-amber-500 dark:text-amber-400">
                                Full Batches
                            </p>
                            <p class="mt-3 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $trainingBatches->filter(fn($b) => $b->status === 'full')->count() }}
                            </p>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Reached max participants
                            </p>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-amber-50 text-amber-600 dark:bg-amber-500/10 dark:text-amber-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h7.5m-7.5 4.5h7.5m-7.5 4.5h4.5" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25A2.25 2.25 0 016 3h12a2.25 2.25 0 012.25 2.25v13.5A2.25 2.25 0 0118 21H6a2.25 2.25 0 01-2.25-2.25V5.25z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-5 h-1.5 rounded-full bg-amber-50 dark:bg-amber-500/10">
                        <div class="h-1.5 w-1/3 rounded-full bg-amber-500"></div>
                    </div>
                </div>
            </div>

            {{-- Table Card --}}
            <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
                <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800">
                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h2 class="text-sm font-semibold text-gray-800 dark:text-gray-100">
                                Batch Directory
                            </h2>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                View batch details, assigned course, dates, participants, trainer, and status.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100 text-sm dark:divide-gray-800">
                        <thead class="bg-gray-50/80 dark:bg-gray-800/40">
                            <tr>
                                <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 w-14">
                                    #
                                </th>
                                <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Batch
                                </th>
                                <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Course
                                </th>
                                <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Dates
                                </th>
                                <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Participants
                                </th>
                                <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Trainer
                                </th>
                                <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Status
                                </th>
                                <th class="px-5 py-3 text-right text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 w-28">
                                    Action
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 bg-white dark:divide-gray-800 dark:bg-gray-900">
                            @forelse ($trainingBatches as $trainingBatch)
                            <tr class="transition hover:bg-gray-50/80 dark:hover:bg-gray-800/40">
                                <td class="px-5 py-4">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-xs font-semibold text-gray-600 dark:bg-gray-800 dark:text-gray-300">
                                        {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                    </div>
                                </td>

                                <td class="px-5 py-4">
                                    <div class="min-w-0">
                                        <p class="font-semibold text-gray-900 dark:text-white">
                                            {{ $trainingBatch->batch_name }}
                                        </p>
                                        <p class="mt-1 text-xs font-mono text-gray-400 dark:text-gray-500">
                                            {{ $trainingBatch->batch_code }}
                                        </p>
                                    </div>
                                </td>

                                <td class="px-5 py-4">
                                    <div class="min-w-0">
                                        <p class="font-medium text-gray-800 dark:text-gray-100">
                                            {{ $trainingBatch->course_name }}
                                        </p>
                                        <p class="mt-1 text-xs font-mono text-gray-400 dark:text-gray-500">
                                            {{ $trainingBatch->course_code }}
                                        </p>
                                    </div>
                                </td>

                                <td class="px-5 py-4">
                                    <p class="text-sm text-gray-700 dark:text-gray-300">
                                        {{ date('M d, Y', strtotime($trainingBatch->start_date)) }}
                                    </p>
                                    <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">
                                        → {{ date('M d, Y', strtotime($trainingBatch->end_date)) }}
                                    </p>
                                </td>

                                <td class="px-5 py-4">
                                    @php
                                    $pct = $trainingBatch->max_participants > 0
                                    ? round(($trainingBatch->registered_students_count / $trainingBatch->max_participants) * 100)
                                    : 0;
                                    $barColor = $pct >= 100 ? 'bg-amber-400' : 'bg-emerald-500';
                                    @endphp

                                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                        {{ $trainingBatch->registered_students_count }} / {{ $trainingBatch->max_participants }}
                                    </p>
                                    <div class="mt-2 h-1.5 w-24 overflow-hidden rounded-full bg-gray-100 dark:bg-gray-800">
                                        <div class="h-full rounded-full {{ $barColor }}" style="width: {{ min($pct, 100) }}%"></div>
                                    </div>
                                </td>

                                <td class="px-5 py-4">
                                    @if($trainingBatch->trainer_name)
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-emerald-50 text-xs font-bold text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-300">
                                            {{ strtoupper(substr($trainingBatch->trainer_name, 0, 1)) }}{{ strtoupper(substr($trainingBatch->trainer_last_name ?? '', 0, 1)) }}
                                        </div>
                                        <div class="min-w-0">
                                            <p class="font-medium text-gray-800 dark:text-gray-100">
                                                {{ $trainingBatch->trainer_name }} {{ $trainingBatch->trainer_last_name }}
                                            </p>
                                            <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">
                                                {{ $trainingBatch->center_name }}
                                            </p>
                                        </div>
                                    </div>
                                    @else
                                    <span class="text-xs italic text-gray-400 dark:text-gray-500">— Not assigned</span>
                                    @endif
                                </td>

                                <td class="px-5 py-4">
                                    @php
                                    $statusStyles = [
                                    'open' => 'border-green-200 bg-green-50 text-green-700 dark:border-green-900/40 dark:bg-green-500/10 dark:text-green-300',
                                    'ongoing' => 'border-blue-200 bg-blue-50 text-blue-700 dark:border-blue-900/40 dark:bg-blue-500/10 dark:text-blue-300',
                                    'full' => 'border-amber-200 bg-amber-50 text-amber-700 dark:border-amber-900/40 dark:bg-amber-500/10 dark:text-amber-300',
                                    'closed' => 'border-gray-200 bg-gray-100 text-gray-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300',
                                    'completed' => 'border-gray-200 bg-gray-100 text-gray-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300',
                                    ];
                                    $style = $statusStyles[$trainingBatch->status] ?? 'border-gray-200 bg-gray-100 text-gray-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300';
                                    @endphp

                                    <span class="inline-flex items-center gap-1.5 rounded-full border px-2.5 py-1 text-xs font-semibold uppercase tracking-wide {{ $style }}">
                                        <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                        {{ $trainingBatch->status }}
                                    </span>
                                </td>

                                <td class="px-5 py-4 text-right">
                                    <a href="{{ route('training_batches.show', $trainingBatch->uuid) }}"
                                        class="inline-flex items-center gap-1.5 rounded-xl border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700 transition hover:bg-emerald-100 dark:border-emerald-900/40 dark:bg-emerald-500/10 dark:text-emerald-300 dark:hover:bg-emerald-500/20">
                                        View
                                        <svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="px-5 py-16 text-center">
                                    <div class="mx-auto flex max-w-sm flex-col items-center">
                                        <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-gray-100 text-gray-400 dark:bg-gray-800 dark:text-gray-500">
                                            <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                            </svg>
                                        </div>
                                        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                                            No training batches found
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                            Create a new batch to get started.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($trainingBatches->hasPages())
                <div class="border-t border-gray-100 px-5 py-4 dark:border-gray-800">
                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-xs text-gray-400 dark:text-gray-500">
                            Showing {{ $trainingBatches->firstItem() }}–{{ $trainingBatches->lastItem() }} of {{ $trainingBatches->total() }} batches
                        </p>
                        <div>
                            {{ $trainingBatches->links() }}
                        </div>
                    </div>
                </div>
                @endif
            </div>

        </div>
    </div>
</div>