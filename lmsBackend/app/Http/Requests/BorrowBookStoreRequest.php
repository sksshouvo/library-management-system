<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Rules\CheckCrossDate;
use App\Enums\Status;

class BorrowBookStoreRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "member_id" => ["required", $this->checkEntityForMember],
            "book_id" => ["required", $this->checkEntityForBook],
            "borrow_date" => ["required", "date_format:Y-m-d"],
            "return_date" => ["required", "date_format:Y-m-d", new CheckCrossDate($this->borrow_date)],
            "status" => ["required", Rule::enum(Status::class)],
        ];
    }

    
}
