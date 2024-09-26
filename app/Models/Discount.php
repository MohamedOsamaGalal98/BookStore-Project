<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;


    protected $fillable = [
            'code',
            'discount_type',
            'value',
            'limit',
            'start_date',
            'end_date',
        ];


    public function user_discounts()
    {
        return $this->belongsToMany('App\Models\User'); 
    }


    // public function book_discounts()
    // {
    //     return $this->belongsToMany('App\Models\Book'); 
    // }


    public function books()
    {
        return $this->belongsToMany('App\Models\Book' , 'book_discount'); 
    }

}
