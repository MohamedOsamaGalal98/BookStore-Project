<?php

namespace App\Http\Controllers;

use App\Models\Author;

class AuthorController extends Controller
{
    

    public function index()
    {
        $authors =  Author::whereHas('books')->withCount('books')->get();

         return view('Authors.index', compact('authors'));

    
    
        }



}
    