@extends('site.layouts.layout')

@section('title', 'Order Confirmed')

@section('content')

<section class="py-5" style="background:#f5f7fb;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                    {{-- Top banner --}}
                    <div class="order-success-banner">
                        <div class="order-success-icon">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <h4 class="text-white fw-bold mt-3 mb-2">Order Confirmed</h4>
                        <p class="mb-0" style="color:rgba(255,255,255,.85);font-size:.9rem;">
                            Thank you! Your order has been placed successfully.<br>
                            A confirmation email is on its way to your inbox.
                        </p>
                    </div>

                    <div class="card-body p-4">

                        {{-- Order number --}}
                        <div class="text-center mb-4">
                            <div class="text-muted" style="font-size:.8rem;letter-spacing:.5px;">ORDER NUMBER</div>
                            <div class="fw-bold" style="font-size:1.4rem;color:var(--tm-navy);">#{{ $order->order_number }}</div>
                        </div>

                        {{-- Items --}}
                        <div class="border rounded-4 p-3 mb-3" style="background:#fff;">
                            <h6 class="fw-bold mb-3" style="color:var(--tm-navy);">
                                <i class="bi bi-bag-check me-2"></i>Order Items
                            </h6>
                            @foreach($order->items as $item)
                            <div class="d-flex justify-content-between align-items-center @if(!$loop->last) mb-3 pb-3 border-bottom @endif">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ $item->product_image ? asset('storage/'.$item->product_image) : asset('assets/img/no-image.jpg') }}"
                                         style="width:48px;height:48px;object-fit:cover;border-radius:8px;" alt="">
                                    <div>
                                        <div class="fw-semibold" style="font-size:.9rem;">{{ $item->product_name }}</div>
                                        @if($item->variant_label)
                                        <small class="text-muted d-block">{{ $item->variant_label }}</small>
                                        @endif
                                        <small class="text-muted">Qty: {{ $item->quantity }}</small>
                                    </div>
                                </div>
                                <div class="fw-bold" style="color:var(--tm-navy);font-size:.95rem;">
                                    ₹{{ number_format($item->total) }}
                                </div>
                            </div>
                            @endforeach
                        </div>

                        {{-- Payment info — rendered once, not per item --}}
                        <div class="border rounded-4 p-3 mb-3" style="background:#fff;">
                            <h6 class="fw-bold mb-3" style="color:var(--tm-navy);">
                                <i class="bi bi-credit-card me-2"></i>Payment Information
                            </h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <small class="text-muted d-block">Payment Method</small>
                                    <strong>{{ ucfirst($order->payment_method) }}</strong>
                                </div>
                                <div class="col-md-6">
                                    <small class="text-muted d-block">Payment Status</small>
                                    @if($order->payment_status == 'paid')
                                        <span class="badge bg-success">Paid</span>
                                    @elseif($order->payment_status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($order->payment_status == 'failed')
                                        <span class="badge bg-danger">Failed</span>
                                    @elseif($order->payment_status == 'refunded')
                                        <span class="badge bg-secondary">Refunded</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($order->payment_status) }}</span>
                                    @endif
                                </div>

                                @if($order->payment)
                                <div class="col-md-6">
                                    <small class="text-muted d-block">Transaction ID</small>
                                    <strong>{{ $order->payment->payment_id ?? '-' }}</strong>
                                </div>
                                <div class="col-md-6">
                                    <small class="text-muted d-block">Razorpay Order ID</small>
                                    <strong>{{ $order->payment->razorpay_order_id ?? '-' }}</strong>
                                </div>
                                <div class="col-md-6">
                                    <small class="text-muted d-block">Amount Paid</small>
                                    <strong class="text-success">₹{{ number_format($order->payment->amount) }}</strong>
                                </div>
                                <div class="col-md-6">
                                    <small class="text-muted d-block">Paid On</small>
                                    <strong>{{ optional($order->payment->paid_at)->format('d M Y, h:i A') ?? '-' }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>

                        {{-- Shipping address --}}
                        <div class="border rounded-4 p-3 mb-4" style="background:#fff;">
                            <h6 class="fw-bold mb-2" style="color:var(--tm-navy);">
                                <i class="bi bi-geo-alt me-2"></i>Shipping Address
                            </h6>
                            <div style="font-size:.88rem;color:#495057;">
                                {{ $order->shipping_name }} · {{ $order->shipping_phone }}<br>
                                {{ $order->shipping_address_line1 }}{{ $order->shipping_address_line2 ? ', '.$order->shipping_address_line2 : '' }}<br>
                                {{ $order->shipping_city }}, {{ $order->shipping_state }} - {{ $order->shipping_pincode }}
                            </div>
                        </div>

                        {{-- Total --}}
                        <div class="d-flex justify-content-between align-items-center px-1 mb-4">
                            <span class="fw-bold">Total Paid</span>
                            <span class="fw-bold" style="color:#198754;font-size:1.25rem;">₹{{ number_format($order->total) }}</span>
                        </div>

                        {{-- Actions --}}
                        <div class="text-center d-flex flex-column flex-sm-row gap-2 justify-content-center">
                            <a href="{{ route('shop') }}" class="btn btn-primary px-4 py-2 rounded fw-bold">
                                <i class="bi bi-bag me-2"></i>Continue Shopping
                            </a>
                            <a href="{{ route('account.orders.show', $order) }}" class="btn btn-outline-secondary px-4 py-2 rounded fw-bold">
                                <i class="bi bi-receipt me-2"></i>View Order
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
