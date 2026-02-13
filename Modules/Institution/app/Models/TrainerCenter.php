<?php

namespace Modules\Institution\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Institution\Database\Factories\TrainerCenterFactory;

class TrainerCenter extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'center_id',
        'trainer_id'
    ];

    // protected static function newFactory(): TrainerCenterFactory
    // {
    //     // return TrainerCenterFactory::new();
    // }
}
