<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostmangApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::prefix('api-test')->group(function () {
//     Route::get('/weather', [PostmangApiController::class, 'index'])->name('api.weather.index');
//     Route::post('/weather', [PostmangApiController::class, 'store'])->name('api.weather.store');
// });

Route::get('/weather', [PostmangApiController::class, 'index']);
Route::post('/weather', [PostmangApiController::class, 'store']);
