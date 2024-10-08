<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookStoreController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CartController;

Route::resource('/books', BookStoreController::class);  


Route::get('/departments', [DepartmentController::class, 'index']);

Route::get('/departments/create', [DepartmentController::class, 'create']);

Route::post('/departments', [DepartmentController::class, 'store']);


Route::get('/authors', [AuthorController::class, 'index']);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/cart/{id}', [CartController::class, 'addToCart']);

Route::any('/cart', [CartController::class, 'showCart']);

Route::post('/cart/{id}', [CartController::class, 'dropitem']);


