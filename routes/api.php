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

// Home

Route::get('/', [HomeController::class, 'index']);
Route::get('/{locale?}/', [HomeController::class, 'index']);

// Beers

Route::get('/{locale?}/beers', [BeerController::class, 'index']);
Route::post('/beers/store', [BeerController::class, 'store'])->middleware('api.user');

// Brands

Route::get('/{locale?}/brands', [BrandController::class, 'index'])->name('brands');
Route::get('/{locale?}/brands/{id}/', [BrandController::class, 'show'])->name('brand');

// Places

Route::get('/{locale?}/places', [PlaceController::class, 'index']);

// Auth

Route::post('/register', [SessionController::class,  'register'])->middleware('guest');

Route::post('/login', [SessionController::class, 'login'])->middleware('guest');

Route::post('/logout', [SessionController::class, 'logout'])->middleware('api.user');

Route::post('/verify', [SessionController::class, 'verifyPhone'])->middleware('guest');

// Add a beer inputs

Route::get('/inputs/brand-selector', [BrandController::class, 'input'])->name('brand-selector');
