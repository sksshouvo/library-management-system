<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class LoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                "name" => "Test User",
                "email_verified_at" => now(),
                "email" => "testuser@test.com",
                "password" => Hash::make("12345678"),
                "created_at" => now(),
                "updated_at" => now()
            ],[
                "name" => "Test Admin",
                "email_verified_at" => now(),
                "email" => "testadmin@test.com",
                "password" => Hash::make("12345678"),
                "created_at" => now(),
                "updated_at" => now()
            ],[
                "name" => "Test Moderator",
                "email_verified_at" => now(),
                "email" => "testmoderator@test.com",
                "password" => Hash::make("12345678"),
                "created_at" => now(),
                "updated_at" => now()
            ]
        ]);

        $users = User::all();
        foreach ($users as $key => $user) {
            if ($user->id == 1) {
                $user->addRole('admin');
            } else if ($user->id == 2) {
                $user->addRole('admin');
            } else if ($user->id == 3) {
                $user->addRole('moderator');
            }
        }
    }
}
