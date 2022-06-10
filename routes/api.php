<?php

use App\Http\Controllers\HeroController;
use App\Http\Controllers\StrongOpponentController;
use App\Http\Controllers\WeakOpponentController;
// use App\Http\Controllers\HeroPositionController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('heroes', HeroController::class);
Route::apiResource('strong-opponent', StrongOpponentController::class);
Route::apiResource('weak-opponent', WeakOpponentController::class);
// Route::apiResource('hero-positions', HeroPositionController::class);

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
