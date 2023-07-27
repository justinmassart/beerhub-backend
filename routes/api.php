<?php

use App\Http\Controllers\API\SessionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BeerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\PlaceController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

// Home

Route::get('/', [HomeController::class, 'index'])->middleware('setLocale');
Route::get('/{locale?}/', [HomeController::class, 'index'])->middleware('setLocale');

// Beers

Route::get('/{locale?}/beers', [BeerController::class, 'index'])->middleware(['auth:sanctum', 'setLocale']);

// Brands

Route::get('/{locale?}/brands', [BrandController::class, 'index'])->middleware('setLocale');
Route::get('/{locale?}/brands/{id}/', [BrandController::class, 'show'])->middleware('setLocale');

// Places

Route::get('/{locale?}/places', [PlaceController::class, 'index'])->middleware('setLocale');

// Auth

Route::post('/register', [SessionController::class,  'register'])->middleware(['setLocale', 'guest']);

Route::post('/login', [SessionController::class, 'login'])->middleware(['setLocale', 'guest']);

Route::post('/logout', [SessionController::class, 'logout'])->middleware('auth');
