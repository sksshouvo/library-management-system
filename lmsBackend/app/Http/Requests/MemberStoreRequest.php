<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberStoreRequest extends FormRequest
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
            "first_name"        => ["required", "string"],
            "last_name"         => ["required", "string"],
            "phone_number"      => ["required", "phone:INTERNATIONAL", "unique:members"],
            "email"             => ["required", "email", "unique:members"],
            "registration_date" => ["required", "date_format:Y-m-d"]
        ];
    }
}
