<?php

namespace Modules\CourseAdministration\Models;

use App\Traits\AdditionalUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\CourseAdministration\Database\Factories\TrainingActivityFactory;

class TrainingActivity extends Model
{
    use AdditionalUuid;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'training_batch_id',
        'title',
        'activity_date',
        'activity_time',
    ];

    // protected static function newFactory(): TrainingActivityFactory
    // {
    //     // return TrainingActivityFactory::new();
    // }
}
