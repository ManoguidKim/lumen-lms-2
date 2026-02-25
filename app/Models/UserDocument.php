<?php

namespace App\Models;

use App\Traits\AdditionalUuid;
use Illuminate\Database\Eloquent\Model;

class UserDocument extends Model
{
    use AdditionalUuid;

    protected $fillable = [
        'user_id',
        'type',
        'file',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
