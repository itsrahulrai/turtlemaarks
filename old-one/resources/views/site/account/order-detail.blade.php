@extends('site.layouts.app')

@section('title', 'Order ' . $order->order_number . ' — ' . SITE_NAME)

@section('content')

  <section class="tm-page-hero text-center position-relative">
    <div class="container">
      <nav aria-label="breadcrumb" class="d-inline-flex mb-2">
        <div class="tm-breadcrumb-pill">
          <a href="{{ route('home') }}"><i class="bi bi-house-door"></i> Home</a>
          <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
          <a href="{{ route('account.orders') }}">Orders</a>
          <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
          <span class="tm-breadcrumb-current" aria-current="page">{{ $order->order_number }}</span>
        </div>
      </nav>
      <h1 class="display-6 fw-bold text-white mb-1 font-heading">Order {{ $order->order_number }}</h1>
      <p class="text-white-50 mx-auto small mb-0">Placed {{ $order->created_at->format('d M Y, h:i A') }}</p>
    </div>
  </section>

  <section class="py-5 bg-light">
    <div class="container">
      <div class="row g-4">

        @include('site.partials.account-sidebar', ['active_tab' => 'orders'])

        <div class="col-lg-9">
          <div class="row g-4">

            <div class="col-lg-7">
              <div class="card rounded-4 border p-4 bg-white shadow-xs mb-4">
                <h6 class="fw-bold text-navy mb-3 border-bottom pb-2 font-heading">Items in this order</h6>
                @foreach ($order->items as $item)
                <div class="d-flex align-items-center gap-3 small mb-3">
                  <img src="{{ $item->image_url }}" alt="{{ $item->product_name }}" class="rounded-3 border bg-white p-1" style="width: 58px; height: 58px; object-fit: contain;">
                  <div class="flex-grow-1">
                    <strong class="text-navy d-block">{{ $item->product_name }}</strong>
                    <span class="text-muted">Qty {{ $item->quantity }} × {{ inr($item->price) }}</span>
                    @if ($item->variant_label)<div class="text-muted">{{ $item->variant_label }}</div>@endif
                  </div>
                  <span class="fw-semibold text-navy">{{ inr($item->total) }}</span>
                </div>
                @endforeach
              </div>

              <div class="card rounded-4 border p-4 bg-white shadow-xs">
                <h6 class="fw-bold text-navy mb-3 border-bottom pb-2 font-heading">Delivery &amp; Fitting Address</h6>
                <div class="small text-secondary">
                  <strong class="text-navy d-block">{{ $order->shipping_name }} &bull; {{ $order->shipping_phone }}</strong>
                  {{ $order->shipping_address_line1 }}@if ($order->shipping_address_line2), {{ $order->shipping_address_line2 }}@endif,
                  {{ $order->shipping_city }}, {{ $order->shipping_state }} — {{ $order->shipping_pincode }}
                </div>
                @if ($order->notes)
                  <div class="mt-3 p-3 bg-light rounded-3 small">
                    <strong class="text-navy d-block mb-1">Your note to the clinic</strong>
                    <span class="text-secondary">{{ $order->notes }}</span>
                  </div>
                @endif
              </div>
            </div>

            <div class="col-lg-5">
              <div class="card rounded-4 border p-4 bg-white shadow-xs mb-4">
                <h6 class="fw-bold text-navy mb-3 border-bottom pb-2 font-heading">Payment Summary</h6>
                <div class="d-flex justify-content-between small mb-2"><span class="text-secondary">Subtotal</span><strong class="text-navy">{{ inr($order->subtotal) }}</strong></div>
                @if ($order->discount_amount > 0)
                <div class="d-flex justify-content-between small mb-2"><span class="text-secondary">Discount{{ $order->coupon_code ? ' (' . $order->coupon_code . ')' : '' }}</span><strong class="text-success">- {{ inr($order->discount_amount) }}</strong></div>
                @endif
                <div class="d-flex justify-content-between small mb-2"><span class="text-secondary">Delivery &amp; Fitting</span><strong class="text-navy">{{ $order->shipping_charge > 0 ? inr($order->shipping_charge) : 'FREE' }}</strong></div>
                @if ($order->tax_amount > 0)
                <div class="d-flex justify-content-between small mb-2"><span class="text-secondary">Tax</span><strong class="text-navy">{{ inr($order->tax_amount) }}</strong></div>
                @endif
                <div class="d-flex justify-content-between border-top pt-3 mt-2 fs-6">
                  <span class="fw-bold text-navy">Total</span><span class="fw-bold text-orange">{{ inr($order->total) }}</span>
                </div>
                <div class="small text-muted mt-3">
                  {{ strtoupper($order->payment_method) }} &bull; {{ ucfirst($order->payment_status) }}
                </div>
              </div>

              <div class="card rounded-4 border p-4 bg-white shadow-xs">
                <h6 class="fw-bold text-navy mb-3 border-bottom pb-2 font-heading">Status</h6>
                <div class="mb-3">{!! $order->status_badge !!}</div>
                @if ($order->tracking_number)
                  <div class="small text-secondary mb-3">
                    {{ $order->shipping_partner ?: 'Courier' }} &bull; AWB <strong class="text-navy">{{ $order->tracking_number }}</strong>
                  </div>
                @endif
                <div class="d-grid gap-2">
                  <a href="{{ route('account.orders.invoice', $order->id) }}" class="tm-btn tm-btn-outline-navy tm-btn-sm"><i class="bi bi-file-earmark-pdf me-1"></i> Download Invoice</a>
                  @if ($order->canBeCancelled())
                  <form method="POST" action="{{ route('account.orders.cancel', $order->id) }}" onsubmit="return confirm('Cancel this order?');">
                    @csrf
                    <button class="tm-btn tm-btn-outline-danger tm-btn-sm w-100"><i class="bi bi-x-circle me-1"></i> Cancel Order</button>
                  </form>
                  @endif
                  <a href="tel:{{ $sitePhoneRaw ?? site_phone_raw() }}" class="tm-btn tm-btn-primary tm-btn-sm"><i class="bi bi-telephone-fill me-1"></i> Call Clinic</a>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
