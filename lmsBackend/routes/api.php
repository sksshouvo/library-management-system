<?php

use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\BorrowBookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::fallback(function () {
    $response = [
        'message' => __('common.invalid_endpoint'),
        'errors' => NULL,
        'result' => NULL,
        'token' => NULL
    ];
    return response()->json($response, 403);
});

Route::group(['prefix' => 'authentication'], function() {
    Route::post("login", [LoginController::class, 'login'])->name('auth.login');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('book', BookController::class)->names('book');
    Route::apiResource('author', AuthorController::class)->names('author');
    Route::apiResource('member', MemberController::class)->names('member');
    Route::apiResource('borrow-book', BorrowBookController::class)->names('borrow.book');
});

