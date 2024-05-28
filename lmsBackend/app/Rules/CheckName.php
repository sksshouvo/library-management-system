<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckName implements ValidationRule
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
        $checkAuthor = $this->model::where("name", $value)->first();
        
        if ($checkAuthor && ($checkAuthor->id != $routeId)) {
            $fail('The given :attribute is already exist.');
        }
    }
}
