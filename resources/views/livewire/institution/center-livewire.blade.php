<div class="mx-auto max-w-full">
    <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">

        {{-- Header --}}
        <div class="border-b border-gray-100 bg-gradient-to-r from-indigo-50 to-white px-6 py-5 dark:border-gray-800 dark:from-indigo-500/10 dark:to-gray-900">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                <div class="flex items-start gap-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 21V7.5l8.25-4.5L21 7.5V21M9 21V12h7.5v9" />
                        </svg>
                    </div>

                    <div>
                        <h1 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                            Training Centers
                        </h1>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Manage and monitor all training centers
                        </p>
                    </div>
                </div>

                <a href="{{ route('centers.create') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-2xl bg-indigo-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-indigo-700">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    New Center
                </a>
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

            {{-- Table Card --}}
            <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
                <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h2 class="text-sm font-semibold text-gray-800 dark:text-gray-100">
                                Training Center Directory
                            </h2>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                View center profile, address, contact information, and details.
                            </p>
                        </div>

                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z" />
                                </svg>
                            </div>
                            <input
                                type="text"
                                placeholder="Search center..."
                                wire:model.live="search"
                                class="block w-full rounded-2xl border border-gray-200 bg-white py-2.5 pl-10 pr-4 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100 dark:border-gray-700 dark:bg-gray-900 dark:text-white dark:placeholder:text-gray-500 dark:focus:border-indigo-500 dark:focus:ring-indigo-500/10 sm:w-64">
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
                                    Center
                                </th>
                                <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Address
                                </th>
                                <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Mobile #
                                </th>
                                <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Landline #
                                </th>
                                <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Email
                                </th>
                                <th class="px-5 py-3 text-right text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 w-24">
                                    Action
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 bg-white dark:divide-gray-800 dark:bg-gray-900">
                            @forelse ($centers as $center)
                            <tr class="transition hover:bg-gray-50/80 dark:hover:bg-gray-800/40">
                                <td class="px-5 py-4">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-xs font-semibold text-gray-600 dark:bg-gray-800 dark:text-gray-300">
                                        {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                    </div>
                                </td>

                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 21V7.5l8.25-4.5L21 7.5V21M9 21V12h7.5v9" />
                                            </svg>
                                        </div>
                                        <div class="min-w-0">
                                            <p class="font-semibold text-gray-900 dark:text-white">
                                                {{ $center->name }}
                                            </p>
                                            <p class="mt-1 text-xs font-mono text-gray-400 dark:text-gray-500">
                                                {{ $center->code ?: 'No code' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-5 py-4">
                                    @if($center->address)
                                    <p class="max-w-[240px] text-sm leading-relaxed text-gray-600 dark:text-gray-300">
                                        {{ $center->address }}
                                    </p>
                                    @else
                                    <span class="text-xs text-gray-400 dark:text-gray-500">—</span>
                                    @endif
                                </td>

                                <td class="px-5 py-4">
                                    @if($center->contact_mobile)
                                    <span class="inline-flex items-center gap-1 rounded-full border border-emerald-200 bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 dark:border-emerald-900/40 dark:bg-emerald-500/10 dark:text-emerald-300">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                        {{ $center->contact_mobile }}
                                    </span>
                                    @else
                                    <span class="text-xs text-gray-400 dark:text-gray-500">No mobile</span>
                                    @endif
                                </td>

                                <td class="px-5 py-4">
                                    @if($center->contact_landline)
                                    <span class="text-sm text-gray-600 dark:text-gray-300">
                                        {{ $center->contact_landline }}
                                    </span>
                                    @else
                                    <span class="text-xs text-gray-400 dark:text-gray-500">—</span>
                                    @endif
                                </td>

                                <td class="px-5 py-4">
                                    @if($center->email)
                                    <span class="inline-flex items-center rounded-full border border-indigo-200 bg-indigo-50 px-2.5 py-1 text-xs font-medium text-indigo-700 dark:border-indigo-900/40 dark:bg-indigo-500/10 dark:text-indigo-300">
                                        {{ $center->email }}
                                    </span>
                                    @else
                                    <span class="text-xs text-gray-400 dark:text-gray-500">No email</span>
                                    @endif
                                </td>

                                <td class="px-5 py-4 text-right">
                                    <a href="{{ route('centers.show', ['uuid' => $center->uuid]) }}"
                                        class="inline-flex items-center gap-1.5 rounded-xl border border-indigo-200 bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-700 transition hover:bg-indigo-100 dark:border-indigo-900/40 dark:bg-indigo-500/10 dark:text-indigo-300 dark:hover:bg-indigo-500/20">
                                        View
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-5 py-16 text-center">
                                    <div class="mx-auto flex max-w-sm flex-col items-center">
                                        <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-gray-100 text-gray-400 dark:bg-gray-800 dark:text-gray-500">
                                            <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 21V7.5l8.25-4.5L21 7.5V21M9 21V12h7.5v9" />
                                            </svg>
                                        </div>
                                        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                                            No training centers found
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                            Try adjusting your search or create a new center.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($centers->hasPages())
                <div class="border-t border-gray-100 px-5 py-4 dark:border-gray-800">
                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-xs text-gray-400 dark:text-gray-500">
                            Showing {{ $centers->firstItem() }}–{{ $centers->lastItem() }} of {{ $centers->total() }} centers
                        </p>
                        <div>
                            {{ $centers->links() }}
                        </div>
                    </div>
                </div>
                @endif
            </div>

        </div>
    </div>
</div>