<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookStoreController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\CartController;

Route::resource('/books', BookStoreController::class)->except(['create', 'edit']);;  



Route::get('/departments', [DepartmentController::class, 'index']);
Route::post('/departments', [DepartmentController::class, 'store']);

Route::get('/authors', [AuthorController::class, 'index']);



//Route::get('/cart/{id}', [CartController::class, 'addToCart']);
Route::any('/cart', [CartController::class, 'showCart']);
Route::post('/cart/{id}', [CartController::class, 'dropitem']);

