<?php

namespace Modules\CourseAdministration\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\CourseAdministration\Database\Factories\TrainingBatchScheduleItemFactory;

class TrainingBatchScheduleItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): TrainingBatchScheduleItemFactory
    // {
    //     // return TrainingBatchScheduleItemFactory::new();
    // }
}
