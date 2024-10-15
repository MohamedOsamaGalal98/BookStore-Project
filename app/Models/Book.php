<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Book extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

     protected $fillable = [
        'title',
        'pages',
        'published_at',
        'department_id',
        'price',
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

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')->singleFile();
    
    }

//     public function registerMediaConversions(?Media $media = null): void
// {
//     $this
//         ->addMediaConversion('preview')
//         ->fit(Fit::Contain, 300, 300)
//         ->nonQueued();
// }


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



