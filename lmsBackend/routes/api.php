<?php

use App\Http\Controllers\BidRequestController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\Authentication\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::apiResource('campaign', CampaignController::class);
Route::post('bid-request', [BidRequestController::class, 'compareWithCampaign']);

Route::group(['prefix' => 'authentication'], function() {
    Route::get("login", [LoginController::class, 'login'])->name('auth.login');
});
