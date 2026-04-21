<div class="space-y-6">
    {{-- Header --}}
    <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
        <div class="flex items-start gap-4">
            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72A9.094 9.094 0 0112 21a9.094 9.094 0 01-6-2.28m12 0A8.966 8.966 0 0021 12c0-4.97-4.03-9-9-9s-9 4.03-9 9c0 2.76 1.24 5.23 3 6.72m12 0L15.75 15.75M8.25 15.75 6 18.72M15 9.75h.008v.008H15V9.75Zm-6 0h.008v.008H9V9.75Z" />
                </svg>
            </div>

            <div>
                <h1 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                    Registered Applicants
                </h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Review and manage all registered learner applicants
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
                    placeholder="Search name, ULI, etc."
                    wire:model.live="search"
                    class="block w-full rounded-xl border border-gray-200 bg-white py-2.5 pl-10 pr-4 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100 dark:border-gray-700 dark:bg-gray-900 dark:text-white dark:placeholder:text-gray-500 dark:focus:border-indigo-500 dark:focus:ring-indigo-500/10 sm:w-72">
            </div>

            <a
                href="{{ route('learner-applications.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-950">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                New Application
            </a>
        </div>
    </div>

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

    {{-- Table Card --}}
    <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
        <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800">
            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-sm font-semibold text-gray-800 dark:text-gray-100">
                        Applicant Directory
                    </h2>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        View applicant details, update records, enroll learners, or print forms.
                    </p>
                </div>

                <div class="text-xs text-gray-400 dark:text-gray-500">
                    @if(method_exists($applicants, 'total'))
                    Total: {{ $applicants->total() }} applicant(s)
                    @endif
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
                            ULI
                        </th>
                        <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                            Applicant
                        </th>
                        <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                            Sex
                        </th>
                        <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                            Birth Date
                        </th>
                        <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                            Civil Status
                        </th>
                        <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                            Contact
                        </th>
                        <th class="px-5 py-3 text-right text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 w-[280px]">
                            Actions
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 bg-white dark:divide-gray-800 dark:bg-gray-900">
                    @forelse ($applicants as $applicant)
                    <tr class="transition hover:bg-gray-50/80 dark:hover:bg-gray-800/40">
                        <td class="px-5 py-4">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-xs font-semibold text-gray-600 dark:bg-gray-800 dark:text-gray-300">
                                {{ $loop->iteration }}
                            </div>
                        </td>

                        <td class="px-5 py-4">
                            <span class="inline-flex items-center rounded-lg bg-indigo-50 px-2.5 py-1 font-mono text-xs font-semibold text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-300">
                                {{ strtoupper($applicant->uli) }}
                            </span>
                        </td>

                        <td class="px-5 py-4">
                            <div>
                                <p class="font-semibold uppercase tracking-tight text-gray-900 dark:text-white">
                                    {{ $applicant->name }}
                                    {{ $applicant->middle_name ? $applicant->middle_name . ' ' : '' }}
                                    {{ $applicant->last_name }}
                                </p>
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                    {{ collect([$applicant->address_number_street, $applicant->address_barangay, $applicant->address_city, $applicant->address_province])->filter()->implode(', ') ?: '—' }}
                                </p>
                            </div>
                        </td>

                        <td class="px-5 py-4">
                            <span class="text-sm text-gray-700 dark:text-gray-300">
                                {{ ucwords($applicant->sex) }}
                            </span>
                        </td>

                        <td class="px-5 py-4 whitespace-nowrap">
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                {{ date('M d, Y', strtotime($applicant->birth_date)) }}
                            </span>
                        </td>

                        <td class="px-5 py-4">
                            <span class="inline-flex items-center rounded-lg bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-700 dark:bg-gray-800 dark:text-gray-300">
                                {{ ucwords($applicant->civil_status) }}
                            </span>
                        </td>

                        <td class="px-5 py-4 whitespace-nowrap">
                            <span class="text-sm text-gray-700 dark:text-gray-300">
                                {{ $applicant->contact_mobile ?: '—' }}
                            </span>
                        </td>

                        <td class="px-5 py-4">
                            <div class="flex items-center justify-end gap-2">

                                {{-- Update --}}
                                <a
                                    href="{{ route('update-registered-learner.edit', $applicant->uuid) }}"
                                    class="inline-flex items-center gap-1.5 rounded-xl border border-blue-200 bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-700 transition hover:bg-blue-100 focus:ring-2 focus:ring-blue-200">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" />
                                    </svg>
                                    Update
                                </a>

                                {{-- Enroll --}}
                                <a
                                    href="{{ route('learner-training-applications.register.existing.application', $applicant->uuid) }}"
                                    class="inline-flex items-center gap-1.5 rounded-xl border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700 transition hover:bg-emerald-100 focus:ring-2 focus:ring-emerald-200">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                                    </svg>
                                    Enroll
                                </a>

                                {{-- View Form --}}
                                <button
                                    wire:click="printForm('{{ $applicant->uuid }}')"
                                    type="button"
                                    class="inline-flex items-center gap-1.5 rounded-xl border border-violet-200 bg-violet-50 px-3 py-1.5 text-xs font-semibold text-violet-700 transition hover:bg-violet-100 focus:ring-2 focus:ring-violet-200">

                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 9V2h9l5 5v13a2 2 0 01-2 2H6a2 2 0 01-2-2V9h2m0 0h10m-10 0V7a2 2 0 012-2h4" />
                                    </svg>
                                    Form
                                </button>

                            </div>
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
                                    Try adjusting your search or add a new application.
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

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Livewire.on('open-pdf', (event) => {
                const base64 = event.pdf;
                const byteCharacters = atob(base64);
                const byteNumbers = Array.from(byteCharacters, c => c.charCodeAt(0));
                const byteArray = new Uint8Array(byteNumbers);
                const blob = new Blob([byteArray], {
                    type: 'application/pdf'
                });
                const blobUrl = URL.createObjectURL(blob);

                const win = window.open(blobUrl, '_blank');
                if (win) {
                    win.onload = () => win.print();
                }
            });
        });
    </script>
</div>