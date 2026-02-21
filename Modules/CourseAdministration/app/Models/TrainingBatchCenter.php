<?php

namespace Modules\CourseAdministration\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\CourseAdministration\Database\Factories\TrainingBatchCenterFactory;

class TrainingBatchCenter extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): TrainingBatchCenterFactory
    // {
    //     // return TrainingBatchCenterFactory::new();
    // }
}
