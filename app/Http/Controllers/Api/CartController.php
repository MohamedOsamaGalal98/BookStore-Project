<?php


namespace App\Http\Controllers\Api;
use App\Http\Controllers\controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Discount;

class CartController extends Controller
{
    private DiscountController $discountController;
    
    public function __construct(DiscountController  $discountController)
    {
        $this->discountController = $discountController;
    }
    
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
        return response()->json(['message' => 'Success'], 200); // Status code OK
        //return redirect('books'); 
  }



    public function showCart(Request $request)
    {

        $cartitems = Auth::user()->cart->items;
        $item_price = 0;
        $total_price = 0;

        $cartitems->each(function($item) use (&$total_quantity, &$item_price, &$total_price){
            $item_price = $this->getTotalPrice($item->discount->first(), $item->price);
            $total_price += $item->pivot->quantity * $item_price;
            $total_quantity += $item->pivot->quantity;
        });

        $discount = null;
        if($request->has('copon')) {
            $discount = Discount::where("code", $request->copon)->first();

            $checkDiscount = $this->discountController->checkDiscount($discount);
            Session::flash('message', $checkDiscount['message']);

            if($checkDiscount['status']) {
                $total_price = $this->getTotalPrice($discount, $total_price);
            }
        } 

        return response()->json([ 'data' => ['cartitems' => $cartitems,
                                             'total_price' => $total_price, 
                                             'total_quantity' => $total_quantity, 
                                             'discount' => $discount,
                                             ]   
                                ], 200); // Status code OK

        //return view('Cart.show', compact('cartitems', 'total_price', 'total_quantity', 'discount'));

    }

    public function getTotalPrice($discount, $total_price)
    {
    //dd($discount);
         if((isset($discount) && $discount->discount_type == 'percentage')) {
             $total_price =  ($total_price  - ($total_price *  $discount->value/100)) ;
         }elseif(isset($discount) &&  $discount->discount_type == 'fixed') {
            //dd('aaaa');
             $total_price =  ($total_price  - $discount->value) ;
         } else {
             $total_price =  $total_price;
         }
        // dd($total_price);
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

        return response()->json(['message' => 'Success'], 200); // Status code OK
        //return redirect('cart'); 
    }

}