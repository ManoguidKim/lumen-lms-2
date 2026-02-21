<?php

namespace App\Livewire\PerformanceAdministration\Report;

use Livewire\Component;
use Modules\CourseAdministration\Models\TrainingBatch;
use Modules\CourseAdministration\Models\TrainingBatchStudent;
use Modules\PerformanceAdministration\Models\StudentBatchAttendance;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class StudentAttendanceReport extends Component
{
    public $trainingBatch     = null;
    public $trainingBatchUuid = null;

    public $students      = [];
    public $dateRange     = [];

    public $attendanceMap = [];

    public function mount($trainingBatchUuid)
    {
        $this->trainingBatchUuid = $trainingBatchUuid;
        $this->trainingBatch     = TrainingBatch::where('uuid', $trainingBatchUuid)->firstOrFail();

        $this->loadReport();
    }

    private function loadReport(): void
    {
        // 1. Build full date range from batch start → end
        $period = CarbonPeriod::create(
            Carbon::parse($this->trainingBatch->start_date),
            Carbon::parse($this->trainingBatch->end_date)
        );

        $this->dateRange = collect($period)
            ->map(fn($d) => $d->toDateString())
            ->toArray();

        // 2. Load enrolled students
        $this->students = TrainingBatchStudent::query()
            ->join('users', 'training_batch_students.user_id', '=', 'users.id')
            ->where('training_batch_students.training_batch_id', $this->trainingBatch->id)
            ->select(
                'training_batch_students.id as batch_student_id',
                'training_batch_students.user_id',
                'users.full_name_searchable as student_name',
            )
            ->get()
            ->toArray();

        // 3. Fetch all attendance records for these students
        $batchStudentIds = collect($this->students)->pluck('batch_student_id')->toArray();
        // dd($batchStudentIds);

        $attendances = StudentBatchAttendance::whereIn('training_batch_student_id', $batchStudentIds)
            ->get();

        // 4. Build attendanceMap — status resolved HERE in PHP, never in Blade
        $this->attendanceMap = [];

        foreach ($attendances as $att) {
            $date     = Carbon::parse($att->attendance_date)->toDateString();
            $checkIn  = $att->check_in_time  ? Carbon::parse($att->check_in_time)->format('g:i A')  : null;
            $checkOut = $att->check_out_time ? Carbon::parse($att->check_out_time)->format('g:i A') : null;

            $status = match (true) {
                $checkIn && $checkOut   => 'present',
                $checkIn || $checkOut   => 'partial',
                default                 => 'absent',
            };

            $this->attendanceMap[$att->training_batch_student_id][$date] = [
                'status'         => $status,
                'check_in_time'  => $checkIn,
                'check_out_time' => $checkOut,
            ];
        }

        // dd($this->attendanceMap); 
    }

    public function render()
    {
        return view('livewire.performance-administration.report.student-attendance-report');
    }
}
