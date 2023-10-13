<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'id' => 1,
                'name' => 'Admin',
            ],
            [
                'id' => 2,
                'name' => 'User',
            ],
        ];

        Role::insert($roles);

    }
}