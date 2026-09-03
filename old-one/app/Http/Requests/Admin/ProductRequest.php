<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $productId = $this->route('product')?->id;
        return [
            'name'              => 'required|string|max:200',
            'slug'              => 'nullable|string|unique:products,slug,' . $productId,
            'sku'               => 'nullable|string|unique:products,sku,' . $productId . '|max:100',
            'short_description' => 'nullable|string',
            'description'       => 'nullable|string',
            'price'             => 'required|numeric|min:0',
            'sale_price'        => 'nullable|numeric|min:0|lt:price',
            'cost_price'        => 'nullable|numeric|min:0',
            'stock'             => 'integer|min:0',
            'low_stock_threshold' => 'integer|min:0',
            'manage_stock'      => 'boolean',
            'tax_rate'          => 'numeric|min:0|max:100',
            'category_id'       => 'required|exists:categories,id',
            'subcategory_id'    => 'nullable|exists:subcategories,id',
            'thumbnail'         => 'nullable|image|max:2048',
            'gallery.*'         => 'nullable|image|max:2048',
            'status'            => 'required|in:active,inactive,draft',
            'is_featured'       => 'boolean',
            'is_trending'       => 'boolean',
            'is_new_arrival'    => 'boolean',
            'is_best_seller'    => 'boolean',
            'is_on_sale'        => 'boolean',
            'meta_title'        => 'nullable|string|max:160',
            'meta_description'  => 'nullable|string|max:300',
            'meta_keywords'     => 'nullable|string',

            // Hearing-aid catalogue fields
            'brand_id'          => 'nullable|exists:brands,id',
            'product_kind'      => 'required|in:hearing_aid,accessory',
            'model_number'      => 'nullable|string|max:100',
            'form_factor'       => 'nullable|string|max:100',
            'kit_configuration' => 'nullable|string|max:150',
            'warranty_months'   => 'nullable|integer|min:0',
            'channels'          => 'nullable|string|max:100',
            'fitting_range'     => 'nullable|string|max:150',
            'battery_type'      => 'nullable|string|max:100',
            'receiver_options'  => 'nullable|string|max:150',
            'connectivity'      => 'nullable|string|max:150',
            'colour_options'    => 'nullable|array',
            'colour_options.*'  => 'nullable|string|max:50',
            'spec_labels'       => 'nullable|array',
            'spec_labels.*'     => 'nullable|string|max:100',
            'spec_values'       => 'nullable|array',
            'spec_values.*'     => 'nullable|string|max:200',
        ];
    }

    protected function prepareForValidation(): void
    {
        $bools = ['manage_stock','is_featured','is_trending','is_new_arrival','is_best_seller','is_on_sale'];
        foreach ($bools as $field) {
            $this->merge([$field => $this->has($field) ? 1 : 0]);
        }
        if (!$this->filled('slug') && $this->filled('name')) {
            $this->merge(['slug' => \Illuminate\Support\Str::slug($this->name)]);
        }
        if (!$this->filled('sku') && $this->filled('name')) {
            $this->merge(['sku' => 'SCC-' . strtoupper(substr(md5($this->name . time()), 0, 8))]);
        }
        if (!$this->filled('product_kind')) {
            $this->merge(['product_kind' => 'hearing_aid']);
        }
    }

    /**
     * Build the `specifications` JSON payload from the parallel
     * spec_labels[]/spec_values[] repeater inputs. Call this on the
     * validated data before saving (labels/values themselves are not
     * columns on the products table).
     */
    public function specifications(): ?array
    {
        $labels = $this->input('spec_labels', []);
        $values = $this->input('spec_values', []);
        $specs  = [];

        foreach ($labels as $i => $label) {
            if (trim((string) $label) === '') {
                continue;
            }
            $specs[trim($label)] = trim((string) ($values[$i] ?? ''));
        }

        return $specs ?: null;
    }
}
