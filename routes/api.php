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

// All Products
Route::get('/',[ProductController::class, 'index']);

// Store Product Data
Route::post('/products', [ProductController::class, 'upload']);

// Update product
Route::put('/products/{product}', [ProductController::class, 'update']);

// Delete Produt
Route::delete('/products/{product}', [ProductController::class, 'destroy']);


// // Single product
// Route::get('/products/{product}', [ProductController::class, 'show']);

// Show Register/Create Form
Route::get('register', [UserController::class,'create'])->middleware('guest');

// Create New Users
Route::post('/users', [UserController::class, 'store']);

// Log User Out
Route::post('/logout', [UserController::class,'logout'])->middleware('auth');

// Show Login Form
Route::get('/login', [UserController::class,'login'])->middleware('guest')->name('login');

// Login User
Route::post('users/authenticate', [UserController::class,'authenticate']);
