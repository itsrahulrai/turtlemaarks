@extends('site.layouts.layout')
@section('title', 'My Account')
@section('content')
<div class="account-area">
<div class="container">
    <div class="row g-4">
        <div class="col-lg-3">
            @include('customer.partials.sidebar')
        </div>

        <div class="col-lg-9">
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="account-stat-card navy">
                        <i class="bi bi-box-seam stat-icon"></i>
                        <div class="stat-value">{{ $totalOrders }}</div>
                        <div class="stat-label">Total Orders</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="account-stat-card orange">
                        <i class="bi bi-wallet2 stat-icon"></i>
                        <div class="stat-value">₹{{ number_format($totalSpent, 0) }}</div>
                        <div class="stat-label">Total Spent</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="account-stat-card navy">
                        <i class="bi bi-heart stat-icon"></i>
                        <div class="stat-value">{{ $wishlistCount }}</div>
                        <div class="stat-label">Wishlist Items</div>
                    </div>
                </div>
            </div>

            <div class="account-panel">
                <div class="account-panel-header">
                    <h6>Recent Orders</h6>
                    <a href="{{ route('account.orders') }}">View All</a>
                </div>
                @forelse($recentOrders as $order)
                <div class="account-order-row">
                    <div>
                        <div class="order-number">#{{ $order->order_number }}</div>
                        <div class="order-meta">{{ $order->created_at->format('d M Y') }} &middot; {{ $order->items->count() }} items</div>
                    </div>
                    <div class="text-end">
                        <div class="order-total">₹{{ number_format($order->total, 2) }}</div>
                        {!! $order->status_badge !!}
                    </div>
                    <a href="{{ route('account.orders.show', $order) }}" class="btn btn-sm btn-light" style="border-radius:8px;font-size:.78rem;">View</a>
                </div>
                @empty
                <div class="account-empty">
                    <i class="bi bi-bag-x"></i>
                    No orders yet. <a href="{{ route('shop') }}" style="color:var(--tm-orange);font-weight:600;">Start shopping!</a>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
</div>
@endsection
