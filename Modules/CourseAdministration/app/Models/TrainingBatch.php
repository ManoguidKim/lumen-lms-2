<?php

namespace Modules\CourseAdministration\Models;

use App\Traits\AdditionalUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

// use Modules\CourseAdministration\Database\Factories\TrainingBatchFactory;

class TrainingBatch extends Model
{
    use AdditionalUuid;
    use HasFactory;
    use LogsActivity;

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

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->fillable) // logs all fillable fields
            ->logOnlyDirty()           // only log what actually changed
            ->dontSubmitEmptyLogs()    // skip if nothing changed
            ->setDescriptionForEvent(fn(string $eventName) => "User was {$eventName}");
    }

    // protected static function newFactory(): TrainingBatchFactory
    // {
    //     // return TrainingBatchFactory::new();
    // }
}
