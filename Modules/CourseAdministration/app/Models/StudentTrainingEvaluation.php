<?php

namespace Modules\CourseAdministration\Models;

use App\Traits\AdditionalUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\CourseAdministration\Database\Factories\StudentTrainingEvaluationFactory;

class StudentTrainingEvaluation extends Model
{
    use AdditionalUuid;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'training_batch_id',
        'training_requirement_id',
        'user_id',
        'rating',
        'remarks',
        'evaluated_by',
        'evaluated_at',
    ];

    // protected static function newFactory(): StudentTrainingEvaluationFactory
    // {
    //     // return StudentTrainingEvaluationFactory::new();
    // }
}
