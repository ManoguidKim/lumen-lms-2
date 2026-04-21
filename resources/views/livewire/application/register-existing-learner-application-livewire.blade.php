<div>
    <div class="w-full mx-auto">
        <div class="relative bg-white rounded-lg shadow-sm border border-blue-200">

            {{-- Header --}}
            <div class="flex items-center justify-between p-4 md:p-5 border-b border-gray-200 bg-blue-50 rounded-t-lg">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">
                        Enroll Learner — {{ $firstName . ' ' . $lastName }}
                    </h3>
                    <p class="text-sm text-gray-500 mt-0.5">
                        Choose a training course, center, and batch to enroll this learner.
                    </p>
                </div>
            </div>

            {{-- Flash Message --}}
            @if(session()->has('success'))
            <div class="m-4 p-4 text-green-800 bg-green-50 rounded-lg border border-green-200 text-sm" role="alert">
                {{ session('success') }}
            </div>
            @endif

            <form wire:submit.prevent="save">
                <div class="p-4 md:p-5 space-y-4">

                    {{-- Tardiness Dashboard --}}
                    @if(!empty($tardiness))
                    <div style="border: 0.5px solid var(--color-border-tertiary);"
                        class="rounded-lg overflow-hidden mb-1">

                        <div class="flex items-center gap-2 px-4 py-3 border-b border-gray-100 bg-gray-50">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg>
                            <span class="text-sm font-medium text-gray-700">Tardiness and adsences summary</span>
                        </div>

                        <div class="p-4">
                            {{-- Stat cards --}}
                            <div class="grid grid-cols-4 gap-2.5 mb-4">
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <p class="text-xs text-gray-500 mb-1">Total batches</p>
                                    <p class="text-xl font-medium text-gray-900">{{ $tardiness['total_batches'] }}</p>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <p class="text-xs text-gray-500 mb-1">Late arrivals</p>
                                    <p class="text-xl font-medium text-gray-900">{{ $tardiness['total_late'] }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5">across all batches</p>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <p class="text-xs text-gray-500 mb-1">Avg. minutes late</p>
                                    <p class="text-xl font-medium text-gray-900">{{ $tardiness['avg_minutes'] }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5">per late instance</p>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <p class="text-xs text-gray-500 mb-1">Worst severity</p>
                                    <div class="mt-1.5">
                                        @if($tardiness['severe'] > 0)
                                        <span class="inline-block text-xs font-medium px-2 py-0.5 rounded-full bg-red-50 text-red-700">Severe</span>
                                        @elseif($tardiness['moderate'] > 0)
                                        <span class="inline-block text-xs font-medium px-2 py-0.5 rounded-full bg-amber-50 text-amber-700">Moderate</span>
                                        @elseif($tardiness['minor'] > 0)
                                        <span class="inline-block text-xs font-medium px-2 py-0.5 rounded-full bg-green-50 text-green-700">Minor</span>
                                        @else
                                        <span class="inline-block text-xs font-medium px-2 py-0.5 rounded-full bg-gray-100 text-gray-500">None</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <p class="text-xs text-gray-500 mb-1">Total absences</p>
                                    <p class="text-xl font-medium text-gray-900">{{ $absences['total_absent'] }}/{{ $absences['total_days'] }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5">across all batches</p>
                                </div>

                                <div class="bg-gray-50 rounded-lg p-3">
                                    <p class="text-xs text-gray-500 mb-1">Absent Percentage</p>
                                    <p class="text-xl font-medium text-gray-900">{{ $absences['absent_pct'] }}%</p>
                                    <p class="text-xs text-gray-400 mt-0.5">across all batches</p>
                                </div>
                            </div>

                            {{-- Severity bars --}}
                            @if($tardiness['total_late'] > 0)
                            <div class="border-t border-gray-100 pt-3">
                                <p class="text-xs font-medium text-gray-400 uppercase tracking-wide mb-3">Severity breakdown</p>

                                @foreach([
                                ['label' => 'Minor', 'pct' => $tardiness['minor_pct'], 'count' => $tardiness['minor'], 'bar' => 'bg-green-500', 'text' => 'text-green-700'],
                                ['label' => 'Moderate', 'pct' => $tardiness['moderate_pct'], 'count' => $tardiness['moderate'], 'bar' => 'bg-amber-500', 'text' => 'text-amber-700'],
                                ['label' => 'Severe', 'pct' => $tardiness['severe_pct'], 'count' => $tardiness['severe'], 'bar' => 'bg-red-500', 'text' => 'text-red-700'],
                                ] as $row)
                                <div class="flex items-center gap-2.5 mb-2.5">
                                    <span class="text-xs text-gray-500 w-16 flex-shrink-0">{{ $row['label'] }}</span>
                                    <div class="flex-1 h-2 bg-gray-100 rounded-full overflow-hidden">
                                        <div class="{{ $row['bar'] }} h-full rounded-full" style="width: {{ $row['pct'] }}%"></div>
                                    </div>
                                    <span class="text-xs font-medium {{ $row['text'] }} w-9 text-right">{{ $row['pct'] }}%</span>
                                    <span class="text-xs text-gray-400 w-7 text-right">{{ $row['count'] }}×</span>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="border-t border-gray-100 pt-3 text-center py-4">
                                <p class="text-sm text-gray-400">No tardiness records found.</p>
                            </div>
                            @endif

                            @if($absences['total_absent'] > 0)
                            <div class="border-t border-gray-100 pt-3">
                                <p class="text-xs font-medium text-gray-400 uppercase tracking-wide mb-3">Attendance breakdown percentage</p>

                                <div class="flex items-center gap-2.5 mb-2.5">
                                    <span class="text-xs text-gray-500 w-16 flex-shrink-0">Absent</span>
                                    <div class="flex-1 h-2 bg-gray-100 rounded-full overflow-hidden">
                                        <div class="bg-red-500 h-full rounded-full" style="width: {{ $absences['absent_pct'] }}%"></div>
                                    </div>
                                    <span class="text-xs font-medium text-red-700 w-9 text-right">{{ $absences['absent_pct'] }}%</span>
                                    <span class="text-xs text-gray-400 w-7 text-right">{{ $absences['total_absent'] }}×</span>
                                </div>
                            </div>
                            @else
                            <div class="border-t border-gray-100 pt-3 text-center py-4">
                                <p class="text-sm text-gray-400">No absent records found.</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    {{-- Training Course --}}
                    <div>
                        <label class="block mb-1.5 text-sm font-medium text-gray-700">
                            Training Course <span class="text-red-500">*</span>
                        </label>
                        <select wire:model.live="courseId"
                            class="bg-gray-50 border @error('courseId') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="">— Select a training course —</option>
                            @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->course_name }} — {{ $course->course_code }}</option>
                            @endforeach
                        </select>
                        @error('courseId')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    {{-- Training Center --}}
                    <div>
                        <label class="block mb-1.5 text-sm font-medium text-gray-700 {{ !$courseId ? 'opacity-50' : '' }}">
                            Training Center <span class="text-red-500">*</span>
                        </label>
                        <select wire:model.live="centerId" @disabled(!$courseId)
                            class="bg-gray-50 border @error('centerId') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 disabled:opacity-50 disabled:cursor-not-allowed">
                            <option value="">{{ $courseId ? '— Select a training center —' : 'Select a course first' }}</option>
                            @foreach ($centers as $center)
                            <option value="{{ $center->id }}">{{ $center->name }}</option>
                            @endforeach
                        </select>
                        @error('centerId')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    {{-- Training Batch --}}
                    <div>
                        <label class="block mb-1.5 text-sm font-medium text-gray-700 {{ !$centerId ? 'opacity-50' : '' }}">
                            Training Batch <span class="text-red-500">*</span>
                        </label>
                        <select wire:model.live="batchId" @disabled(!$centerId)
                            class="bg-gray-50 border @error('batchId') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 disabled:opacity-50 disabled:cursor-not-allowed">
                            <option value="">{{ $centerId ? '— Select a training batch —' : 'Select a center first' }}</option>
                            @foreach ($batches as $batch)
                            <option value="{{ $batch->id }}">
                                {{ $batch->batch_name }} • {{ $batch->batch_code }}
                                ({{ \Carbon\Carbon::parse($batch->start_date)->format('M d, Y') }}
                                – {{ \Carbon\Carbon::parse($batch->end_date)->format('M d, Y') }})
                            </option>
                            @endforeach
                        </select>
                        @error('batchId')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                </div>

                {{-- Actions --}}
                <div class="flex items-center gap-3 p-4 md:p-5 border-t border-gray-200">
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Register Application
                    </button>
                    <a href="{{ route('learner-training-applications.list.registered.applicants') }}"
                        class="py-2.5 px-5 text-sm font-medium text-gray-700 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:outline-none transition">
                        Back to List
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>