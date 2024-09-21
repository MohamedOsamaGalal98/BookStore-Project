<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart($id){
      
        $cart = Auth::user()->cart;

        if(!$cart) {
            $cart = Auth::user()->cart()->create([]);
       }
       
        $existsBook = $cart->items->where('id', $id)->first();

        if ($existsBook){
            $existsBook->pivot->update(["quantity" => ++$existsBook->pivot->quantity]);
        } else{
            $cart->items()->attach($id);
        }    
        return redirect('books'); 
  }



    public function showCart(){

        $cartitems = Auth::user()->cart->items;
        $total_quantity = 0;

        $cartitems->each(function($item) use (&$total_quantity, &$total_price){
            $discount = $item->discount;
            $total_price = $this->getTotalPrice($discount, $item);
            $total_quantity += $item->pivot->quantity;
        });

        return view('Cart.show', compact('cartitems', 'total_price', 'total_quantity'));

    }

    public function getTotalPrice($discount, $item)
    {
        $total_price = 0;

        if((isset($discount) && $discount->type == 'percentage')) {
            $total_price += $item->pivot->quantity * ($item->price  - ($item->price *  $discount->value/100)) ;
        }elseif(isset($discount) &&  $discount->type == 'numeric') {
            $total_price += $item->pivot->quantity * ($item->price  - $discount->value) ;
        } else {
            $total_price += $item->pivot->quantity * $item->price;
        }
        return $total_price;
    }

    public function dropitem($id){

        $book = Auth::user()->cart->items()->where('book_id', $id)->first();

        if ($book->pivot->quantity == 1){
            Auth::user()->cart->items()->detach($book->id);
            Session::flash('message','Item Has Been Deleted Successfully');
        } else {
            $book->pivot->update(["quantity" => --$book->pivot->quantity]);
            Session::flash('message','Your Item Dropped Successfully');
        }

        return redirect('cart'); 
    }

}