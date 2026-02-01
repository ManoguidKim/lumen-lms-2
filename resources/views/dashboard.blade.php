<x-layouts.app.flowbite>
    <h2 class="mb-6 text-xl font-medium leading-none tracking-tight text-gray-600 md:text-xl dark:text-white">
        Overview
    </h2>

    @if (auth()->user()->hasRole('Student'))
    <!-- Learner Dashboard Cards Livewire Component -->
    <livewire:dashboard.learner.card-livewire />
    @else
    <!-- Dashboard Cards Livewire Component -->
    <livewire:dashboard.card-dashboard-livewire />
    @endif

    <!-- Dashboard Charts Livewire Component - ongoing -->
</x-layouts.app.flowbite>