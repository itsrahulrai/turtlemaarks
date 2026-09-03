{{--
  CANONICAL PRODUCT CARD — the single card markup used site-wide.
  Never echo product markup anywhere else; use
      @include('site.partials.product-card', ['p' => $p, 'col' => '...'])
  or the grid partial. Its JS twin (identical markup) lives in
  public/frontend-assets/js/products.js -> renderCard() and is used only where
  cards are re-rendered live (filters, search, wishlist, compare).
  $p is the array produced by App\Support\TmCatalog::map().
--}}
@php
    $col   = $col   ?? 'col-xl-3 col-lg-4 col-md-6';
    $wrap  = $wrap  ?? true;
    $isWishlistPage = $isWishlistPage ?? false;

    $price   = (float) $p['price'];
    $mrp     = (float) ($p['mrp'] ?? $p['price']);
    $savePct = $mrp > $price ? (int) round((($mrp - $price) / $mrp) * 100) : 0;

    $badgeText = !empty($p['badge']) ? $p['badge'] : ($savePct > 0 ? $savePct . '% OFF' : 'Authorized');
    $image     = !empty($p['image']) ? $p['image'] : asset('frontend-assets/images/no-product/no-product.png');
    $detailUrl = $p['url'] ?? route('product.show', $p['slug'] ?? $p['id']);

    $jsItem = "{id:'" . js_str($p['id']) . "', name:'" . js_str($p['name'])
        . "', brand:'" . js_str($p['brand'] ?? SITE_SHORT)
        . "', price:" . (int) $price . ", mrp:" . (int) $mrp
        . ", image:'" . js_str($image) . "'}";
@endphp
@if ($wrap)<div class="{{ $col }}">@endif
  <div class="tm-product-card" data-product-id="{{ $p['id'] }}">

    <!-- Media, badge & floating actions -->
    <div class="tm-product-media">
      <span class="tm-product-save-badge">{{ $badgeText }}</span>

      <div class="tm-product-actions-group">
        <button type="button" class="tm-product-action-btn"
                data-wishlist-id="{{ $p['id'] }}"
                onclick="Wishlist.toggle({!! $jsItem !!})"
                title="Add to Wishlist" aria-label="Wishlist">
          <i class="bi bi-heart"></i>
        </button>
      </div>

      <a href="{{ $detailUrl }}" class="tm-product-img-wrap d-flex align-items-center justify-content-center">
        <img src="{{ $image }}" onerror="this.onerror=null;this.src='{{ asset('frontend-assets/images/no-product/no-product.png') }}';" alt="{{ $p['name'] }}" class="tm-product-img" loading="lazy">
      </a>
    </div>

    <!-- Body -->
    <div class="tm-product-body">

      <div class="tm-product-brand-tag">
        <span class="tm-brand-name">
          <i class="bi bi-shield-check text-orange me-1"></i>{{ $p['brand'] }}
          <span class="tm-origin-text">• {{ $p['brandOrigin'] ?? 'Global' }}</span>
        </span>
        <span class="tm-rating-chip">
          <i class="bi bi-star-fill text-warning"></i> {{ number_format((float) ($p['rating'] ?? 4.9), 1) }}
          <span class="text-muted tm-reviews-count">({{ (int) ($p['reviews'] ?? 0) }})</span>
        </span>
      </div>

      <h6 class="tm-product-title">
        <a href="{{ $detailUrl }}" title="{{ $p['name'] }}">{{ $p['name'] }}</a>
      </h6>

      <div class="tm-product-specs-chips">
        @if (!empty($p['style']))
          <span class="tm-spec-chip tm-spec-style"><i class="bi bi-soundwave"></i> {{ $p['style'] }}</span>
        @endif
        @if (!empty($p['rechargeable']))
          <span class="tm-spec-chip tm-spec-recharge"><i class="bi bi-battery-charging text-success"></i> Rechargeable</span>
        @endif
        @if (!empty($p['bluetooth']))
          <span class="tm-spec-chip tm-spec-bt"><i class="bi bi-bluetooth text-primary"></i> Bluetooth</span>
        @endif
        @if (!empty($p['channels']))
          <span class="tm-spec-chip tm-spec-channels"><i class="bi bi-cpu"></i> {{ (int) $p['channels'] }} Ch</span>
        @endif
        @if (!empty($p['featureHighlight']))
          <span class="tm-spec-chip tm-spec-feature">{{ $p['featureHighlight'] }}</span>
        @endif
      </div>

      <div class="tm-product-price-row">
        <div>
          <div class="tm-product-sale-price">{{ inr($price) }}</div>
          @if ($mrp > $price)
            <div class="tm-product-mrp">MRP: {{ inr($mrp) }}</div>
          @endif
        </div>
        <button type="button" class="tm-product-btn-cart" onclick="Cart.addItem({!! $jsItem !!})" title="Add to Cart">
          <i class="bi bi-cart-plus-fill"></i> Add to Cart
        </button>
      </div>

      @if ($isWishlistPage)
        <div class="tm-product-wishlist-actions mt-2 pt-2 border-top">
          <button type="button" class="tm-btn tm-btn-sm tm-btn-outline-danger w-100 d-flex align-items-center justify-content-center gap-1"
                  onclick="Wishlist.toggle({!! $jsItem !!})" title="Remove product from Wishlist">
            <i class="bi bi-trash3"></i> Remove from Wishlist
          </button>
        </div>
      @endif

    </div>
  </div>
@if ($wrap)</div>@endif
