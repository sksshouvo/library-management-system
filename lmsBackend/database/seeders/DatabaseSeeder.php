<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BorrowBook;
use App\Models\Author;
use App\Models\Member;
use App\Models\User;
use App\Models\Book;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LaratrustSeeder::class,
            LoginSeeder::class,
        ]);

        Author::factory()->count(10)->create();
        Book::factory()->count(100)->create();
        Member::factory()->count(10)->create();
        BorrowBook::factory()->count(100)->create();
    }
}
