<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Author;
use App\Models\Book;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title"        => fake()->sentence(3),                            // Generates a title with 3 words
            "published_at" => fake()->dateTimeThisMonth()->format('Y-m-d'),
            "ISBN"         => fake()->isbn13(),                               // Generates a valid 13-digit ISBN number
            "total_copies" => fake()->numberBetween(1, 100),                  // Generates a random number between 1 and 100
            "author_id"    => Author::inRandomOrder()->first()->id,           // Assumes an Author factory exists
            "created_by"   => User::inRandomOrder()->first()->id,             // Selects a random existing user ID
        ];
    }
}
