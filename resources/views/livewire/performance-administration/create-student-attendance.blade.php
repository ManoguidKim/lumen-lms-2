<div>
    {{-- ===== HEADER ===== --}}
    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 pb-5 mb-5 border-b border-gray-100 dark:border-gray-700">
        <div class="flex flex-col gap-1.5">
            <h1 class="text-lg font-semibold text-gray-800 dark:text-white leading-snug">
                Create Student Batch Attendances
            </h1>
            <div class="flex items-center gap-2 flex-wrap">
                <span class="inline-flex items-center gap-1.5 text-xs font-medium text-blue-600 bg-blue-50 dark:bg-blue-900/30 dark:text-blue-400 border border-blue-100 dark:border-blue-800 px-2.5 py-1 rounded-lg">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                    </svg>
                    {{ $trainingBatch->batch_name }}
                </span>
                <span class="text-xs text-gray-400 font-mono bg-gray-100 dark:bg-gray-700 dark:text-gray-400 px-2.5 py-1 rounded-lg">
                    {{ $trainingBatch->batch_code }}
                </span>
            </div>
            <p class="text-sm text-gray-400">Manage and monitor student attendance for training batches.</p>
        </div>

        {{-- Date Picker --}}
        <div class="flex flex-col gap-1.5 sm:items-end shrink-0">
            <label class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Attendance Date
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <input type="date"
                    wire:model.live="attendanceDate"
                    class="bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-800 dark:text-white text-sm rounded-xl focus:ring-2 focus:ring-blue-400 focus:border-transparent pl-10 pr-4 py-2.5 w-52 shadow-sm transition">
            </div>
            <p class="text-xs text-gray-400 dark:text-gray-500">
                {{ \Carbon\Carbon::parse($attendanceDate)->format('l, F d, Y') }}
            </p>
        </div>
    </div>

    {{-- ===== FLASH MESSAGE ===== --}}
    @if(session()->has('success'))
    <div class="mb-4 flex items-center gap-3 p-4 text-green-800 bg-green-50 dark:bg-green-900/20 dark:text-green-400 rounded-xl border border-green-200 dark:border-green-800">
        <div class="w-7 h-7 bg-green-100 dark:bg-green-900/40 rounded-lg flex items-center justify-center flex-shrink-0">
            <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
        </div>
        <p class="text-sm font-medium">{{ session('success') }}</p>
    </div>
    @endif

    {{-- ===== BULK MARK ALL ACTIONS ===== --}}
    <div class="flex flex-wrap items-center gap-0 mb-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl overflow-hidden shadow-sm divide-x divide-gray-100 dark:divide-gray-700">

        {{-- AM Section --}}
        <div class="flex items-center gap-3 px-5 py-3 flex-1 min-w-[160px]">
            <div class="w-8 h-8 rounded-lg bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3" />
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">AM Session</p>
                <p class="text-[10px] text-gray-400">Mark all students at once</p>
            </div>
            <div class="flex items-center gap-2">
                <button wire:click="markAllTime('first_check_in_time')"
                    class="inline-flex items-center gap-1 text-xs font-semibold text-blue-600 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/20 dark:text-blue-400 dark:hover:bg-blue-900/40 border border-blue-200 dark:border-blue-700 px-3 py-1.5 rounded-lg transition-colors">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14" />
                    </svg>
                    All In
                </button>
                <button wire:click="markAllTime('first_check_out_time')"
                    class="inline-flex items-center gap-1 text-xs font-semibold text-blue-500 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/20 dark:text-blue-300 dark:hover:bg-blue-900/40 border border-blue-200 dark:border-blue-700 px-3 py-1.5 rounded-lg transition-colors">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                    All Out
                </button>
            </div>
        </div>

        {{-- PM Section --}}
        <div class="flex items-center gap-3 px-5 py-3 flex-1 min-w-[160px]">
            <div class="w-8 h-8 rounded-lg bg-purple-50 dark:bg-purple-900/30 flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">PM Session</p>
                <p class="text-[10px] text-gray-400">Mark all students at once</p>
            </div>
            <div class="flex items-center gap-2">
                <button wire:click="markAllTime('second_check_in_time')"
                    class="inline-flex items-center gap-1 text-xs font-semibold text-purple-600 bg-purple-50 hover:bg-purple-100 dark:bg-purple-900/20 dark:text-purple-400 dark:hover:bg-purple-900/40 border border-purple-200 dark:border-purple-700 px-3 py-1.5 rounded-lg transition-colors">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14" />
                    </svg>
                    All In
                </button>
                <button wire:click="markAllTime('second_check_out_time')"
                    class="inline-flex items-center gap-1 text-xs font-semibold text-purple-500 bg-purple-50 hover:bg-purple-100 dark:bg-purple-900/20 dark:text-purple-300 dark:hover:bg-purple-900/40 border border-purple-200 dark:border-purple-700 px-3 py-1.5 rounded-lg transition-colors">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                    All Out
                </button>
            </div>
        </div>

    </div>

    {{-- ===== TABLE ===== --}}
    <div class="overflow-x-auto rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
            <thead>
                <tr class="bg-gray-50 dark:bg-gray-700/60">
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider w-10">#</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Student</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wider" colspan="2">
                        <div class="inline-flex items-center gap-1.5 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 px-3 py-1 rounded-full">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3" />
                            </svg>
                            AM Session
                        </div>
                    </th>
                    <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wider" colspan="2">
                        <div class="inline-flex items-center gap-1.5 bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 px-3 py-1 rounded-full">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                            PM Session
                        </div>
                    </th>
                </tr>
                <tr class="bg-gray-50 dark:bg-gray-700/60 border-t border-gray-100 dark:border-gray-600">
                    <th class="px-4 py-2"></th>
                    <th class="px-4 py-2"></th>
                    <th class="px-4 py-2 text-center">
                        <span class="inline-flex items-center gap-1 text-xs font-medium text-blue-500">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14" />
                            </svg>
                            Time In
                        </span>
                    </th>
                    <th class="px-4 py-2 text-center">
                        <span class="inline-flex items-center gap-1 text-xs font-medium text-blue-400">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                            Time Out
                        </span>
                    </th>
                    <th class="px-4 py-2 text-center">
                        <span class="inline-flex items-center gap-1 text-xs font-medium text-purple-500">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14" />
                            </svg>
                            Time In
                        </span>
                    </th>
                    <th class="px-4 py-2 text-center">
                        <span class="inline-flex items-center gap-1 text-xs font-medium text-purple-400">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                            Time Out
                        </span>
                    </th>
                </tr>
            </thead>

            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($trainingBatchStudent as $index => $batchStudent)

                {{-- Determine if row is fully complete --}}
                @php
                $allMarked =
                !empty($attendances[$batchStudent->id]['first_check_in_time']) &&
                !empty($attendances[$batchStudent->id]['second_check_out_time']);
                @endphp

                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/40 transition-colors duration-150 {{ $allMarked ? 'bg-green-50/30 dark:bg-green-900/5' : '' }}">

                    {{-- # --}}
                    <td class="px-4 py-4">
                        <span class="text-xs font-mono text-gray-400 dark:text-gray-500">{{ $index + 1 }}</span>
                    </td>

                    {{-- Student --}}
                    <td class="px-4 py-4">
                        <div class="flex items-center gap-3">
                            <div class="relative inline-flex items-center justify-center w-9 h-9 rounded-full flex-shrink-0
                                {{ $allMarked ? 'bg-green-100 dark:bg-green-900/40' : 'bg-indigo-100 dark:bg-indigo-900/40' }}">
                                <span class="text-xs font-bold {{ $allMarked ? 'text-green-700 dark:text-green-300' : 'text-indigo-700 dark:text-indigo-300' }}">
                                    {{ strtoupper(substr($batchStudent->full_name_searchable, 0, 1)) }}{{ strtoupper(substr(strrchr($batchStudent->full_name_searchable, ' '), 1, 1)) }}
                                </span>
                                @if($allMarked)
                                <span class="absolute -bottom-0.5 -right-0.5 w-3.5 h-3.5 bg-green-500 rounded-full flex items-center justify-center">
                                    <svg class="w-2 h-2 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                @endif
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span class="font-medium text-gray-800 dark:text-white text-sm truncate">
                                    {{ $batchStudent->full_name_searchable }}
                                </span>
                                <span class="text-xs text-gray-400 dark:text-gray-500 font-mono truncate">
                                    ULI: {{ $batchStudent->uli }}
                                </span>
                            </div>
                            @if($allMarked)
                            <span class="inline-flex items-center gap-1 text-[10px] font-semibold text-green-600 bg-green-50 dark:bg-green-900/30 dark:text-green-400 border border-green-200 dark:border-green-800 px-2 py-0.5 rounded-full">
                                <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Complete
                            </span>
                            @endif
                        </div>
                    </td>

                    {{-- Reusable time cell macro --}}
                    @php
                    $fields = [
                    ['field' => 'first_check_in_time', 'color' => 'blue', 'label' => 'Mark In'],
                    ['field' => 'first_check_out_time', 'color' => 'blue', 'label' => 'Mark Out'],
                    ['field' => 'second_check_in_time', 'color' => 'purple', 'label' => 'Mark In'],
                    ['field' => 'second_check_out_time', 'color' => 'purple', 'label' => 'Mark Out'],
                    ];
                    @endphp

                    @foreach($fields as $cell)
                    <td class="px-4 py-4 text-center">
                        @if(!empty($attendances[$batchStudent->id][$cell['field']]))
                        <div class="flex flex-col items-center gap-1">
                            <div class="inline-flex items-center gap-1.5
                                    {{ $cell['color'] === 'blue'
                                        ? 'bg-blue-50 dark:bg-blue-900/30 border-blue-200 dark:border-blue-700 text-blue-700 dark:text-blue-300'
                                        : 'bg-purple-50 dark:bg-purple-900/30 border-purple-200 dark:border-purple-700 text-purple-700 dark:text-purple-300'
                                    }} border text-sm font-bold px-3 py-1.5 rounded-lg tabular-nums">
                                <svg class="w-3.5 h-3.5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $attendances[$batchStudent->id][$cell['field']] }}
                            </div>
                            <button wire:click="clearTime({{ $batchStudent->id }}, '{{ $cell['field'] }}')"
                                class="text-[10px] font-medium text-red-400 hover:text-red-600 dark:text-red-500 dark:hover:text-red-400 hover:underline transition-colors">
                                Clear
                            </button>
                        </div>
                        @else
                        <button wire:click="markTime({{ $batchStudent->id }}, '{{ $cell['field'] }}')"
                            wire:loading.attr="disabled"
                            wire:target="markTime({{ $batchStudent->id }}, '{{ $cell['field'] }}')"
                            class="inline-flex items-center gap-1.5 text-xs font-semibold
                                    {{ $cell['color'] === 'blue'
                                        ? 'text-blue-600 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/20 dark:hover:bg-blue-900/40 dark:text-blue-400 border-blue-200 dark:border-blue-700'
                                        : 'text-purple-600 bg-purple-50 hover:bg-purple-100 dark:bg-purple-900/20 dark:hover:bg-purple-900/40 dark:text-purple-400 border-purple-200 dark:border-purple-700'
                                    }} border border-dashed px-3 py-2 rounded-lg transition-colors duration-150 whitespace-nowrap">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $cell['label'] }}
                        </button>
                        @endif
                        @error("attendances.{$batchStudent->id}.{$cell['field']}")
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </td>
                    @endforeach

                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-16 text-center bg-white dark:bg-gray-800">
                        <div class="flex flex-col items-center gap-3">
                            <div class="w-14 h-14 bg-gray-50 dark:bg-gray-700 rounded-2xl flex items-center justify-center">
                                <svg class="w-7 h-7 text-gray-300 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-500 dark:text-gray-400">No students in this batch</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">Students will appear here once enrolled.</p>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>