<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookStoreController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AuthorController;



Route::resource('/books', BookStoreController::class);  


//Route::get('/books/{id}', [BookStoreController::class, 'xxxx']);

//Route::get('/books/{id}/edit', [BookStoreController::class, 'edit']);


Route::get('/departments', [DepartmentController::class, 'index']);

Route::get('/departments/create', [DepartmentController::class, 'create']);

Route::post('/departments', [DepartmentController::class, 'store']);


Route::get('/authors', [AuthorController::class, 'index']);


//Route::resource('/departments', DepartmentController::class);  


