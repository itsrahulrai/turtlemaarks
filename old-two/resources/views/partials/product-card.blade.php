<div class="col-xl-3 col-lg-4 col-md-4 col-6">
    <div class="product-card">
        <div class="card-img-wrapper">
            <a href="{{ route('product.show', $product->slug) }}">
                <img src="{{ $product->thumbnail_url }}"
                    alt="{{ $product->name }}"
                    loading="lazy"
                    onerror="this.onerror=null;this.src='{{ base_public_url('assets/img/no-image.jpg') }}';">
            </a>

            {{-- Badges --}}
            <div class="card-badges">
                @if($product->is_new_arrival)
                    <span class="badge-pill badge-new">New</span>
                @endif
                @if($product->discount_percent > 0)
                    <span class="badge-pill badge-discount">-{{ $product->discount_percent }}%</span>
                @endif
                @if($product->stock === 0 && $product->manage_stock)
                    <span class="badge-pill badge-out">Out of Stock</span>
                @endif
            </div>

            {{-- Action overlay --}}
            <div class="overlay-actions">
                @php $wished = auth()->check() && auth()->user()->wishlists()->where('product_id', $product->id)->exists(); @endphp
                <button class="overlay-btn btn-wishlist {{ $wished ? 'wishlisted' : '' }}"
                        data-product-id="{{ $product->id }}" title="Wishlist">
                    <i class="bi bi-heart{{ $wished ? '-fill' : '' }}"></i>
                </button>
                <a href="{{ route('product.show', $product->slug) }}" class="overlay-btn" title="Quick View">
                    <i class="bi bi-eye"></i>
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="product-category">{{ $product->category->name ?? '' }}</div>

            <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none">
                <div class="product-title">{{ $product->name }}</div>
            </a>

            @if($product->reviews->count() > 0)
            <div class="product-rating">
                <div class="stars">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="bi bi-star{{ $i <= round($product->avg_rating) ? '-fill' : ($i - $product->avg_rating < 1 ? '-half' : '') }}"></i>
                    @endfor
                </div>
                <span class="rating-count">({{ $product->reviews->count() }})</span>
            </div>
            @endif

            <div class="card-footer-row">
                <div class="price-block">
                    <span class="price-current">₹{{ number_format($product->effective_price) }}</span>
                    @if($product->sale_price && $product->sale_price < $product->price)
                    <span class="price-original">₹{{ number_format($product->price) }}</span>
                    @endif
                </div>

                @if($product->isInStock())
                <button class="btn-add-cart btn-add-to-cart" data-product-id="{{ $product->id }}" title="Add to Cart">
                    <i class="bi bi-bag-plus"></i>
                </button>
                @else
                <span class="sold-out-text">Sold Out</span>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    :root {
    /* re-themed to match the Turtle Maarks logo (navy + orange) instead of
       the original green/gold palette */
    --kkt-green: #0c3c64;
    --kkt-green-dark: #092f50;
    --kkt-navy: #16263A;
    --kkt-gold: #ff9501;
    --kkt-muted: #8A94A0;
    --kkt-border: #EEF2F5;
}

/* ===== CARD SHELL ===== */
.product-card {
    position: relative;
    background: #fff;
    border: 1px solid #E3EAE7;
    border-radius: 22px;
    overflow: hidden;
    height: 100%;
    display: flex;
    flex-direction: column;
    box-shadow:
        0 1px 2px rgba(16,40,34,.05),
        0 12px 28px rgba(16,40,34,.08);
    transition: transform .4s cubic-bezier(.25,.8,.25,1),
                box-shadow .4s cubic-bezier(.25,.8,.25,1),
                border-color .4s ease;
}

/* accent top strip — always visible, brightens on hover */
.product-card::before {
    content: "";
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--kkt-gold), var(--kkt-green));
    opacity: .55;
    transition: opacity .35s ease;
    z-index: 3;
}

.product-card:hover::before { opacity: 1; }

.product-card:hover {
    transform: translateY(-12px);
    border-color: var(--kkt-green);
    box-shadow:
        0 4px 8px rgba(16,40,34,.08),
        0 36px 60px rgba(16,40,34,.20),
        0 0 0 5px rgba(14,107,79,.10);
}

.product-card:hover {
    transform: translateY(-10px);
    border-color: var(--kkt-green);
    box-shadow:
        0 2px 4px rgba(16,40,34,.05),
        0 30px 50px rgba(16,40,34,.16),
        0 0 0 4px rgba(14,107,79,.06);
}

/* ===== IMAGE (photo-cover, uniform across all cards) ===== */
.card-img-wrapper {
    position: relative;
    aspect-ratio: 1 / 1;
    overflow: hidden;
    background: #f1f5f3;
}

.card-img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    transition: transform .5s cubic-bezier(.25,.8,.25,1), filter .5s ease;
    filter: saturate(1.04) contrast(1.02);
}

.product-card:hover .card-img-wrapper img {
    transform: scale(1.08);
}

