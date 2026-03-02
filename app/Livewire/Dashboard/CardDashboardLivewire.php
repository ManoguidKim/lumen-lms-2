<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Modules\CourseAdministration\Models\LearnerTrainingApplication;

class CardDashboardLivewire extends Component
{
    public int $selectedYear;
    public array $availableYears = [];

    public function mount(): void
    {
        $this->selectedYear = (int) date('Y');

        // Get available years from the database
        $this->availableYears = LearnerTrainingApplication::selectRaw('YEAR(application_date) as year')
            ->groupBy('year')
            ->orderByDesc('year')
            ->pluck('year')
            ->toArray();

        // Fallback if no data yet
        if (empty($this->availableYears)) {
            $this->availableYears = [(int) date('Y')];
        }
    }

    public function updatedSelectedYear(): void
    {
        // Triggers re-render automatically in Livewire
        $this->dispatch('chartDataUpdated', data: $this->monthlyData);
    }

    public function getMonthlyDataProperty(): array
    {
        $data = LearnerTrainingApplication::selectRaw('
                MONTH(application_date) as month,
                COUNT(*) as total
            ')
            ->where('status', 'approved')
            ->whereYear('application_date', $this->selectedYear)
            ->groupByRaw('MONTH(application_date)')
            ->orderByRaw('MONTH(application_date)')
            ->get();

        $months = array_fill(1, 12, 0);
        foreach ($data as $row) {
            $months[$row->month] = $row->total;
        }

        return array_values($months);
    }

    public function getTotalApplicationsProperty(): int
    {
        return array_sum($this->monthlyData);
    }

    public function getPeakMonthProperty(): string
    {
        $data = $this->monthlyData;
        $maxIndex = array_search(max($data), $data);
        $monthNames = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];
        return max($data) > 0 ? $monthNames[$maxIndex] : 'N/A';
    }

    public function render()
    {
        return view('livewire.dashboard.card-dashboard-livewire', [
            'monthlyData'         => $this->monthlyData,
            'totalApplications'   => $this->totalApplications,
            'peakMonth'           => $this->peakMonth,
        ]);
    }
}
