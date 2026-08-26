@extends('site.layouts.layout')
@section('title', 'Shopping Cart')

@section('content')
<div class="breadcrumb-kkt">
    <div class="container">
        <nav><ol class="breadcrumb mb-0" style="font-size:.84rem;">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Cart</li>
        </ol></nav>
    </div>
</div>

<section class="py-5">
    <div class="container">
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if($items->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-bag-x" style="font-size:4rem;color:#e9ecef;display:block;"></i>
            <h4 class="mt-3 fw-700" style="color:var(--tm-navy);">Your cart is empty</h4>
            <p class="text-muted">Looks like you haven't added anything yet.</p>
            <a href="{{ route('shop') }}" class="btn btn-primary px-4 mt-2">Start Shopping</a>
        </div>
        @else
        <div class="row g-4">
            <div class="col-lg-8">
               <div class="table-responsive" style="background:#fff;border-radius:14px;border:1px solid var(--tm-border);overflow-x:auto;-webkit-overflow-scrolling:touch;">
                     <table class="table mb-0" style="min-width:700px;">
                        <thead style="background:var(--tm-navy-tint);" class="cart-table-head">
                            <tr>
                                <th style="padding:16px;font-size:.8rem;text-transform:uppercase;">Product</th>
                                <th style="padding:16px;font-size:.8rem;text-transform:uppercase;">Price</th>
                                <th style="padding:16px;font-size:.8rem;text-transform:uppercase;">Qty</th>
                                <th style="padding:16px;font-size:.8rem;text-transform:uppercase;">Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="cart-items-body">
                            @foreach($items as $item)
                            <tr id="cart-row-{{ $item->id }}" data-price="{{ $item->effective_price }}">
                                <td style="padding:16px;">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{ $item->image_url }}" style="width:60px;height:60px;object-fit:cover;border-radius:10px;" onerror="this.onerror=null;this.src='{{ base_public_url('assets/img/no-image.jpg') }}';">
                                        <div>
                                            @if($item->isService())
                                                <span style="font-weight:600;font-size:.9rem;color:var(--tm-text);">{{ $item->service->name }}</span>
                                                <div style="font-size:.78rem;color:#6c757d;">Service</div>
                                            @else
                                                <a href="{{ route('product.show', $item->product->slug) }}" class="text-decoration-none" style="font-weight:600;font-size:.9rem;color:var(--tm-text);">{{ $item->product->name }}</a>
                                                @if($item->productVariant)
                                                <div style="font-size:.78rem;color:#6c757d;">{{ $item->productVariant->label }}</div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td style="padding:16px;font-weight:700;color:var(--tm-navy);">₹{{ number_format($item->effective_price) }}</td>
                                <td style="padding:16px;">
                                    <div class="qty-stepper">
                                        <button type="button" onclick="stepQty({{ $item->id }}, -1)" {{ $item->quantity <= 1 ? 'disabled' : '' }}>−</button>
                                        <span class="qty-value" id="qty-{{ $item->id }}">{{ $item->quantity }}</span>
                                        <button type="button" onclick="stepQty({{ $item->id }}, 1)">+</button>
                                    </div>
                                </td>
                                <td style="padding:16px;font-weight:700;color:var(--tm-text);" id="total-{{ $item->id }}">₹{{ number_format($item->line_total) }}</td>
                                <td style="padding:16px;">
                                    <button onclick="removeCart({{ $item->id }})" class="btn btn-light btn-sm" style="border-radius:8px;color:#dc3545;"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Coupon --}}
                <div class="mt-3 p-4 coupon-box">
                    <div class="d-flex gap-2">
                        <input type="text" id="coupon-input" class="form-control" placeholder="Enter coupon code" value="{{ session('coupon_code') }}" {{ session('coupon_code') ? 'readonly' : '' }}>
                        @if(session('coupon_code'))
                        <button type="button" onclick="removeCoupon()" class="btn btn-outline-danger px-3" title="Remove coupon"><i class="bi bi-x-circle"></i></button>
                        @else
                        <button type="button" onclick="applyCoupon()" class="btn btn-brand-orange">Apply</button>
                        @endif
                    </div>
                    <div id="coupon-message" class="mt-2" style="font-size:.84rem;"></div>
                </div>
            </div>

            {{-- Order Summary --}}
            <div class="col-lg-4">
                <div class="p-4 order-summary-card" style="position:sticky;top:80px;">
                    <h6 class="fw-700 mb-4">Order Summary</h6>
                    <div id="cart-summary">
                        <div class="d-flex justify-content-between mb-2"><span class="text-muted">Subtotal</span><span id="sum-subtotal">₹{{ number_format($totals['subtotal']) }}</span></div>
                        <div class="d-flex justify-content-between mb-2" id="sum-discount-row" style="{{ $totals['discount'] > 0 ? '' : 'display:none;' }}"><span class="text-muted">Discount</span><span class="text-success" id="sum-discount">-₹{{ number_format($totals['discount']) }}</span></div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Shipping</span>
                            <span id="sum-shipping">
                                @if($totals['shippingCharge'] > 0)
                                    ₹{{ number_format($totals['shippingCharge']) }}
                                @else
                                    <span class="text-success fw-bold"><i class="bi bi-truck me-1"></i>Free</span>
                                @endif
                            </span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-700 mb-4" style="font-size:1.1rem;">
                            <span>Total</span>
                            <span style="color:var(--tm-navy);" id="sum-total">₹{{ number_format($totals['total']) }}</span>
                        </div>
                    </div>
                    @auth
                    <a href="{{ route('checkout.index') }}" class="btn btn-primary w-100 py-2" style="border-radius:10px;font-weight:700;">
                        Proceed to Checkout <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                    @else
                    <a href="{{ route('login') }}" class="btn btn-primary w-100 py-2" style="border-radius:10px;font-weight:700;">
                        Login to Checkout
                    </a>
                    @endauth
                    <a href="{{ route('shop') }}" class="btn btn-outline-secondary w-100 mt-2" style="border-radius:10px;">Continue Shopping</a>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
