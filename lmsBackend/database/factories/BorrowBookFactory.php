<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Member;
use App\Enums\Status;
use App\Models\Book;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BorrowBookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "member_id" => Member::inRandomOrder()->first()->id,
            "book_id" => Book::inRandomOrder()->first()->id,
            "borrow_date" => fake()->dateTimeThisMonth()->format('Y-m-d'),
            "return_date" => date('2024-06-d'),
            "status" => "BORROWED",
            "created_by" => User::inRandomOrder()->first()->id,
        ];
    }
}
