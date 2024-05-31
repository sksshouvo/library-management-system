<?php

namespace App\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CheckEntity;
use App\Models\BorrowBook;
use App\Rules\CheckValue;
use App\Rules\CheckPhone;
use App\Rules\CheckISBN;
use App\Rules\CheckName;
use App\Models\Author;
use App\Models\Member;
use App\Models\Book;

class BaseRequest extends FormRequest
{

    public function __construct() {
        $this->checkEntityForBook = new CheckEntity(Book::class);
        $this->checkEntityForMember = new CheckEntity(Member::class);
        $this->checkEntityForAuthor = new CheckEntity(Author::class);
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
