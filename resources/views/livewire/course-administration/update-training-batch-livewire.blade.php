<div class="mx-auto max-w-full">
    <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">

        {{-- Header --}}
        <div class="border-b border-gray-100 bg-gradient-to-r from-blue-50 to-white px-6 py-5 dark:border-gray-800 dark:from-blue-500/10 dark:to-gray-900">
            <div class="flex items-start gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>

                <div>
                    <h1 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                        Update Training Batch
                    </h1>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Update the details of the training batch
                    </p>
                </div>
            </div>
        </div>

        {{-- Error Message --}}
        @if(session('error'))
        <div class="mx-6 mt-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-red-800 shadow-sm dark:border-red-900/40 dark:bg-red-500/10 dark:text-red-300">
            <div class="flex items-start gap-3">
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
        </div>
        @endif

        <div class="space-y-8">

            {{-- Basic Information --}}
            <div class="px-6 pt-6">
                <div class="mb-4 flex items-center gap-3">
                    <div class="h-8 w-1 rounded-full bg-blue-500"></div>
                    <div>
                        <h2 class="text-base font-semibold text-gray-900 dark:text-white">Basic Information</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Training course, batch details, dates, and capacity</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                    <div class="md:col-span-2">
                        <label for="training_course_id" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Training Course <span class="text-red-500">*</span>
                        </label>
                        <select
                            id="training_course_id"
                            name="training_course_id"
                            wire:model.live="trainingBatchCourseId"
                            class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 dark:bg-gray-800 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500/10 @error('trainingBatchCourseId') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">
                            <option value="">Select training course</option>
                            @foreach($trainingCourses as $course)
                            <option value="{{ $course->id }}">
                                {{ $course->course_name }}
                            </option>
                            @endforeach
                        </select>
                        @error('trainingBatchCourseId')
                        <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="batch_code" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Batch Code <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="batch_code"
                            wire:model="batchCode"
                            value="{{ old('batchCode') }}"
                            placeholder="Enter batch code"
                            class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 dark:bg-gray-800 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500/10 @error('batchCode') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">
                        @error('batchCode')
                        <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="batch_name" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Batch Name <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="batch_name"
                            wire:model="batchName"
                            placeholder="Enter batch name"
                            class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 dark:bg-gray-800 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500/10 @error('batchName') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">
                        @error('batchName')
                        <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="start_date" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Start Date <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="date"
                            id="start_date"
                            wire:model.live="startDate"
                            class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 dark:bg-gray-800 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500/10 @error('startDate') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">
                        @error('startDate')
                        <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="end_date" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            End Date <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="date"
                            id="end_date"
                            wire:model.live="endDate"
                            class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 dark:bg-gray-800 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500/10 @error('endDate') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">
                        @error('endDate')
                        <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="max_participants" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Max Participants <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="number"
                            id="max_participants"
                            wire:model="maxParticipants"
                            min="0"
                            placeholder="Enter max participants"
                            class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 dark:bg-gray-800 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500/10 @error('maxParticipants') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">
                        @error('maxParticipants')
                        <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select
                            id="status"
                            wire:model="batchStatus"
                            class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 dark:bg-gray-800 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500/10 @error('batchStatus') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">
                            <option value="">Select status</option>
                            <option value="open">Open</option>
                            <option value="full">Full</option>
                            <option value="ongoing">Ongoing</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                        @error('batchStatus')
                        <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Batch Schedule Information --}}
            <div class="px-6">
                <div class="mb-4 flex items-center gap-3">
                    <div class="h-8 w-1 rounded-full bg-emerald-500"></div>
                    <div>
                        <h2 class="text-base font-semibold text-gray-900 dark:text-white">Batch Schedule Information</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Assign a schedule template to this batch</p>
                    </div>
                </div>

                <div>
                    <label for="training_schedule_item_id" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Assigned Schedule <span class="text-red-500">*</span>
                    </label>
                    <select
                        id="training_schedule_item_id"
                        wire:model.live="trainingBatchScheduleId"
                        class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition focus:border-emerald-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100 dark:bg-gray-800 dark:text-white dark:focus:border-emerald-500 dark:focus:ring-emerald-500/10 @error('trainingBatchScheduleId') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">
                        <option value="">Select schedule</option>
                        @foreach($trainigScheduleItems as $schedule)
                        <option value="{{ $schedule->id }}">
                            {{ $schedule->name }}
                            @if($schedule->schedule_days)
                            - {{ is_array($schedule->schedule_days) ? implode(', ', $schedule->schedule_days) : $schedule->schedule_days }}
                            @endif
                            @if($schedule->start_time && $schedule->end_time)
                            ({{ \Carbon\Carbon::parse($schedule->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($schedule->end_time)->format('g:i A') }})
                            @endif
                        </option>
                        @endforeach
                    </select>
                    @error('trainingBatchScheduleId')
                    <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Trainer Information --}}
            <div class="px-6">
                <div class="mb-4 flex items-center gap-3">
                    <div class="h-8 w-1 rounded-full bg-violet-500"></div>
                    <div>
                        <h2 class="text-base font-semibold text-gray-900 dark:text-white">Trainer Information</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Assign a trainer and review schedule conflicts</p>
                    </div>
                </div>

                <div class="space-y-5">
                    <div>
                        <label for="trainer_id" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Assigned Trainer <span class="text-red-500">*</span>
                        </label>
                        <select
                            id="trainer_id"
                            name="trainingBatchTrainerId"
                            wire:model.live="trainingBatchTrainerId"
                            class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition focus:border-violet-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-violet-100 dark:bg-gray-800 dark:text-white dark:focus:border-violet-500 dark:focus:ring-violet-500/10 @error('trainingBatchTrainerId') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">
                            <option value="">Select trainer</option>
                            @foreach($trainers as $trainer)
                            <option value="{{ $trainer->id }}">
                                {{ $trainer->name }} {{ $trainer->last_name }} - Center: {{ $trainer->center_name }}
                            </option>
                            @endforeach
                        </select>
                        @error('trainingBatchTrainerId')
                        <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    @if($trainingBatchTrainerId && count($trainerBatchList) > 0)
                    <div class="rounded-2xl border border-gray-200 bg-gray-50 p-5 dark:border-gray-700 dark:bg-gray-800/60">
                        <div class="mb-3 flex items-center justify-between">
                            <label class="block text-sm font-semibold text-gray-800 dark:text-gray-100">
                                Existing Batches
                            </label>

                            @if(count($conflictingBatchIds) > 0)
                            <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-medium text-red-600 dark:bg-red-500/10 dark:text-red-300">
                                {{ count($conflictingBatchIds) }} conflict{{ count($conflictingBatchIds) > 1 ? 's' : '' }} detected
                            </span>
                            @endif
                        </div>

                        <div class="space-y-3">
                            @foreach($trainerBatchList as $batch)
                            @php
                            $isConflict = in_array($batch['id'], $conflictingBatchIds);
                            $days = is_array($batch['schedule_days'])
                            ? $batch['schedule_days']
                            : json_decode($batch['schedule_days'], true);
                            @endphp

                            <div class="flex flex-col gap-3 rounded-2xl border px-4 py-4 transition-colors sm:flex-row sm:items-start sm:justify-between
                                {{ $isConflict ? 'border-red-300 bg-red-50 dark:border-red-900/40 dark:bg-red-500/10' : 'border-green-200 bg-white dark:border-green-900/40 dark:bg-gray-900' }}">

                                <div class="flex items-start gap-3">
                                    <div class="mt-0.5 flex h-4 w-4 shrink-0 items-center justify-center rounded-full border-2
                                        {{ $isConflict ? 'border-red-500' : 'border-emerald-500' }}">
                                        <div class="h-2 w-2 rounded-full {{ $isConflict ? 'bg-red-500' : 'bg-emerald-500' }}"></div>
                                    </div>

                                    <div>
                                        <p class="text-sm font-semibold {{ $isConflict ? 'text-red-700 dark:text-red-300' : 'text-gray-800 dark:text-gray-100' }}">
                                            {{ $batch['batch_name'] }}
                                        </p>
                                        <p class="mt-0.5 text-xs {{ $isConflict ? 'text-red-500 dark:text-red-300' : 'text-gray-500 dark:text-gray-400' }}">
                                            {{ $batch['batch_code'] }}
                                        </p>
                                        <p class="mt-1 text-xs {{ $isConflict ? 'text-red-400 dark:text-red-300' : 'text-gray-400 dark:text-gray-500' }}">
                                            {{ \Carbon\Carbon::parse($batch['start_date'])->format('M d, Y') }}
                                            –
                                            {{ \Carbon\Carbon::parse($batch['end_date'])->format('M d, Y') }}
                                        </p>
                                        <p class="mt-1 text-xs {{ $isConflict ? 'text-red-400 dark:text-red-300' : 'text-gray-400 dark:text-gray-500' }}">
                                            🕐 {{ \Carbon\Carbon::parse($batch['start_time'])->format('g:i A') }}
                                            – {{ \Carbon\Carbon::parse($batch['end_time'])->format('g:i A') }}
                                            &nbsp;|&nbsp;
                                            {{ implode(', ', $days ?? []) }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex flex-col items-start gap-1 sm:items-end">
                                    @if($isConflict)
                                    <span class="rounded-full bg-red-100 px-2.5 py-1 text-xs font-medium text-red-600 dark:bg-red-500/10 dark:text-red-300">
                                        Conflict
                                    </span>
                                    <span class="text-xs text-red-400 dark:text-red-300">⚠ Overlapping schedule</span>
                                    @else
                                    <span class="rounded-full bg-green-100 px-2.5 py-1 text-xs font-medium text-green-600 dark:bg-green-500/10 dark:text-green-300">
                                        No batch schedule conflict
                                    </span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @elseif($trainingBatchTrainerId && count($trainerBatchList) === 0)
                    <p class="text-sm italic text-gray-400 dark:text-gray-500">
                        This trainer has no existing open batches.
                    </p>
                    @endif
                </div>
            </div>

            {{-- Additional Information --}}
            <div class="px-6">
                <div class="mb-4 flex items-center gap-3">
                    <div class="h-8 w-1 rounded-full bg-amber-500"></div>
                    <div>
                        <h2 class="text-base font-semibold text-gray-900 dark:text-white">Additional Information</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Optional notes or comments for this batch</p>
                    </div>
                </div>

                <div>
                    <label for="notes" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Notes
                    </label>
                    <textarea
                        id="notes"
                        wire:model="notes"
                        rows="4"
                        placeholder="Enter any additional notes or comments"
                        class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-amber-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-amber-100 dark:bg-gray-800 dark:text-white dark:focus:border-amber-500 dark:focus:ring-amber-500/10 @error('notes') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">{{ old('notes') }}</textarea>
                    @error('notes')
                    <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Footer --}}
            <div class="flex flex-col gap-3 border-t border-gray-100 bg-gray-50 px-6 py-5 dark:border-gray-800 dark:bg-gray-900/70 sm:flex-row sm:items-center sm:justify-between">
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    Review all batch details carefully before saving changes.
                </p>

                <div class="flex items-center gap-3">
                    <button
                        wire:click="updateTrainingBatch"
                        class="inline-flex items-center gap-2 rounded-2xl bg-blue-600 px-5 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        Update Training Batch
                    </button>

                    <button
                        wire:click="deleteTrainingBatch"
                        wire:confirm='Are you sure you want to delete this training batch?'
                        class="inline-flex items-center gap-2 rounded-2xl bg-red-600 px-5 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Delete Training Batch
                    </button>

                    <a href="{{ route('training_batches.index') }}"
                        class="inline-flex items-center rounded-2xl border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                        Cancel
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>