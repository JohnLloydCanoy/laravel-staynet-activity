<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create the ADMIN User
        User::factory()->create([
            'name' => 'System Admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        // 2. Create the STAFF User
        User::factory()->create([
            'name' => 'Staff Member',
            'email' => 'staff@example.com',
            'role' => 'staff',
        ]);

        // 3. Create the REGULAR User
        User::factory()->create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'role' => 'user',
        ]);

        // Generate 15 random users (they will default to 'user' role)
        User::factory(15)->create();

        // Generate 20 fake customers
        Customer::factory(20)->create();
    }
}