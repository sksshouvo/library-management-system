<?php

use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\BorrowBookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::group(['prefix' => 'authentication'], function() {
    Route::get("login", [LoginController::class, 'login'])->name('auth.login');
});

Route::apiResource('book', BookController::class)->names('book');
Route::apiResource('author', AuthorController::class)->names('author');
Route::apiResource('member', AuthorController::class)->names('member');