.card-img-wrapper::before {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(14,107,79,0) 60%, rgba(10,40,30,.12) 100%);
    pointer-events: none;
    z-index: 1;
}

.card-img-wrapper::after {
    content: "";
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 30% 15%, rgba(255,255,255,.18), transparent 45%);
    pointer-events: none;
    z-index: 1;
}

/* ===== BADGES ===== */
.card-badges {
    position: absolute; top: 12px; left: 12px;
    display: flex; flex-direction: column; gap: 6px;
    z-index: 2;
}

.badge-pill {
    font-size: .65rem; font-weight: 700;
    padding: 5px 11px; border-radius: 20px;
    letter-spacing: .3px;
    box-shadow: 0 3px 8px rgba(0,0,0,.1);
}

.badge-new { background: var(--kkt-green-dark); color: #fff; }
.badge-discount {
    background: linear-gradient(135deg, #F0C063, var(--kkt-gold));
    color: #5c3d05;
}
.badge-out { background: #fff; color: #d23c3c; border: 1px solid #f1c6c6; }

/* ===== OVERLAY ACTIONS ===== */
.overlay-actions {
    position: absolute; top: 12px; right: 12px;
    display: flex; flex-direction: column; gap: 8px;
    opacity: 0; transform: translateX(8px);
    transition: opacity .3s ease, transform .3s ease;
    z-index: 2;
}

.product-card:hover .overlay-actions { opacity: 1; transform: translateX(0); }

.overlay-btn {
    width: 34px; height: 34px; border-radius: 50%;
    background: rgba(255,255,255,.9);
    backdrop-filter: blur(6px);
    border: 1px solid var(--kkt-border);
    display: flex; align-items: center; justify-content: center;
    color: var(--kkt-green-dark);
    box-shadow: 0 4px 10px rgba(0,0,0,.08);
    transition: all .25s ease;
}

.overlay-btn:hover {
    background: var(--kkt-green-dark);
    color: #fff;
    border-color: var(--kkt-green-dark);
    transform: scale(1.08);
}

.btn-wishlist.wishlisted { background: #d6336c; color: #fff; border-color: #d6336c; }

/* ===== BODY ===== */
.card-body {
    padding: 14px 16px 16px;
    display: flex;
    flex-direction: column;
    gap: 2px;
    flex: 1;
    transition: transform .3s ease;
}

.product-card:hover .card-body {
    transform: translateY(-2px);
}

.product-category {
    font-size: .66rem;
    color: var(--kkt-muted);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1.1px;
    margin-bottom: 2px;
    transition: color .3s ease;
}

.product-title {
    font-size: .95rem;
    font-weight: 600;
    color: var(--kkt-navy);
    line-height: 1.4;
    margin-bottom: 6px;
    letter-spacing: -.1px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    transition: color .25s ease;
}

.product-title:hover { color: var(--kkt-green); }

.product-rating { display: flex; align-items: center; gap: 6px; margin-bottom: 6px; }
.stars { color: var(--kkt-gold); font-size: .7rem; }
.rating-count { font-size: .72rem; color: var(--kkt-muted); }

.card-footer-row {
    margin-top: 6px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 10px;
    border-top: 1px solid var(--kkt-border);
}

.price-block { display: flex; flex-direction: column; gap: 1px; }

.price-current {
    font-size: 1.05rem;
    font-weight: 800;
    color: var(--kkt-green);
    letter-spacing: -.2px;
}

.price-original {
    font-size: .76rem;
    font-weight: 300;
    color: var(--kkt-muted);
    text-decoration: line-through;
}

.sold-out-text { font-size: .75rem; color: #d23c3c; font-weight: 600; }

/* ===== ADD TO CART BUTTON ===== */
.btn-add-cart {
    width: 42px; height: 42px;
    border-radius: 18px;
    border: none;
    background: linear-gradient(135deg, #11815C, var(--kkt-green-dark));
    color: #fff;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.05rem;
    box-shadow: 0 6px 14px rgba(14,107,79,.32);
    transition: transform .3s cubic-bezier(.25,.8,.25,1), box-shadow .3s ease, background .3s ease;
}

.btn-add-cart:hover {
    transform: translateY(-3px) scale(1.06);
    box-shadow: 0 10px 22px rgba(14,107,79,.42), 0 0 0 6px rgba(14,107,79,.1);
    background: linear-gradient(135deg, #129067, #0E6B4F);
}

.btn-add-cart:active { transform: translateY(-1px) scale(.98); }

/* ===== RESPONSIVE ===== */
@media (max-width: 575px) {
    .card-body { padding: 12px 12px 14px; }
    .product-title { font-size: .86rem; }
    .price-current { font-size: .92rem; }
    .btn-add-cart { width: 36px; height: 36px; border-radius: 14px; }
    .overlay-btn { width: 30px; height: 30px; }
}

@media (hover: none) {
    .overlay-actions { opacity: 1; transform: none; }
}
</style>