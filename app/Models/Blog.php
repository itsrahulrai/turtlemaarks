<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'image',
        'short_content',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'tags',
        'robots',
        'status',
    ];
    

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
