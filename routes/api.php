<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookStoreController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\PaymentController;

Route::post('/login', [LoginController::class, 'login']);


Route::resource('/books', BookStoreController::class)->except(['create', 'edit'])->middleware('auth:sanctum'); 

Route::get('/departments', [DepartmentController::class, 'index'])->middleware('auth:sanctum'); 
Route::post('/departments', [DepartmentController::class, 'store'])->middleware('auth:sanctum'); 

Route::get('/authors', [AuthorController::class, 'index'])->middleware('auth:sanctum'); 

Route::post('/cart', [CartController::class, 'addToCart'])->middleware('auth:sanctum'); 
Route::get('/cart', [CartController::class, 'showCart'])->middleware('auth:sanctum'); 
Route::delete('/cart', [CartController::class, 'dropitem'])->middleware('auth:sanctum'); 

Route::post('/payment', [PaymentController::class, 'checkout'])->middleware('auth:sanctum'); 
Route::get('/paymentcallback', [PaymentController::class, 'paymentCallback']);
