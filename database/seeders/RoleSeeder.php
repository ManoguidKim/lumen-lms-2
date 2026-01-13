<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        // Seed roles here
        $roleAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $permissions = [
            'User Admin',
            'Course Admin',
            'Center Admin',
            'Training Requirement Admin',
            'Batches Admin',
            'Student Batches Admin',
            'Schedule Admin',
            'Batch Schedule Admin',
            'Attendance Admin',
        ];
        $roleAdmin->givePermissionTo($permissions);

        $roles = ['Director', 'Student', 'Trainer', 'Course Admin'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
    }
}
