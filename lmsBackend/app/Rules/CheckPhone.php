<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckPhone implements ValidationRule
{
    public function __construct(public $model){
        
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {   
        $routeId = request()->segment(3);
        $checkPhone = $this->model::phoneNumberWiseFilter($value)->first();

        if ($checkPhone && ($checkPhone->id != $routeId)) {
            $fail("The {$attribute} already exist");
        }
    }
}
