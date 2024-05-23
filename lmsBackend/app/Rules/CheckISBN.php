<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Book;

class CheckISBN implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $routeId = request()->segment(3);
        $checkBook = Book::isbnWiseFilter($value)->first();

        if ($checkBook && ($checkBook->id != $routeId)) {
            $fail("the {$attribute} already exist");
        }
    }
}
