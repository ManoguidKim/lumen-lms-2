<div class="space-y-6">
    {{-- KPI CARDS --}}
    <div class="grid grid-cols-1 gap-4 md:grid-cols-3 xl:grid-cols-3">

        {{-- Learners --}}
        <div class="relative overflow-hidden rounded-3xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md dark:border-gray-800 dark:bg-gray-900">
            <div wire:loading wire:target="render" class="absolute inset-0 z-10 flex items-center justify-center bg-white/80 backdrop-blur-sm dark:bg-gray-900/80">
                <div class="space-y-3 text-center">
                    <div class="mx-auto h-10 w-10 animate-pulse rounded-2xl bg-gray-200 dark:bg-gray-700"></div>
                    <div class="mx-auto h-3 w-24 animate-pulse rounded bg-gray-200 dark:bg-gray-700"></div>
                    <div class="mx-auto h-8 w-16 animate-pulse rounded bg-gray-200 dark:bg-gray-700"></div>
                </div>
            </div>

            <div wire:loading.remove wire:target="render">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-blue-500 dark:text-blue-400">
                            Learners
                        </p>
                        <h3 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ number_format($totalLearners ?? 0) }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Total registered learners
                        </p>
                    </div>

                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 10a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 1114 0H3z" />
                        </svg>
                    </div>
                </div>

                <div class="mt-5 h-1.5 w-full overflow-hidden rounded-full bg-blue-50 dark:bg-blue-500/10">
                    <div class="h-full w-3/4 rounded-full bg-blue-500"></div>
                </div>
            </div>
        </div>

        {{-- Courses --}}
        <div class="relative overflow-hidden rounded-3xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md dark:border-gray-800 dark:bg-gray-900">
            <div wire:loading wire:target="render" class="absolute inset-0 z-10 flex items-center justify-center bg-white/80 backdrop-blur-sm dark:bg-gray-900/80">
                <div class="space-y-3 text-center">
                    <div class="mx-auto h-10 w-10 animate-pulse rounded-2xl bg-gray-200 dark:bg-gray-700"></div>
                    <div class="mx-auto h-3 w-24 animate-pulse rounded bg-gray-200 dark:bg-gray-700"></div>
                    <div class="mx-auto h-8 w-16 animate-pulse rounded bg-gray-200 dark:bg-gray-700"></div>
                </div>
            </div>

            <div wire:loading.remove wire:target="render">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-emerald-500 dark:text-emerald-400">
                            Courses
                        </p>
                        <h3 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ number_format($totalCourses ?? 0) }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Total registered courses
                        </p>
                    </div>

                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 1.293a1 1 0 00-1.414 0l-8 8a1 1 0 001.414 1.414L3 10.414V18a2 2 0 002 2h3a1 1 0 001-1v-4h2v4a1 1 0 001 1h3a2 2 0 002-2v-7.586l.293.293a1 1 0 001.414-1.414l-8-8z" />
                        </svg>
                    </div>
                </div>

                <div class="mt-5 h-1.5 w-full overflow-hidden rounded-full bg-emerald-50 dark:bg-emerald-500/10">
                    <div class="h-full w-2/3 rounded-full bg-emerald-500"></div>
                </div>
            </div>
        </div>

        {{-- Trainings --}}
        <div class="relative overflow-hidden rounded-3xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md dark:border-gray-800 dark:bg-gray-900">
            <div wire:loading wire:target="render" class="absolute inset-0 z-10 flex items-center justify-center bg-white/80 backdrop-blur-sm dark:bg-gray-900/80">
                <div class="space-y-3 text-center">
                    <div class="mx-auto h-10 w-10 animate-pulse rounded-2xl bg-gray-200 dark:bg-gray-700"></div>
                    <div class="mx-auto h-3 w-24 animate-pulse rounded bg-gray-200 dark:bg-gray-700"></div>
                    <div class="mx-auto h-8 w-16 animate-pulse rounded bg-gray-200 dark:bg-gray-700"></div>
                </div>
            </div>

            <div wire:loading.remove wire:target="render">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-violet-500 dark:text-violet-400">
                            Trainings
                        </p>
                        <h3 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ number_format($totalTrainings ?? 0) }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Ongoing training batches
                        </p>
                    </div>

                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-50 text-violet-600 dark:bg-violet-500/10 dark:text-violet-400">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c1.657 0 3-1.79 3-4s-1.343-4-3-4-3 1.79-3 4 1.343 4 3 4zm0 2c-2.33 0-7 1.17-7 3.5V20h14v-2.5c0-2.33-4.67-3.5-7-3.5zm7-6c0 1.657-1.343 3-3 3s-3-1.343-3-3 1.343-3 3-3 3 1.343 3 3zm-1 9v-1.25c0-1.25-2.5-2.25-4-2.25h-.59c.36.53.59 1.14.59 1.75V20h4zm-12 0v-1.75c0-.61.23-1.22.59-1.75H6c-1.5 0-4 .99-4 2.25V20h4z" />
                        </svg>
                    </div>
                </div>

                <div class="mt-5 h-1.5 w-full overflow-hidden rounded-full bg-violet-50 dark:bg-violet-500/10">
                    <div class="h-full w-1/2 rounded-full bg-violet-500"></div>
                </div>
            </div>
        </div>
    </div>

    @if (auth()->user()->hasRole('Director'))
    {{-- MAIN ANALYTICS --}}
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">
        {{-- Monthly Applications Chart --}}
        <div class="xl:col-span-2 overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
            <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Monthly Applications
                        </h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Learner applications overview for {{ $selectedYear }}
                        </p>
                    </div>

                    <select
                        wire:model.live="selectedYear"
                        class="w-full rounded-xl border border-gray-200 bg-white px-3 py-2 text-sm text-gray-700 shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 dark:focus:border-indigo-500 dark:focus:ring-indigo-500/10 sm:w-auto">
                        @foreach($availableYears as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 border-b border-gray-100 px-5 py-4 dark:border-gray-800 sm:grid-cols-3">
                <div class="rounded-2xl bg-blue-50 px-4 py-4 dark:bg-blue-500/10">
                    <p class="text-[11px] font-semibold uppercase tracking-wider text-blue-600 dark:text-blue-400">
                        Total Applications
                    </p>
                    <p class="mt-2 text-3xl font-bold text-blue-700 dark:text-blue-300">
                        {{ $totalApplications }}
                    </p>
                </div>

                <div class="rounded-2xl bg-emerald-50 px-4 py-4 dark:bg-emerald-500/10">
                    <p class="text-[11px] font-semibold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">
                        Peak Month
                    </p>
                    <p class="mt-2 text-3xl font-bold text-emerald-700 dark:text-emerald-300">
                        {{ $peakMonth }}
                    </p>
                </div>

                <div class="rounded-2xl bg-violet-50 px-4 py-4 dark:bg-violet-500/10">
                    <p class="text-[11px] font-semibold uppercase tracking-wider text-violet-600 dark:text-violet-400">
                        Monthly Average
                    </p>
                    <p class="mt-2 text-3xl font-bold text-violet-700 dark:text-violet-300">
                        {{ $totalApplications > 0 ? round($totalApplications / 12, 1) : 0 }}
                    </p>
                </div>
            </div>

            <div class="p-5">
                <div class="h-[360px]">
                    <canvas wire:ignore id="monthlyApplicationChart"></canvas>
                </div>
            </div>
        </div>

        {{-- Top Courses --}}
        <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
            <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Most Applied Courses
                </h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Top courses by application count — {{ $selectedYear }}
                </p>
            </div>

            <div class="space-y-3 p-5">
                @if(count($topCoursesData['series']) > 0)
                @foreach(array_slice(array_keys($topCoursesData['series']), 0, 3) as $i)
                <div class="flex items-center gap-3 rounded-2xl border px-4 py-3
                                {{ $i === 0 ? 'border-yellow-200 bg-yellow-50 dark:border-yellow-900/30 dark:bg-yellow-500/10' : ($i === 1 ? 'border-gray-200 bg-gray-50 dark:border-gray-700 dark:bg-gray-800/60' : 'border-orange-200 bg-orange-50 dark:border-orange-900/30 dark:bg-orange-500/10') }}">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl font-black
                                    {{ $i === 0 ? 'bg-yellow-100 text-yellow-600 dark:bg-yellow-500/10 dark:text-yellow-300' : ($i === 1 ? 'bg-gray-200 text-gray-600 dark:bg-gray-700 dark:text-gray-300' : 'bg-orange-100 text-orange-600 dark:bg-orange-500/10 dark:text-orange-300') }}">
                        #{{ $i + 1 }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="truncate text-sm font-semibold text-gray-800 dark:text-gray-100">
                            {{ $topCoursesData['names'][$i] ?? '' }}
                        </p>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            {{ $topCoursesData['series'][$i] ?? 0 }} applications
                        </p>
                    </div>
                </div>
                @endforeach

                <div class="pt-2">
                    <div class="h-[260px]">
                        <canvas wire:ignore id="topCoursesChart"></canvas>
                    </div>
                </div>
                @else
                <div class="flex min-h-[220px] flex-col items-center justify-center text-center">
                    <div class="mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-gray-100 text-gray-400 dark:bg-gray-800 dark:text-gray-500">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-6m3 6V7m3 10v-3m3 7H6a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2v14a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <p class="text-sm font-medium text-gray-700 dark:text-gray-200">
                        No course data available
                    </p>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        Top applied courses will appear here once applications are recorded.
                    </p>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endif

    @once
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endonce

    <script>
        (function() {
            let monthlyChart = null;
            let topCoursesChart = null;

            const monthLabels = [
                'January', 'February', 'March', 'April',
                'May', 'June', 'July', 'August',
                'September', 'October', 'November', 'December'
            ];

            function destroyCharts() {
                if (monthlyChart) {
                    monthlyChart.destroy();
                    monthlyChart = null;
                }
                if (topCoursesChart) {
                    topCoursesChart.destroy();
                    topCoursesChart = null;
                }
            }

            function renderMonthlyChart() {
                const el = document.getElementById('monthlyApplicationChart');
                if (!el || typeof Chart === 'undefined') return;

                monthlyChart = new Chart(el, {
                    type: 'bar',
                    data: {
                        labels: monthLabels,
                        datasets: [{
                            label: 'Applications',
                            data: @json($monthlyData),
                            backgroundColor: '#3b82f6',
                            borderRadius: 8,
                            borderSkipped: false,
                            maxBarThickness: 42,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return `${context.parsed.y} application(s)`;
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    color: '#6b7280',
                                    maxRotation: 45,
                                    minRotation: 45
                                }
                            },
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    precision: 0,
                                    color: '#6b7280'
                                },
                                grid: {
                                    color: '#f3f4f6'
                                }
                            }
                        }
                    }
                });
            }

            function renderTopCoursesChart() {
                const el = document.getElementById('topCoursesChart');
                if (!el || typeof Chart === 'undefined') return;

                const labels = @json($topCoursesData['names'] ?? []);
                const data = @json($topCoursesData['series'] ?? []);

                if (!labels.length) return;

                topCoursesChart = new Chart(el, {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: [
                                '#f59e0b',
                                '#6366f1',
                                '#10b981',
                                '#ef4444',
                                '#8b5cf6'
                            ],
                            borderWidth: 0,
                            hoverOffset: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '68%',
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    boxWidth: 12,
                                    color: '#6b7280',
                                    padding: 16
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return `${context.label}: ${context.parsed} application(s)`;
                                    }
                                }
                            }
                        }
                    }
                });
            }

            function renderCharts() {
                destroyCharts();
                renderMonthlyChart();
                renderTopCoursesChart();
            }

            document.addEventListener('DOMContentLoaded', renderCharts);

            document.addEventListener('livewire:navigated', renderCharts);

            window.addEventListener('chartDataUpdated', function(event) {
                destroyCharts();

                const monthlyData = event.detail.data ?? @json($monthlyData);
                const topNames = event.detail.topCourseNames ?? @json($topCoursesData['names'] ?? []);
                const topSeries = event.detail.topCourseSeries ?? @json($topCoursesData['series'] ?? []);

                const monthlyEl = document.getElementById('monthlyApplicationChart');
                if (monthlyEl && typeof Chart !== 'undefined') {
                    monthlyChart = new Chart(monthlyEl, {
                        type: 'bar',
                        data: {
                            labels: monthLabels,
                            datasets: [{
                                label: 'Applications',
                                data: monthlyData,
                                backgroundColor: '#3b82f6',
                                borderRadius: 8,
                                borderSkipped: false,
                                maxBarThickness: 42,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            return `${context.parsed.y} application(s)`;
                                        }
                                    }
                                }
                            },
                            scales: {
                                x: {
                                    grid: {
                                        display: false
                                    },
                                    ticks: {
                                        color: '#6b7280',
                                        maxRotation: 45,
                                        minRotation: 45
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        precision: 0,
                                        color: '#6b7280'
                                    },
                                    grid: {
                                        color: '#f3f4f6'
                                    }
                                }
                            }
                        }
                    });
                }

                const topEl = document.getElementById('topCoursesChart');
                if (topEl && typeof Chart !== 'undefined' && topNames.length) {
                    topCoursesChart = new Chart(topEl, {
                        type: 'doughnut',
                        data: {
                            labels: topNames,
                            datasets: [{
                                data: topSeries,
                                backgroundColor: [
                                    '#f59e0b',
                                    '#6366f1',
                                    '#10b981',
                                    '#ef4444',
                                    '#8b5cf6'
                                ],
                                borderWidth: 0,
                                hoverOffset: 6
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            cutout: '68%',
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: {
                                        boxWidth: 12,
                                        color: '#6b7280',
                                        padding: 16
                                    }
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            return `${context.label}: ${context.parsed} application(s)`;
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
            });
        })();
    </script>
</div>