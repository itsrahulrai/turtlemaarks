@extends('site.layouts.app')

@section('title', 'Hearing Aid Repair & Service Lab — Turtle Maarks')
@section('meta_description', 'Hearing aid repair, ultrasonic cleaning, receiver replacement, and software reprogramming in Greater Noida West. All brands serviced.')
@section('active_nav', 'services')

@section('content')
<!-- HERO BANNER -->
  <section class="tm-page-hero text-center position-relative">
    <div class="container">
      <nav aria-label="breadcrumb" class="d-inline-flex mb-2">
        <div class="tm-breadcrumb-pill">
          <a href="{{ route('home') }}"><i class="bi bi-house-door"></i> Home</a>
          <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
          <span class="tm-breadcrumb-current" aria-current="page">Repair &amp; Servicing</span>
        </div>
      </nav>
      <h1 class="display-6 fw-bold text-white mb-2 font-heading">Hearing Aid Repair &amp; Servicing</h1>
      <p class="text-white-50 mx-auto small mb-0" style="max-width: 620px;">Certified lab diagnostics, ultrasonic dehumidification, mic/receiver replacement, and acoustic reprogramming for all brands.</p>
    </div>
  </section>

  <!-- COMMON PROBLEMS & PACKAGES -->
  <section class="py-5 bg-light">
    <div class="container">
      <div class="row g-4">
        
        <!-- Package 1 -->
        <div class="col-md-4">
          <div class="card rounded-4 border p-4 bg-white shadow-xs h-100 d-flex flex-column justify-content-between">
            <div>
              <div class="tm-diag-icon"><i class="bi bi-droplet"></i></div>
              <h5 class="fw-bold text-navy mb-2">Deep Ultrasonic Cleaning</h5>
              <p class="small text-secondary mb-3">Electronic vacuum moisture extraction, wax guard replacement, mic port clearing, and contact sterilization.</p>
            </div>
            <div class="border-top pt-3 d-flex justify-content-between align-items-center">
              <span class="fw-bold text-navy fs-5">₹600</span>
              <a href="{{ route('appointments.create') }}" class="tm-btn tm-btn-primary tm-btn-sm">Book Service</a>
            </div>
          </div>
        </div>

        <!-- Package 2 -->
        <div class="col-md-4">
          <div class="card rounded-4 border p-4 bg-white shadow-xs h-100 d-flex flex-column justify-content-between">
            <div>
              <div class="tm-diag-icon"><i class="bi bi-sliders"></i></div>
              <h5 class="fw-bold text-navy mb-2">Audiogram Reprogramming</h5>
              <p class="small text-secondary mb-3">Re-tuning channels and gain parameters based on your latest PTA test audiogram to eliminate whistling feedback.</p>
            </div>
            <div class="border-top pt-3 d-flex justify-content-between align-items-center">
              <span class="fw-bold text-navy fs-5">₹800</span>
              <a href="{{ route('appointments.create') }}" class="tm-btn tm-btn-primary tm-btn-sm">Book Service</a>
            </div>
          </div>
        </div>

        <!-- Package 3 -->
        <div class="col-md-4">
          <div class="card rounded-4 border p-4 bg-white shadow-xs h-100 d-flex flex-column justify-content-between">
            <div>
              <div class="tm-diag-icon"><i class="bi bi-cpu"></i></div>
              <h5 class="fw-bold text-navy mb-2">Receiver / Speaker Overhaul</h5>
              <p class="small text-secondary mb-3">Replacement of distorted, dead, or crackling speaker wires with original manufacturer-certified receivers.</p>
            </div>
            <div class="border-top pt-3 d-flex justify-content-between align-items-center">
              <span class="fw-bold text-navy fs-5">₹2,500 <span class="small text-muted">+ Parts</span></span>
              <a href="{{ route('appointments.create') }}" class="tm-btn tm-btn-primary tm-btn-sm">Book Service</a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection
