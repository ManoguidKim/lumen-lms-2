<?php

namespace Modules\CourseAdministration\Models;

use App\Traits\AdditionalUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\CourseAdministration\Database\Factories\TrainingScheduleItemFactory;

class TrainingScheduleItem extends Model
{
    use AdditionalUuid;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'description',
        'schedule_days', // json array of days
        'start_time', // date
        'end_time', // date
    ];

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
