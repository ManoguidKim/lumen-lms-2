<div>
    <!-- resources/views/livewire/dashboard/card-dashboard-livewire.blade.php -->
    <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-4 gap-4 mb-4">

        <!-- Citizen -->
        <div class="w-full">
            <div class="p-5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-1 hover:scale-[1.02] relative min-h-32">

                <!-- Loading Skeleton -->
                <div wire:loading wire:target="render" class="absolute inset-0 bg-white dark:bg-gray-800 rounded-lg flex items-center justify-center z-10">
                    <div class="flex flex-col items-center gap-3 w-full p-5">
                        <div class="w-10 h-10 bg-gradient-to-r from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-600 rounded-xl animate-pulse"></div>
                        <div class="w-24 h-4 bg-gradient-to-r from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-600 rounded animate-pulse"></div>
                        <div class="w-16 h-8 bg-gradient-to-r from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-600 rounded animate-pulse"></div>
                    </div>
                </div>

                <!-- Content -->
                <div wire:loading.remove wire:target="render">
                    <!-- Header -->
                    <div class="flex flex-col mb-7">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-100 to-blue-300 dark:from-blue-900 dark:to-blue-700 rounded-xl flex items-center justify-center shadow-inner">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 10a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 1114 0H3z" />
                                </svg>
                            </div>
                            <div>
                                <h6 class="text-sm font-semibold text-gray-700 dark:text-gray-200 tracking-wide">Learners</h6>
                                <p class="text-xs text-gray-500 dark:text-gray-400 -mt-0.5">Total registered learners</p>
                            </div>
                        </div>
                    </div>

                    <!-- Value -->
                    <p class="text-4xl font-bold text-gray-700 dark:text-white mb-1 leading-none">
                        {{ 0 }}
                    </p>
                </div>
            </div>
        </div>


        <!-- Household -->
        <div class="w-full">
            <div class="p-5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-1 hover:scale-[1.02] relative min-h-32">

                <!-- Loading Skeleton -->
                <div wire:loading wire:target="render" class="absolute inset-0 bg-white dark:bg-gray-800 rounded-lg flex items-center justify-center z-10">
                    <div class="flex flex-col items-center gap-3 w-full p-5">
                        <div class="w-10 h-10 bg-gradient-to-r from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-600 rounded-xl animate-pulse"></div>
                        <div class="w-24 h-4 bg-gradient-to-r from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-600 rounded animate-pulse"></div>
                        <div class="w-16 h-8 bg-gradient-to-r from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-600 rounded animate-pulse"></div>
                    </div>
                </div>

                <!-- Content -->
                <div wire:loading.remove wire:target="render">
                    <!-- Header -->
                    <div class="flex flex-col mb-7">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-100 to-green-300 dark:from-green-900 dark:to-green-700 rounded-xl flex items-center justify-center shadow-inner">
                                <svg class="w-5 h-5 text-green-600 dark:text-green-400" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 1.293a1 1 0 00-1.414 0l-8 8a1 1 0 001.414 1.414L3 10.414V18a2 2 0 002 2h3a1 1 0 001-1v-4h2v4a1 1 0 001 1h3a2 2 0 002-2v-7.586l.293.293a1 1 0 001.414-1.414l-8-8z" />
                                </svg>
                            </div>
                            <div>
                                <h6 class="text-sm font-semibold text-gray-700 dark:text-gray-200 tracking-wide">Course</h6>
                                <p class="text-xs text-gray-500 dark:text-gray-400 -mt-0.5">Total registered course</p>
                            </div>
                        </div>
                    </div>

                    <!-- Value -->
                    <p class="text-4xl font-bold text-gray-700 dark:text-white mb-1 leading-none">
                        {{ 0 }}
                    </p>
                </div>
            </div>
        </div>


        <!-- Family -->
        <div class="w-full">
            <div class="p-5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-1 hover:scale-[1.02] relative min-h-32">

                <!-- Loading Skeleton -->
                <div wire:loading wire:target="render" class="absolute inset-0 bg-white dark:bg-gray-800 rounded-lg flex items-center justify-center z-10">
                    <div class="flex flex-col items-center gap-3 w-full p-5">
                        <div class="w-10 h-10 bg-gradient-to-r from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-600 rounded-xl animate-pulse"></div>
                        <div class="w-24 h-4 bg-gradient-to-r from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-600 rounded animate-pulse"></div>
                        <div class="w-16 h-8 bg-gradient-to-r from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-600 rounded animate-pulse"></div>
                    </div>
                </div>

                <!-- Content -->
                <div wire:loading.remove wire:target="render">
                    <!-- Header -->
                    <div class="flex flex-col mb-7">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-purple-100 to-purple-300 dark:from-purple-900 dark:to-purple-700 rounded-xl flex items-center justify-center shadow-inner">
                                <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c1.657 0 3-1.79 3-4s-1.343-4-3-4-3 1.79-3 4 1.343 4 3 4zm0 2c-2.33 0-7 1.17-7 3.5V20h14v-2.5c0-2.33-4.67-3.5-7-3.5zm7-6c0 1.657-1.343 3-3 3s-3-1.343-3-3 1.343-3 3-3 3 1.343 3 3zm-1 9v-1.25c0-1.25-2.5-2.25-4-2.25h-.59c.36.53.59 1.14.59 1.75V20h4zm-12 0v-1.75c0-.61.23-1.22.59-1.75H6c-1.5 0-4 .99-4 2.25V20h4z" />
                                </svg>
                            </div>
                            <div>
                                <h6 class="text-sm font-semibold text-gray-700 dark:text-gray-200 tracking-wide">Trainings</h6>
                                <p class="text-xs text-gray-500 dark:text-gray-400 -mt-0.5">Total number of ongoing trainings</p>
                            </div>
                        </div>
                    </div>


                    <!-- Value -->
                    <p class="text-4xl font-bold text-gray-700 dark:text-white mb-1 leading-none">
                        {{ 0 }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    @if (auth()->user()->hasRole('Director'))
    {{-- Chart Card --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 mb-6">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Monthly Applications</h3>
                <p class="text-sm text-gray-500 mt-0.5">
                    Learner applications overview for {{ $selectedYear }}
                </p>
            </div>

            {{-- Year Filter --}}
            <select
                wire:model.live="selectedYear"
                class="text-sm border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500 bg-white text-gray-700 w-full sm:w-auto">
                @foreach($availableYears as $year)
                <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
        </div>

        {{-- Summary Stats --}}
        <div class="grid grid-cols-3 gap-4 mb-6">
            <div class="bg-blue-50 rounded-lg p-3 text-center">
                <p class="text-2xl font-bold text-blue-600">{{ $totalApplications }}</p>
                <p class="text-xs text-gray-500 mt-1">Total Applications</p>
            </div>
            <div class="bg-green-50 rounded-lg p-3 text-center">
                <p class="text-2xl font-bold text-green-600">{{ $peakMonth }}</p>
                <p class="text-xs text-gray-500 mt-1">Peak Month</p>
            </div>
            <div class="bg-purple-50 rounded-lg p-3 text-center">
                <p class="text-2xl font-bold text-purple-600">
                    {{ $totalApplications > 0 ? round($totalApplications / 12, 1) : 0 }}
                </p>
                <p class="text-xs text-gray-500 mt-1">Monthly Average</p>
            </div>
        </div>

        {{-- Chart --}}
        <div
            wire:ignore
            id="monthlyApplicationChart"
            style="min-height: 350px;"></div>
    </div>
    @endif

    <script>
        (function() {
            function renderChart() {
                if (typeof ApexCharts === 'undefined') {
                    setTimeout(renderChart, 100);
                    return;
                }

                const el = document.querySelector('#monthlyApplicationChart');
                if (!el) return;

                const chart = new ApexCharts(el, {
                    series: [{
                        name: 'Applications',
                        data: @json($monthlyData)
                    }],
                    chart: {
                        type: 'bar',
                        height: 350,
                        toolbar: {
                            show: false
                        },
                        fontFamily: 'Inter, sans-serif',
                        animations: {
                            enabled: true,
                            easing: 'easeinout',
                            speed: 600
                        }
                    },
                    colors: ['#3b82f6'],
                    plotOptions: {
                        bar: {
                            borderRadius: 6,
                            columnWidth: '55%',
                            dataLabels: {
                                position: 'top'
                            },
                            colors: {
                                ranges: [{
                                    from: 0,
                                    to: 0,
                                    color: '#e5e7eb'
                                }]
                            }
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        offsetY: -22,
                        style: {
                            fontSize: '11px',
                            fontWeight: '600',
                            colors: ['#374151']
                        },
                        formatter: val => val > 0 ? val : ''
                    },
                    xaxis: {
                        categories: [
                            'January', 'February', 'March', 'April',
                            'May', 'June', 'July', 'August',
                            'September', 'October', 'November', 'December'
                        ],
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        },
                        labels: {
                            rotate: -45,
                            style: {
                                colors: '#6b7280',
                                fontSize: '12px'
                            }
                        }
                    },
                    yaxis: {
                        min: 0,
                        forceNiceScale: true,
                        labels: {
                            style: {
                                colors: '#6b7280',
                                fontSize: '12px'
                            },
                            formatter: val => Math.floor(val)
                        }
                    },
                    grid: {
                        borderColor: '#f3f4f6',
                        strokeDashArray: 4,
                        yaxis: {
                            lines: {
                                show: true
                            }
                        },
                        xaxis: {
                            lines: {
                                show: false
                            }
                        },
                        padding: {
                            top: 10,
                            bottom: 0
                        }
                    },
                    tooltip: {
                        y: {
                            formatter: val => val + ' application(s)'
                        },
                        x: {
                            formatter: (val, {
                                dataPointIndex
                            }) => {
                                const months = [
                                    'January', 'February', 'March', 'April',
                                    'May', 'June', 'July', 'August',
                                    'September', 'October', 'November', 'December'
                                ];
                                return months[dataPointIndex] + ' {{ $selectedYear }}';
                            }
                        }
                    },
                    states: {
                        hover: {
                            filter: {
                                type: 'darken',
                                value: 0.85
                            }
                        }
                    }
                });

                chart.render();

                window.addEventListener('chartDataUpdated', event => {
                    chart.updateSeries([{
                        name: 'Applications',
                        data: event.detail.data
                    }]);
                });
            }

            renderChart();
        })();
    </script>
</div>