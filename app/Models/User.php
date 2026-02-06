<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserTypeEnum;
use App\Traits\AdditionalUuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable, HasRoles;
    use AdditionalUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'middle_name',
        'extension',
        'email',
        'password',
        'learner_id',

        // Other user details for learners
        'uli',
        'picture_path',

        'school_name',
        'school_address',

        'client_type',

        'address_number_street',
        'address_barangay',
        'address_city',
        'address_district',
        'address_province',
        'address_region',
        'address_zip_code',

        'mother_name',
        'father_name',

        'sex',
        'civil_status',
        'birth_date',
        'birth_place',

        'contact_tel',
        'contact_mobile',
        'contact_email',
        'contact_fax',
        'contact_others',

        'educational_attainment',
        'educational_attainment_others',

        'employment_status',

        'registration_type',

        'work_experiences',
        'trainings',
        'licensure_examination',
        'competency_assessment',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'name' => 'encrypted',
            'last_name' => 'encrypted',
            'middle_name' => 'encrypted',
            'extension' => 'encrypted',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            // Other casts details
            'work_experiences' => 'array',
            'trainings' => 'array',
            'licensure_examination' => 'array',
            'competency_assessment' => 'array',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn($word) => Str::substr($word, 0, 1))
            ->implode('');
    }
}
