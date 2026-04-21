<div>
    {{-- ===== HEADER ===== --}}
    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 pb-4 mb-5 border-b border-gray-200">
        <div>
            <h1 class="text-base font-semibold text-gray-800">Attendance Report</h1>
            <div class="flex items-center gap-2 flex-wrap mt-1">
                <span class="text-sm font-medium text-gray-700">{{ $trainingBatch->batch_name }}</span>
                <span class="text-gray-300">·</span>
                <span class="font-mono text-xs text-gray-400 bg-gray-100 px-2 py-0.5 rounded">{{ $trainingBatch->batch_code }}</span>
                <span class="text-gray-300">·</span>
                <span class="text-xs text-gray-500 flex items-center gap-1">
                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    {{ \Carbon\Carbon::parse($trainingBatch->start_date)->format('M d, Y') }}
                    –
                    {{ \Carbon\Carbon::parse($trainingBatch->end_date)->format('M d, Y') }}
                </span>
                @if($trainingScheduleItem)
                <span class="text-gray-300">·</span>
                <span class="text-xs text-gray-500 flex items-center gap-1">
                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Expected in: <span class="font-medium text-gray-700">{{ \Carbon\Carbon::parse($trainingScheduleItem->start_time)->format('g:i A') }}</span>
                </span>
                @endif
            </div>
        </div>

        {{-- Legend --}}
        <div class="flex flex-col gap-2 shrink-0">
            <div class="flex items-center gap-3 flex-wrap text-xs text-gray-500">
                <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-green-500"></span> Present <span class="text-gray-400 text-[10px]">(1st In + 2nd Out)</span></span>
                <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-yellow-400"></span> Partial</span>
                <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-red-400"></span> Absent</span>
                <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-gray-300"></span> No Record</span>
            </div>
            <div class="flex items-center gap-3 flex-wrap text-xs text-gray-500">
                <span class="flex items-center gap-1.5"><span class="inline-block w-2 h-2 rounded-sm bg-orange-200 border border-orange-300"></span> Late – Minor (1–10 min)</span>
                <span class="flex items-center gap-1.5"><span class="inline-block w-2 h-2 rounded-sm bg-orange-400 border border-orange-500"></span> Moderate (11–30 min)</span>
                <span class="flex items-center gap-1.5"><span class="inline-block w-2 h-2 rounded-sm bg-red-500 border border-red-600"></span> Severe (31+ min)</span>
            </div>
        </div>
    </div>

    {{-- ===== TABLE ===== --}}
    <div class="border border-gray-200 rounded-xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-xs border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-4 py-3 text-left text-[11px] font-semibold text-gray-500 uppercase tracking-wider sticky left-0 bg-gray-50 z-10 border-r border-gray-200 min-w-[190px]">
                            Student
                        </th>
                        @foreach($dateRange as $date)
                        <th class="px-3 py-3 text-center border-l border-gray-200 min-w-[145px]">
                            <div class="text-[11px] font-semibold text-gray-700">
                                {{ \Carbon\Carbon::parse($date)->format('M d') }}
                            </div>
                            <div class="text-[10px] text-gray-400 font-normal mt-0.5">
                                {{ \Carbon\Carbon::parse($date)->format('D') }}
                            </div>
                        </th>
                        @endforeach
                        <th class="px-3 py-3 text-center text-[11px] font-semibold border-l border-gray-200 min-w-[50px]">
                            <span class="text-green-600">Present</span>
                        </th>
                        <th class="px-3 py-3 text-center text-[11px] font-semibold min-w-[50px]">
                            <span class="text-red-400">Absent</span>
                        </th>
                        <th class="px-3 py-3 text-center text-[11px] font-semibold min-w-[50px]">
                            <span class="text-orange-500">Lates</span>
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($students as $student)
                    @php
                    $presentCount = 0;
                    $absentCount = 0;
                    $lateCount = 0;
                    @endphp

                    <tr class="hover:bg-gray-50/70 transition-colors duration-100 group align-top">

                        {{-- Student Name --}}
                        <td class="px-4 py-3 sticky left-0 bg-white group-hover:bg-gray-50/70 z-10 border-r border-gray-200 transition-colors">
                            <span class="font-medium text-gray-800 text-xs">{{ $student['student_name'] }}</span>
                        </td>

                        {{-- Date cells --}}
                        @foreach($dateRange as $date)
                        @php
                        $record = $attendanceMap[$student['batch_student_id']][$date] ?? null;
                        $overall = $record['status'] ?? 'none';
                        $isLate = $record['is_late'] ?? false;
                        $minLate = $record['minutes_late'] ?? 0;
                        $severity = $record['severity'] ?? null;

                        if ($overall === 'present') $presentCount++;
                        if ($overall === 'absent') $absentCount++;
                        if ($isLate) $lateCount++;

                        $dotColor = match($overall) {
                        'present' => 'bg-green-500',
                        'partial' => 'bg-yellow-400',
                        'absent' => 'bg-red-400',
                        default => 'bg-gray-300',
                        };

                        $lateBadge = match($severity) {
                        'severe' => 'bg-red-100 text-red-700 border border-red-200',
                        'moderate' => 'bg-orange-100 text-orange-700 border border-orange-200',
                        'minor' => 'bg-yellow-50 text-yellow-700 border border-yellow-200',
                        default => '',
                        };
                        @endphp

                        <td class="px-3 py-3 border-l border-gray-100 align-top">
                            @if($record)
                            <div class="flex flex-col gap-1.5">

                                {{-- Status dot + late badge --}}
                                <div class="flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full {{ $dotColor }} flex-shrink-0"></span>
                                    @if($isLate && $severity)
                                    <span class="text-[10px] font-semibold px-1.5 py-0.5 rounded {{ $lateBadge }}">
                                        Late {{ $minLate }}m
                                    </span>
                                    @endif
                                </div>

                                {{-- AM Times --}}
                                @if($record['am']['check_in'] || $record['am']['check_out'])
                                <div class="flex flex-col gap-0.5">
                                    @if($record['am']['check_in'])
                                    <span class="flex items-center gap-1 text-gray-500 leading-tight {{ $isLate ? 'text-orange-600' : '' }}">
                                        <svg class="w-3 h-3 text-gray-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>First In: <span class="font-semibold {{ $isLate ? 'text-orange-700' : 'text-gray-700' }}">{{ $record['am']['check_in'] }}</span></span>
                                    </span>
                                    @endif
                                    @if($record['am']['check_out'])
                                    <span class="flex items-center gap-1 text-gray-500 leading-tight">
                                        <svg class="w-3 h-3 text-gray-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>First Out: <span class="font-semibold text-gray-700">{{ $record['am']['check_out'] }}</span></span>
                                    </span>
                                    @endif
                                </div>
                                @endif

                                {{-- Divider --}}
                                @if(($record['am']['check_in'] || $record['am']['check_out']) && ($record['pm']['check_in'] || $record['pm']['check_out']))
                                <div class="border-t border-dashed border-gray-100 -mx-1"></div>
                                @endif

                                {{-- PM Times --}}
                                @if($record['pm']['check_in'] || $record['pm']['check_out'])
                                <div class="flex flex-col gap-0.5">
                                    @if($record['pm']['check_in'])
                                    <span class="flex items-center gap-1 text-gray-500 leading-tight">
                                        <svg class="w-3 h-3 text-gray-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>Second In: <span class="font-semibold text-gray-700">{{ $record['pm']['check_in'] }}</span></span>
                                    </span>
                                    @endif
                                    @if($record['pm']['check_out'])
                                    <span class="flex items-center gap-1 text-gray-500 leading-tight">
                                        <svg class="w-3 h-3 text-gray-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>Second Out: <span class="font-semibold text-gray-700">{{ $record['pm']['check_out'] }}</span></span>
                                    </span>
                                    @endif
                                </div>
                                @endif

                            </div>
                            @else
                            <span class="text-gray-300 select-none">—</span>
                            @endif
                        </td>
                        @endforeach

                        {{-- Present --}}
                        <td class="px-3 py-3 text-center border-l border-r border-gray-200 align-top">
                            <span class="text-xs font-bold text-green-600">{{ $presentCount }}</span>
                        </td>

                        {{-- Absent --}}
                        <td class="px-3 py-3 text-center border-r border-gray-200 align-top">
                            <span class="text-xs font-bold text-red-400">{{ $absentCount }}</span>
                        </td>

                        {{-- Late --}}
                        <td class="px-3 py-3 text-center align-top">
                            <span class="text-xs font-bold text-orange-500">{{ $lateCount }}</span>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="{{ count($dateRange) + 4 }}" class="px-5 py-14 text-center">
                            <div class="flex flex-col items-center gap-2">
                                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                                <p class="text-sm text-gray-400">No students found in this batch.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>

                @if(count($students) > 0)
                <tfoot class="bg-gray-50 border-t border-gray-200">
                    <tr>
                        <td class="px-4 py-2.5 text-[11px] text-gray-400 sticky left-0 bg-gray-50 border-r border-gray-200">
                            <span class="font-medium text-gray-600">{{ count($students) }}</span> students
                            <span class="text-gray-300 mx-1">·</span>
                            <span class="font-medium text-gray-600">{{ count($dateRange) }}</span> scheduled days
                        </td>
                        @foreach($dateRange as $date)
                        <td class="border-l border-gray-100 py-2.5"></td>
                        @endforeach
                        <td class="border-l border-gray-200"></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
                @endif

            </table>
        </div>
    </div>
</div>