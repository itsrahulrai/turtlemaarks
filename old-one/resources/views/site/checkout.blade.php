@extends('site.layouts.app')

@section('title', 'Checkout — ' . SITE_NAME)
@section('meta_description', 'Secure patient checkout for hearing aid orders and diagnostic appointments.')

@section('content')
@php
    $default = $addresses->firstWhere('is_default', true) ?? $addresses->first();
@endphp

  <!-- HERO BANNER -->
  <section class="tm-page-hero text-center position-relative">
    <div class="container">
      <nav aria-label="breadcrumb" class="d-inline-flex mb-2">
        <div class="tm-breadcrumb-pill">
          <a href="{{ route('home') }}"><i class="bi bi-house-door"></i> Home</a>
          <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
          <a href="{{ route('cart.index') }}">Cart</a>
          <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
          <span class="tm-breadcrumb-current" aria-current="page">Checkout</span>
        </div>
      </nav>
      <h1 class="display-6 fw-bold text-white mb-1 font-heading">Secure Checkout</h1>
      <p class="text-white-50 mx-auto small mb-0" style="max-width: 580px;">Complete your patient details and choose your delivery or in-clinic fitting preference.</p>
    </div>
  </section>

  <section class="py-5 bg-light">
    <div class="container">
      <form method="POST" action="{{ route('checkout.process') }}">
        @csrf
        <div class="row g-4">

          <!-- Checkout Form (Left) -->
          <div class="col-lg-8">
            <div class="card rounded-4 border p-4 p-md-5 bg-white shadow-xs">

              <h5 class="fw-bold text-navy mb-4"><i class="bi bi-person-lines-fill text-orange me-2"></i> Patient &amp; Delivery Information</h5>

              @if ($addresses->isNotEmpty())
              <div class="mb-4">
                <label class="form-label small fw-bold text-navy">Use a saved address</label>
                <select class="form-select" id="tmSavedAddressSelect">
                  <option value="">— Enter a new address below —</option>
                  @foreach ($addresses as $addr)
                    <option value="{{ $addr->id }}"
                            data-name="{{ $addr->name }}" data-phone="{{ $addr->phone }}"
                            data-line1="{{ $addr->address_line1 }}" data-line2="{{ $addr->address_line2 }}"
                            data-city="{{ $addr->city }}" data-state="{{ $addr->state }}" data-pincode="{{ $addr->pincode }}"
                            @selected($default && $default->id === $addr->id)>
                      {{ ucfirst($addr->type ?? 'home') }} — {{ $addr->address_line1 }}, {{ $addr->city }} {{ $addr->pincode }}
                    </option>
                  @endforeach
                </select>
              </div>
              @endif

              <div class="row g-3 mb-4">

                <div class="col-md-6">
                  <label class="form-label small fw-bold text-navy">Patient / Buyer Full Name *</label>
                  <input type="text" name="shipping_name" class="form-control" required
                         value="{{ old('shipping_name', $default->name ?? auth()->user()->name) }}"
                         placeholder="e.g. Ramesh Chandra">
                </div>

                <div class="col-md-6">
                  <label class="form-label small fw-bold text-navy">WhatsApp / Mobile Number *</label>
                  <input type="tel" name="shipping_phone" class="form-control" required
                         value="{{ old('shipping_phone', $default->phone ?? auth()->user()->phone) }}"
                         placeholder="10-digit mobile number">
                </div>

                <div class="col-md-6">
                  <label class="form-label small fw-bold text-navy">Email Address</label>
                  <input type="email" class="form-control" value="{{ auth()->user()->email }}" readonly>
                </div>

                <div class="col-md-6">
                  <label class="form-label small fw-bold text-navy">City / Area *</label>
                  <input type="text" name="shipping_city" class="form-control" required
                         value="{{ old('shipping_city', $default->city ?? 'Greater Noida West') }}">
                </div>

                <div class="col-12">
                  <label class="form-label small fw-bold text-navy">
                    Address Line 1 * <span class="text-muted fw-normal">(House/Flat No., Building Name)</span>
                  </label>
                  <input type="text" name="shipping_address_line1" class="form-control" required
                         value="{{ old('shipping_address_line1', $default->address_line1 ?? '') }}"
                         placeholder="e.g. Flat 402, Riviera Tower, Gaur City 2">
                </div>

                <div class="col-12">
                  <label class="form-label small fw-bold text-navy">
                    Address Line 2 <span class="text-muted fw-normal">(Sector / Society / Landmark — Optional)</span>
                  </label>
                  <input type="text" name="shipping_address_line2" class="form-control"
                         value="{{ old('shipping_address_line2', $default->address_line2 ?? '') }}"
                         placeholder="e.g. Near Lotus Pond, Sector 16C, Greater Noida West">
                </div>

                <div class="col-md-6">
                  <label class="form-label small fw-bold text-navy">State *</label>
                  <input type="text" name="shipping_state" class="form-control" required
                         value="{{ old('shipping_state', $default->state ?? 'Uttar Pradesh') }}">
                </div>

                <div class="col-md-6">
                  <label class="form-label small fw-bold text-navy">PIN Code *</label>
                  <input type="text" name="shipping_pincode" class="form-control" required inputmode="numeric"
                         pattern="[0-9]{6}" maxlength="6"
                         value="{{ old('shipping_pincode', $default->pincode ?? '') }}"
                         placeholder="e.g. 201306">
                </div>

                <div class="col-12">
                  <label class="form-label small fw-bold text-navy">Notes for the audiologist (optional)</label>
                  <textarea name="notes" rows="2" class="form-control" placeholder="e.g. Senior citizen — please call before the home visit">{{ old('notes') }}</textarea>
                </div>

              </div>

              <!-- PAYMENT METHOD -->
              <h5 class="fw-bold text-navy mb-3">
                <i class="bi bi-credit-card-2-front-fill text-orange me-2"></i> Payment Method
              </h5>

              <div class="d-flex flex-column gap-3 mb-4">

                <!-- Razorpay -->
                <div class="p-3 border rounded-3 d-flex align-items-start gap-3 tm-pay-card" id="payCardRazorpay"
                     onclick="tmSelectPayment('payRazorpay', this)"
                     style="cursor:pointer; border-color:#FF6B00 !important; background:#FFF8F3;">
                  <input type="radio" name="payment_method" value="razorpay" id="payRazorpay" checked class="form-check-input mt-1 flex-shrink-0">
                  <label for="payRazorpay" class="mb-0 w-100" style="cursor:pointer;">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-1">
                      <span class="fw-bold text-navy small">
                        <i class="bi bi-lightning-charge-fill text-warning me-1"></i> Pay Online via Razorpay
                      </span>
                      <div class="d-flex gap-1 flex-wrap">
                        <span class="badge bg-light border text-secondary fw-semibold" style="font-size:0.67rem;">UPI</span>
                        <span class="badge bg-light border text-secondary fw-semibold" style="font-size:0.67rem;">Cards</span>
                        <span class="badge bg-light border text-secondary fw-semibold" style="font-size:0.67rem;">Net Banking</span>
                        <span class="badge bg-light border text-secondary fw-semibold" style="font-size:0.67rem;">EMI</span>
                      </div>
                    </div>
                    <div class="small text-muted fw-normal">
                      Secure 256-bit encrypted gateway. Instant confirmation &amp; GST invoice.
                    </div>
                  </label>
                </div>

                <!-- Cash on Delivery -->
                <div class="p-3 border rounded-3 bg-white d-flex align-items-start gap-3 tm-pay-card" id="payCardCOD"
                     onclick="tmSelectPayment('payCOD', this)" style="cursor:pointer;">
                  <input type="radio" name="payment_method" value="cod" id="payCOD" class="form-check-input mt-1 flex-shrink-0">
                  <label for="payCOD" class="mb-0 w-100" style="cursor:pointer;">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-1">
                      <span class="fw-bold text-navy small">
                        <i class="bi bi-cash-stack text-success me-1"></i> Cash on Delivery
                      </span>
                      <span class="badge bg-success-subtle text-success border border-success-subtle" style="font-size:0.67rem;">
                        No Advance Required
                      </span>
                    </div>
                    <div class="small text-muted fw-normal">
                      Pay cash or UPI at your doorstep when our audiologist arrives. Device trial before payment.
                    </div>
                  </label>
                </div>

              </div>

              <button type="submit" class="tm-btn tm-btn-primary tm-btn-lg w-100">
                <i class="bi bi-check2-circle me-1"></i> Place Order
              </button>

            </div>
          </div>

          <!-- Summary (Right) -->
          <div class="col-lg-4">
            <div class="card rounded-4 border p-4 bg-white shadow-xs sticky-top tm-checkout-summary-card" style="top: 85px;">
              <h5 class="fw-bold text-navy mb-3">Order Items</h5>
              <div id="tmCheckoutItemsList" class="mb-3 border-bottom pb-2">
                @foreach ($items as $item)
                  <div class="d-flex justify-content-between align-items-center mb-2 small">
                    <div>
                      <strong class="text-navy">{{ $item->name }}</strong>
                      <div class="text-muted" style="font-size:0.75rem;">Qty: {{ $item->quantity }} × {{ inr($item->effective_price) }}</div>
                    </div>
                    <span class="fw-bold text-navy">{{ inr($item->line_total) }}</span>
                  </div>
                @endforeach
              </div>
              <div class="d-flex justify-content-between mb-2 small text-secondary">
                <span>Subtotal:</span>
                <strong class="text-navy" id="tmCheckoutSubtotal">{{ inr($totals['subtotal']) }}</strong>
              </div>
              @if ($totals['discount'] > 0)
              <div class="d-flex justify-content-between mb-2 small text-secondary">
                <span>Discount{{ session('coupon_code') ? ' (' . session('coupon_code') . ')' : '' }}:</span>
                <strong class="text-success">- {{ inr($totals['discount']) }}</strong>
              </div>
              @endif
              <div class="d-flex justify-content-between mb-2 small text-secondary">
                <span>Home Delivery &amp; Fitting:</span>
                <strong class="text-success">{{ $totals['shippingCharge'] > 0 ? inr($totals['shippingCharge']) : 'FREE' }}</strong>
              </div>
              <div class="d-flex justify-content-between mb-3 border-top pt-3 fs-5">
                <span class="fw-bold text-navy">Total Payable:</span>
                <span class="fw-bold text-orange" id="tmCheckoutGrandTotal">{{ inr($totals['total']) }}</span>
              </div>
              <div class="small text-muted bg-light p-3 rounded-3">
                <i class="bi bi-shield-check text-success me-1"></i> Includes Official Manufacturer Warranty, Calibration Slip &amp; GST Invoice.
              </div>
            </div>
          </div>

        </div>
      </form>
    </div>
  </section>
@endsection

@push('scripts')
<script>
  function tmSelectPayment(radioId, card) {
    document.querySelectorAll('.tm-pay-card').forEach(c => {
      c.style.borderColor = '';
      c.style.background = '#FFFFFF';
    });
    document.getElementById(radioId).checked = true;
    card.style.borderColor = '#FF6B00';
    card.style.background = '#FFF8F3';
  }

  /* Fill the delivery fields from a saved address */
  (function () {
    const select = document.getElementById('tmSavedAddressSelect');
    if (!select) return;

    const apply = () => {
      const opt = select.selectedOptions[0];
      if (!opt || !opt.value) return;
      const map = {
        shipping_name: 'name',
        shipping_phone: 'phone',
        shipping_address_line1: 'line1',
        shipping_address_line2: 'line2',
        shipping_city: 'city',
        shipping_state: 'state',
        shipping_pincode: 'pincode'
      };
      Object.entries(map).forEach(([field, key]) => {
        const input = document.querySelector('[name="' + field + '"]');
        if (input) input.value = opt.dataset[key] || '';
      });
    };

    select.addEventListener('change', apply);
  })();
</script>
@endpush
