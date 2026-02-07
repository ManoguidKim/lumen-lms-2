<div>
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
        <div>
            <h1 class="text-xl font-semibold text-gray-800">Training Applicants</h1>
            <p class="text-sm text-gray-400 mt-0.5">Review and manage all training applications</p>
        </div>
        <div class="flex items-center gap-3">

            <div class="relative">
                <a href="{{ route('learner-training-applications.register.application') }}"
                    class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-white bg-indigo-500 hover:bg-indigo-600 rounded-lg shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    New Student Application
                </a>
            </div>
            <!-- Filter Dropdown -->
            <div class="relative">
                <select class="pl-4 pr-10 py-2 text-sm border border-gray-200 rounded-lg bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition appearance-none">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                </select>
                <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>

            <!-- Search -->
            <div class="relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 11 5 11a6 6 0 0112 0z" />
                </svg>
                <input
                    type="text"
                    placeholder="Search applicants..."
                    wire:model.live="search"
                    class="pl-9 pr-4 py-2 text-sm border border-gray-200 rounded-lg w-64 bg-white text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
            </div>

            <!-- Export Button -->
            <button class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 hover:bg-gray-50 rounded-lg shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Export
            </button>
        </div>
    </div>

    @if(session()->has('success'))
    <div class="mb-6 p-4 text-green-800 bg-green-50 rounded-lg border border-green-200" role="alert">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            {{ session('success') }}
        </div>
    </div>
    @endif

    @if(session()->has('error'))
    <div class="mb-6 p-4 text-red-800 bg-red-50 rounded-lg border border-red-200" role="alert">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            {{ session('error') }}
        </div>
    </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-blue-500 uppercase tracking-wider">Total Applications</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($totalAppplication) }}</p>
                </div>
                <div class="p-3 bg-indigo-50 rounded-lg">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Pending Review</p>
                    <p class="text-2xl font-bold text-gray-600 mt-1">{{ number_format($totalPendingAppplication) }}</p>
                </div>
                <div class="p-3 bg-amber-50 rounded-lg">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-green-500 uppercase tracking-wider">Approved</p>
                    <p class="text-2xl font-bold text-gray-600 mt-1">{{ number_format($totalApprovedAppplication) }}</p>
                </div>
                <div class="p-3 bg-green-50 rounded-lg">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-red-500 uppercase tracking-wider">Rejected</p>
                    <p class="text-2xl font-bold text-gray-600 mt-1">{{ number_format($totalRejectedAppplication) }}</p>
                </div>
                <div class="p-3 bg-red-50 rounded-lg">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50">
                        <th class="px-5 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Application No.</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Applicant Details</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Training Course</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Training Center</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Application Date</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <!-- <th class="px-5 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Application Type</th> -->
                        <th class="px-5 py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($applicants as $applicant)
                    <tr class="border-b border-gray-100 last:border-0 hover:bg-gray-50 transition">
                        <td class="px-5 py-3.5 text-gray-400 font-medium uppercase">
                            {{ $applicant->application_number }}
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                <!-- <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                    <span class="text-sm font-semibold text-indigo-600">
                                        {{ substr($applicant->name, 0, 1) }}{{ substr($applicant->last_name, 0, 1) }}
                                    </span>
                                </div> -->
                                <div>
                                    <div class="font-semibold text-gray-800">
                                        {{ $applicant->name }} {{ $applicant->last_name }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ $applicant->email }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ $applicant->contact_number }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="font-medium text-gray-800">{{ $applicant->course_name }}</div>
                            <div class="text-xs text-gray-500">{{ $applicant->course_code }}</div>
                        </td>
                        <td class="px-5 py-3.5 text-gray-600">
                            <div class="font-medium">{{ $applicant->center_name }}</div>
                            <div class="text-xs text-gray-500">{{ $applicant->center_code }}</div>
                        </td>
                        <td class="px-5 py-3.5 text-gray-500 font-mono text-xs">
                            {{ date('M d, Y', strtotime($applicant->application_date)) }}
                        </td>
                        <td class="px-5 py-3.5">
                            @if($applicant->status === 'pending')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                </svg>
                                Pending
                            </span>
                            @elseif($applicant->status === 'approved')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Approved
                            </span>
                            @elseif($applicant->status === 'rejected')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                                Rejected
                            </span>
                            @endif
                        </td>
                        <td class="px-5 py-3.5 text-right">
                            <div class="flex items-center justify-end gap-2">
                                @if ($applicant->registration_type == "online" && $applicant->status == "pending")
                                <button wire:click.prevent="toggleModalOnlineApplication({{ $applicant->id }})" class="text-indigo-500 hover:text-indigo-700 font-medium text-sm transition">
                                    Review
                                </button>
                                <span class="text-gray-300">|</span>
                                @endif
                                <button class="text-gray-500 hover:text-gray-700 font-medium text-sm transition">
                                    View →
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-5 py-12 text-center">
                            <svg class="mx-auto w-12 h-12 text-gray-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                            <p class="mt-4 text-sm font-medium text-gray-500">No applicants found</p>
                            <p class="mt-1 text-xs text-gray-400">Try adjusting your search or filter to find what you're looking for.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if ($applicants->hasPages())
    <div class="mt-4">
        {{ $applicants->links() }}
    </div>
    @endif

    @if($openModalOnlineApplication)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">

        <div class="relative w-full max-w-4xl max-h-full p-4">
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <!-- Header -->
                <div class="flex items-center justify-between p-4 border-b border-gray-200 rounded-t md:p-5 bg-blue-50 dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Select Available Batch
                    </h3>
                    <button
                        wire:click="toggleModalOnlineApplication"
                        class="w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900">
                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>

                <!-- Body -->
                <div class="p-4 space-y-4 md:p-5">
                    @if(session()->has('message'))
                    <div class="p-4 text-sm text-green-800 bg-green-100 rounded-lg" role="alert">
                        {{ session('message') }}
                    </div>
                    @endif

                    @if($batches->count() > 0)
                    <div class="space-y-3">
                        <label class="block text-sm font-medium text-gray-700">
                            Choose a batch:
                        </label>

                        @foreach($batches as $batch)
                        <label class="flex items-start p-4 transition border rounded-lg cursor-pointer hover:bg-gray-50 {{ $selectedBatchId == $batch->id ? 'border-blue-500 bg-blue-50' : 'border-gray-200' }}">
                            <input
                                type="radio"
                                wire:model="selectedBatchId"
                                value="{{ $batch->id }}"
                                class="w-4 h-4 mt-1 text-blue-600 border-gray-300 focus:ring-blue-500">
                            <div class="flex-1 ml-3">
                                <div class="flex items-center justify-between">
                                    <span class="font-medium text-gray-900">{{ $batch->batch_name }} - {{ $batch->batch_code }}</span>
                                    <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                                        {{ $batch->status }}
                                    </span>
                                </div>
                                <div class="mt-1 space-y-1 text-sm text-gray-500">
                                    <p>Start: {{ \Carbon\Carbon::parse($batch->start_date)->format('M d, Y') }}</p>
                                    @if($batch->end_date)
                                    <p>End: {{ \Carbon\Carbon::parse($batch->end_date)->format('M d, Y') }}</p>
                                    @endif
                                    @if($batch->max_participants)
                                    <p>Capacity: {{ $batch->registered_students_count ?? 0 }}/{{ $batch->max_participants }}</p>
                                    @endif
                                </div>
                            </div>
                        </label>
                        @endforeach

                        @error('selectedBatchId')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    @else
                    <div class="p-8 text-center text-gray-500">
                        <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <p>No available batches at the moment.</p>
                    </div>
                    @endif
                </div>

                <!-- Footer -->
                <div class="flex items-center p-4 border-t border-gray-200 rounded-b md:p-5 dark:border-gray-600">
                    <button
                        wire:click="assignBatch"
                        wire:confirm="Are you sure you want to approve and assign this learner to this training batch? This action cannot be undone."
                        type="button"
                        {{ $batches->count() == 0 ? 'disabled' : '' }}
                        class="px-5 py-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 disabled:opacity-50 disabled:cursor-not-allowed">
                        Confirm Selection
                    </button>
                    <button
                        wire:click="toggleModalOnlineApplication"
                        type="button"
                        class="py-2.5 px-5 ml-3 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-blue-700">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>