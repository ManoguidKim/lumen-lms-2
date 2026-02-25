<?php

namespace Modules\CourseAdministration\Models;

use App\Traits\AdditionalUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

// use Modules\CourseAdministration\Database\Factories\TrainingBatchScheduleItemFactory;

class TrainingBatchScheduleItem extends Model
{
    use AdditionalUuid;
    use HasFactory;
    use LogsActivity;

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

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->fillable) // logs all fillable fields
            ->logOnlyDirty()           // only log what actually changed
            ->dontSubmitEmptyLogs()    // skip if nothing changed
            ->setDescriptionForEvent(fn(string $eventName) => "User was {$eventName}");
    }

    // protected static function newFactory(): TrainingBatchScheduleItemFactory
    // {
    //     // return TrainingBatchScheduleItemFactory::new();
    // }
}
