<?php

namespace Modules\Institution\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Institution\Database\Factories\CenterFactory;

class Center extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): CenterFactory
    // {
    //     // return CenterFactory::new();
    // }
}
