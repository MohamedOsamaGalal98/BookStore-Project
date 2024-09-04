<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    

    public function index()
    {
        $authors =  Author::whereHas('books')->withCount('books')->get();

        //dd($authors);
        //  function($query) {$query->where('title','!=','PHP');}

         return view('Authors.index', compact('authors'));

    
    
        }



}
    