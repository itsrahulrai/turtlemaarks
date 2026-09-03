@extends('site.layouts.app')

@section('title', 'Sign in with OTP — ' . SITE_NAME)
@section('meta_description', 'Sign in to the Turtle Maarks patient portal using a one-time password sent to your registered mobile number.')

@section('content')

  <section class="tm-page-hero text-center position-relative">
    <div class="container">
      <nav aria-label="breadcrumb" class="d-inline-flex mb-2">
        <div class="tm-breadcrumb-pill">
          <a href="{{ route('home') }}"><i class="bi bi-house-door"></i> Home</a>
          <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
          <a href="{{ route('login') }}">Sign In</a>
          <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
          <span class="tm-breadcrumb-current" aria-current="page">OTP Login</span>
        </div>
      </nav>
      <h1 class="display-6 fw-bold text-white mb-1 font-heading">Sign In With OTP</h1>
      <p class="text-white-50 mx-auto small mb-0" style="max-width: 580px;">Use the one-time password sent to your registered mobile number.</p>
    </div>
  </section>

  <section class="py-5 bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
          <div class="card rounded-4 border p-4 p-md-5 bg-white shadow-sm">

            @if (request()->filled('phone'))
              <h4 class="fw-bold text-navy mb-1 font-heading">Enter Your OTP</h4>
              <p class="text-secondary small mb-4">A 6-digit code was sent to <strong class="text-navy">{{ request('phone') }}</strong>.</p>

              <form method="POST" action="{{ route('login.otp.verify.submit') }}">
                @csrf
                <input type="hidden" name="phone" value="{{ request('phone') }}">
                <div class="mb-3">
                  <label class="form-label small fw-bold text-navy">One-Time Password *</label>
                  <input type="text" name="otp" inputmode="numeric" maxlength="6" class="form-control text-center fs-4 fw-bold @error('otp') is-invalid @enderror" required placeholder="––––––">
                  @error('otp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <button type="submit" class="tm-btn tm-btn-primary tm-btn-lg w-100 mb-3"><i class="bi bi-shield-check me-1"></i> Verify &amp; Sign In</button>
              </form>

              <form method="POST" action="{{ route('login.otp.send') }}" class="text-center">
                @csrf
                <input type="hidden" name="phone" value="{{ request('phone') }}">
                <button type="submit" class="btn btn-link btn-sm text-orange text-decoration-none">Resend OTP</button>
              </form>
            @else
              <h4 class="fw-bold text-navy mb-1 font-heading">Sign In With Your Mobile</h4>
              <p class="text-secondary small mb-4">We&rsquo;ll send a one-time password to your registered number.</p>

              <form method="POST" action="{{ route('login.otp.send') }}">
                @csrf
                <div class="mb-3">
                  <label class="form-label small fw-bold text-navy">Registered Mobile Number *</label>
                  <div class="input-group">
                    <span class="input-group-text bg-light text-muted small">+91</span>
                    <input type="tel" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" required placeholder="10-digit mobile number">
                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                </div>
                <button type="submit" class="tm-btn tm-btn-primary tm-btn-lg w-100 mb-3"><i class="bi bi-chat-dots-fill me-1"></i> Send OTP</button>
              </form>
            @endif

            <div class="text-center small text-muted border-top pt-3">
              Prefer a password? <a href="{{ route('login') }}" class="fw-bold text-orange text-decoration-none">Sign in with email</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
