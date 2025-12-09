<?php

namespace Modules\PerformanceAdministration\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\PerformanceAdministration\Database\Factories\StudentBatchAttendanceFactory;

class StudentBatchAttendance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): StudentBatchAttendanceFactory
    // {
    //     // return StudentBatchAttendanceFactory::new();
    // }
}
