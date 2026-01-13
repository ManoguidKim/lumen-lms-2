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
        $this->call(
            [
                PermissionSeeder::class,
                RoleSeeder::class,
                UserSeeder::class,
            ]
        );
    }
}
