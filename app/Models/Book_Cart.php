<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book_Cart extends Model
{
    use HasFactory;

    protected $table = 'book_cart';
    
    protected $fillable = [
        'cart_id',
        'book_id',
        'quantity',
    ];  
}
