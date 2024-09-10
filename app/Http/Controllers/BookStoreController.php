<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\Cart;
use App\Models\User;

use App\Http\Requests\BookRequest;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BookStoreController extends Controller
{
    public function index(Request $request)
    {    

     if(isset($request->q)){
               $books = $this->getBooksBySearch($request);
     }
     else{
               if(isset($request->department)) {
                    $books = Book::where('department_id' , $request->department)->get();

               } else {
                    $books = Book::all();  
               }          
          }
          return view('Books.index', compact('books'));

    }

    private function getBooksBySearch($request)
    {
          return Book::where('title', 'LIKE', '%' . $request->q . '%')->get();
    }


    public function create()
    {
         $authors = Author::all();
         return view('Books.create', compact('authors'));
    }


    public function store(BookRequest $request)
    {
         //dd($request->all());
         $book  = Book::create($request->all());
         $book->authors()->sync($request->input('author_list'));
         //dd($book->department()->save($request->department));
//dd($request->image);
         $imageName = time().'.'.$request->image->extension();

         // Public Folder
         $request->image->move(public_path('images'), $imageName);
          $book->image=$imageName;
          $book->save();

        // dd($book->authors);
         Session::flash('message', 'Your Book Has Been Created Successfully'); 
         return redirect('books');
    }




    public function show($id)
    {
     Auth::user();
         $book = Book::findorfail($id);

         //dd($book);
         return view('Books.show', compact('book'));

    }



    public function edit($id)
    {
         $book = Book::findorfail($id);
         $authors = Author::all();
         //dd($book);
         return view('Books.edit', compact('book', 'authors'));
    }

   public function update(BookRequest $request, $id)
    {
         $book = Book::findorfail($id);
         $book->update($request->all());
         $book->authors()->sync($request->input('author_list'));

         $imageName = time().'.'.$request->image->extension();
         $request->image->move(public_path('images'), $imageName);
          $book->image=$imageName;
          $book->save();
          
         //dd($book);
         Session::flash('message', 'Your Book Has Been Updated Successfully'); 
         return redirect('books'); 
    }

  public function destroy($id)
    {
         $book = Book::findorcr($id);
         $book->delete();
         Session::flash('message','Your Book Has Been Deleted Successfully');
         return redirect('books'); 
    }


    public function addToCart($id){
     
          if(Auth::user()->cart()->first() == null) {
                $cart = Auth::user()->cart()->create([]);
         }

          $cart = Auth::user()->cart;
          $cart->items()->sync([
               "book_id" => $id,
          ], false);

    }
}
