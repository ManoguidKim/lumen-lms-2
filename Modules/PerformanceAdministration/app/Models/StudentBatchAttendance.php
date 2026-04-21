<?php

namespace Modules\PerformanceAdministration\Models;

use App\Traits\AdditionalUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\PerformanceAdministration\Database\Factories\StudentBatchAttendanceFactory;

class StudentBatchAttendance extends Model
{
    use AdditionalUuid;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'training_batch_student_id',
        'training_batch_schedule_item_id',
        'attendance_date',
        'first_check_in_time',
        'first_check_out_time',
        'second_check_in_time',
        'second_check_out_time',
    ];

    // protected static function newFactory(): StudentBatchAttendanceFactory
    // {
    //     // return StudentBatchAttendanceFactory::new();
    // }
}
