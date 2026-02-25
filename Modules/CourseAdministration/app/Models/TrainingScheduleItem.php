<?php

namespace Modules\CourseAdministration\Models;

use App\Traits\AdditionalUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

// use Modules\CourseAdministration\Database\Factories\TrainingScheduleItemFactory;

class TrainingScheduleItem extends Model
{
    use AdditionalUuid;
    use HasFactory;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'description',
        'schedule_days', // json array of days
        'start_time', // date
        'end_time', // date
        'center_id', // foreign key to centers table
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->fillable) // logs all fillable fields
            ->logOnlyDirty()           // only log what actually changed
            ->dontSubmitEmptyLogs()    // skip if nothing changed
            ->setDescriptionForEvent(fn(string $eventName) => "User was {$eventName}");
    }

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'schedule_days' => 'array',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
    ];

    // protected static function newFactory(): TrainingScheduleItemFactory
    // {
    //     // return TrainingScheduleItemFactory::new();
    // }
}
