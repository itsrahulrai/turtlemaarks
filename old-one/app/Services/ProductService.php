<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductService
{
   public function create(array $data, array $images = []): Product
{
    $data['slug'] = $data['slug'] ?? Str::slug($data['name']);

    $data['sku'] = $data['sku'] ?? $this->generateSku($data['name']);

    $product = Product::create($data);

    foreach ($images as $index => $image) {

        $path = app(ImageService::class)->store(
            $image,
            'products/gallery'
        );

        ProductImage::create([
            'product_id' => $product->id,
            'image'      => $path,
            'is_primary' => $index === 0,
            'sort_order' => $index,
        ]);
    }

    return $product;
}

   public function update(Product $product, array $data, array $newImages = []): Product
    {
        // Update Product Data
        $product->update($data);

        // Upload New Gallery Images
        foreach ($newImages as $index => $image) {

            $path = app(ImageService::class)->store(
                $image,
                'products/gallery'
            );

            ProductImage::create([
                'product_id' => $product->id,
                'image'      => $path,
                'sort_order' => $product->images()->count() + $index,
            ]);
        }

        return $product->fresh();
    }

    private function generateSku(string $name): string
    {
        return strtoupper(Str::limit(Str::slug($name, ''), 8, '')) . '-' . strtoupper(Str::random(4));
    }
}
