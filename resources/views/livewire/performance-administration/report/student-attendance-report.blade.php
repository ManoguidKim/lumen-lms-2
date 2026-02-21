<div>
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <h1 class="text-xl font-semibold text-gray-800">Attendance Report</h1>
            </div>
            <p class="text-sm text-gray-400 mt-0.5">
                <span class="font-medium text-gray-700">{{ $trainingBatch->batch_name }}</span>
                <span class="text-gray-400 mx-1">·</span>
                <span class="text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full font-medium">
                    {{ $trainingBatch->batch_code }}
                </span>
                <span class="text-gray-400 mx-1">·</span>
                {{ \Carbon\Carbon::parse($trainingBatch->start_date)->format('M d, Y') }}
                –
                {{ \Carbon\Carbon::parse($trainingBatch->end_date)->format('M d, Y') }}
            </p>
        </div>

        <!-- Legend -->
        <div class="flex items-center gap-4 text-xs text-gray-500">
            <div class="flex items-center gap-1.5">
                <span class="w-3 h-3 rounded-sm bg-green-400 inline-block"></span> Present
            </div>
            <div class="flex items-center gap-1.5">
                <span class="w-3 h-3 rounded-sm bg-red-400 inline-block"></span> Absent
            </div>
            <!-- <div class="flex items-center gap-1.5">
                <span class="w-3 h-3 rounded-sm bg-yellow-400 inline-block"></span> Partial
            </div> -->
            <div class="flex items-center gap-1.5">
                <span class="w-3 h-3 rounded-sm bg-gray-200 inline-block"></span> No Record
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-5 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider sticky left-0 bg-gray-50 z-10 border-r border-gray-200 min-w-[180px]">
                            Student Name
                        </th>
                        @foreach ($dateRange as $date)
                        <th class="px-3 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center min-w-[90px]">
                            <div>{{ \Carbon\Carbon::parse($date)->format('M d') }}</div>
                            <div class="text-gray-400 font-normal normal-case mt-0.5">
                                {{ \Carbon\Carbon::parse($date)->format('D') }}
                            </div>
                        </th>
                        @endforeach
                        <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center min-w-[80px] border-l border-gray-200">
                            Present
                        </th>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center min-w-[80px]">
                            Absent
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)

                    @php
                    $presentCount = 0;
                    $absentCount = 0;
                    @endphp

                    <tr class="border-b border-gray-100 last:border-0 hover:bg-gray-50 transition group">

                        <!-- Student Name (sticky) -->
                        <td class="px-5 py-3.5 font-medium text-gray-900 sticky left-0 bg-white group-hover:bg-gray-50 z-10 border-r border-gray-200 transition">
                            {{ $student['student_name'] }}
                        </td>

                        <!-- One cell per date -->
                        @foreach ($dateRange as $date)
                        @php
                        // Read directly from the pre-built map — NO method calls
                        $record = $attendanceMap[$student['batch_student_id']][$date] ?? null;
                        $status = $record['status'] ?? 'none';

                        if ($status === 'present') $presentCount++;
                        if ($status === 'absent') $absentCount++;

                        $cellBg = match($status) {
                        'present' => 'bg-green-100 text-green-800',
                        'absent' => 'bg-red-100 text-red-700',
                        'partial' => 'bg-yellow-100 text-yellow-800',
                        default => 'bg-gray-100 text-gray-400',
                        };

                        $cellLabel = match($status) {
                        'present' => '✓',
                        'absent' => '✗',
                        'partial' => '~',
                        default => '—',
                        };
                        @endphp

                        <td class="px-3 py-3.5 text-center">
                            <div class="group/cell relative inline-block">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-md text-xs font-semibold {{ $cellBg }}">
                                    {{ $cellLabel }}
                                </span>

                                <!-- Hover tooltip showing exact times -->
                                @if($record && ($record['check_in_time'] || $record['check_out_time']))
                                <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover/cell:flex flex-col items-start bg-gray-900 text-white text-xs rounded-lg px-3 py-2 shadow-lg z-50 whitespace-nowrap pointer-events-none">
                                    @if($record['check_in_time'])
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-3 h-3 text-green-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14" />
                                        </svg>
                                        In: {{ $record['check_in_time'] }}
                                    </div>
                                    @endif
                                    @if($record['check_out_time'])
                                    <div class="flex items-center gap-1.5 mt-0.5">
                                        <svg class="w-3 h-3 text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 8l4 4m0 0l-4 4m4-4H3" />
                                        </svg>
                                        Out: {{ $record['check_out_time'] }}
                                    </div>
                                    @endif
                                    <div class="absolute top-full left-1/2 -translate-x-1/2 w-0 h-0 border-l-4 border-r-4 border-t-4 border-l-transparent border-r-transparent border-t-gray-900"></div>
                                </div>
                                @endif
                            </div>
                        </td>
                        @endforeach

                        <!-- Present / Absent counts -->
                        <td class="px-4 py-3.5 text-center border-l border-gray-200">
                            <span class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                {{ $presentCount }}
                            </span>
                        </td>
                        <td class="px-4 py-3.5 text-center">
                            <span class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                {{ $absentCount }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ count($dateRange) + 3 }}" class="px-5 py-10 text-center">
                            <svg class="mx-auto w-10 h-10 text-gray-300 mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                            <p class="text-sm text-gray-400">No students found in this batch.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
    @if(count($students) > 0)
    <div class="mt-4 flex items-center gap-6 text-sm text-gray-500">
        <div class="flex items-center gap-1.5">
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0" />
            </svg>
            <span><strong class="text-gray-700">{{ count($students) }}</strong> students</span>
        </div>
        <div class="flex items-center gap-1.5">
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span><strong class="text-gray-700">{{ count($dateRange) }}</strong> days tracked</span>
        </div>
    </div>
    @endif
</div>