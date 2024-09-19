<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;


    protected $fillable = [
        'type',
        'value',
    ];

    

    public function general_user_discount()
    {
        return $this->hasMany('App\Models\User'); 
    }


    public function discount()
    {
        return $this->hasMany('App\Models\Book'); 
    }


    public function specific_user_discount()
    {
        return $this->belongsToMany('App\Models\User'); 
    }


    public function specific_book_discount()
    {
        return $this->belongsToMany('App\Models\Book'); 
    }
}
