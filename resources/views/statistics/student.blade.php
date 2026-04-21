<x-layouts.app.flowbite>
     @if(!empty($tardiness))
     <div class="space-y-4">

          {{-- Header Card --}}
          <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
               <div class="flex items-center justify-between border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white px-6 py-4 dark:border-gray-800 dark:from-gray-900 dark:to-gray-900">
                    <div class="flex items-center gap-3">
                         <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800">
                              <svg class="h-4.5 w-4.5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.5V21h4.5v-7.5H3zM9.75 9V21h4.5V9h-4.5zM16.5 3.75V21H21V3.75h-4.5z" />
                              </svg>
                         </div>
                         <div>
                              <h2 class="text-sm font-bold tracking-tight text-gray-800 dark:text-gray-100">Tardiness & Absences Summary</h2>
                              <p class="mt-0.5 text-xs text-gray-400 dark:text-gray-500">Aggregated across all payroll batches</p>
                         </div>
                    </div>
                    <div class="flex items-center gap-2">
                         @if($tardiness['severe'] > 0)
                         <span class="inline-flex items-center gap-1.5 rounded-full border border-rose-100 bg-rose-50 px-3 py-1 text-xs font-semibold text-rose-600 dark:border-rose-900/20 dark:bg-rose-500/10 dark:text-rose-300">
                              <span class="inline-block h-1.5 w-1.5 rounded-full bg-rose-400"></span>
                              High Risk
                         </span>
                         @elseif($tardiness['moderate'] > 0)
                         <span class="inline-flex items-center gap-1.5 rounded-full border border-amber-200 bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700 dark:border-amber-900/40 dark:bg-amber-500/10 dark:text-amber-300">
                              <span class="inline-block h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                              Moderate Risk
                         </span>
                         @elseif($tardiness['minor'] > 0)
                         <span class="inline-flex items-center gap-1.5 rounded-full border border-green-200 bg-green-50 px-3 py-1 text-xs font-semibold text-green-700 dark:border-green-900/40 dark:bg-green-500/10 dark:text-green-300">
                              <span class="inline-block h-1.5 w-1.5 rounded-full bg-green-500"></span>
                              Low Risk
                         </span>
                         @else
                         <span class="inline-flex items-center gap-1.5 rounded-full border border-gray-200 bg-gray-50 px-3 py-1 text-xs font-semibold text-gray-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
                              <span class="inline-block h-1.5 w-1.5 rounded-full bg-gray-400"></span>
                              No Issues
                         </span>
                         @endif
                    </div>
               </div>

               {{-- KPI Grid --}}
               <div class="grid grid-cols-2 divide-x divide-y divide-gray-100 md:grid-cols-4 md:divide-y-0 dark:divide-gray-800">

                    {{-- Total Batches --}}
                    <div class="p-5 transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/40">
                         <div class="mb-3 flex items-start justify-between">
                              <p class="text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">Total Batches</p>
                              <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-gray-100 dark:bg-gray-800">
                                   <svg class="h-3.5 w-3.5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h12M6 10h12M6 14h12M6 18h12" />
                                   </svg>
                              </div>
                         </div>
                         <p class="text-3xl font-extrabold tabular-nums text-gray-800 dark:text-gray-100">{{ $tardiness['total_batches'] }}</p>
                         <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">payroll periods</p>
                    </div>

                    {{-- Late Arrivals --}}
                    <div class="p-5 transition-colors hover:bg-amber-50 dark:hover:bg-amber-500/10">
                         <div class="mb-3 flex items-start justify-between">
                              <p class="text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">Late Arrivals</p>
                              <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-amber-100 dark:bg-amber-500/10">
                                   <svg class="h-3.5 w-3.5 text-amber-500 dark:text-amber-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z" />
                                   </svg>
                              </div>
                         </div>
                         <p class="text-3xl font-extrabold tabular-nums text-amber-500 dark:text-amber-400">{{ $tardiness['total_late'] }}</p>
                         <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">instances across all batches</p>
                    </div>

                    {{-- Avg Minutes Late --}}
                    <div class="p-5 transition-colors hover:bg-orange-50 dark:hover:bg-orange-500/10">
                         <div class="mb-3 flex items-start justify-between">
                              <p class="text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">Avg. Late</p>
                              <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-orange-100 dark:bg-orange-500/10">
                                   <svg class="h-3.5 w-3.5 text-orange-500 dark:text-orange-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
                                   </svg>
                              </div>
                         </div>
                         <div class="flex items-baseline gap-1">
                              <p class="text-3xl font-extrabold tabular-nums text-orange-500 dark:text-orange-400">{{ $tardiness['avg_minutes'] }}</p>
                              <span class="text-sm font-medium text-orange-400 dark:text-orange-300">min</span>
                         </div>
                         <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">per late instance</p>
                    </div>

                    {{-- Worst Severity --}}
                    <div class="p-5 transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/40">
                         <div class="mb-3 flex items-start justify-between">
                              <p class="text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">Worst Severity</p>
                              <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-gray-100 dark:bg-gray-800">
                                   <svg class="h-3.5 w-3.5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                                   </svg>
                              </div>
                         </div>
                         <div class="mt-2">
                              @if($tardiness['severe'] > 0)
                              <span class="inline-flex items-center gap-1.5 rounded-xl border border-rose-100 bg-rose-50 px-3 py-1.5 text-sm font-bold text-rose-600 dark:border-rose-900/20 dark:bg-rose-500/10 dark:text-rose-300">
                                   <span class="inline-block h-2 w-2 rounded-full bg-rose-400"></span>
                                   Severe
                              </span>
                              @elseif($tardiness['moderate'] > 0)
                              <span class="inline-flex items-center gap-1.5 rounded-xl border border-amber-200 bg-amber-50 px-3 py-1.5 text-sm font-bold text-amber-700 dark:border-amber-900/40 dark:bg-amber-500/10 dark:text-amber-300">
                                   <span class="inline-block h-2 w-2 rounded-full bg-amber-500"></span>
                                   Moderate
                              </span>
                              @elseif($tardiness['minor'] > 0)
                              <span class="inline-flex items-center gap-1.5 rounded-xl border border-green-200 bg-green-50 px-3 py-1.5 text-sm font-bold text-green-700 dark:border-green-900/40 dark:bg-green-500/10 dark:text-green-300">
                                   <span class="inline-block h-2 w-2 rounded-full bg-green-500"></span>
                                   Minor
                              </span>
                              @else
                              <span class="inline-flex items-center gap-1.5 rounded-xl border border-gray-200 bg-gray-50 px-3 py-1.5 text-sm font-bold text-gray-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
                                   <span class="inline-block h-2 w-2 rounded-full bg-gray-400"></span>
                                   None
                              </span>
                              @endif
                         </div>
                         <p class="mt-2 text-xs text-gray-400 dark:text-gray-500">overall rating</p>
                    </div>
               </div>
          </div>

          {{-- Absence Stats Row --}}
          <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

               {{-- Absence KPIs --}}
               <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
                    <div class="flex items-center gap-3 border-b border-gray-100 bg-gray-50 px-5 py-3.5 dark:border-gray-800 dark:bg-gray-900">
                         <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-rose-50 dark:bg-rose-500/10">
                              <svg class="h-3.5 w-3.5 text-rose-400 dark:text-rose-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                              </svg>
                         </div>
                         <p class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Absence Overview</p>
                    </div>
                    <div class="grid grid-cols-2 divide-x divide-gray-100 dark:divide-gray-800">
                         <div class="p-5">
                              <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">Total Absences</p>
                              <div class="flex items-baseline gap-1">
                                   <p class="text-3xl font-extrabold tabular-nums text-rose-400 dark:text-rose-300">{{ $absences['total_absent'] }}</p>
                                   <span class="text-sm font-medium text-gray-400 dark:text-gray-500">/ {{ $absences['total_days'] }} days</span>
                              </div>
                              <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">across all batches</p>
                         </div>
                         <div class="p-5">
                              <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">Absence Rate</p>
                              <div class="flex items-baseline gap-1">
                                   <p class="text-3xl font-extrabold tabular-nums {{ $absences['absent_pct'] >= 20 ? 'text-rose-400 dark:text-rose-300' : ($absences['absent_pct'] >= 10 ? 'text-amber-500 dark:text-amber-400' : 'text-green-500 dark:text-green-400') }}">
                                        {{ $absences['absent_pct'] }}%
                                   </p>
                              </div>
                              <div class="mt-2 h-1.5 w-full overflow-hidden rounded-full bg-gray-100 dark:bg-gray-800">
                                   <div class="h-full rounded-full {{ $absences['absent_pct'] >= 20 ? 'bg-rose-300' : ($absences['absent_pct'] >= 10 ? 'bg-amber-500' : 'bg-green-500') }}"
                                        style="width: {{ min($absences['absent_pct'], 100) }}%"></div>
                              </div>
                              <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">of scheduled days</p>
                         </div>
                    </div>
               </div>

               {{-- Attendance Health Score --}}
               <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
                    <div class="flex items-center gap-3 border-b border-gray-100 bg-gray-50 px-5 py-3.5 dark:border-gray-800 dark:bg-gray-900">
                         <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-500/10">
                              <svg class="h-3.5 w-3.5 text-blue-500 dark:text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                              </svg>
                         </div>
                         <p class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Attendance Health</p>
                    </div>
                    <div class="p-5">
                         @php
                         $attendancePct = $absences['total_days'] > 0
                         ? round((($absences['total_days'] - $absences['total_absent']) / $absences['total_days']) * 100, 1)
                         : 100;
                         $healthColor = $attendancePct >= 90 ? 'text-green-500 dark:text-green-400' : ($attendancePct >= 75 ? 'text-amber-500 dark:text-amber-400' : 'text-rose-400 dark:text-rose-300');
                         $barColor = $attendancePct >= 90 ? 'bg-green-500' : ($attendancePct >= 75 ? 'bg-amber-500' : 'bg-rose-300');
                         $healthLabel = $attendancePct >= 90 ? 'Excellent' : ($attendancePct >= 75 ? 'Fair' : 'Poor');
                         @endphp
                         <div class="mb-3 flex items-center justify-between">
                              <div>
                                   <p class="text-3xl font-extrabold tabular-nums {{ $healthColor }}">{{ $attendancePct }}%</p>
                                   <p class="mt-0.5 text-xs text-gray-400 dark:text-gray-500">attendance rate</p>
                              </div>
                              <span class="rounded-xl px-3 py-1.5 text-sm font-bold
                            {{ $attendancePct >= 90 ? 'border border-green-200 bg-green-50 text-green-700 dark:border-green-900/40 dark:bg-green-500/10 dark:text-green-300' : ($attendancePct >= 75 ? 'border border-amber-200 bg-amber-50 text-amber-700 dark:border-amber-900/40 dark:bg-amber-500/10 dark:text-amber-300' : 'border border-rose-100 bg-rose-50 text-rose-600 dark:border-rose-900/20 dark:bg-rose-500/10 dark:text-rose-300') }}">
                                   {{ $healthLabel }}
                              </span>
                         </div>
                         <div class="h-3 w-full overflow-hidden rounded-full bg-gray-100 dark:bg-gray-800">
                              <div class="{{ $barColor }} h-full rounded-full transition-all duration-500"
                                   style="width: {{ $attendancePct }}%"></div>
                         </div>
                         <div class="mt-1.5 flex justify-between">
                              <span class="text-xs text-gray-400 dark:text-gray-500">0%</span>
                              <span class="text-xs text-gray-400 dark:text-gray-500">100%</span>
                         </div>
                    </div>
               </div>
          </div>

          {{-- Tardiness Severity Breakdown --}}
          <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
               <div class="flex items-center gap-3 border-b border-gray-100 bg-gray-50 px-6 py-3.5 dark:border-gray-800 dark:bg-gray-900">
                    <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-amber-100 dark:bg-amber-500/10">
                         <svg class="h-3.5 w-3.5 text-amber-500 dark:text-amber-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z" />
                         </svg>
                    </div>
                    <p class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Tardiness Severity Breakdown</p>
               </div>

               @if($tardiness['total_late'] > 0)
               <div class="p-6">
                    <div class="mb-5 flex h-4 overflow-hidden rounded-full bg-gray-100 dark:bg-gray-800">
                         @if($tardiness['minor'] > 0)
                         <div class="h-full bg-green-400 transition-all" style="width: {{ $tardiness['minor_pct'] }}%" title="Minor: {{ $tardiness['minor_pct'] }}%"></div>
                         @endif
                         @if($tardiness['moderate'] > 0)
                         <div class="h-full bg-amber-400 transition-all" style="width: {{ $tardiness['moderate_pct'] }}%" title="Moderate: {{ $tardiness['moderate_pct'] }}%"></div>
                         @endif
                         @if($tardiness['severe'] > 0)
                         <div class="h-full bg-rose-300 transition-all" style="width: {{ $tardiness['severe_pct'] }}%" title="Severe: {{ $tardiness['severe_pct'] }}%"></div>
                         @endif
                    </div>

                    <div class="space-y-3">
                         @foreach([
                         ['label' => 'Minor', 'desc' => '1–15 mins late', 'pct' => $tardiness['minor_pct'], 'count' => $tardiness['minor'], 'bar' => 'bg-green-400', 'text' => 'text-green-700 dark:text-green-300', 'bg' => 'bg-green-50 dark:bg-green-500/10', 'border' => 'border-green-200 dark:border-green-900/40'],
                         ['label' => 'Moderate', 'desc' => '16–30 mins late', 'pct' => $tardiness['moderate_pct'], 'count' => $tardiness['moderate'], 'bar' => 'bg-amber-400', 'text' => 'text-amber-700 dark:text-amber-300', 'bg' => 'bg-amber-50 dark:bg-amber-500/10', 'border' => 'border-amber-200 dark:border-amber-900/40'],
                         ['label' => 'Severe', 'desc' => '30+ mins late', 'pct' => $tardiness['severe_pct'], 'count' => $tardiness['severe'], 'bar' => 'bg-rose-300', 'text' => 'text-rose-600 dark:text-rose-300', 'bg' => 'bg-rose-50 dark:bg-rose-500/10', 'border' => 'border-rose-100 dark:border-rose-900/20'],
                         ] as $row)
                         <div class="flex items-center gap-3">
                              <div class="flex w-28 flex-shrink-0 items-center gap-2">
                                   <span class="h-2.5 w-2.5 flex-shrink-0 rounded-full {{ $row['bar'] }}"></span>
                                   <div>
                                        <p class="text-xs font-semibold text-gray-700 dark:text-gray-200">{{ $row['label'] }}</p>
                                        <p class="text-[10px] text-gray-400 dark:text-gray-500">{{ $row['desc'] }}</p>
                                   </div>
                              </div>
                              <div class="h-2.5 flex-1 overflow-hidden rounded-full bg-gray-100 dark:bg-gray-800">
                                   <div class="{{ $row['bar'] }} h-full rounded-full transition-all duration-500"
                                        style="width: {{ $row['pct'] }}%"></div>
                              </div>
                              <span class="w-10 text-right text-xs font-bold tabular-nums {{ $row['text'] }}">{{ $row['pct'] }}%</span>
                              <span class="inline-flex w-14 items-center justify-center rounded-full border px-2 py-0.5 text-center text-xs font-semibold tabular-nums {{ $row['text'] }} {{ $row['bg'] }} {{ $row['border'] }}">
                                   {{ $row['count'] }}×
                              </span>
                         </div>
                         @endforeach
                    </div>
               </div>
               @else
               <div class="flex flex-col items-center justify-center py-10 text-center">
                    <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-green-50 dark:bg-green-500/10">
                         <svg class="h-6 w-6 text-green-400 dark:text-green-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                         </svg>
                    </div>
                    <p class="text-sm font-semibold text-gray-600 dark:text-gray-300">No Tardiness Recorded</p>
                    <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">All arrivals were on time across all batches.</p>
               </div>
               @endif
          </div>

          {{-- Absence Breakdown --}}
          <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
               <div class="flex items-center gap-3 border-b border-gray-100 bg-gray-50 px-6 py-3.5 dark:border-gray-800 dark:bg-gray-900">
                    <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-rose-50 dark:bg-rose-500/10">
                         <svg class="h-3.5 w-3.5 text-rose-300 dark:text-rose-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                         </svg>
                    </div>
                    <p class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Absence Breakdown</p>
               </div>

               @if($absences['total_absent'] > 0)
               <div class="p-6">
                    <div class="mb-2 flex h-4 overflow-hidden rounded-full bg-gray-100 dark:bg-gray-800">
                         <div class="h-full bg-green-400 transition-all" style="width: {{ 100 - $absences['absent_pct'] }}%"></div>
                         <div class="h-full bg-rose-300 transition-all" style="width: {{ $absences['absent_pct'] }}%"></div>
                    </div>
                    <div class="mb-5 flex justify-between">
                         <span class="flex items-center gap-1.5 text-xs text-gray-500 dark:text-gray-400">
                              <span class="inline-block h-2 w-2 rounded-full bg-green-400"></span>
                              Present ({{ 100 - $absences['absent_pct'] }}%)
                         </span>
                         <span class="flex items-center gap-1.5 text-xs text-gray-500 dark:text-gray-400">
                              <span class="inline-block h-2 w-2 rounded-full bg-rose-300"></span>
                              Absent ({{ $absences['absent_pct'] }}%)
                         </span>
                    </div>

                    <div class="flex items-center gap-3">
                         <div class="flex w-28 flex-shrink-0 items-center gap-2">
                              <span class="h-2.5 w-2.5 flex-shrink-0 rounded-full bg-rose-300"></span>
                              <div>
                                   <p class="text-xs font-semibold text-gray-700 dark:text-gray-200">Absent / AWOL</p>
                                   <p class="text-[10px] text-gray-400 dark:text-gray-500">No log recorded</p>
                              </div>
                         </div>
                         <div class="h-2.5 flex-1 overflow-hidden rounded-full bg-gray-100 dark:bg-gray-800">
                              <div class="h-full rounded-full bg-rose-300 transition-all duration-500"
                                   style="width: {{ $absences['absent_pct'] }}%"></div>
                         </div>
                         <span class="w-10 text-right text-xs font-bold text-rose-600 tabular-nums dark:text-rose-300">{{ $absences['absent_pct'] }}%</span>
                         <span class="inline-flex w-14 items-center justify-center rounded-full border border-rose-100 bg-rose-50 px-2 py-0.5 text-center text-xs font-semibold text-rose-600 tabular-nums dark:border-rose-900/20 dark:bg-rose-500/10 dark:text-rose-300">
                              {{ $absences['total_absent'] }}×
                         </span>
                    </div>
               </div>
               @else
               <div class="flex flex-col items-center justify-center py-10 text-center">
                    <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-green-50 dark:bg-green-500/10">
                         <svg class="h-6 w-6 text-green-400 dark:text-green-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                         </svg>
                    </div>
                    <p class="text-sm font-semibold text-gray-600 dark:text-gray-300">Perfect Attendance</p>
                    <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">No absences recorded across all batches.</p>
               </div>
               @endif
          </div>

     </div>
     @endif
</x-layouts.app.flowbite>