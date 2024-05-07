<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Employee;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'firstname' => 'Test User',
            'email' => 'user@gmail.com',
            'password' => 'password',
        ]);
        Admin::create([
            'firstname' => 'Test User',
            'email' => 'admin@gmail.com',
            'password' => 'password',
        ]);
        Employee::create([
            'firstname' => 'Test User',
            'email' => 'employee@gmail.com',
            'password' => 'password',
        ]);
    }
}
