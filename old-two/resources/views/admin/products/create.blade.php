@extends('layouts.admin')
@section('title', isset($product) ? 'Edit Product' : 'Add Product')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-700 mb-0">{{ isset($product) ? 'Edit Product' : 'Add New Product' }}</h5>
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Back
    </a>
</div>

<form method="POST"
      action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}"
      enctype="multipart/form-data">
    @csrf
    @isset($product) @method('PUT') @endisset

    <div class="row g-4">
        {{-- Left Column --}}
        <div class="col-xl-8">
            {{-- Basic Info --}}
            <div class="form-card mb-4">
                <h6 class="fw-700 mb-3 pb-2 border-bottom">Basic Information</h6>
                <div class="mb-3">
                    <label class="form-label">Product Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $product->name ?? '') }}" id="product-name" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Slug</label>
                        <input type="text" name="slug" id="product-slug" class="form-control @error('slug') is-invalid @enderror"
                               value="{{ old('slug', $product->slug ?? '') }}">
                        @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">SKU</label>
                        <input type="text" name="sku" class="form-control @error('sku') is-invalid @enderror"
                               value="{{ old('sku', $product->sku ?? '') }}" placeholder="Auto-generated if empty">
                        @error('sku') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Short Description</label>
                    <textarea name="short_description" class="form-control" rows="2">{{ old('short_description', $product->short_description ?? '') }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Full Description</label>
                    <textarea name="description" id="description-editor" class="form-control" rows="6">{{ old('description', $product->description ?? '') }}</textarea>
                </div>
            </div>

            {{-- Pricing & Inventory --}}
            <div class="form-card mb-4">
                <h6 class="fw-700 mb-3 pb-2 border-bottom">Pricing & Inventory</h6>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Regular Price (₹) <span class="text-danger">*</span></label>
                        <input type="number" name="price" class="form-control" step="0.01" min="0"
                               value="{{ old('price', $product->price ?? '') }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Sale Price (₹)</label>
                        <input type="number" name="sale_price" class="form-control" step="0.01" min="0"
                               value="{{ old('sale_price', $product->sale_price ?? '') }}" placeholder="Leave empty if no discount">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Cost Price (₹)</label>
                        <input type="number" name="cost_price" class="form-control" step="0.01" min="0"
                               value="{{ old('cost_price', $product->cost_price ?? '') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Stock Quantity</label>
                        <input type="number" name="stock" class="form-control" min="0"
                               value="{{ old('stock', $product->stock ?? 0) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Low Stock Threshold</label>
                        <input type="number" name="low_stock_threshold" class="form-control" min="0"
                               value="{{ old('low_stock_threshold', $product->low_stock_threshold ?? 5) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tax Rate (%)</label>
                        <input type="number" name="tax_rate" class="form-control" step="0.01" min="0"
                               value="{{ old('tax_rate', $product->tax_rate ?? 0) }}">
                    </div>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="manage_stock" id="manage_stock" value="1"
                           {{ old('manage_stock', $product->manage_stock ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="manage_stock">Track inventory for this product</label>
                </div>
            </div>

            {{-- SEO --}}
            <div class="form-card mb-4">
                <h6 class="fw-700 mb-3 pb-2 border-bottom">SEO Settings</h6>
                <div class="mb-3">
                    <label class="form-label">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control"
                           value="{{ old('meta_title', $product->meta_title ?? '') }}" maxlength="160">
                </div>
                <div class="mb-3">
                    <label class="form-label">Meta Description</label>
                    <textarea name="meta_description" class="form-control" rows="2" maxlength="300">{{ old('meta_description', $product->meta_description ?? '') }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Meta Keywords</label>
                    <input type="text" name="meta_keywords" class="form-control"
                           value="{{ old('meta_keywords', $product->meta_keywords ?? '') }}" placeholder="Comma separated keywords">
                </div>
            </div>
        </div>

        {{-- Right Column --}}
        <div class="col-xl-4">
            {{-- Status & Visibility --}}
            <div class="form-card mb-4">
                <h6 class="fw-700 mb-3 pb-2 border-bottom">Status & Visibility</h6>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="active" {{ old('status', $product->status ?? 'active') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $product->status ?? '') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="draft" {{ old('status', $product->status ?? '') === 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>

                <div class="d-flex flex-column gap-2">
                    @foreach(['is_featured'=>'Featured Product','is_trending'=>'Trending','is_new_arrival'=>'New Arrival','is_best_seller'=>'Best Seller','is_on_sale'=>'On Sale'] as $field => $label)
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="{{ $field }}" id="{{ $field }}" value="1"
                               {{ old($field, $product->{$field} ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label" for="{{ $field }}" style="font-size:.87rem;">{{ $label }}</label>
                    </div>
                    @endforeach
                </div>
                
            </div>

            {{-- Category & Brand --}}
            <div class="form-card mb-4">
                <h6 class="fw-700 mb-3 pb-2 border-bottom">Category &amp; Brand</h6>
                <div class="mb-3">
                    <label class="form-label">Category <span class="text-danger">*</span></label>
                    <select name="category_id" id="category-select" class="form-select" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Subcategory</label>
                    <select name="subcategory_id" id="subcategory-select" class="form-select">
                        <option value="">Select Subcategory</option>
                        @isset($product)
                        @foreach($product->category?->subcategories ?? [] as $sub)
                        <option value="{{ $sub->id }}" {{ $product->subcategory_id == $sub->id ? 'selected' : '' }}>{{ $sub->name }}</option>
                        @endforeach
                        @endisset
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Brand</label>
                    <select name="brand_id" class="form-select">
                        <option value="">Select Brand</option>
                        @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id ?? '') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label">Product Type</label>
                    <select name="product_kind" class="form-select">
                        <option value="hearing_aid" {{ old('product_kind', $product->product_kind ?? 'hearing_aid') === 'hearing_aid' ? 'selected' : '' }}>Hearing Aid</option>
                        <option value="accessory" {{ old('product_kind', $product->product_kind ?? '') === 'accessory' ? 'selected' : '' }}>Accessory (charger, receiver, filter, battery, etc.)</option>
                    </select>
                </div>
            </div>

            {{-- Hearing Aid Details --}}
            <div class="form-card mb-4">
                <h6 class="fw-700 mb-3 pb-2 border-bottom">Hearing Aid Details</h6>
                <small class="text-muted d-block mb-3">Leave any field blank if it doesn't apply (e.g. for accessories).</small>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Model Number</label>
                        <input type="text" name="model_number" class="form-control"
                               value="{{ old('model_number', $product->model_number ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Form Factor</label>
                        <input type="text" name="form_factor" class="form-control" placeholder="BTE, RIC, ITC, CIC..."
                               value="{{ old('form_factor', $product->form_factor ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kit Configuration</label>
                        <input type="text" name="kit_configuration" class="form-control" placeholder="Standard kit, Premium kit with charger..."
                               value="{{ old('kit_configuration', $product->kit_configuration ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Warranty (months)</label>
                        <input type="number" name="warranty_months" class="form-control" min="0"
                               value="{{ old('warranty_months', $product->warranty_months ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Channels</label>
                        <input type="text" name="channels" class="form-control"
                               value="{{ old('channels', $product->channels ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Fitting Range</label>
                        <input type="text" name="fitting_range" class="form-control" placeholder="Mild to Severe..."
                               value="{{ old('fitting_range', $product->fitting_range ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Battery Type</label>
                        <input type="text" name="battery_type" class="form-control" placeholder="Rechargeable, Zinc Air 312..."
                               value="{{ old('battery_type', $product->battery_type ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Receiver Options</label>
                        <input type="text" name="receiver_options" class="form-control"
                               value="{{ old('receiver_options', $product->receiver_options ?? '') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Connectivity</label>
                        <input type="text" name="connectivity" class="form-control" placeholder="Bluetooth, App Control..."
                               value="{{ old('connectivity', $product->connectivity ?? '') }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Colour Options</label>
                    <input type="text" name="colour_options_input" id="colour-options-input" class="form-control"
                           placeholder="Type a colour and press Enter (e.g. Beige, Black, Silver)"
                           value="{{ old('colour_options_input', isset($product) && $product->colour_options ? implode(', ', $product->colour_options) : '') }}">
                    <small class="text-muted">Comma-separated list of available colours.</small>
                    <div id="colour-hidden-inputs"></div>
                </div>

                {{-- Free-form additional specs (label/value repeater) --}}
                <div>
                    <label class="form-label d-flex justify-content-between align-items-center">
                        <span>Additional Specifications</span>
                        <button type="button" id="add-spec-row" class="btn btn-sm btn-outline-secondary">+ Add Row</button>
                    </label>
                    <div id="spec-rows">
                        @php $existingSpecs = old('spec_labels') ? array_combine(old('spec_labels'), old('spec_values')) : ($product->specifications ?? []); @endphp
                        @forelse($existingSpecs ?? [] as $label => $value)
                        <div class="d-flex gap-2 mb-2 spec-row">
                            <input type="text" name="spec_labels[]" class="form-control" placeholder="Label (e.g. Water Resistance)" value="{{ $label }}">
                            <input type="text" name="spec_values[]" class="form-control" placeholder="Value (e.g. IP68)" value="{{ $value }}">
                            <button type="button" class="btn btn-outline-danger remove-spec-row">×</button>
                        </div>
                        @empty
                        <div class="d-flex gap-2 mb-2 spec-row">
                            <input type="text" name="spec_labels[]" class="form-control" placeholder="Label (e.g. Water Resistance)">
                            <input type="text" name="spec_values[]" class="form-control" placeholder="Value (e.g. IP68)">
                            <button type="button" class="btn btn-outline-danger remove-spec-row">×</button>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Thumbnail --}}
            <div class="form-card mb-4">
                <h6 class="fw-700 mb-3 pb-2 border-bottom">Thumbnail</h6>
                @isset($product)
                @if($product->thumbnail)
                <div class="mb-2">
                    <img src="{{ $product->thumbnail_url }}" class="img-fluid rounded" style="max-height:160px;object-fit:cover;">
                </div>
                @endif
                @endisset
                <input type="file" name="thumbnail" class="form-control form-control-sm" accept="image/*">
                <small class="text-muted">Recommended: 800x800px, JPG/PNG, max 2MB</small>
            </div>

            {{-- Gallery --}}
            <div class="form-card mb-4">
                <h6 class="fw-700 mb-3 pb-2 border-bottom">Product Gallery</h6>
                @isset($product)
                @if($product->images->count())
                <div class="d-flex flex-wrap gap-2 mb-3">
                    @foreach($product->images as $img)
                    <div class="position-relative">
                        <img src="{{ $img->url }}" style="width:64px;height:64px;object-fit:cover;border-radius:8px;">
                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 delete-image"
                                data-id="{{ $img->id }}" data-url="{{ route('admin.products.images.destroy', $img) }}"
                                style="padding:1px 5px;font-size:.65rem;border-radius:0 8px 0 8px;">×</button>
                    </div>
                    @endforeach
                </div>
                @endif
                @endisset
                <input type="file" name="gallery[]" class="form-control form-control-sm" accept="image/*" multiple>
                <small class="text-muted">Upload multiple images (max 2MB each)</small>
            </div>

            <button type="submit" class="btn btn-admin-primary text-white w-100 py-2">
                <i class="bi bi-check2-circle me-2"></i>{{ isset($product) ? 'Update Product' : 'Create Product' }}
            </button>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
// Auto-generate slug
$('#product-name').on('input', function() {
    if (!{!! isset($product) ? 'true' : 'false' !!}) {
        const slug = $(this).val().toLowerCase().replace(/[^a-z0-9\s-]/g,'').trim().replace(/\s+/g,'-');
        $('#product-slug').val(slug);
    }
});

// Load subcategories on category change
$('#category-select').on('change', function() {
    const catId = $(this).val();
    const $sub = $('#subcategory-select');
    $sub.html('<option value="">Loading...</option>');
    if (!catId) { $sub.html('<option value="">Select Subcategory</option>'); return; }
    $.get('{{ url("admin/categories") }}/' + catId + '/subcategories', function(data) {
        let html = '<option value="">Select Subcategory</option>';
        data.forEach(s => html += `<option value="${s.id}">${s.name}</option>`);
        $sub.html(html);
    });
});

// Delete gallery image
$(document).on('click', '.delete-image', function() {
    if (!confirm('Delete this image?')) return;
    const btn = $(this);
    $.ajax({ url: btn.data('url'), method: 'DELETE' })
        .done(() => btn.closest('.position-relative').remove());
});

// Build colour_options[] hidden inputs from the comma-separated text field
function syncColourInputs() {
    const raw = $('#colour-options-input').val() || '';
    const colours = raw.split(',').map(c => c.trim()).filter(Boolean);
    const $hidden = $('#colour-hidden-inputs');
    $hidden.empty();
    colours.forEach(c => {
        $hidden.append(`<input type="hidden" name="colour_options[]" value="${$('<div>').text(c).html()}">`);
    });
}
$('#colour-options-input').on('input', syncColourInputs);
syncColourInputs();
$('form').on('submit', syncColourInputs);

// Specification repeater rows
$('#add-spec-row').on('click', function() {
    $('#spec-rows').append(`
        <div class="d-flex gap-2 mb-2 spec-row">
            <input type="text" name="spec_labels[]" class="form-control" placeholder="Label (e.g. Water Resistance)">
            <input type="text" name="spec_values[]" class="form-control" placeholder="Value (e.g. IP68)">
            <button type="button" class="btn btn-outline-danger remove-spec-row">×</button>
        </div>
    `);
});
$(document).on('click', '.remove-spec-row', function() {
    if ($('.spec-row').length > 1) {
        $(this).closest('.spec-row').remove();
    } else {
        $(this).closest('.spec-row').find('input').val('');
    }
});
</script>

<script>
new Jodit('#description-editor', {
    height: 350
});
</script>
@endpush
