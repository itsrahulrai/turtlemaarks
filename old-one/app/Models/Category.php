<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'description', 'image', 'icon',
        'meta_title', 'meta_description', 'meta_keywords',
        'is_active', 'is_featured', 'sort_order',
    ];

    protected $casts = [
        'is_active'   => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function subcategories(): HasMany { return $this->hasMany(Subcategory::class)->where('is_active', true); }
    public function products(): HasMany      { return $this->hasMany(Product::class); }
    public function getImageUrlAttribute(): string
    {
        return $this->image ? asset('public/storage/' . $this->image) : asset('images/no-image.png');
    }

    public function scopeActive($q)  { return $q->where('is_active', true); }
    public function scopeFeatured($q){ return $q->where('is_featured', true); }
}
