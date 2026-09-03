@extends('site.layouts.app')

@section('title', 'Forgot Password — ' . SITE_NAME)
@section('meta_description', 'Reset your Turtle Maarks patient portal password via your registered email address.')

@section('content')

  <!-- HERO BANNER -->
  <section class="tm-page-hero text-center position-relative">
    <div class="container">
      <nav aria-label="breadcrumb" class="d-inline-flex mb-2">
        <div class="tm-breadcrumb-pill">
          <a href="{{ route('home') }}"><i class="bi bi-house-door"></i> Home</a>
          <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
          <a href="{{ route('login') }}">Sign In</a>
          <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
          <span class="tm-breadcrumb-current" aria-current="page">Forgot Password</span>
        </div>
      </nav>
      <h1 class="display-6 fw-bold text-white mb-1 font-heading">Reset Password</h1>
      <p class="text-white-50 mx-auto small mb-0" style="max-width: 580px;">Recover access to your patient portal, audiograms, and device warranties.</p>
    </div>
  </section>

  <section class="py-5 bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
          <div class="card rounded-4 border p-4 p-md-5 bg-white shadow-sm">

            <div class="text-center mb-4">
              <div class="bg-primary-subtle text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 58px; height: 58px;">
                <i class="bi bi-shield-lock-fill fs-3 text-orange"></i>
              </div>
              <h4 class="fw-bold text-navy mb-1 font-heading">Trouble Signing In?</h4>
              <p class="text-secondary small mb-0">
                Enter your registered email address and we&rsquo;ll send you a secure password reset link.
              </p>
            </div>

            <form method="POST" action="{{ route('password.email') }}">
              @csrf
              <div class="mb-4">
                <label class="form-label small fw-bold text-navy">Registered Email Address *</label>
                <div class="input-group">
                  <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-envelope-at"></i></span>
                  <input type="email" name="email" value="{{ old('email') }}" class="form-control border-start-0 ps-1 @error('email') is-invalid @enderror" required placeholder="e.g. name@example.com">
                  @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-text extra-small text-muted" style="font-size: 0.76rem;">
                  We will send a single-use secure reset link valid for 60 minutes.
                </div>
              </div>

              <button type="submit" class="tm-btn tm-btn-primary tm-btn-lg w-100 mb-3">
                <i class="bi bi-envelope-check-fill me-1"></i> Send Password Reset Link
              </button>
            </form>

            <div class="text-center small text-muted border-top pt-3 mt-2">
              Remember your password? <a href="{{ route('login') }}" class="fw-bold text-orange text-decoration-none">Back to Sign In</a>
            </div>

            <div class="mt-4 pt-3 border-top text-center bg-light rounded-3 p-3">
              <div class="small fw-semibold text-navy mb-1"><i class="bi bi-headset text-orange me-1"></i> Need Audiologist Help?</div>
              <p class="text-muted extra-small mb-2" style="font-size: 0.78rem;">Our clinical reception team can manually assist with account recovery during clinic hours.</p>
              <a href="tel:{{ $sitePhoneRaw ?? site_phone_raw() }}" class="tm-btn tm-btn-sm tm-btn-outline w-100 py-1">
                <i class="bi bi-telephone-fill me-1"></i> Call Clinic {{ $sitePhone ?? site_phone() }}
              </a>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
