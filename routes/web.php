<?php

use App\Http\Controllers\Api\V1\BestSellerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('api/v1/')->group(function () {
    Route::prefix('bestsellers')->name('bestsellers.')->group(function () {
        Route::get('/', [BestSellerController::class, 'index'])->name('index');
    });
});
