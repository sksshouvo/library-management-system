<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Requests\Authentication\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Classes\ApiResponseClass;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct() {
        //
    }

    public function login(LoginRequest $request) : JsonResponse {
        if (Auth::attempt($request->validated())) {
            $user = Auth::user();
            $user->tokens()->delete();
            return $this->response(msg: __('user.logged_in'), data: $user, token: $user->createToken(config('sanctum.token_name'), ['*'], now()->addDay())->plainTextToken, code: 200, errors: NULL);
        }
        return $this->response( msg: __('user.invalid_credentials'), code: 422, data: NULL, errors: NULL, token: NULL);
    }
}
