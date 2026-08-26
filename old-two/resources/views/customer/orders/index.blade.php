@extends('site.layouts.layout')
@section('title', 'My Orders')
@section('content')
<div class="account-area">
<div class="container">
    <div class="row g-4">
        <div class="col-lg-3">
            @include('customer.partials.sidebar')
        </div>
        <div class="col-lg-9">
            <div class="account-panel">
                <div class="account-panel-header">
                    <h6>My Orders</h6>
                </div>
                @forelse($orders as $order)
                <div class="p-4 border-bottom">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                        <div>
                            <div class="order-number">#{{ $order->order_number }}</div>
                            <div class="order-meta">{{ $order->created_at->format('d M Y, h:i A') }}</div>
                        </div>
                        <div class="d-flex gap-2 align-items-center">
                            {!! $order->status_badge !!}
                            <span class="badge {{ $order->payment_status === 'paid' ? 'bg-success' : 'bg-warning text-dark' }}">{{ ucfirst($order->payment_status) }}</span>
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-3 flex-wrap">
                        @foreach($order->items->take(4) as $item)
                        <img src="{{ $item->image_url }}" style="width:48px;height:48px;object-fit:cover;border-radius:8px;border:1px solid var(--tm-border);">
                        @endforeach
                        @if($order->items->count() > 4)
                        <div style="width:48px;height:48px;border-radius:8px;border:1px solid var(--tm-border);display:flex;align-items:center;justify-content:center;font-size:.75rem;color:var(--tm-muted);">+{{ $order->items->count() - 4 }}</div>
                        @endif
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="order-total">₹{{ number_format($order->total, 2) }}</div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('account.orders.show', $order) }}" class="btn btn-sm" style="border-radius:8px;font-size:.8rem;border:1px solid var(--tm-navy);color:var(--tm-navy);">View Details</a>
                            @if($order->canBeCancelled())
                            <form method="POST" action="{{ route('account.orders.cancel', $order) }}" onsubmit="return confirm('Cancel this order?')">
                                @csrf
                                <button class="btn btn-sm btn-outline-danger" style="border-radius:8px;font-size:.8rem;">Cancel</button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="account-empty">
                    <i class="bi bi-bag-x"></i>
                    No orders found
                    <div class="mt-2"><a href="{{ route('shop') }}" class="account-btn-primary d-inline-block text-decoration-none">Start Shopping</a></div>
                </div>
                @endforelse
            </div>
            <div class="mt-3">{{ $orders->links() }}</div>
        </div>
    </div>
</div>
</div>
@endsection
