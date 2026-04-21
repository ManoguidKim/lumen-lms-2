<?php

namespace Modules\PerformanceAdministration\Models;

use App\Traits\AdditionalUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\PerformanceAdministration\Database\Factories\StudentTrainingBatchTardinessRecordFactory;

class StudentTrainingBatchTardinessRecord extends Model
{
    use AdditionalUuid;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'training_batch_id',
        'user_id',
        'tardiness_date',
        'expected_check_in_time',
        'actual_check_in_time',
        'minutes_late',
        'severity',
        'remarks'
    ];

    // protected static function newFactory(): StudentTrainingBatchTardinessRecordFactory
    // {
    //     // return StudentTrainingBatchTardinessRecordFactory::new();
    // }
}
