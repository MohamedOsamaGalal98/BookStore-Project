<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppliedDiscountsCarts extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_name',
        'user_email',
        'PaymentId',
        'general_cart_discount',
        'books_data_with_specific_cart_discount',
    ];

    protected $casts = [
        'general_cart_discount' => 'json',
        'books_data_with_specific_cart_discount' => 'json',
    ];
}
