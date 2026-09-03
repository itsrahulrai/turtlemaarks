@extends('site.layouts.app')

@section('title', 'Set a New Password — ' . SITE_NAME)

@section('content')
  <section class="tm-page-hero text-center position-relative">
    <div class="container">
      <h1 class="display-6 fw-bold text-white mb-1 font-heading">Set a New Password</h1>
      <p class="text-white-50 mx-auto small mb-0" style="max-width: 580px;">Choose a strong password for your patient portal.</p>
    </div>
  </section>

  <section class="py-5 bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
          <div class="card rounded-4 border p-4 p-md-5 bg-white shadow-sm">
            <form method="POST" action="{{ route('password.update') }}">
              @csrf
              <input type="hidden" name="token" value="{{ $token }}">

              <div class="mb-3">
                <label class="form-label small fw-bold text-navy">Email Address *</label>
                <input type="email" name="email" value="{{ old('email', $email) }}" class="form-control @error('email') is-invalid @enderror" required>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>

              <div class="mb-3">
                <label class="form-label small fw-bold text-navy">New Password *</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required placeholder="At least 8 characters">
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>

              <div class="mb-3">
                <label class="form-label small fw-bold text-navy">Confirm New Password *</label>
                <input type="password" name="password_confirmation" class="form-control" required placeholder="••••••••">
              </div>

              <button type="submit" class="tm-btn tm-btn-primary tm-btn-lg w-100"><i class="bi bi-shield-check me-1"></i> Update Password</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
