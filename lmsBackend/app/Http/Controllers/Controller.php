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

    function successResponse(string | null $msg, object | null $data, string | null $token, int $code = 200) : JsonResponse {
        return response()->json([
            "message" => $msg,
            "errors" => NULL,
            "data" => $data,
            "token" => $token
        ], $code);
    }

    function errorResponse(string | null $msg, $errors, string | null $token, int $code = 500) : JsonResponse {
        return response()->json([
            "message" => $msg,
            "errors" => $errors,
            "data" => NULL,
            "token" => $token
        ], $code);
    }
}
