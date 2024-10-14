<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookStoreController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;

Route::resource('/books', BookStoreController::class)->middleware('auth:authors,web');

Route::get('/departments', [DepartmentController::class, 'index'])->middleware('auth:authors,web');  

Route::get('/departments/create', [DepartmentController::class, 'create'])->middleware('auth:authors,web');

Route::post('/departments', [DepartmentController::class, 'store'])->middleware('auth:authors,web');

Route::get('/authors', [AuthorController::class, 'index'])->middleware('auth:authors,web');  



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth:authors,web');



Route::get('/cart/{id}', [CartController::class, 'addToCart'])->middleware('auth:authors,web');  

Route::any('/cart', [CartController::class, 'showCart'])->middleware('auth:authors,web');  

Route::post('/cart/{id}', [CartController::class, 'dropitem'])->middleware('auth:authors,web');  

Route::post('/payment/{total_price}', [PaymentController::class, 'checkout'])->middleware('auth:authors,web');
Route::get('/paymentcallback', [PaymentController::class, 'paymentCallback']);
