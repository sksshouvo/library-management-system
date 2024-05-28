<?php

namespace App\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Rules\CheckEntity;
use App\Models\Author;

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
            "ISBN"         => ["required", "numeric", "min:13", "unique:books"],
            "total_copies" => ["required", "numeric"],
            "author_id"    => ["required", "numeric", new CheckEntity(Author::class)],
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    
    protected function failedValidation(Validator $validator)
    {
        $response = [
            'message' => 'The given data was invalid.',
            'errors' => $validator->errors(),
            'result' => NULL,
            'token' => request()->bearerToken()
        ];

        throw new HttpResponseException(response()->json($response, 422));
    }
}
