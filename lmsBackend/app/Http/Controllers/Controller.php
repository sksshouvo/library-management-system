<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

abstract class Controller
{
    public function response(string | null $msg, array | null $errors, object | null $data, string | null $token, int $code) : JsonResponse {

        return response()->json([
            "message" => $msg,
            "errors" => $errors,
            "data" => $data,
            "token" => $token
        ], $code);
    }
}
