<?php

namespace Modules\CourseAdministration\Models;

use App\Traits\AdditionalUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\CourseAdministration\Database\Factories\TrainingCourseFactory;

class TrainingCourse extends Model
{
    use AdditionalUuid;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'course_code',
        'course_name',
        'description',
        'duration_hours',
        'status',
        'is_tesda_course',
        'tr_number',
    ];

    // protected static function newFactory(): TrainingCourseFactory
    // {
    //     // return TrainingCourseFactory::new();
    // }
}
