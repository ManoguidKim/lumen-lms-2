<?php

namespace Modules\CourseAdministration\Models;

use App\Traits\AdditionalUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

// use Modules\CourseAdministration\Database\Factories\LearnerTrainingApplicationFactory;

class LearnerTrainingApplication extends Model
{
    use AdditionalUuid;
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'center_id',
        'training_course_id',
        'training_batch_id',
        'application_number',
        'application_date',
        'status',
        'reviewed_by',
        'reviewed_at',
        'review_remarks',
        'learner_remarks',
    ];

    protected $casts = [
        'application_date' => 'date',
        'reviewed_at' => 'datetime',
    ];
}
