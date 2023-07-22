<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BeerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\UserController;
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

Route::get('/{locale?}/beers', [BeerController::class, 'index'])->middleware('setLocale');

// Brands

Route::get('/{locale?}/brands', [BrandController::class, 'index'])->middleware('setLocale');
Route::get('/{locale?}/brands/{id}/', [BrandController::class, 'show'])->middleware('setLocale');

// Places

Route::get('/{locale?}/places', [PlaceController::class, 'index'])->middleware('setLocale');

// Auth

Route::post('/register', [UserController::class,  'store'])->middleware(['setLocale', 'guest']);

Route::post('/login', [LoginController::class, 'login'])->middleware(['setLocale', 'guest']);
