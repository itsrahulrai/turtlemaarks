@extends('site.layouts.app')

@section('title', 'Shopping Cart — ' . SITE_NAME)
@section('meta_description', 'View and manage items in your Turtle Maarks shopping cart. Apply discount promo codes and proceed to secure checkout.')

@section('content')

  <!-- HERO BANNER -->
  <section class="tm-page-hero text-center position-relative">
    <div class="container">
      <nav aria-label="breadcrumb" class="d-inline-flex mb-2">
        <div class="tm-breadcrumb-pill">
          <a href="{{ route('home') }}"><i class="bi bi-house-door"></i> Home</a>
          <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
          <span class="tm-breadcrumb-current" aria-current="page">Shopping Cart</span>
        </div>
      </nav>
      <h1 class="display-6 fw-bold text-white mb-1 font-heading">Your Shopping Cart</h1>
      <p class="text-white-50 mx-auto small mb-3" style="max-width: 580px;">Review selected hearing devices, diagnostic services, and accessories.</p>

      <!-- Stepper Indicator -->
      <div class="tm-cart-step-nav mb-0">
        <div class="tm-cart-step-item active">
          <span class="tm-cart-step-num">1</span>
          <span>Review Cart</span>
        </div>
        <i class="bi bi-chevron-right text-white-50 small"></i>
        <div class="tm-cart-step-item">
          <span class="tm-cart-step-num">2</span>
          <span>Delivery &amp; Fitting</span>
        </div>
        <i class="bi bi-chevron-right text-white-50 small"></i>
        <div class="tm-cart-step-item">
          <span class="tm-cart-step-num">3</span>
          <span>Confirmation</span>
        </div>
      </div>
    </div>
  </section>

  <!-- CART PAGE CONTENT -->
  <section class="py-4 bg-light">
    <div class="container" id="tmCartPageWrap">

      <!-- Free Delivery / Trial Milestone Alert -->
      <div class="tm-cart-free-shipping-box d-flex align-items-center justify-content-between flex-wrap gap-2">
        <div class="d-flex align-items-center gap-2">
          <i class="bi bi-check-circle-fill text-success fs-5"></i>
          <div>
            <div class="fw-bold text-navy small">Free Senior Home Fitting &amp; Doctor Fine-Tuning Unlocked!</div>
            <div class="text-muted" style="font-size: 0.775rem;">Your order qualifies for complimentary doorstep audiologist assessment in Noida &amp; NCR.</div>
          </div>
        </div>
        <span class="badge bg-success-subtle text-success border border-success-subtle py-1 px-2 fw-bold">FREE DELIVERY</span>
      </div>

      <div class="row g-4">

        <!-- Cart Table (Left) -->
        <div class="col-lg-8">
          <div class="card rounded-3 border p-3 p-md-4 bg-white shadow-xs">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h5 class="fw-bold text-navy mb-0">Selected Hearing Products &amp; Services</h5>
              <span class="text-muted small"><i class="bi bi-shield-check text-success me-1"></i> Genuine Certified Devices</span>
            </div>

            <div class="table-responsive">
              <table class="table tm-cart-table align-middle">
                <thead>
                  <tr>
                    <th>Item Details</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th class="text-end">Remove</th>
                  </tr>
                </thead>
                <tbody id="tmCartPageTableBody">
                  @forelse ($items as $item)
                  <tr data-cart-row="{{ $item->id }}">
                    <td>
                      <div class="d-flex align-items-center gap-3">
                        <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="rounded-3 border bg-white p-1" style="width: 62px; height: 62px; object-fit: contain;">
                        <div>
                          <div class="fw-bold text-navy small mb-1">{{ $item->name }}</div>
                          <div class="text-muted" style="font-size: 0.75rem;">
                            {{ $item->isService() ? 'Clinical Service' : ($item->product?->brand?->name ?? SITE_SHORT) }}
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="fw-semibold text-navy">{{ inr($item->effective_price) }}</td>
                    <td>
                      <form method="POST" action="{{ route('cart.update', $item->id) }}" class="d-inline-flex align-items-center gap-1">
                        @csrf
                        @method('PATCH')
                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="50"
                               class="form-control form-control-sm text-center" style="width: 76px;"
                               onchange="this.form.submit()">
                      </form>
                    </td>
                    <td class="fw-bold text-orange">{{ inr($item->line_total) }}</td>
                    <td class="text-end">
                      <form method="POST" action="{{ route('cart.remove', $item->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-link text-danger p-0" title="Remove item">
                          <i class="bi bi-trash3 fs-5"></i>
                        </button>
                      </form>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="5" class="text-center py-5">
                      <i class="bi bi-cart-x text-muted d-block mb-2" style="font-size: 3rem;"></i>
                      <h6 class="fw-bold text-navy mb-1">Your Shopping Cart is Empty</h6>
                      <p class="text-secondary small mb-3">Add hearing devices, test packages, or batteries to start.</p>
                      <a href="{{ route('products') }}" class="tm-btn tm-btn-primary tm-btn-sm"><i class="bi bi-bag"></i> Shop Hearing Aids</a>
                      <a href="{{ route('diagnostic-services') }}" class="tm-btn tm-btn-outline-navy tm-btn-sm"><i class="bi bi-heart-pulse"></i> Diagnostic Tests</a>
                    </td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>

            <!-- Coupon Input & Quick Promos -->
            <div class="border-top pt-3 mt-3">
              <div class="row g-3 align-items-center justify-content-between">
                <div class="col-md-7">
                  <label class="form-label small fw-bold text-navy mb-1">Have a Doctor Referral or Promo Code?</label>
                  @if (session('coupon_code'))
                    <div class="d-flex align-items-center gap-2">
                      <span class="badge bg-success-subtle text-success border border-success-subtle py-2 px-3">
                        <i class="bi bi-tag-fill me-1"></i> {{ session('coupon_code') }} applied
                      </span>
                      <form method="POST" action="{{ route('cart.coupon.remove') }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-link text-danger p-0">Remove</button>
                      </form>
                    </div>
                  @else
                    <form method="POST" action="{{ route('cart.coupon.apply') }}" class="input-group input-group-sm">
                      @csrf
                      <input type="text" name="coupon_code" id="tmCartCouponInput" class="form-control" placeholder="Enter your promo code" required>
                      <button class="btn btn-dark tm-btn-sm" type="submit">Apply Code</button>
                    </form>
                  @endif
                </div>
                <div class="col-md-5 text-md-end">
                  <a href="{{ route('products') }}" class="tm-btn tm-btn-outline-navy tm-btn-sm"><i class="bi bi-plus-circle"></i> Add More Items</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Order Summary (Right) -->
        <div class="col-lg-4">
          <div class="tm-cart-summary-card sticky-top" style="top: 85px;">
            <h5 class="fw-bold text-navy mb-3 pb-2 border-bottom">Order Summary</h5>

            <div class="d-flex justify-content-between mb-2 small">
              <span class="text-secondary">Cart Subtotal:</span>
              <strong class="text-navy" id="tmCartSummarySubtotal">{{ inr($totals['subtotal']) }}</strong>
            </div>

            <div class="d-flex justify-content-between mb-2 small">
              <span class="text-secondary">Promotional Discount:</span>
              <strong class="text-success" id="tmCartSummaryDiscount">- {{ inr($totals['discount']) }}</strong>
            </div>

            <div class="d-flex justify-content-between mb-2 small">
              <span class="text-secondary">Doorstep Fitting &amp; Visit:</span>
              <strong class="text-success">{{ $totals['shippingCharge'] > 0 ? inr($totals['shippingCharge']) : 'FREE (Included)' }}</strong>
            </div>

            <div class="d-flex justify-content-between mb-2 small">
              <span class="text-secondary">GST / Taxes:</span>
              <strong class="text-muted">{{ $totals['taxAmount'] > 0 ? inr($totals['taxAmount']) : 'Included in Price' }}</strong>
            </div>

            <div class="d-flex justify-content-between mb-3 border-top pt-3 fs-5">
              <span class="fw-bold text-navy">Grand Total:</span>
              <span class="fw-bold text-orange" id="tmCartSummaryGrandTotal">{{ inr($totals['total']) }}</span>
            </div>

            @if ($items->isNotEmpty())
              <a href="{{ route('checkout.index') }}" class="tm-btn tm-btn-primary w-100 py-2 fs-6 mb-3">
                <i class="bi bi-lock-fill me-1"></i> Proceed to Checkout
              </a>
            @else
              <a href="{{ route('products') }}" class="tm-btn tm-btn-primary w-100 py-2 fs-6 mb-3">
                <i class="bi bi-bag me-1"></i> Browse Hearing Aids
              </a>
            @endif

            <!-- Clinical Guarantees -->
            <div class="bg-light rounded p-3 small text-secondary border">
              <div class="d-flex align-items-center gap-2 mb-2">
                <i class="bi bi-patch-check-fill text-orange"></i>
                <span>100% Genuine Brand Warranty (2-4 Yrs)</span>
              </div>
              <div class="d-flex align-items-center gap-2 mb-2">
                <i class="bi bi-people-fill text-orange"></i>
                <span>RCI Licensed Audiologist Fine-Tuning</span>
              </div>
              <div class="d-flex align-items-center gap-2">
                <i class="bi bi-arrow-repeat text-orange"></i>
                <span>7-Day Hassle-Free Trial Guarantee</span>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection
