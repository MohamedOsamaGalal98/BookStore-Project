<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applied_Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'discount_id',
        'user_id',
        'book_id',
    ];

}
