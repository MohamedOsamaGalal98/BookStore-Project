<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookStoreController;



Route::resource('/books', BookStoreController::class);  


//Route::get('/books/{id}', [BookStoreController::class, 'xxxx']);

//Route::get('/books/{id}/edit', [BookStoreController::class, 'edit']);
