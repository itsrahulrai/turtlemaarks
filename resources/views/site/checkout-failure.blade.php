@extends('site.layouts.app')

@section('title', 'Payment Failed — ' . SITE_NAME)

@section('content')
<section class="py-5 bg-light">
  <div class="container text-center">
    <div class="card rounded-4 border p-4 p-md-5 bg-white shadow-sm mx-auto" style="max-width: 560px;">
      <div class="bg-danger-subtle text-danger rounded-circle d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width: 78px; height: 78px;">
        <i class="bi bi-x-circle-fill fs-1"></i>
      </div>
      <h3 class="fw-bold text-navy mb-1">Payment Not Completed</h3>
      <p class="text-secondary small mb-4">
        Your payment was cancelled or could not be verified. No amount has been captured.
        If money was debited it will be refunded automatically within 5–7 working days.
      </p>

      <div class="d-flex justify-content-center flex-wrap gap-2">
        <a href="{{ route('cart.index') }}" class="tm-btn tm-btn-primary tm-btn-sm"><i class="bi bi-arrow-repeat"></i> Try Again</a>
        <a href="tel:{{ $sitePhoneRaw ?? site_phone_raw() }}" class="tm-btn tm-btn-navy tm-btn-sm"><i class="bi bi-telephone-fill"></i> Call {{ $sitePhone ?? site_phone() }}</a>
        <a href="{{ route('home') }}" class="tm-btn tm-btn-outline-navy tm-btn-sm">Return to Home</a>
      </div>
    </div>
  </div>
</section>
@endsection