function renderTotals(totals) {
    document.getElementById('sum-subtotal').textContent = '₹' + Math.round(totals.subtotal).toLocaleString('en-IN');
    const discountRow = document.getElementById('sum-discount-row');
    if (totals.discount > 0) {
        discountRow.style.display = '';
        document.getElementById('sum-discount').textContent = '-₹' + Math.round(totals.discount).toLocaleString('en-IN');
    } else {
        discountRow.style.display = 'none';
    }
    document.getElementById('sum-shipping').innerHTML = totals.shippingCharge > 0
        ? '₹' + Math.round(totals.shippingCharge).toLocaleString('en-IN')
        : '<span class="text-success fw-bold"><i class="bi bi-truck me-1"></i>Free</span>';
    document.getElementById('sum-total').textContent = '₹' + Math.round(totals.total).toLocaleString('en-IN');
}

function stepQty(id, delta) {
    const qtyEl = document.getElementById('qty-' + id);
    const current = parseInt(qtyEl.textContent, 10);
    const next = current + delta;
    if (next < 1) return;
    updateCart(id, next);
}

function updateCart(id, qty) {
    const row = document.getElementById('cart-row-' + id);
    row.classList.add('cart-row-updating');

    $.ajax({ url: '{{ url("cart") }}/' + id, method: 'PATCH', data: { quantity: qty } })
        .done(res => {
            if (res.success) {
                document.getElementById('qty-' + id).textContent = qty;

                const price = parseFloat(row.dataset.price);
                document.getElementById('total-' + id).textContent = '₹' + Math.round(price * qty).toLocaleString('en-IN');

                const minusBtn = row.querySelector('.qty-stepper button:first-child');
                minusBtn.disabled = qty <= 1;

                renderTotals(res.totals);
            }
        })
        .fail(() => {
            alert('Could not update quantity. Please try again.');
        })
        .always(() => row.classList.remove('cart-row-updating'));
}

function removeCart(id) {
    $.ajax({ url: '{{ url("cart") }}/' + id, method: 'DELETE' })
        .done(res => {
            if (res.success) {
                document.getElementById('cart-row-' + id)?.remove();
                $('#cart-count').text(res.count);
                if (res.count === 0) location.reload();
                else location.reload(); // refresh totals/coupon eligibility after removal
            }
        })
        .fail(() => alert('Could not remove item. Please try again.'));
}

function applyCoupon() {
    const code = document.getElementById('coupon-input').value.trim();
    if (!code) return;
    $.post('{{ route("cart.coupon.apply") }}', { coupon_code: code })
        .done(res => {
            const el = document.getElementById('coupon-message');
            el.style.color = res.success ? 'green' : '#dc3545';
            el.textContent = res.message;
            if (res.success) setTimeout(() => location.reload(), 800);
        })
        .fail(() => {
            const el = document.getElementById('coupon-message');
            el.style.color = '#dc3545';
            el.textContent = 'Something went wrong. Please try again.';
        });
}

function removeCoupon() {
    $.ajax({ url: '{{ route("cart.coupon.remove") }}', method: 'DELETE' })
        .done(() => location.reload())
        .fail(() => {
            const el = document.getElementById('coupon-message');
            el.style.color = '#dc3545';
            el.textContent = 'Could not remove coupon. Please try again.';
        });
}
</script>
@endpush
