<?php

namespace Modules\CourseAdministration\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\CourseAdministration\Database\Factories\TrainingCenterCourseFactory;

class TrainingCenterCourse extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'training_course_id',
        'center_id',
        'is_active',
    ];

    // protected static function newFactory(): TrainingCenterCourseFactory
    // {
    //     // return TrainingCenterCourseFactory::new();
    // }
}
