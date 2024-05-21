<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
class BookStoreRequest extends FormRequest
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
            "title"        => ["required", "string"],
            "published_at" => ["required", "date_format:Y-m-d"],
            "ISBN"         => ["required", "numeric", "min:13"],
            "total_copies" => ["required", "numeric"],
            "author_id"    => ["required", "numeric"],
        ];
    }
}
