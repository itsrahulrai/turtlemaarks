@extends('site.layouts.app')

@section('title', 'Track Order & Calibration — ' . SITE_NAME)
@section('meta_description', 'Live order fulfillment and audiologist calibration tracker for your digital hearing aids.')

@section('content')
@php
    /** Fulfilment stages mapped onto the order status stored by the admin panel. */
    $stages = [
        ['key' => 'placed',    'label' => 'Order Placed',        'icon' => 'bi-check2',      'statuses' => ['pending', 'confirmed', 'processing', 'shipped', 'out_for_delivery', 'delivered']],
        ['key' => 'calibrated','label' => 'PTA Calibration',     'icon' => 'bi-soundwave',   'statuses' => ['processing', 'shipped', 'out_for_delivery', 'delivered']],
        ['key' => 'fitting',   'label' => 'Out for Fitting',     'icon' => 'bi-truck',       'statuses' => ['shipped', 'out_for_delivery', 'delivered']],
        ['key' => 'delivered', 'label' => 'Delivered & Verified','icon' => 'bi-house-check', 'statuses' => ['delivered']],
    ];
@endphp

  <!-- HERO BANNER -->
  <section class="tm-page-hero text-center position-relative">
    <div class="container">
      <nav aria-label="breadcrumb" class="d-inline-flex mb-2">
        <div class="tm-breadcrumb-pill">
          <a href="{{ route('home') }}"><i class="bi bi-house-door"></i> Home</a>
          <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
          <span class="tm-breadcrumb-current" aria-current="page">Order Tracking</span>
        </div>
      </nav>
      <h1 class="display-6 fw-bold text-white mb-2 font-heading">Order &amp; Calibration Tracking</h1>
      <p class="text-white-50 mx-auto small mb-0" style="max-width: 580px;">Real-time fulfillment, lab acoustic calibration, and doorstep delivery updates.</p>
    </div>
  </section>

  <section class="py-5 bg-light">
    <div class="container">

      <!-- Lookup form -->
      <div class="card rounded-4 border p-4 bg-white shadow-xs mx-auto mb-4" style="max-width: 760px;">
        <form method="GET" action="{{ route('order.tracking') }}" class="row g-2 align-items-end">
          <div class="col-md-8">
            <label class="form-label small fw-bold text-navy mb-1">Enter your Order Number</label>
            <input type="text" name="order" value="{{ request('order') }}" class="form-control"
                   placeholder="e.g. GW-A1B2C3-20260831" required>
          </div>
          <div class="col-md-4">
            <button type="submit" class="tm-btn tm-btn-primary w-100"><i class="bi bi-search me-1"></i> Track Order</button>
          </div>
        </form>
        @auth
          <div class="small text-muted mt-2">
            Signed in as {{ auth()->user()->name }} — you can also see every order in your
            <a href="{{ route('account.orders') }}" class="fw-bold text-orange text-decoration-none">patient portal</a>.
          </div>
        @endauth
      </div>

      @if (request()->filled('order') && !$order)
        <div class="alert alert-warning small mx-auto" style="max-width: 760px;">
          <i class="bi bi-exclamation-triangle-fill me-1"></i>
          We couldn't find an order with that number. Please check the number on your confirmation email, or call {{ $sitePhone ?? site_phone() }}.
        </div>
      @endif

      @if ($order)
      <div class="card rounded-4 border p-4 p-md-5 bg-white shadow-xs mx-auto" style="max-width: 760px;">
        <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4 flex-wrap gap-2">
          <div>
            <h5 class="fw-bold text-navy mb-0">Order Tracking: {{ $order->order_number }}</h5>
            <span class="small text-muted">
              {{ $order->items->pluck('product_name')->implode(', ') }}
            </span>
          </div>
          <span>{!! $order->status_badge !!}</span>
        </div>

        <!-- 4-Stage Tracker -->
        <div class="row text-center g-2 mb-4">
          @foreach ($stages as $stage)
            @php $done = in_array($order->status, $stage['statuses'], true); @endphp
            <div class="col-3">
              <div class="badge {{ $done ? 'bg-success text-white' : 'bg-light text-muted border' }} rounded-circle p-3 mb-2">
                <i class="bi {{ $stage['icon'] }}"></i>
              </div>
              <div class="small {{ $done ? 'fw-bold text-navy' : 'text-muted' }}">{{ $stage['label'] }}</div>
              <span class="text-muted" style="font-size: 0.7rem;">
                {{ $loop->first ? $order->created_at->format('M d, h:i A') : ($done ? 'Completed' : 'Pending') }}
              </span>
            </div>
          @endforeach
        </div>

        @if ($order->tracking_number)
        <div class="p-3 bg-light rounded-3 small mb-3">
          <strong class="text-navy d-block mb-1">Shipment Tracking</strong>
          <span class="text-secondary">
            {{ $order->shipping_partner ?: 'Courier' }} &bull; AWB {{ $order->tracking_number }}
          </span>
        </div>
        @endif

        <div class="p-3 bg-light rounded-3 small">
          <strong class="text-navy d-block mb-1">Delivery &amp; Fitting Address:</strong>
          <p class="text-secondary mb-0">
            {{ $order->shipping_name }}, {{ $order->shipping_address_line1 }}
            @if ($order->shipping_address_line2), {{ $order->shipping_address_line2 }}@endif,
            {{ $order->shipping_city }}, {{ $order->shipping_state }} — {{ $order->shipping_pincode }}
          </p>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
          @auth
            @if ($order->user_id === auth()->id())
              <a href="{{ route('account.orders.show', $order->id) }}" class="tm-btn tm-btn-outline-navy tm-btn-sm">
                <i class="bi bi-receipt me-1"></i> Full Order Details
              </a>
            @endif
          @endauth
          <a href="tel:{{ $sitePhoneRaw ?? site_phone_raw() }}" class="tm-btn tm-btn-primary tm-btn-sm">
            <i class="bi bi-telephone-fill me-1"></i> Call Clinic
          </a>
        </div>
      </div>
      @endif

    </div>
  </section>
@endsection
