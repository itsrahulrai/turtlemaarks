<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;
     protected $fillable = [
        'name',
        'designation',
        'image',
        'text',
        'rating',
        'status',
    ];
   
    protected $casts = [
        'rating' => 'integer',
        'status' => 'boolean',
    ];

}
