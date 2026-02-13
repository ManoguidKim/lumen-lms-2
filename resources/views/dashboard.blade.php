<x-layouts.app.flowbite>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-4">
        <div>
            <h1 class="text-xl font-semibold text-gray-800">Overview</h1>
            <p class="text-sm text-gray-400 mt-0.5">
                Overview of your activities, progress, and recent updates
            </p>
        </div>
    </div>

    @if (auth()->user()->hasRole('Student'))
    <!-- Learner Dashboard Cards Livewire Component -->
    <livewire:dashboard.learner.card-livewire />
    @else
    <!-- Dashboard Cards Livewire Component -->
    <livewire:dashboard.card-dashboard-livewire />

    <!-- Sample Graph -->

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Client Type Chart -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Client Type</h2>
            <div id="clientTypeChart"></div>
        </div>

        <!-- Educational Attainment Chart -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Educational Attainment</h2>
            <div id="educationalChart"></div>
        </div>

        <!-- Employment Status Chart -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Employment Status</h2>
            <div id="employmentChart"></div>
        </div>

        <!-- Gender Distribution Chart -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Gender Distribution</h2>
            <div id="genderChart"></div>
        </div>
    </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        // Sample data - Replace with your Laravel data
        const data = {
            clientTypes: ['TVET Student', 'TVET Graduate', 'Industry Worker', 'K-12', 'OFW'],
            clientCounts: [45, 78, 62, 34, 28],

            education: ['Elementary', 'High School', 'TVET', 'College Level', 'College Grad'],
            educationCounts: [12, 35, 78, 45, 62],

            employment: ['Casual', 'Job Order', 'Probationary', 'Permanent', 'Self-Employed', 'OFW'],
            employmentCounts: [25, 18, 22, 55, 40, 28],

            gender: ['Male', 'Female'],
            genderCounts: [130, 117]
        };

        // Client Type Chart
        new ApexCharts(document.querySelector("#clientTypeChart"), {
            series: [{
                data: data.clientCounts
            }],
            chart: {
                type: 'bar',
                height: 300
            },
            plotOptions: {
                bar: {
                    horizontal: false
                }
            },
            xaxis: {
                categories: data.clientTypes
            },
            colors: ['#3b82f6']
        }).render();

        // Educational Attainment Chart
        new ApexCharts(document.querySelector("#educationalChart"), {
            series: [{
                data: data.educationCounts
            }],
            chart: {
                type: 'bar',
                height: 300
            },
            plotOptions: {
                bar: {
                    horizontal: false
                }
            },
            xaxis: {
                categories: data.education
            },
            colors: ['#10b981']
        }).render();

        // Employment Status Chart
        new ApexCharts(document.querySelector("#employmentChart"), {
            series: [{
                data: data.employmentCounts
            }],
            chart: {
                type: 'bar',
                height: 300
            },
            plotOptions: {
                bar: {
                    horizontal: false
                }
            },
            xaxis: {
                categories: data.employment
            },
            colors: ['#f59e0b']
        }).render();

        // Gender Distribution Chart
        new ApexCharts(document.querySelector("#genderChart"), {
            series: data.genderCounts,
            chart: {
                type: 'pie',
                height: 300
            },
            labels: data.gender,
            colors: ['#3b82f6', '#ec4899']
        }).render();
    </script>

    <!-- Dashboard Charts Livewire Component - ongoing -->
</x-layouts.app.flowbite>