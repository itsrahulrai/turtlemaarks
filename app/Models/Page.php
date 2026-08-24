<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'content',
        'image',
        'alt',
        'meta_title',
        'canonical_url',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'visibility',  
        'index_status',  
        'follow_status',
        'status',
    ];
}
