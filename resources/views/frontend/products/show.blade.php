@extends('site.layouts.layout')
@section('title', $product->meta_title ?? $product->name)
@section('meta_description', $product->meta_description ?? $product->short_description)
@section('og_title', $product->name)
@section('og_image', $product->thumbnail_url)

@section('content')
<div class="breadcrumb-kkt">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size:.84rem;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('shop.category', $product->category->slug) }}">{{ $product->category->name }}</a></li>
                <li class="breadcrumb-item active">{{ Str::limit($product->name, 40) }}</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-4">
    <div class="container">
        <div class="row g-5">
            {{-- Images --}}
            <div class="col-lg-5">
                <div class="position-sticky" style="top: 80px;">
                    <div style="border-radius:16px;overflow:hidden;border:1px solid #e9ecef;background:#f8f9fa;aspect-ratio:1;" class="mb-3">
                        <img id="main-image" src="{{ $product->thumbnail_url }}" alt="{{ $product->name }}"
                             onerror="this.onerror=null;this.src='{{ base_public_url('assets/img/no-image.jpg') }}';"
                             style="width:100%;height:100%;object-fit:contain;cursor:zoom-in;transition:transform .3s;"
                             onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    </div>
                    <div class="d-flex gap-2 flex-wrap" id="image-thumbnails">
                        <div class="thumb-item active" onclick="changeImage('{{ $product->thumbnail_url }}', this)"
                             style="width:64px;height:64px;border-radius:8px;overflow:hidden;cursor:pointer;border:2px solid var(--kkt-primary);">
                            <img src="{{ $product->thumbnail_url }}" style="width:100%;height:100%;object-fit:cover;"  onerror="this.onerror=null;this.src='{{ base_public_url('assets/img/no-image.jpg') }}';">
                        </div>
                        @foreach($product->images as $img)
                        <div class="thumb-item" onclick="changeImage('{{ $img->url }}', this)"
                             style="width:64px;height:64px;border-radius:8px;overflow:hidden;cursor:pointer;border:2px solid #e9ecef;">
                            <img src="{{ $img->url }}" style="width:100%;height:100%;object-fit:cover;" onerror="this.onerror=null;this.src='{{ base_public_url('assets/img/no-image.jpg') }}';">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Product Info --}}
            <div class="col-lg-7">
                <div style="font-size:.82rem;color:var(--kkt-muted);margin-bottom:6px;">
                    <a href="{{ route('shop.category', $product->category->slug) }}" style="color:var(--kkt-primary);text-decoration:none;">{{ $product->category->name }}</a>
                    @if($product->subcategory)
                        <span class="mx-1">/</span>
                        <a href="{{ route('shop.subcategory', [$product->category->slug, $product->subcategory->slug]) }}" style="color:var(--kkt-primary);text-decoration:none;">{{ $product->subcategory->name }}</a>
                    @endif
                </div>

                <h1 style="font-size:1.7rem;font-weight:800;color:var(--kkt-dark);">{{ $product->name }}</h1>

                {{-- Rating --}}
                @if($product->reviews->count() > 0)
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="text-warning">
                        @for($i = 1; $i <= 5; $i++)
                        <i class="bi bi-star{{ $i <= round($product->avg_rating) ? '-fill' : '' }}"></i>
                        @endfor
                    </div>
                    <span style="font-size:.88rem;color:#6c757d;">({{ $product->reviews->count() }} reviews)</span>
                </div>
                @endif

                {{-- Price --}}
                <div class="mb-4">
                    <span id="display-price" style="font-size:2rem;font-weight:900;color:var(--kkt-primary);">
                        ₹{{ number_format($product->effective_price) }}
                    </span>
                    @if($product->sale_price && $product->sale_price < $product->price)
                    <span style="font-size:1.1rem;text-decoration:line-through;color:#6c757d;margin-left:10px;">₹{{ number_format($product->price) }}</span>
                    <span class="badge-discount ms-2">{{ $product->discount_percent }}% OFF</span>
                    @endif
                </div>

                @if($product->short_description)
                <p style="color:#555;line-height:1.8;margin-bottom:20px;">{{ $product->short_description }}</p>
                @endif

                {{-- Variants --}}
                @if($product->variants->count())
                <div class="mb-4">
                    @php $colors = $product->variants->whereNotNull('color')->unique('color'); @endphp
                    @php $sizes  = $product->variants->whereNotNull('size')->unique('size'); @endphp

                    @if($colors->count())
                    <div class="mb-3">
                        <div style="font-size:.88rem;font-weight:600;margin-bottom:8px;">Color: <span id="selected-color">{{ $colors->first()->color }}</span></div>
                        <div class="d-flex gap-2 flex-wrap">
                            @foreach($colors as $variant)
                            <button type="button" class="variant-color-btn {{ $loop->first ? 'active' : '' }}"
                                    data-color="{{ $variant->color }}"
                                    title="{{ $variant->color }}"
                                    style="width:32px;height:32px;border-radius:50%;background:{{ $variant->color_hex ?? '#ccc' }};border:{{ $loop->first ? '3px solid #0C3C64' : '2px solid #ccc' }};cursor:pointer;transition:border .2s;">
                            </button>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if($sizes->count())
                    <div class="mb-3">
                        <div style="font-size:.88rem;font-weight:600;margin-bottom:8px;">Size: <span id="selected-size">—</span></div>
                        <div class="d-flex gap-2 flex-wrap" id="size-buttons">
                            @foreach($sizes as $variant)
                            <button type="button" class="variant-size-btn"
                                    data-size="{{ $variant->size }}"
                                    style="padding:6px 16px;border-radius:8px;border:2px solid #e9ecef;background:#fff;font-size:.84rem;font-weight:600;cursor:pointer;transition:all .2s;">
                                {{ $variant->size }}
                            </button>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                @endif

                {{-- Quantity + Add to Cart --}}
                <div class="d-flex align-items-center gap-3 mb-4 flex-wrap">
                    <div class="d-flex align-items-center border rounded" style="border-radius:10px!important;overflow:hidden;">
                        <button onclick="changeQty(-1)" class="btn btn-light" style="padding:10px 16px;border:none;">−</button>
                        <input type="number" id="qty-input" value="1" min="1" max="{{ $product->stock ?: 99 }}"
                               style="width:60px;text-align:center;border:none;outline:none;font-weight:700;">
                        <button onclick="changeQty(1)" class="btn btn-light" style="padding:10px 16px;border:none;">+</button>
                    </div>

                    @if($product->isInStock())
                    <button id="main-add-to-cart" class="btn btn-primary px-4 py-2 btn-add-to-cart-detail"
                            data-product-id="{{ $product->id }}"
                            style="border-radius:10px;font-weight:700;font-size:1rem;">
                        <i class="bi bi-bag-plus me-2"></i>Add to Cart
                    </button>
                    @else
                    <button class="btn btn-secondary px-4 py-2 flex-grow-1" disabled style="border-radius:10px;">
                        Out of Stock
                    </button>
                    @endif

                    @auth
                    <button class="btn btn-outline-secondary btn-wishlist py-2 px-3"
                            data-product-id="{{ $product->id }}"
                            style="border-radius:10px;" title="Add to Wishlist">
                        <i class="bi bi-heart{{ auth()->user()->wishlists()->where('product_id', $product->id)->exists() ? '-fill' : '' }}"></i>
                    </button>
                    @endauth
                </div>

                {{-- Product Meta --}}
                <div style="border-top:1px solid #e9ecef;padding-top:16px;font-size:.85rem;color:#555;line-height:2;">
                    <div><span style="font-weight:600;color:var(--kkt-dark);">SKU:</span> {{ $product->sku }}</div>
                    <div><span style="font-weight:600;color:var(--kkt-dark);">Category:</span> {{ $product->category->name }}</div>
                    <div>
                        <span style="font-weight:600;color:var(--kkt-dark);">Availability:</span>
                        @if($product->isInStock())
                        <span style="color:#198754;font-weight:600;">✓ In Stock</span>
                        @else
                        <span style="color:#dc3545;font-weight:600;">✗ Out of Stock</span>
                        @endif
                    </div>
                    @if($product->tags)
                    <div><span style="font-weight:600;color:var(--kkt-dark);">Tags:</span> {{ implode(', ', $product->tags) }}</div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Description & Reviews Tabs --}}
        <div class="row mt-5">
            <div class="col-12">
                <ul class="nav nav-tabs" id="productTabs">
                    <li class="nav-item"><button class="nav-link active" data-toggle="tab" data-target="#description">Description</button></li>
                    <li class="nav-item"><button class="nav-link" data-toggle="tab" data-target="#reviews">Reviews ({{ $product->reviews->count() }})</button></li>
                </ul>
                <div class="tab-content border border-top-0 rounded-bottom p-4">
                    <div class="tab-pane fade show active" id="description">
                        {!! $product->description ?? '<p>No description available.</p>' !!}
                    </div>
                    <div class="tab-pane fade" id="reviews">
                        {{-- Add Review Form --}}
                            @auth

                            <div class="border rounded-4 p-4 mb-4 bg-light">

                                <h5 class="fw-bold mb-3">
                                    Write a Review
                                </h5>

                                <form action="{{ route('reviews.store', $product->id) }}" method="POST">

                                    @csrf

                                    {{-- Rating --}}
                                    <div class="mb-3">

                                        <label class="form-label fw-semibold">
                                            Rating
                                        </label>

                                        <select name="rating" class="form-select" required>
                                            <option value="">Select Rating</option>
                                            <option value="5">★★★★★ (5)</option>
                                            <option value="4">★★★★☆ (4)</option>
                                            <option value="3">★★★☆☆ (3)</option>
                                            <option value="2">★★☆☆☆ (2)</option>
                                            <option value="1">★☆☆☆☆ (1)</option>
                                        </select>

                                    </div>

                                    {{-- Title --}}
                                    <div class="mb-3">

                                        <label class="form-label fw-semibold">
                                            Review Title
                                        </label>

                                        <input
                                            type="text"
                                            name="title"
                                            class="form-control"
                                            placeholder="Enter review title"
                                        >

                                    </div>

                                    {{-- Review --}}
                                    <div class="mb-3">

                                        <label class="form-label fw-semibold">
                                            Your Review
                                        </label>

                                        <textarea
                                            name="body"
                                            rows="4"
                                            class="form-control"
                                            placeholder="Write your review..."
                                            required
                                        ></textarea>

                                    </div>

                                    <button class="btn btn-primary px-4">
                                        Submit Review
                                    </button>

                                </form>

                            </div>

                            @else

                            <div class="alert alert-light border">
                                Please
                                <a href="{{ route('login') }}">
                                    login
                                </a>
                                to write a review.
                            </div>

                            @endauth
                        @forelse($product->reviews as $review)
                        <div class="d-flex gap-3 border-bottom pb-3 mb-3">
                            <img src="{{ $review->user->avatar_url }}" style="width:44px;height:44px;border-radius:50%;object-fit:cover;" alt="{{ $review->user->name }}">
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between">
                                    <strong style="font-size:.9rem;">{{ $review->user->name }}</strong>
                                    <span style="font-size:.78rem;color:#6c757d;">{{ $review->created_at->format('d M Y') }}</span>
                                </div>
                                <div class="text-warning my-1" style="font-size:.8rem;">
                                    @for($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>
                                    @endfor
                                </div>
                                @if($review->title)<div style="font-weight:600;font-size:.88rem;">{{ $review->title }}</div>@endif
                                <p style="font-size:.87rem;color:#555;margin-top:4px;">{{ $review->body }}</p>
                            </div>
                        </div>
                        @empty
                        <p class="text-muted">No reviews yet. Be the first to review!</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- Related Products --}}
        @if($related->count())
        <div class="mt-5 pt-4 pb-5">
            <div class="section-header mb-4">
                <span class="badge-label">You May Also Like</span>
                <h2>Related Products</h2>
            </div>

            <div class="row g-4">
                @foreach($related as $p)
                    @include('partials.product-card', ['product' => $p])
                @endforeach
            </div>
        </div>
