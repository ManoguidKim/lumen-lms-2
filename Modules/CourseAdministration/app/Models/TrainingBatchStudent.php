<?php

namespace Modules\CourseAdministration\Models;

use App\Traits\AdditionalUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\CourseAdministration\Database\Factories\TrainingBatchStudentFactory;

class TrainingBatchStudent extends Model
{
    use AdditionalUuid;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'training_batch_id',
        'user_id',
        'enrollment_date',
        'enrollment_status',
    ];

    // protected static function newFactory(): TrainingBatchStudentFactory
    // {
    //     // return TrainingBatchStudentFactory::new();
    // }
}
