<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\UserTypeEnum;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $google2fa = app(Google2FA::class); 

        User::factory()->withoutTwoFactor()->create([
            'name' => config('app.admin_first_name'),
            'last_name' => config('app.admin_last_name'),
            'email' => config('app.admin_email'),
            'user_type' => UserTypeEnum::INSTITUTIONAL_USER,
            'is_super_admin' => true,                
            'uuid' =>  Str::orderedUuid(),            
            // 'two_factor_secret' => encrypt($google2fa->generateSecretKey()), // Encrypt the secret
            // 'two_factor_recovery_codes' => encrypt(json_encode(collect(range(0, 8))->map(function () {
            //     return str_replace('-', '', fake()->uuid());
            // })->all())), 

            'password' => Hash::make('password'), // Default password
        ]);
    }
}