@endif
    </div>
</section>

@endsection

@push('scripts')
<script>
const variants = @json($product->variants);
let selectedVariantId = null;

function changeImage(url, el) {
    document.getElementById('main-image').src = url;
    document.querySelectorAll('.thumb-item').forEach(t => t.style.borderColor = '#e9ecef');
    el.style.borderColor = 'var(--kkt-primary)';
}

function changeQty(delta) {
    const input = document.getElementById('qty-input');
    let val = parseInt(input.value) + delta;
    input.value = Math.max(1, val);
}

// Color selection
document.querySelectorAll('.variant-color-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.variant-color-btn').forEach(b => b.style.border = '2px solid #ccc');
        this.style.border = '3px solid #0C3C64';
        document.getElementById('selected-color').textContent = this.dataset.color;
        updateVariantPrice();
    });
});

// Size selection
document.querySelectorAll('.variant-size-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.variant-size-btn').forEach(b => {
            b.style.borderColor = '#e9ecef'; b.style.background = '#fff'; b.style.color = '#333';
        });
        this.style.borderColor = '#0C3C64'; this.style.background = '#0C3C64'; this.style.color = '#fff';
        document.getElementById('selected-size').textContent = this.dataset.size;
        updateVariantPrice();
    });
});

function updateVariantPrice() {
    const color = document.getElementById('selected-color')?.textContent;
    const size  = document.getElementById('selected-size')?.textContent;
    const variant = variants.find(v => (!color || v.color === color) && (!size || v.size === size));
    if (variant) {
        selectedVariantId = variant.id;
        const price = variant.sale_price || variant.price || {{ $product->effective_price }};
        document.getElementById('display-price').textContent = '₹' + Math.round(parseFloat(price)).toLocaleString('en-IN');
        document.getElementById('main-add-to-cart').dataset.variantId = variant.id;
    }
}

// Dedicated add-to-cart handler for THIS page only — separate from the
// generic .btn-add-to-cart delegated handler in shop.js, so a click here
// doesn't fire twice. This one also sends the selected variant + quantity.
document.getElementById('main-add-to-cart')?.addEventListener('click', function(e) {
    e.preventDefault();
    const btn = this;
    const productId = this.dataset.productId;
    const variantId = this.dataset.variantId || null;
    const qty = parseInt(document.getElementById('qty-input').value) || 1;

    btn.disabled = true;
    $.post('{{ route("cart.add") }}', { product_id: productId, product_variant_id: variantId, quantity: qty })
        .done(res => {
            if (res.success) {
                updateCartBadge(res.count);
                showToast(res.message, 'success');
            } else {
                showToast(res.message || 'Could not add to cart.', 'error');
            }
        })
        .fail(xhr => {
            const msg = xhr.status === 401
                ? 'Please login to add items to your cart.'
                : 'Could not add to cart. Please try again.';
            showToast(msg, 'error');
        })
        .always(() => { btn.disabled = false; });
});
</script>
@endpush
