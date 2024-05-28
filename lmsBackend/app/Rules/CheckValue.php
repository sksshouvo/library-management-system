<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckValue implements ValidationRule
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
        $checkValue = $this->model::where($attribute, $value)->where("id", "<>", $routeId)->first();

        if ($checkValue) {
            $fail("The {$attribute} already exist");
        }
    }
}
