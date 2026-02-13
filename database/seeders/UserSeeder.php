<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $userAdmin = User::create([
            'name' => config('app.admin_first_name'),
            'last_name' => config('app.admin_last_name'),
            'email' => config('app.admin_email'),
            'uuid' =>  Str::orderedUuid(),
            'password' => Hash::make('password'), // Default password
            'email_verified_at' => now()
        ]);
        $userAdmin->assignRole('Super Admin');
    }
}
