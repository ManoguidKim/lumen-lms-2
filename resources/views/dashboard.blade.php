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
    @endif

    <!-- Dashboard Charts Livewire Component - ongoing -->
</x-layouts.app.flowbite>