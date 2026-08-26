<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id', 'name', 'slug', 'description', 'image',
        'meta_title', 'meta_description', 'is_active', 'sort_order',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function category(): BelongsTo  { return $this->belongsTo(Category::class); }
    public function products(): HasMany    { return $this->hasMany(Product::class); }
    public function getImageUrlAttribute(): string
    {
        return $this->image ? asset('/storage/' . $this->image) : asset('images/no-image.png');
    }
    public function scopeActive($q) { return $q->where('is_active', true); }
}
