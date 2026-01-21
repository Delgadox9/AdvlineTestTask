<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'password' => Hash::make('Admin'),
            'email' => 'admin@example.com',
            'role_id' => Role::where('name', User::DEFAULT_ADMIN_ROLE_NAME)->first()->id,
        ]);

        User::factory()->create([
            'name' => 'User',
            'password' => Hash::make('User'),
            'email' => 'user@example.com',
            'role_id' => Role::where('name', User::DEFAULT_USER_ROLE_NAME)->first()->id,
        ]);
    }
}
