<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

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
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/products/store', [ProductController::class, 'store']);
    Route::get('/products/show/{id}', [ProductController::class, 'show']);
    Route::post('/products/update/{id}', [ProductController::class, 'update']);
    Route::delete('/products/destroy/{id}', [ProductController::class, 'destroy']);

    Route::post('/logout', [UserController::class, 'logout']);
});

