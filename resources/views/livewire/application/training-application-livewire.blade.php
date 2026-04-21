<div class="mx-auto max-w-full">
    <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">

        {{-- Header --}}
        <div class="border-b border-gray-100 bg-gradient-to-r from-indigo-50 to-white px-6 py-5 dark:border-gray-800 dark:from-indigo-500/10 dark:to-gray-900">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                <div class="flex items-start gap-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 21V7.125a1.125 1.125 0 00-.659-1.024l-6.75-3a1.125 1.125 0 00-.932 0l-6.75 3A1.125 1.125 0 003.75 7.125V21m15.75 0h-15m15 0h1.5m-16.5 0H3m3.75-9h10.5m-10.5 4.5h10.5M8.25 21v-3.375c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125V21" />
                        </svg>
                    </div>

                    <div>
                        <h1 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                            Learner Training Applications
                        </h1>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Manage and monitor all training applications of learner
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
                            placeholder="Search application..."
                            wire:model.live="search"
                            class="block w-full rounded-2xl border border-gray-200 bg-white py-2.5 pl-10 pr-4 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100 dark:border-gray-700 dark:bg-gray-900 dark:text-white dark:placeholder:text-gray-500 dark:focus:border-indigo-500 dark:focus:ring-indigo-500/10 sm:w-64">
                    </div>

                    <a href="{{ route('learner-training-applications.create') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-2xl bg-indigo-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-indigo-700">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        New Application
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
            <div class="flex items-start gap-3 rounded-2xl border border-rose-100 bg-rose-50 px-4 py-3 text-rose-700 shadow-sm dark:border-rose-900/20 dark:bg-rose-500/10 dark:text-rose-300">
                <div class="mt-0.5 flex h-9 w-9 items-center justify-center rounded-xl bg-rose-100 dark:bg-rose-500/10">
                    <svg class="h-4 w-4 text-rose-500 dark:text-rose-300" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
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
                                Total Applications
                            </p>
                            <p class="mt-3 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $applications->total() }}
                            </p>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Submitted records
                            </p>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 21V7.125a1.125 1.125 0 00-.659-1.024l-6.75-3a1.125 1.125 0 00-.932 0l-6.75 3A1.125 1.125 0 003.75 7.125V21m15.75 0h-15" />
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
                            <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-amber-500 dark:text-amber-400">
                                Pending
                            </p>
                            <p class="mt-3 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $applications->where('status', 'pending')->count() }}
                            </p>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Awaiting review
                            </p>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-amber-50 text-amber-600 dark:bg-amber-500/10 dark:text-amber-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-5 h-1.5 rounded-full bg-amber-50 dark:bg-amber-500/10">
                        <div class="h-1.5 w-1/2 rounded-full bg-amber-500"></div>
                    </div>
                </div>

                <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-800 dark:bg-gray-900">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-emerald-500 dark:text-emerald-400">
                                Approved
                            </p>
                            <p class="mt-3 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $applications->where('status', 'approved')->count() }}
                            </p>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Approved applications
                            </p>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
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
                                With Batch
                            </p>
                            <p class="mt-3 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $applications->filter(fn($application) => !empty($application->batch_name))->count() }}
                            </p>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Already assigned
                            </p>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-violet-50 text-violet-600 dark:bg-violet-500/10 dark:text-violet-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-5 h-1.5 rounded-full bg-violet-50 dark:bg-violet-500/10">
                        <div class="h-1.5 w-1/3 rounded-full bg-violet-500"></div>
                    </div>
                </div>
            </div>

            {{-- Table Card --}}
            <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
                <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800">
                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h2 class="text-sm font-semibold text-gray-800 dark:text-gray-100">
                                Application Directory
                            </h2>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                Review submitted training applications, status, and remarks.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100 text-sm dark:divide-gray-800">
                        <thead class="bg-gray-50/80 dark:bg-gray-800/40">
                            <tr>
                                <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">#</th>
                                <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Application Number</th>
                                <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Training Center</th>
                                <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Training Course</th>
                                <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Application Date</th>
                                <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Status</th>
                                <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Reviewed By</th>
                                <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Reviewed At</th>
                                <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Reviewed Remarks</th>
                                <th class="px-5 py-3 text-right text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white dark:divide-gray-800 dark:bg-gray-900">
                            @forelse ($applications as $application)
                            <tr class="transition hover:bg-gray-50/80 dark:hover:bg-gray-800/40">
                                <td class="px-5 py-4">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-xs font-semibold text-gray-600 dark:bg-gray-800 dark:text-gray-300">
                                        {{ $loop->iteration }}
                                    </div>
                                </td>

                                <td class="px-5 py-4">
                                    <span class="inline-flex items-center rounded-lg bg-indigo-50 px-2.5 py-1 text-xs font-semibold text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-300">
                                        {{ $application->application_number }}
                                    </span>
                                </td>

                                <td class="px-5 py-4">
                                    <div class="font-semibold text-gray-800 dark:text-gray-100">
                                        {{ $application->name }}
                                    </div>
                                </td>

                                <td class="px-5 py-4">
                                    <div class="text-gray-700 dark:text-gray-300">
                                        {{ $application->course_name }}
                                    </div>
                                    <div class="mt-1 text-xs text-gray-400 dark:text-gray-500">
                                        {{ $application->course_code }}
                                    </div>
                                </td>

                                <td class="px-5 py-4">
                                    <span class="font-mono text-xs text-gray-500 dark:text-gray-400">
                                        {{ date('M d, Y', strtotime($application->application_date)) }}
                                    </span>
                                </td>

                                <td class="px-5 py-4">
                                    @php
                                    $status = strtolower($application->status);
                                    $statusClasses = match($status) {
                                    'approved' => 'border-emerald-200 bg-emerald-50 text-emerald-700 dark:border-emerald-900/40 dark:bg-emerald-500/10 dark:text-emerald-300',
                                    'pending' => 'border-amber-200 bg-amber-50 text-amber-700 dark:border-amber-900/40 dark:bg-amber-500/10 dark:text-amber-300',
                                    'rejected' => 'border-rose-100 bg-rose-50 text-rose-600 dark:border-rose-900/20 dark:bg-rose-500/10 dark:text-rose-300',
                                    default => 'border-gray-200 bg-gray-50 text-gray-600 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300',
                                    };
                                    @endphp
                                    <span class="inline-flex items-center gap-1.5 rounded-full border px-2.5 py-1 text-xs font-semibold {{ $statusClasses }}">
                                        <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                        {{ ucfirst($application->status) }}
                                    </span>
                                </td>

                                <td class="px-5 py-4 text-gray-500 dark:text-gray-400">
                                    {{ $application->reviewed_by ?? '—' }}
                                </td>

                                <td class="px-5 py-4 text-gray-500 dark:text-gray-400">
                                    {{ $application->reviewed_at ? date('M d, Y', strtotime($application->reviewed_at)) : '—' }}
                                </td>

                                <td class="px-5 py-4">
                                    <p class="max-w-xs text-sm text-gray-500 dark:text-gray-400">
                                        {{ $application->reviewed_remarks ?? '—' }}
                                    </p>
                                </td>

                                <td class="px-5 py-4 text-right">
                                    <a href="{{ route('learner-training-applications.show', $application->uuid) }}"
                                        class="inline-flex items-center gap-1.5 rounded-xl border border-indigo-200 bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-700 transition hover:bg-indigo-100 dark:border-indigo-900/40 dark:bg-indigo-500/10 dark:text-indigo-300 dark:hover:bg-indigo-500/20">
                                        View
                                        <svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="px-5 py-16 text-center">
                                    <div class="mx-auto flex max-w-sm flex-col items-center">
                                        <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-gray-100 text-gray-400 dark:bg-gray-800 dark:text-gray-500">
                                            <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                            </svg>
                                        </div>
                                        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">No training applications found</h3>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Try adjusting your search or create a new application.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Pagination --}}
            @if ($applications->hasPages())
            <div class="rounded-2xl border border-gray-200 bg-white px-4 py-3 shadow-sm dark:border-gray-800 dark:bg-gray-900">
                {{ $applications->links() }}
            </div>
            @endif
        </div>
    </div>
</div>