<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::factory()->create([
            'name' => User::DEFAULT_USER_ROLE_NAME,
        ]);

        Role::factory()->create([
            'name' => User::DEFAULT_ADMIN_ROLE_NAME,
        ]);
    }
}
