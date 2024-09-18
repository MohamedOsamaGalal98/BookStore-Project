<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CartRequest;

use App\Models\Cart;
use App\Models\User;
use App\Models\Book_Cart;

use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{


    public function addToCart($id){
      
        if(Auth::user()->cart()->first() == null) {
            $cart = Auth::user()->cart()->create([]);
       }

        $cart = Auth::user()->cart;
        $cartbooks = $cart->items;

        if ($cartbooks->where('id', $id)->first() !=  null){
            $book = Book_Cart::where('book_id', $id)
            ->where('cart_id', ($cart->id),)
            ->first();

            $new_quantity = ($book->quantity) + 1;
            $book->update([
                "quantity" => $new_quantity,
                ]);
        } else{
            Book_Cart::create([
                "cart_id" => $cart->id,
                "book_id" => $id,
                "quantity" => '1',
                ]);
        }    
        return redirect('books'); 
  }



    public function showCart(){

        $cart = Auth::user()->cart;
        $cartitems = $cart->items;

        $cartbooks = Book_Cart::where('cart_id', ($cart->id))->get();

        return view('Cart.show', compact('cartbooks', 'cartitems'));

    }



    public function dropitem($id){

        $cart = Auth::user()->cart;
        $cartitems = $cart->items;

        $book = Book_Cart::where('book_id', $id)
        ->where('cart_id', ($cart->id),)
        ->first();

        if ($book->quantity == 1){
            $book->delete();
            Session::flash('message','Item Has Been Deleted Successfully');
        } else {
            $new_quantity = ($book->quantity) - 1;
            $book->update([
                "quantity" => $new_quantity,
                ]);
            Session::flash('message','Your Item Dropped Successfully');
        }

        return redirect('cart'); 

    }

}