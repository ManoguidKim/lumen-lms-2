<?php

namespace Modules\Institution\Models;

use App\Traits\AdditionalUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

// use Modules\Institution\Database\Factories\CenterFactory;

class Center extends Model
{
    use AdditionalUuid;
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'short_name',
        'code',
        'type',
        'address',
        'contact_number',
        'contact_mobile',
        'contact_landline',
        'email',
        'status',
        'logo_path',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Accessor for logo URL
    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo_path ? Storage::disk('public')->url($this->logo_path) : null;
    }
}
