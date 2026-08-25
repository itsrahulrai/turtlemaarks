<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    protected $fillable = [
        'user_id', 'session_id', 'item_type', 'product_id', 'product_variant_id',
        'service_id', 'quantity',
    ];

    public function user(): BelongsTo           { return $this->belongsTo(User::class); }
    public function product(): BelongsTo        { return $this->belongsTo(Product::class); }
    public function productVariant(): BelongsTo { return $this->belongsTo(ProductVariant::class); }
    public function service(): BelongsTo        { return $this->belongsTo(Service::class); }

    public function isService(): bool { return $this->item_type === 'service'; }

    public function getNameAttribute(): string
    {
        return $this->isService() ? $this->service->name : $this->product->name;
    }

    public function getImageUrlAttribute(): string
    {
        return $this->isService()
            ? $this->service->image_url
            : ($this->productVariant?->image_url ?? $this->product->thumbnail_url);
    }

    public function getEffectivePriceAttribute(): float
    {
        if ($this->isService()) {
            return (float) $this->service->price;
        }
        if ($this->productVariant) {
            return (float) $this->productVariant->effective_price;
        }
        return (float) $this->product->effective_price;
    }

    public function getLineTotalAttribute(): float
    {
        return $this->effective_price * $this->quantity;
    }
}
