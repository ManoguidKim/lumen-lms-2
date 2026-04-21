<div class="mx-auto max-w-7xl px-4 py-6">
    <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">

        {{-- Main Header --}}
        <div class="border-b border-gray-100 bg-gradient-to-r from-indigo-50 to-white px-6 py-5 dark:border-gray-800 dark:from-indigo-500/10 dark:to-gray-900">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div class="flex items-start gap-4">
                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-600 shadow-sm dark:bg-indigo-500/10 dark:text-indigo-400">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72A9.094 9.094 0 0112 21a9.094 9.094 0 01-6-2.28m12 0A8.966 8.966 0 0021 12c0-4.97-4.03-9-9-9s-9 4.03-9 9c0 2.76 1.24 5.23 3 6.72m12 0L15.75 15.75M8.25 15.75 6 18.72M15 9.75h.008v.008H15V9.75Zm-6 0h.008v.008H9V9.75Z" />
                        </svg>
                    </div>

                    <div>
                        <h1 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                            Training Applicants
                        </h1>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Review and manage all training applications
                        </p>
                    </div>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    <a
                        href="{{ route('learner-training-applications.list.registered.applicants') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-2xl border border-amber-200 bg-amber-50 px-4 py-2.5 text-sm font-medium text-amber-800 shadow-sm transition hover:bg-amber-100 dark:border-amber-900/40 dark:bg-amber-500/10 dark:text-amber-300 dark:hover:bg-amber-500/20">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                        Registered Applicants
                    </a>

                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z" />
                            </svg>
                        </div>
                        <input
                            type="text"
                            placeholder="Search applicants..."
                            wire:model.live="search"
                            class="block w-full rounded-2xl border border-gray-200 bg-white py-2.5 pl-10 pr-4 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100 dark:border-gray-700 dark:bg-gray-900 dark:text-white dark:placeholder:text-gray-500 dark:focus:border-indigo-500 dark:focus:ring-indigo-500/10 sm:w-72">
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6 px-6 py-6">

            {{-- Flash Messages --}}
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
                                Total Applications
                            </p>
                            <p class="mt-3 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ number_format($totalAppplication) }}
                            </p>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">All submitted applications</p>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
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
                                Pending Review
                            </p>
                            <p class="mt-3 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ number_format($totalPendingAppplication) }}
                            </p>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Awaiting action</p>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-amber-50 text-amber-600 dark:bg-amber-500/10 dark:text-amber-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
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
                                {{ number_format($totalApprovedAppplication) }}
                            </p>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Successfully approved</p>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
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
                            <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-rose-500 dark:text-rose-400">
                                Cancelled
                            </p>
                            <p class="mt-3 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ number_format($totalCancelledAppplication) }}
                            </p>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">No longer active</p>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-rose-50 text-rose-600 dark:bg-rose-500/10 dark:text-rose-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-5 h-1.5 rounded-full bg-rose-50 dark:bg-rose-500/10">
                        <div class="h-1.5 w-1/3 rounded-full bg-rose-500"></div>
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
                                Review applicant profile, course, training center, assigned batch, and status.
                            </p>
                        </div>
                        <div class="text-xs text-gray-400 dark:text-gray-500">
                            @if(method_exists($applicants, 'total'))
                            Total: {{ $applicants->total() }} application(s)
                            @endif
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100 text-sm dark:divide-gray-800">
                        <thead class="bg-gray-50/80 dark:bg-gray-800/40">
                            <tr>
                                <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Application No.
                                </th>
                                <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Applicant Details
                                </th>
                                <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Training Course
                                </th>
                                <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Training Center
                                </th>
                                <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Assigned Batch
                                </th>
                                <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Application Date
                                </th>
                                <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Status
                                </th>
                                <th class="px-5 py-3 text-right text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 w-36">
                                    Actions
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 bg-white dark:divide-gray-800 dark:bg-gray-900">
                            @forelse ($applicants as $applicant)
                            <tr class="transition hover:bg-gray-50/80 dark:hover:bg-gray-800/40">
                                <td class="px-5 py-4">
                                    <span class="inline-flex items-center rounded-lg bg-gray-100 px-2.5 py-1 font-mono text-xs font-semibold uppercase text-gray-700 dark:bg-gray-800 dark:text-gray-300">
                                        {{ $applicant->application_number }}
                                    </span>
                                </td>

                                <td class="px-5 py-4">
                                    <div class="min-w-0">
                                        <p class="font-semibold text-gray-900 dark:text-white">
                                            {{ $applicant->full_name_searchable }}
                                        </p>
                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                            {{ $applicant->email }}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $applicant->contact_number }}
                                        </p>
                                    </div>
                                </td>

                                <td class="px-5 py-4">
                                    <div class="font-medium text-gray-800 dark:text-gray-100">
                                        {{ $applicant->course_name }}
                                    </div>
                                    <div class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                        {{ $applicant->course_code }}
                                    </div>
                                </td>

                                <td class="px-5 py-4">
                                    <div class="font-medium text-gray-800 dark:text-gray-100">
                                        {{ $applicant->center_name }}
                                    </div>
                                    <div class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                        {{ $applicant->center_code }}
                                    </div>
                                </td>

                                <td class="px-5 py-4">
                                    @if($applicant->batch_name)
                                    <div class="font-medium text-gray-800 dark:text-gray-100">
                                        {{ $applicant->batch_name }}
                                    </div>
                                    <div class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                        {{ $applicant->batch_code }}
                                    </div>
                                    @else
                                    <span class="inline-flex items-center rounded-full border border-gray-200 bg-gray-50 px-2.5 py-1 text-xs font-medium text-gray-600 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
                                        No batch assigned
                                    </span>
                                    @endif
                                </td>

                                <td class="px-5 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ date('M d, Y', strtotime($applicant->application_date)) }}
                                    </span>
                                </td>

                                <td class="px-5 py-4">
                                    @if($applicant->status === 'pending')
                                    <span class="inline-flex items-center gap-1 rounded-full border border-amber-200 bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700 dark:border-amber-900/40 dark:bg-amber-500/10 dark:text-amber-300">
                                        <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                        </svg>
                                        Pending
                                    </span>
                                    @elseif($applicant->status === 'approved')
                                    <span class="inline-flex items-center gap-1 rounded-full border border-emerald-200 bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700 dark:border-emerald-900/40 dark:bg-emerald-500/10 dark:text-emerald-300">
                                        <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        Approved
                                    </span>
                                    @elseif($applicant->status === 'rejected')
                                    <span class="inline-flex items-center gap-1 rounded-full border border-red-200 bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-700 dark:border-red-900/40 dark:bg-red-500/10 dark:text-red-300">
                                        <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                        </svg>
                                        Rejected
                                    </span>
                                    @elseif($applicant->status === 'cancelled')
                                    <span class="inline-flex items-center gap-1 rounded-full border border-rose-200 bg-rose-50 px-2.5 py-1 text-xs font-semibold text-rose-700 dark:border-rose-900/40 dark:bg-rose-500/10 dark:text-rose-300">
                                        <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                        </svg>
                                        Cancelled
                                    </span>
                                    @endif
                                </td>

                                <td class="px-5 py-4 text-right">
                                    @if ($applicant->status == "pending")
                                    <div class="flex items-center justify-end gap-2">
                                        <button
                                            wire:click.prevent="cancelApplication('{{ $applicant->uuid }}')"
                                            wire:confirm="Are you sure you want to cancel this application? This action cannot be undone."
                                            class="inline-flex items-center gap-1.5 rounded-xl border border-amber-200 bg-amber-50 px-3 py-1.5 text-xs font-semibold text-amber-700 transition hover:bg-amber-100 dark:border-amber-900/40 dark:bg-amber-500/10 dark:text-amber-300 dark:hover:bg-amber-500/20">
                                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Cancel
                                        </button>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="px-5 py-16 text-center">
                                    <div class="mx-auto flex max-w-sm flex-col items-center">
                                        <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-gray-100 text-gray-400 dark:bg-gray-800 dark:text-gray-500">
                                            <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                            </svg>
                                        </div>
                                        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                                            No applicants found
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                            Try adjusting your search or filter to find what you're looking for.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($applicants->hasPages())
                <div class="border-t border-gray-100 px-5 py-4 dark:border-gray-800">
                    {{ $applicants->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Modal --}}
    @if($openModalOnlineApplication)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/60 px-4 backdrop-blur-sm">
        <div class="relative w-full max-w-4xl overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-2xl dark:border-gray-700 dark:bg-gray-900">
            <div class="border-b border-gray-100 bg-gradient-to-r from-indigo-50 to-white px-5 py-4 dark:border-gray-800 dark:from-indigo-500/10 dark:to-gray-900">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex items-start gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Select Available Batch
                            </h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Choose an open batch for this online application.
                            </p>
                        </div>
                    </div>

                    <button
                        wire:click="toggleModalOnlineApplication"
                        class="flex h-9 w-9 items-center justify-center rounded-xl text-gray-400 transition hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-800 dark:hover:text-gray-200">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 14 14" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="max-h-[70vh] overflow-y-auto p-5">
                @if(session()->has('message'))
                <div class="mb-4 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:border-emerald-900/40 dark:bg-emerald-500/10 dark:text-emerald-300">
                    {{ session('message') }}
                </div>
                @endif

                @if($batches->count() > 0)
                <div class="space-y-3">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                        Choose a batch:
                    </label>

                    @foreach($batches as $batch)
                    <label class="flex cursor-pointer items-start rounded-2xl border p-4 transition hover:bg-gray-50 dark:hover:bg-gray-800/40 {{ $selectedBatchId == $batch->id ? 'border-indigo-500 bg-indigo-50 shadow-sm dark:border-indigo-400 dark:bg-indigo-500/10' : 'border-gray-200 dark:border-gray-700' }}">
                        <input
                            type="radio"
                            wire:model="selectedBatchId"
                            value="{{ $batch->id }}"
                            class="mt-1 h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">

                        <div class="ml-3 flex-1">
                            <div class="flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between">
                                <div>
                                    <div class="font-semibold text-gray-900 dark:text-white">
                                        {{ $batch->batch_name }} - {{ $batch->batch_code }}
                                    </div>
                                    <div class="mt-2 space-y-1 text-sm text-gray-500 dark:text-gray-400">
                                        <p>Start: {{ \Carbon\Carbon::parse($batch->start_date)->format('M d, Y') }}</p>
                                        @if($batch->end_date)
                                        <p>End: {{ \Carbon\Carbon::parse($batch->end_date)->format('M d, Y') }}</p>
                                        @endif
                                        @if($batch->max_participants)
                                        <p>Capacity: {{ $batch->registered_students_count ?? 0 }}/{{ $batch->max_participants }}</p>
                                        @endif
                                    </div>
                                </div>

                                <span class="inline-flex items-center rounded-full border border-emerald-200 bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700 dark:border-emerald-900/40 dark:bg-emerald-500/10 dark:text-emerald-300">
                                    {{ $batch->status }}
                                </span>
                            </div>
                        </div>
                    </label>
                    @endforeach

                    @error('selectedBatchId')
                    <p class="text-xs font-medium text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                @else
                <div class="py-12 text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-gray-100 text-gray-400 dark:bg-gray-800 dark:text-gray-500">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        No available batches at the moment.
                    </p>
                </div>
                @endif
            </div>

            <div class="flex items-center justify-end gap-3 border-t border-gray-100 bg-gray-50 px-5 py-4 dark:border-gray-800 dark:bg-gray-900/70">
                <button
                    wire:click="toggleModalOnlineApplication"
                    type="button"
                    class="inline-flex items-center rounded-2xl border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                    Cancel
                </button>

                <button
                    wire:click="assignBatch"
                    wire:confirm="Are you sure you want to approve and assign this learner to this training batch? This action cannot be undone."
                    type="button"
                    {{ $batches->count() == 0 ? 'disabled' : '' }}
                    class="inline-flex items-center rounded-2xl bg-indigo-600 px-5 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 dark:focus:ring-offset-gray-900">
                    Confirm Selection
                </button>
            </div>
        </div>
    </div>
    @endif
</div>