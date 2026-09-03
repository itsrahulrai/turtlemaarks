@extends('site.layouts.app')

@section('title', 'Patient Login — ' . SITE_NAME)
@section('meta_description', 'Access your Turtle Maarks patient portal, audiogram reports, appointments, and warranty cards.')

@section('content')

  <!-- HERO BANNER -->
  <section class="tm-page-hero text-center position-relative">
    <div class="container">
      <nav aria-label="breadcrumb" class="d-inline-flex mb-2">
        <div class="tm-breadcrumb-pill">
          <a href="{{ route('home') }}"><i class="bi bi-house-door"></i> Home</a>
          <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
          <span class="tm-breadcrumb-current" aria-current="page">Sign In</span>
        </div>
      </nav>
      <h1 class="display-6 fw-bold text-white mb-1 font-heading">Patient Sign In</h1>
      <p class="text-white-50 mx-auto small mb-0" style="max-width: 580px;">Access your audiogram reports, order tracking, and appointments.</p>
    </div>
  </section>

  <section class="py-5 bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
          <div class="card rounded-4 border p-4 p-md-5 bg-white shadow-sm">
            @if (request()->has('logged_out'))
            <div class="alert alert-success d-flex align-items-center small py-2 px-3 mb-3">
              <i class="bi bi-check-circle-fill me-2 fs-5"></i>
              <div>You have been safely signed out of your patient portal.</div>
            </div>
            @endif

            <h4 class="fw-bold text-navy mb-1 font-heading">Welcome Back</h4>
            <p class="text-secondary small mb-4">Sign in to view your patient portal and diagnostic records.</p>

            <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="mb-3">
                <label class="form-label small fw-bold text-navy">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror"
                       required autofocus placeholder="e.g. name@example.com">
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
              <div class="mb-3">
                <div class="d-flex justify-content-between">
                  <label class="form-label small fw-bold text-navy">Password</label>
                  <a href="{{ route('password.request') }}" class="small text-orange fw-medium text-decoration-none">Forgot Password?</a>
                </div>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required placeholder="••••••••">
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="remember" id="tmRemember" @checked(old('remember'))>
                <label class="form-check-label small text-secondary" for="tmRemember">Keep me signed in on this device</label>
              </div>
              <button type="submit" class="tm-btn tm-btn-primary tm-btn-lg w-100 mb-3"><i class="bi bi-box-arrow-in-right"></i> Sign In to Account</button>
            </form>

            <div class="text-center small text-muted border-top pt-3 mb-2">
              Prefer OTP? <a href="{{ route('login.otp') }}" class="fw-bold text-orange text-decoration-none">Sign in with your mobile number</a>
            </div>

            <div class="text-center small text-muted">
              Don't have an account? <a href="{{ route('register') }}" class="fw-bold text-orange text-decoration-none">Register Here</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
