@extends('site.layouts.app')

@section('title', 'Order Confirmation — ' . SITE_NAME)
@section('meta_description', 'Order confirmation and fulfillment tracker for your Turtle Maarks hearing aid order.')

@section('content')
<section class="py-5 bg-light">
  <div class="container text-center">
    <div class="card rounded-4 border p-4 p-md-5 bg-white shadow-sm mx-auto" style="max-width: 720px;">
      <div class="bg-success-subtle text-success rounded-circle d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width: 78px; height: 78px;">
        <i class="bi bi-check2-circle fs-1"></i>
      </div>
      <h3 class="fw-bold text-navy mb-1">Thank You! Order Confirmed</h3>
      <p class="text-secondary small mb-4">Your order has been logged. Our certified audiologist is preparing your calibration parameters.</p>

      <div class="card rounded-3 border bg-light p-3 text-start small mb-4">
        <div class="d-flex justify-content-between mb-2">
          <span class="text-muted">Order ID:</span>
          <strong class="text-orange" id="tmOrderId">{{ $order->order_number }}</strong>
        </div>
        <div class="d-flex justify-content-between mb-2">
          <span class="text-muted">Order Status:</span>
          <span>{!! $order->status_badge !!}</span>
        </div>
        <div class="d-flex justify-content-between mb-2">
          <span class="text-muted">Payment:</span>
          <strong class="text-navy">{{ strtoupper($order->payment_method) }} &bull; {{ ucfirst($order->payment_status) }}</strong>
        </div>
        <div class="d-flex justify-content-between mb-2">
          <span class="text-muted">Amount Payable:</span>
          <strong class="text-navy">{{ inr($order->total) }}</strong>
        </div>
        <div class="d-flex justify-content-between mb-0">
          <span class="text-muted">Delivery &amp; Fitting Address:</span>
          <strong class="text-navy text-end ps-3">{{ $order->shipping_address_line1 }}, {{ $order->shipping_city }} {{ $order->shipping_pincode }}</strong>
        </div>
      </div>

      <!-- Ordered items -->
      <div class="card rounded-3 border p-3 text-start small mb-4">
        <h6 class="fw-bold text-navy mb-3 border-bottom pb-2">Items in this order</h6>
        @foreach ($order->items as $item)
        <div class="d-flex justify-content-between align-items-center mb-2">
          <div>
            <strong class="text-navy">{{ $item->product_name }}</strong>
            <div class="text-muted" style="font-size: 0.75rem;">Qty: {{ $item->quantity }} × {{ inr($item->price) }}</div>
          </div>
          <span class="fw-bold text-navy">{{ inr($item->total) }}</span>
        </div>
        @endforeach
      </div>

      <div class="d-flex justify-content-center flex-wrap gap-2">
        <button class="tm-btn tm-btn-primary tm-btn-sm" onclick="window.print()"><i class="bi bi-printer"></i> Print Receipt</button>
        <a href="{{ route('account.orders.show', $order->id) }}" class="tm-btn tm-btn-navy tm-btn-sm"><i class="bi bi-truck"></i> Track Order</a>
        <a href="{{ route('home') }}" class="tm-btn tm-btn-outline-navy tm-btn-sm">Return to Home</a>
      </div>
    </div>
  </div>
</section>
@endsection
