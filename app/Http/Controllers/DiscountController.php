<?php

namespace App\Http\Controllers;
use Illuminate\Support\Carbon;

class DiscountController extends Controller
{
    public function checkDiscount($discount){
        if($discount == NULL){
         return [ 'status' => false, 'message' =>'Copon IS Not Exist'];
        } elseif(!$discount->books->isEmpty()){
         return [ 'status' => false, 'message' =>'Copon IS Not Available'];
        } elseif($discount->start_date >= Carbon::now() || $discount->end_date <= Carbon::now() ){
         return [ 'status' => false, 'message' =>'Copon IS Expired'];
        } else {
          return [ 'status' => true, 'message' =>'Copon Is Applied Successfully'];
        }
  }


}
