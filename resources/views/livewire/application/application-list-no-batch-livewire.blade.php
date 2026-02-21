<div>
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
        <div>
            <h1 class="text-xl font-semibold text-gray-800">List od application without assigned training batch</h1>
            <p class="text-sm text-gray-400 mt-0.5">Review and manage all training applications</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="relative">
                <button wire:click.prevent="assignTrainingBatch()"
                    class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-white bg-indigo-500 hover:bg-indigo-600 rounded-lg shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Assign Training Batch
                </button>
            </div>
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
                    <p class="text-2xl font-bold text-gray-800 mt-1">{{ $applicants->count() }}</p>
                </div>
                <div class="p-3 bg-indigo-50 rounded-lg">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
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
                        <th class="px-5 py-3">
                            <input
                                type="checkbox"
                                wire:model.live="selectAll"
                                class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 focus:ring-indigo-500" />
                        </th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Application No.</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Applicant Details</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Training Course</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Training Center</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Assigned Batch</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Application Date</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($applicants as $applicant)
                    <tr class="border-b border-gray-100 last:border-0 hover:bg-gray-50 transition">
                        <td class="px-5 py-3.5">
                            <input
                                type="checkbox"
                                wire:model.live="selectedIds"
                                value="{{ $applicant->id }}"
                                class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 focus:ring-indigo-500" />
                        </td>
                        <td class="px-5 py-3.5 text-gray-400 font-medium uppercase">
                            {{ $applicant->application_number }}
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                <div>
                                    <div class="font-semibold text-gray-800">
                                        {{ $applicant->name }} {{ $applicant->last_name }}
                                    </div>
                                    <div class="text-xs text-gray-500">{{ $applicant->email }}</div>
                                    <div class="text-xs text-gray-500">{{ $applicant->contact_number }}</div>
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
                        <td class="px-5 py-3.5 text-gray-600">
                            @if($applicant->batch_name)
                            <div class="font-medium">{{ $applicant->batch_name }} - {{ $applicant->batch_code }}</div>
                            @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500">
                                No batch assigned
                            </span>
                            @endif
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
                                <a href="{{ route('learner-training-applications.update.registered.application', $applicant->uuid) }}" class="text-gray-500 hover:text-gray-700 font-medium text-sm transition">
                                    View →
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="px-5 py-12 text-center">
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




    <!-- Assign Batch Modal -->
    @if($openAssignBatchModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-gray-900/50 backdrop-blur-sm" wire:click="$set('openAssignBatchModal', false)"></div>

        <!-- Modal -->
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-2xl mx-4 z-10">

            <!-- Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div>
                    <h3 class="text-base font-semibold text-gray-900">Assign Training Batch</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Assigning batch to {{ count($selectedIds) }} selected application(s)</p>
                </div>
                <button wire:click="$set('openAssignBatchModal', false)" class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Body -->
            <div class="px-6 py-5 space-y-5">

                <!-- Course & Center Info -->
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-gray-50 rounded-lg px-4 py-3">
                        <p class="text-xs text-gray-400 uppercase tracking-wide font-medium mb-1">Training Course</p>
                        <p class="text-sm font-semibold text-gray-800">{{ $trainingCourses->firstWhere('id', $trainingCourseId)?->course_name ?? '—' }}</p>
                        <p class="text-xs text-gray-500">{{ $trainingCourses->firstWhere('id', $trainingCourseId)?->course_code ?? '' }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg px-4 py-3">
                        <p class="text-xs text-gray-400 uppercase tracking-wide font-medium mb-1">Training Center</p>
                        <p class="text-sm font-semibold text-gray-800">{{ $trainingCenters->firstWhere('id', $trainingCenterId)?->name ?? '—' }}</p>
                        <p class="text-xs text-gray-500">{{ $trainingCenters->firstWhere('id', $trainingCenterId)?->center_code ?? '' }}</p>
                    </div>
                </div>

                <!-- Batch Selection -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Select Batch <span class="text-red-500">*</span>
                    </label>

                    @if($trainingBatches->isEmpty())
                    <div class="flex items-center gap-3 p-4 bg-amber-50 border border-amber-200 rounded-lg">
                        <svg class="w-5 h-5 text-amber-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                        <p class="text-sm text-amber-700">No available batches found for this course and center.</p>
                    </div>
                    @else
                    <div class="space-y-2 max-h-60 overflow-y-auto pr-1">
                        @foreach($trainingBatches as $batch)
                        <label class="flex items-start gap-3 p-3 border rounded-lg cursor-pointer transition
                        {{ $trainingBatchId == $batch->id ? 'border-indigo-500 bg-indigo-50' : 'border-gray-200 hover:border-gray-300 hover:bg-gray-50' }}">
                            <input
                                type="radio"
                                wire:model.live="trainingBatchId"
                                value="{{ $batch->id }}"
                                class="mt-0.5 text-indigo-600 focus:ring-indigo-500" />
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-2">
                                    <p class="text-sm font-semibold text-gray-800">{{ $batch->batch_name }}</p>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
                                    {{ $batch->status === 'open' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                                        {{ ucfirst($batch->status) }}
                                    </span>
                                </div>
                                <p class="text-xs text-gray-500 mt-0.5">{{ $batch->batch_code }}</p>
                                <p class="text-xs text-gray-400 mt-1">
                                    {{ \Carbon\Carbon::parse($batch->start_date)->format('M d, Y') }}
                                    –
                                    {{ \Carbon\Carbon::parse($batch->end_date)->format('M d, Y') }}
                                </p>
                            </div>
                        </label>
                        @endforeach
                    </div>
                    @endif

                    @error('trainingBatchId')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- Footer -->
            <div class="flex items-center justify-end gap-3 px-6 py-4 border-t border-gray-100 bg-gray-50 rounded-b-2xl">
                <button
                    wire:click="$set('openAssignBatchModal', false)"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                    Cancel
                </button>
                <button
                    wire:click="confirmBatchAssignment"
                    @disabled($trainingBatches->isEmpty() || !$trainingBatchId)
                    class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition disabled:opacity-50 disabled:cursor-not-allowed">
                    <span wire:loading.remove wire:target="confirmBatchAssignment">Assign Batch</span>
                    <span wire:loading wire:target="confirmBatchAssignment" class="flex items-center gap-2">
                        <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z" />
                        </svg>
                        Assigning...
                    </span>
                </button>
            </div>

        </div>
    </div>
    @endif
</div>