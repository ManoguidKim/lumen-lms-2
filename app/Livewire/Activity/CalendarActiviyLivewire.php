<?php

namespace App\Livewire\Activity;

use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Modules\CourseAdministration\Models\TrainingActivity;
use Modules\CourseAdministration\Models\TrainingBatch;

class CalendarActiviyLivewire extends Component
{
    public int $currentMonth;
    public int $currentYear;
    public ?string $selectedDate = null;
    public $trainingBatches = [];

    // Modal state
    public bool $showModal = false;
    public ?int $editingId = null;

    // Form fields
    #[Rule('required|string|max:255')]
    public array $form = [
        'title'             => '',
        'activity_date'    => '',
        'activity_time'    => '',
        'training_batch_id' => '',
    ];

    public function mount(): void
    {
        $this->currentMonth = now()->month;
        $this->currentYear  = now()->year;

        // Load training batches for dropdown
        $this->trainingBatches = TrainingBatch::orderBy('batch_name')->get();
    }

    // ─── Computed Properties ───────────────────────────────────────────────────

    #[Computed]
    public function monthName(): string
    {
        return Carbon::create($this->currentYear, $this->currentMonth)->format('F');
    }

    #[Computed]
    public function daysInMonth(): int
    {
        return Carbon::create($this->currentYear, $this->currentMonth)->daysInMonth;
    }

    #[Computed]
    public function firstDayOfMonth(): int
    {
        return Carbon::create($this->currentYear, $this->currentMonth, 1)->dayOfWeek;
    }

    #[Computed]
    public function activitiesByDate(): array
    {
        $activities = TrainingActivity::whereYear('activity_date', $this->currentYear)
            ->whereMonth('activity_date', $this->currentMonth)
            ->orderBy('activity_time')
            ->get()
            ->toArray();

        $grouped = [];
        foreach ($activities as $activity) {
            $date = Carbon::parse($activity['activity_date'])->toDateString();
            $grouped[$date][] = $activity;
        }

        return $grouped;
    }

    #[Computed]
    public function monthActivityCount(): int
    {
        return array_sum(array_map('count', $this->activitiesByDate));
    }

    // ─── Navigation ───────────────────────────────────────────────────────────

    public function previousMonth(): void
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth)->subMonth();
        $this->currentMonth = $date->month;
        $this->currentYear  = $date->year;
        $this->selectedDate = null;
    }

    public function nextMonth(): void
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth)->addMonth();
        $this->currentMonth = $date->month;
        $this->currentYear  = $date->year;
        $this->selectedDate = null;
    }

    // ─── Day Selection ────────────────────────────────────────────────────────

    public function selectDay(string $date): void
    {
        $this->selectedDate = ($this->selectedDate === $date) ? null : $date;

        // If day has no activities, open the create modal with date pre-filled
        if (empty($this->activitiesByDate[$date] ?? [])) {
            $this->openCreateModal();
            $this->form['activity_date'] = $date;
        }
    }

    // ─── Modal ────────────────────────────────────────────────────────────────

    public function openCreateModal(): void
    {
        $this->resetForm();
        $this->editingId = null;
        $this->showModal = true;
    }

    public function openEditModal(int $id): void
    {
        $activity = TrainingActivity::findOrFail($id);

        $this->form = [
            'title'             => $activity->title,
            'activity_date'    => Carbon::parse($activity->activity_date)->toDateString(),
            'activity_time'    => Carbon::parse($activity->activity_time)->format('H:i'),
            'training_batch_id' => $activity->training_batch_id,
        ];

        $this->editingId = $id;
        $this->showModal = true;
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->editingId = null;
        $this->resetForm();
        $this->resetValidation();
    }

    // ─── CRUD ─────────────────────────────────────────────────────────────────

    public function save(): void
    {
        $this->validate([
            'form.title'             => 'required|string|max:255',
            'form.activity_date'    => 'required|date',
            'form.activity_time'    => 'required',
            'form.training_batch_id' => 'required|integer|exists:training_batches,id',
        ]);

        $data = [
            'title'             => $this->form['title'],
            'activity_date'    => $this->form['activity_date'],
            'activity_time'    => Carbon::parse($this->form['activity_time'])->format('H:i'),
            'training_batch_id' => $this->form['training_batch_id'],
        ];

        if ($this->editingId) {
            TrainingActivity::findOrFail($this->editingId)->update($data);
            session()->flash('message', 'Activity updated successfully.');
        } else {
            TrainingActivity::create($data);
            session()->flash('message', 'Activity created successfully.');
        }

        // Navigate to the saved activity's month
        $date = Carbon::parse($this->form['activity_date']);
        $this->currentMonth = $date->month;
        $this->currentYear  = $date->year;
        $this->selectedDate = $date->toDateString();

        $this->closeModal();
    }

    public function deleteActivity(int $id): void
    {
        TrainingActivity::findOrFail($id)->delete();
        $this->selectedDate = null;
        session()->flash('message', 'Activity deleted.');
    }

    // ─── Helpers ──────────────────────────────────────────────────────────────

    private function resetForm(): void
    {
        $this->form = [
            'title'             => '',
            'activity_date'    => '',
            'activity_time'    => '',
            'training_batch_id' => '',
        ];
    }

    public function render()
    {
        return view('livewire.activity.calendar-activiy-livewire', [
            'monthName'          => $this->monthName(),
            'daysInMonth'        => $this->daysInMonth(),
            'firstDayOfMonth'    => $this->firstDayOfMonth(),
            'activitiesByDate'   => $this->activitiesByDate(),
            'monthActivityCount' => $this->monthActivityCount(),
        ]);
    }
}
