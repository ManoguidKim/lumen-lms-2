<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\AdditionalUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;
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
        'employer_name',
        'is_trainer',
        'is_course_admin',
        'is_trainee',
        'is_director',
        'is_employer_company_user',
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
            'is_trainer' => 'boolean',
            'is_course_admin' => 'boolean',
            'is_trainee' => 'boolean',
            'is_director' => 'boolean',
            'is_employer_company_user' => 'boolean',
            'employer_name' => 'encrypted',
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
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }
}
