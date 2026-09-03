@php
    $col = $col ?? 'col-xl-3 col-lg-4 col-md-6';
    $products = $products ?? [];
    $isWishlistPage = $isWishlistPage ?? false;
@endphp
@forelse ($products as $p)
  @include('site.partials.product-card', ['p' => $p, 'col' => $col, 'isWishlistPage' => $isWishlistPage])
@empty
  <div class="col-12 d-flex justify-content-center w-100">
    <div class="tm-empty-state-card">
      <div class="tm-empty-state-icon">
        <i class="bi bi-search"></i>
      </div>
      <h4 class="tm-empty-state-title">No Products Available</h4>
      <p class="tm-empty-state-text">
        Try selecting another brand or explore all hearing aids.
      </p>
      <div class="tm-empty-state-actions">
        <a href="{{ route('contact-us') }}" class="tm-btn tm-btn-primary btn-sm px-4">
          <i class="bi bi-headset me-1"></i> Contact Us
        </a>
      </div>
    </div>
  </div>
@endforelse
