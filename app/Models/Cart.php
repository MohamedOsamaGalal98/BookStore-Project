<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        
    ];

    
    public function items()
    {
        return $this->belongsToMany('App\Models\Book')->withPivot('quantity'); 
    }

    public function users()
    {
        return $this->belongsTo('App\Models\User'); 
    }

}
