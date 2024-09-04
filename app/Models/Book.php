<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    
}



