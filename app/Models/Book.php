<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Available_Discount;

class Book extends Model
{
    use HasFactory;  

     protected $fillable = [
        'title',
        'pages',
        'published_at',
        'department_id',
        'image',
    ];


    public function authors()
    {
        return $this->belongsToMany('App\Models\Author'); 
    }

    
    public function department()
    {
        return $this->belongsTo('App\Models\Department'); 
    }


    public function carts()
    {
        return $this->belongsToMany('App\Models\Cart'); 
    }


    //  public function applied_discounts()
    //  {
    //      return $this->belongsToMany('App\Models\Discount', 'applied_discounts'); 
    //  }

     public function discount()
     {
         return $this->belongsToMany('App\Models\Discount', 'book_discount'); 
     }


     public function getDiscountTextAttribute()
     {           
        // dd($this->discount->first());
         $discount = $this->discount->first();
         //dd($discount);
         if($discount == null) {
             return ' No Discount Available ';
         }  elseif ($discount->discount_type == 'percentage') {
             return $discount->value . ' %';
         } elseif ($discount->discount_type == 'fixed') {
             return $discount->value . ' EGY';
         }
     }
 
    
}



