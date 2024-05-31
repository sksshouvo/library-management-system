<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckCrossDate implements ValidationRule
{
    public function __construct(public $borrowDate){
        
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $this->borrowDate = strtotime($this->borrowDate);
        $returnDate = strtotime($value);

        if ($this->borrowDate > $returnDate) {
            $fail("The given {$attribute} must be greater than Borrow date.");
        }
    }
}
