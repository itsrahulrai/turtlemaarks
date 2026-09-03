@extends('site.layouts.app')

@section('title', 'My Orders — ' . SITE_NAME)
@section('meta_description', 'Track your Turtle Maarks hearing aid orders, invoices and fulfilment status.')

@section('content')

  <section class="tm-page-hero text-center position-relative">
    <div class="container">
      <nav aria-label="breadcrumb" class="d-inline-flex mb-2">
        <div class="tm-breadcrumb-pill">
          <a href="{{ route('home') }}"><i class="bi bi-house-door"></i> Home</a>
          <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
          <a href="{{ route('account.dashboard') }}">Account</a>
          <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
          <span class="tm-breadcrumb-current" aria-current="page">Orders</span>
        </div>
      </nav>
      <h1 class="display-6 fw-bold text-white mb-1 font-heading">My Orders &amp; Invoices</h1>
      <p class="text-white-50 mx-auto small mb-0" style="max-width: 580px;">Every hearing device order, calibration status, and GST invoice in one place.</p>
    </div>
  </section>

  <section class="py-5 bg-light">
    <div class="container">
      <div class="row g-4">

        @include('site.partials.account-sidebar', ['active_tab' => 'orders'])

        <div class="col-lg-9">

          <!-- Status filter -->
          <div class="card rounded-4 border p-3 bg-white shadow-xs mb-4">
            <form method="GET" action="{{ route('account.orders') }}" class="d-flex flex-wrap align-items-center gap-2">
              <span class="small fw-bold text-navy me-1">Filter:</span>
              @foreach (['' => 'All', 'pending' => 'Pending', 'processing' => 'Processing', 'shipped' => 'Shipped', 'delivered' => 'Delivered', 'cancelled' => 'Cancelled'] as $val => $label)
                <a href="{{ route('account.orders', $val ? ['status' => $val] : []) }}"
                   class="badge rounded-pill px-3 py-2 text-decoration-none {{ request('status', '') === $val ? 'bg-orange text-white' : 'bg-light text-navy border' }}">
                  {{ $label }}
                </a>
              @endforeach
            </form>
          </div>

          @forelse ($orders as $order)
          <div class="card rounded-4 border p-4 bg-white shadow-xs mb-3">
            <div class="d-flex flex-wrap justify-content-between align-items-center border-bottom pb-3 mb-3 gap-2">
              <div>
                <span class="small text-muted">Order <strong class="text-navy">{{ $order->order_number }}</strong></span>
                <div class="small text-muted">Placed {{ $order->created_at->format('d M Y, h:i A') }}</div>
              </div>
              <div class="text-end">
                {!! $order->status_badge !!}
                <div class="fw-bold text-orange mt-1">{{ inr($order->total) }}</div>
              </div>
            </div>

            <div class="d-flex flex-column gap-2 mb-3">
              @foreach ($order->items as $item)
              <div class="d-flex align-items-center gap-3 small">
                <img src="{{ $item->image_url }}" alt="{{ $item->product_name }}" class="rounded-3 border bg-white p-1" style="width: 52px; height: 52px; object-fit: contain;">
                <div class="flex-grow-1">
                  <strong class="text-navy d-block">{{ $item->product_name }}</strong>
                  <span class="text-muted">Qty {{ $item->quantity }} × {{ inr($item->price) }}</span>
                </div>
                <span class="fw-semibold text-navy">{{ inr($item->total) }}</span>
              </div>
              @endforeach
            </div>

            <div class="d-flex flex-wrap justify-content-end gap-2 border-top pt-3">
              <a href="{{ route('account.orders.show', $order->id) }}" class="tm-btn tm-btn-outline-navy tm-btn-sm">
                <i class="bi bi-eye me-1"></i> View Details
              </a>
              <a href="{{ route('account.orders.invoice', $order->id) }}" class="tm-btn tm-btn-outline-navy tm-btn-sm">
                <i class="bi bi-file-earmark-pdf me-1"></i> Invoice
              </a>
              @if ($order->canBeCancelled())
              <form method="POST" action="{{ route('account.orders.cancel', $order->id) }}" onsubmit="return confirm('Cancel this order?');">
                @csrf
                <button class="tm-btn tm-btn-outline-danger tm-btn-sm"><i class="bi bi-x-circle me-1"></i> Cancel</button>
              </form>
              @endif
            </div>
          </div>
          @empty
          <div class="card rounded-4 border p-5 bg-white shadow-xs text-center">
            <i class="bi bi-bag-x text-muted fs-1 mb-2"></i>
            <h5 class="fw-bold text-navy mb-1">No orders found</h5>
            <p class="small text-secondary mb-3">Once you order a hearing device or accessory it will appear here with live calibration status.</p>
            <div><a href="{{ route('products') }}" class="tm-btn tm-btn-primary tm-btn-sm">Browse Hearing Aids</a></div>
          </div>
          @endforelse

          <div class="mt-4">{{ $orders->links() }}</div>

        </div>
      </div>
    </div>
  </section>
@endsection
