<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id', 'item_type', 'product_id', 'product_variant_id', 'service_id',
        'product_name', 'product_sku', 'variant_label',
        'product_image', 'quantity', 'price', 'sale_price', 'tax_rate', 'total',
    ];

    protected $casts = [
        'price'      => 'decimal:2',
        'sale_price' => 'decimal:2',
        'tax_rate'   => 'decimal:2',
        'total'      => 'decimal:2',
    ];

    public function order(): BelongsTo          { return $this->belongsTo(Order::class); }
    public function product(): BelongsTo        { return $this->belongsTo(Product::class); }
    public function productVariant(): BelongsTo { return $this->belongsTo(ProductVariant::class); }
    public function service(): BelongsTo        { return $this->belongsTo(Service::class); }

    public function isService(): bool { return $this->item_type === 'service'; }

    public function getImageUrlAttribute(): string
    {
        return $this->product_image
            ? asset('/storage/' . $this->product_image)
            : asset('images/no-image.png');
    }
}
