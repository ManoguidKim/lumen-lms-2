<div>
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
        <div>
            <h1 class="text-xl font-semibold text-gray-800">Learner Training Activity</h1>
            <p class="text-sm text-gray-400 mt-0.5">Manage and monitor all training activities of learner</p>
        </div>
        <div class="flex items-center gap-3">
            <!-- Create Button -->
            <button wire:click="openCreateModal"
                class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-white bg-indigo-500 hover:bg-indigo-600 rounded-lg shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                New Activity
            </button>
        </div>
    </div>


    {{-- Calendar Card --}}
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

        {{-- Month Navigation --}}
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <button
                wire:click="previousMonth"
                class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-50 hover:text-gray-800 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </button>
            <div class="text-center">
                <h2 class="text-base font-semibold text-gray-800">{{ $monthName }} {{ $currentYear }}</h2>
            </div>
            <button
                wire:click="nextMonth"
                class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-50 hover:text-gray-800 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </button>
        </div>

        {{-- Day Labels --}}
        <div class="grid grid-cols-7 border-b border-gray-100">
            @foreach(['Sun','Mon','Tue','Wed','Thu','Fri','Sat'] as $day)
            <div class="text-center text-xs font-medium text-gray-400 uppercase tracking-wider py-3">
                {{ $day }}
            </div>
            @endforeach
        </div>

        {{-- Calendar Grid --}}
        <div class="grid grid-cols-7">
            {{-- Empty leading cells --}}
            @if($firstDayOfMonth > 0)
            @foreach(range(1, $firstDayOfMonth) as $i)
            <div class="min-h-[90px] border-b border-r border-gray-100 bg-gray-50/50"></div>
            @endforeach
            @endif

            {{-- Day cells --}}
            @foreach(range(1, $daysInMonth) as $day)
            @php
            $dateStr = $currentYear . '-' . str_pad($currentMonth, 2, '0', STR_PAD_LEFT) . '-' . str_pad($day, 2, '0', STR_PAD_LEFT);
            $dayActivities = $activitiesByDate[$dateStr] ?? [];
            $isToday = $dateStr === now()->toDateString();
            $col = ($firstDayOfMonth + $day - 1) % 7;
            $isLastCol = $col === 6;
            $row = intdiv($firstDayOfMonth + $day - 1, 7);
            $totalCells = $firstDayOfMonth + $daysInMonth;
            $totalRows = ceil($totalCells / 7);
            $isLastRow = $row === $totalRows - 1;
            @endphp

            <div
                wire:click="selectDay('{{ $dateStr }}')"
                class="min-h-[90px] p-2 border-b border-r border-gray-100 cursor-pointer transition-colors hover:bg-gray-50
                            {{ $isLastCol ? 'border-r-0' : '' }}
                            {{ $isLastRow ? 'border-b-0' : '' }}
                            {{ $selectedDate === $dateStr ? 'bg-indigo-50/60' : '' }}">

                {{-- Day number --}}
                <div class="flex items-center justify-between mb-1">
                    <span class="
                                text-xs font-semibold w-6 h-6 flex items-center justify-center rounded-full
                                {{ $isToday ? 'bg-gray-900 text-white' : 'text-gray-500' }}">
                        {{ $day }}
                    </span>
                </div>

                {{-- Activities --}}
                @foreach(array_slice($dayActivities, 0, 2) as $activity)
                <div class="mb-0.5 px-1.5 py-0.5 rounded text-[10px] font-medium truncate
                                {{ $activity['status'] === 'pending'   ? 'bg-amber-50 text-amber-700' : '' }}
                                {{ $activity['status'] === 'completed' ? 'bg-blue-50 text-blue-700' : '' }}">
                    {{ $activity['title'] }}
                </div>
                @endforeach

                @if(count($dayActivities) > 2)
                <p class="text-[10px] text-gray-400 px-1">+{{ count($dayActivities) - 2 }} more</p>
                @endif
            </div>
            @endforeach
        </div>
    </div>

    {{-- Legend & Stats --}}
    <div class="mt-3 flex flex-wrap items-center justify-between gap-3 px-1">
        <div class="flex flex-wrap gap-4">
            @foreach(['pending' => ['bg-amber-400','Pending'], 'completed' => ['bg-blue-400','Completed']] as $status => $meta)
            <span class="flex items-center gap-1.5 text-xs text-gray-500">
                <span class="w-2 h-2 rounded-full {{ $meta[0] }}"></span>
                {{ $meta[1] }}
            </span>
            @endforeach
        </div>
        <span class="text-xs text-gray-400">{{ $monthActivityCount }} {{ Str::plural('activity', $monthActivityCount) }} this month</span>
    </div>

    {{-- Selected Day Panel --}}
    @if($selectedDate && count($activitiesByDate[$selectedDate] ?? []) > 0)
    <div class="mt-4 bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="px-5 py-3.5 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-sm font-semibold text-gray-800">
                {{ \Carbon\Carbon::parse($selectedDate)->format('F j, Y') }}
            </h3>
            <button wire:click="$set('selectedDate', null)" class="text-gray-300 hover:text-gray-500 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="divide-y divide-gray-100">
            @foreach($activitiesByDate[$selectedDate] as $activity)
            <div class="flex items-center justify-between px-5 py-3 hover:bg-gray-50 transition-colors">
                <div>
                    <p class="text-sm font-medium text-gray-800">{{ $activity['title'] }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">
                        {{ \Carbon\Carbon::parse($activity['activity_time'])->format('g:i A') }}
                        &nbsp;·&nbsp; Batch #{{ $activity['training_batch_id'] }}
                    </p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-xs px-2.5 py-1 rounded-full font-medium
                                    {{ $activity['status'] === 'pending'   ? 'bg-amber-50 text-amber-700' : '' }}
                                    {{ $activity['status'] === 'completed' ? 'bg-blue-50 text-blue-700' : '' }}
                                    capitalize">
                        {{ $activity['status'] }}
                    </span>
                    <button
                        wire:click="openEditModal({{ $activity['id'] }})"
                        class="text-xs text-gray-400 hover:text-gray-700 border border-gray-200 rounded-lg px-2.5 py-1 hover:bg-gray-50 transition-all">
                        Edit
                    </button>
                    <button
                        wire:click="deleteActivity({{ $activity['id'] }})"
                        wire:confirm="Are you sure you want to delete this activity?"
                        class="text-xs text-red-400 hover:text-red-600 border border-red-100 rounded-lg px-2.5 py-1 hover:bg-red-50 transition-all">
                        Delete
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif


    {{-- Add / Edit Modal --}}
    @if($showModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/10 backdrop-blur-xs">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md border border-gray-200">

            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <h3 class="text-base font-semibold text-gray-800">
                    {{ $editingId ? 'Edit Activity' : 'New Training Activity' }}
                </h3>
                <button wire:click="closeModal" class="text-gray-300 hover:text-gray-500 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="px-6 py-5 space-y-4">

                {{-- Title --}}
                <div>
                    <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1.5">Title</label>
                    <input
                        type="text"
                        wire:model="form.title"
                        placeholder="e.g. Orientation Session"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent placeholder-gray-300" />
                    @error('form.title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Date & Time --}}
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1.5">Date</label>
                        <input
                            type="date"
                            wire:model="form.activity_date"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent" />
                        @error('form.activity_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1.5">Time</label>
                        <input
                            type="time"
                            wire:model="form.activity_time"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent" />
                        @error('form.activity_time') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Training Batch ID --}}
                <div>
                    <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1.5">Training Batch ID</label>
                    <select
                        wire:model="form.training_batch_id"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent">
                        <option value="">Select Batch</option>
                        @foreach($trainingBatches as $batch)
                        <option value="{{ $batch->id }}">{{ $batch->batch_code }} - {{ $batch->batch_name }}</option>
                        @endforeach
                    </select>
                    @error('form.training_batch_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="px-6 py-4 border-t border-gray-100 flex gap-3">
                <button
                    wire:click="closeModal"
                    class="flex-1 border border-gray-200 text-gray-600 text-sm font-medium px-4 py-2 rounded-lg hover:bg-gray-50 transition-colors">
                    Cancel
                </button>
                <button
                    wire:click="save"
                    class="flex-1 bg-gray-900 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                    {{ $editingId ? 'Update' : 'Save Activity' }}
                </button>
            </div>
        </div>
    </div>
    @endif
</div>