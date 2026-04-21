<?php

namespace Modules\CourseAdministration\Models;

use App\Traits\AdditionalUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\CourseAdministration\Database\Factories\TrainingRequirementFactory;

class TrainingRequirement extends Model
{
    use AdditionalUuid;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'training_course_id',
        'requirement_name',
        'requirement_description',
    ];

    // protected static function newFactory(): TrainingRequirementFactory
    // {
    //     // return TrainingRequirementFactory::new();
    // }
}
