<?php

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

// Beers

Route::get('/{locale?}/beers', [BeerController::class, 'index'])->middleware('setLocale');

// Brands

Route::get('/{locale?}/brands', [BrandController::class, 'index'])->middleware('setLocale');
Route::get('/{locale?}/brands/{id}/', [BrandController::class, 'show'])->middleware('setLocale');

// Places

Route::get('/{locale?}/places', [PlaceController::class, 'index'])->middleware('setLocale');
