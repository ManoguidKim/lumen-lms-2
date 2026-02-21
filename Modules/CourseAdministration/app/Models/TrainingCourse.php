<?php

namespace Modules\CourseAdministration\Models;

use App\Traits\AdditionalUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Institution\Models\Center;

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

    public function centers()
    {
        return $this->belongsToMany(Center::class, 'training_center_courses', 'training_course_id', 'center_id')
            ->withPivot('is_active')
            ->wherePivot('is_active', true)
            ->withTimestamps();
    }


    // protected static function newFactory(): TrainingCourseFactory
    // {
    //     // return TrainingCourseFactory::new();
    // }
}
