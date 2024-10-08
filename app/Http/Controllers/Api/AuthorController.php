<?php


namespace App\Http\Controllers\Api;
use App\Http\Controllers\controller;

use App\Models\Author;

class AuthorController extends Controller
{
    

    public function index()
    {
        $authors =  Author::whereHas('books')->withCount('books')->get();

        return response()->json(['data' => $authors], 200); // Status code OK
        //return view('Authors.index', compact('authors'));

    }



}
    