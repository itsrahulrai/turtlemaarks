@extends('site.layouts.app')

@section('title', 'Processing Payment — ' . SITE_NAME)

@section('content')
<section class="py-5 bg-light">
  <div class="container text-center">
    <div class="card rounded-4 border p-4 p-md-5 bg-white shadow-sm mx-auto" style="max-width: 560px;">
      <div class="bg-primary-subtle text-primary rounded-circle d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width: 74px; height: 74px;">
        <i class="bi bi-shield-lock-fill fs-1 text-orange"></i>
      </div>
      <h3 class="fw-bold text-navy mb-1 font-heading">Opening Secure Payment</h3>
      <p class="text-secondary small mb-4">
        Order <strong class="text-orange">{{ $order->order_number }}</strong> &bull; Payable <strong class="text-navy">{{ inr($order->total) }}</strong>
      </p>

      <div class="spinner-border text-orange mx-auto mb-4" role="status"><span class="visually-hidden">Loading…</span></div>

      <button type="button" class="tm-btn tm-btn-primary tm-btn-lg w-100" onclick="tmOpenRazorpay()">
        <i class="bi bi-credit-card-2-front-fill me-1"></i> Pay {{ inr($order->total) }} Now
      </button>

      <form id="tmRazorpayCallbackForm" method="POST" action="{{ route('checkout.razorpay.callback') }}" class="d-none">
        @csrf
        <input type="hidden" name="razorpay_order_id" id="rzpOrderId">
        <input type="hidden" name="razorpay_payment_id" id="rzpPaymentId">
        <input type="hidden" name="razorpay_signature" id="rzpSignature">
      </form>

      <a href="{{ route('checkout.failure') }}" class="btn btn-link text-muted btn-sm mt-3">Cancel and return</a>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  const tmRzpOptions = {
    key: @json($rpData['key_id']),
    amount: @json($rpData['amount']),
    currency: @json($rpData['currency']),
    order_id: @json($rpData['razorpay_order_id']),
    name: @json(SITE_NAME),
    description: 'Order {{ $order->order_number }}',
    image: @json(asset(SITE_LOGO)),
    prefill: {
      name: @json($order->shipping_name),
      contact: @json($order->shipping_phone),
      email: @json(auth()->user()->email ?? '')
    },
    theme: { color: '#FF6B00' },
    handler: function (response) {
      document.getElementById('rzpOrderId').value   = response.razorpay_order_id;
      document.getElementById('rzpPaymentId').value = response.razorpay_payment_id;
      document.getElementById('rzpSignature').value = response.razorpay_signature;
      document.getElementById('tmRazorpayCallbackForm').submit();
    },
    modal: {
      ondismiss: function () {
        window.location.href = @json(route('checkout.failure'));
      }
    }
  };

  function tmOpenRazorpay() {
    new Razorpay(tmRzpOptions).open();
  }

  document.addEventListener('DOMContentLoaded', () => setTimeout(tmOpenRazorpay, 600));
</script>
@endpush
