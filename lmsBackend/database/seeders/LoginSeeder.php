<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class LoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "name" => "Test User",
            "email_verified_at" => now(),
            "email" => "testuser@test.com",
            "password" => "12345678",
            "created_at" => now(),
            "updated_at" => now()
        ]);
    }
}
