<?php

namespace Modules\CourseAdministration\Models;

use App\Traits\AdditionalUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\CourseAdministration\Database\Factories\TrainingBatchFactory;

class TrainingBatch extends Model
{
    use AdditionalUuid;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'training_course_id',
        'batch_code',
        'batch_name',
        'start_date',
        'end_date',
        'max_participants',
        'status',
        'trainer_id',
        'notes',
        'training_schedule_item_id',
        'center_id',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // protected static function newFactory(): TrainingBatchFactory
    // {
    //     // return TrainingBatchFactory::new();
    // }
}
