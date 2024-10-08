<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\controller;

use Illuminate\Http\Request;
use App\Models\Book;

use App\Http\Requests\BookRequest;
use Illuminate\Support\Facades\Auth;

//return response()->json(['data' => $departments]);

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
          return response()->json(['data' => $books], 200); // Status code OK
          //return view('Books.index', compact('books'));
    }

    private function getBooksBySearch($request)
    {
          return Book::where('title', 'LIKE', '%' . $request->q . '%')->get();
    }


//     public function create()
//     {
//          $authors = Author::all();
//          return view('Books.create', compact('authors'));
//     }


    public function store(BookRequest $request)
    {
         $book  = Book::create($request->all());
         $book->authors()->sync($request->input('author_list'));

         $imageName = time().'.'.$request->image->extension();

         // Public Folder
         $request->image->move(public_path('images'), $imageName);
          $book->image=$imageName;
          $book->save();

          return response()->json(['data' => $book], 201); // Status code created

         //Session::flash('message', 'Your Book Has Been Created Successfully'); 
         //return redirect('books');
    }




    public function show($id)
    {
         Auth::user();
         $book = Book::findorfail($id);

         return response()->json(['data' => $book], 200); // Status code OK
         //return view('Books.show', compact('book'));

    }



//     public function edit($id)
//     {
//          $book = Book::findorfail($id);
//          $authors = Author::all();

//          //return response()->json(['data' => [ 'book' => $book,  'author' => $authors] ], 200); // Status code OK
//          //return view('Books.edit', compact('book', 'authors'));
//     }

   public function update(BookRequest $request, $id)
    {
         $book = Book::findorfail($id);
         $book->update($request->all());
         $book->authors()->sync($request->input('author_list'));

         if($request->has('image')){
         $imageName = time().'.'.$request->image->extension();
         $request->image->move(public_path('images'), $imageName);
          $book->image=$imageName;
         }
          $book->save();
          
          return response()->json(['message' => 'Success', 'data' => $book], 200); // Status code OK
          //Session::flash('message', 'Your Book Has Been Updated Successfully'); 
         //return redirect('books'); 
    }

  public function destroy($id)
    {
         $book = Book::findorfail($id);
         $book->delete();

         return response()->json(['message' => 'Success'], 200); // Status code OK
         //Session::flash('message','Your Book Has Been Deleted Successfully');
         //return redirect('books'); 
    }


}
