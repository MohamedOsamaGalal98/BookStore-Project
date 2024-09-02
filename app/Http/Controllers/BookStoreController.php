<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Requests\BookRequest;
use Session;

class BookStoreController extends Controller
{


    public function index()
    {
         $books = Book::all();
         //dd($books);
         return view('Books.index', compact('books'));
    }


    public function create()
    {
         return view('Books.create');
    }



    public function store(BookRequest $request)
    {
        //dd($request->all());
         $books = Book::create($request->all());
         //dd($books);
         Session::flash('message', 'Your Book Has Been Created Successfully'); 
         return redirect('books');
    }




    public function show($id)
    {
         $book = Book::findorfail($id);
         //dd($book);
         return view('Books.show', compact('book'));

    }



    public function edit($id)
    {
         $book = Book::findorfail($id);
         //dd($book);
         return view('Books.edit', compact('book'));
    }


   public function update(BookRequest $request, $id)
    {
         $book = Book::findorfail($id);
         $book->update($request->all());
         //dd($book);
         Session::flash('message', 'Your Book Has Been Updated Successfully'); 
         return redirect('books'); 
    }


  public function destroy($id)
    {
         $book = Book::findorfail($id);
         $book->delete();
          Session::flash('message','Your Book Has Been Deleted Successfully');
         return redirect('books'); 
    }


}
