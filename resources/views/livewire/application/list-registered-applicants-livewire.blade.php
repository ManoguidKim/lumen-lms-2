<div>
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
        <div>
            <h1 class="text-xl font-semibold text-gray-800">Registered Applicants</h1>
            <p class="text-sm text-gray-400 mt-0.5">Review and manage all registered learner applicants</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z" />
                </svg>
                <input type="text" placeholder="Search name, ULI, etc." wire:model.live="search"
                    class="pl-9 pr-4 py-2 text-sm border border-gray-200 rounded-lg w-64 bg-white text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
            </div>
            <a href="{{ route('learner-applications.create') }}"
                class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-white bg-indigo-500 hover:bg-indigo-600 rounded-lg shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                New Application
            </a>
        </div>
    </div>

    {{-- Flash Messages --}}
    @if(session()->has('success'))
    <div class="mb-4 p-4 text-green-800 bg-green-50 rounded-lg border border-green-200 flex items-center gap-2 text-sm" role="alert">
        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
        </svg>
        {{ session('success') }}
    </div>
    @endif
    @if(session()->has('error'))
    <div class="mb-4 p-4 text-red-800 bg-red-50 rounded-lg border border-red-200 flex items-center gap-2 text-sm" role="alert">
        <svg class="w-4 h-4 text-red-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-9a1 1 0 012 0v4a1 1 0 01-2 0V9zm1 7a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
        </svg>
        {{ session('error') }}
    </div>
    @endif

    {{-- Table --}}
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50">
                        <th class="px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">#</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">ULI</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Address</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Sex</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Date of Birth</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Civil Status</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Contact</th>
                        <th class="px-5 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($applicants as $applicant)
                    <tr class="hover:bg-gray-50 transition-colors duration-100">
                        <td class="px-5 py-3.5 text-gray-400 text-xs font-medium">{{ $loop->iteration }}</td>

                        <td class="px-5 py-3.5">
                            <span class="font-mono text-xs text-indigo-600 font-medium">
                                {{ strtoupper($applicant->uli) }}
                            </span>
                        </td>

                        <td class="px-5 py-3.5 font-medium text-gray-800 uppercase">
                            {{ $applicant->name }}
                            {{ $applicant->middle_name ? $applicant->middle_name . ' ' : '' }}
                            {{ $applicant->last_name }}
                        </td>

                        <td class="px-5 py-3.5 text-gray-500 max-w-[180px]">
                            <span class="line-clamp-1 text-xs">
                                {{ collect([$applicant->address_number_street, $applicant->address_barangay, $applicant->address_city, $applicant->address_province])->filter()->implode(', ') }}
                            </span>
                        </td>

                        <td class="px-5 py-3.5 text-gray-600">{{ ucwords($applicant->sex) }}</td>

                        <td class="px-5 py-3.5 text-gray-500 whitespace-nowrap">
                            {{ date('M d, Y', strtotime($applicant->birth_date)) }}
                        </td>

                        <td class="px-5 py-3.5 text-gray-600">{{ ucwords($applicant->civil_status) }}</td>

                        <td class="px-5 py-3.5 text-gray-600 whitespace-nowrap">{{ $applicant->contact_mobile }}</td>

                        <td class="px-5 py-3.5">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('update-registered-learner.edit', $applicant->uuid) }}"
                                    class="inline-flex items-center gap-1 text-blue-500 hover:text-blue-700 font-medium text-xs transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" />
                                    </svg>
                                    Update
                                </a>

                                <span class="text-gray-200">|</span>

                                <a href="{{ route('learner-training-applications.register.existing.application', $applicant->uuid) }}"
                                    class="inline-flex items-center gap-1 text-emerald-500 hover:text-emerald-700 font-medium text-xs transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                                    </svg>
                                    Enroll
                                </a>

                                <span class="text-gray-200">|</span>

                                <a href="#" wire:click.prevent="printForm('{{ $applicant->uuid }}')"
                                    class="inline-flex items-center gap-1 text-violet-500 hover:text-violet-700 font-medium text-xs transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                    View Form
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="px-5 py-14 text-center">
                            <svg class="mx-auto w-10 h-10 text-gray-300 mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                            <p class="text-sm font-medium text-gray-500">No applicants found</p>
                            <p class="text-xs text-gray-400 mt-1">Try adjusting your search or add a new application.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($applicants->hasPages())
        <div class="px-5 py-4 border-t border-gray-100">
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