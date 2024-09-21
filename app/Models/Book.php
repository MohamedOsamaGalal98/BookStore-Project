<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

     
    public function discount()
    {
        return $this->belongsTo('App\Models\Discount'); 
    }

    public function getDiscountTextAttribute()
    {
        if($this->discount == null) {
            return 'No Discount Available';
        }  elseif ($this->discount->type === 'percentage') {
            return $this->discount->value . ' %';
        } elseif ($this->discount->type === 'numeric') {
            return $this->discount->value . ' EGY';
        }
    }
 
    
}



