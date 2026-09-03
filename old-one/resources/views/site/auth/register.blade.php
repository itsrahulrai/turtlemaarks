@extends('site.layouts.app')

@section('title', 'Patient Registration — ' . SITE_NAME)
@section('meta_description', 'Create a new patient account on Turtle Maarks Hearing Health portal.')

@section('content')

  <!-- HERO BANNER -->
  <section class="tm-page-hero text-center position-relative">
    <div class="container">
      <nav aria-label="breadcrumb" class="d-inline-flex mb-2">
        <div class="tm-breadcrumb-pill">
          <a href="{{ route('home') }}"><i class="bi bi-house-door"></i> Home</a>
          <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
          <span class="tm-breadcrumb-current" aria-current="page">Register</span>
        </div>
      </nav>
      <h1 class="display-6 fw-bold text-white mb-1 font-heading">Create Patient Account</h1>
      <p class="text-white-50 mx-auto small mb-0" style="max-width: 580px;">Track your hearing rehabilitation journey and digital audiograms.</p>
    </div>
  </section>

  <section class="py-5 bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
          <div class="card rounded-4 border p-4 p-md-5 bg-white shadow-sm">
            <h4 class="fw-bold text-navy mb-1">Create Patient Account</h4>
            <p class="text-secondary small mb-4">Track your hearing rehabilitation journey and digital audiograms.</p>

            <form method="POST" action="{{ route('register') }}">
              @csrf
              <div class="mb-3">
                <label class="form-label small fw-bold text-navy">Full Name *</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required placeholder="e.g. Anand Kumar">
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
              <div class="mb-3">
                <label class="form-label small fw-bold text-navy">WhatsApp Mobile Number *</label>
                <input type="tel" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" required placeholder="10-digit mobile number">
                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
              <div class="mb-3">
                <label class="form-label small fw-bold text-navy">Email Address *</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required placeholder="name@example.com">
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
              <div class="mb-3">
                <label class="form-label small fw-bold text-navy">Create Password *</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required placeholder="At least 8 characters">
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
              <div class="mb-3">
                <label class="form-label small fw-bold text-navy">Confirm Password *</label>
                <input type="password" name="password_confirmation" class="form-control" required placeholder="Re-enter your password">
              </div>
              <button type="submit" class="tm-btn tm-btn-primary tm-btn-lg w-100 mb-3"><i class="bi bi-person-plus-fill"></i> Register Account</button>
            </form>

            <div class="text-center small text-muted border-top pt-3">
              Already have an account? <a href="{{ route('login') }}" class="fw-bold text-orange text-decoration-none">Sign In</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
