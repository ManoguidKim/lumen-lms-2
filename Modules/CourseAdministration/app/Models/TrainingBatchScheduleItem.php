<?php

namespace Modules\CourseAdministration\Models;

use App\Traits\AdditionalUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\CourseAdministration\Database\Factories\TrainingBatchScheduleItemFactory;

class TrainingBatchScheduleItem extends Model
{
    use AdditionalUuid;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'training_batch_id',
        'training_schedule_item_id',
        'session_title',
        'description',
        'session_type',
        'notes',
    ];

    // protected static function newFactory(): TrainingBatchScheduleItemFactory
    // {
    //     // return TrainingBatchScheduleItemFactory::new();
    // }
}
