@extends('site.layouts.app')

@section('title', 'Appointment Confirmation — ' . SITE_NAME)
@section('meta_description', 'Your audiology clinic appointment slip with Turtle Maarks Hearing Health.')

@section('content')
<section class="py-5 bg-light">
    <div class="container text-center">
      <div class="card rounded-4 border p-4 p-md-5 bg-white shadow-sm mx-auto" style="max-width: 640px;">
        <div class="bg-success-subtle text-success rounded-circle d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width: 78px; height: 78px;">
          <i class="bi bi-calendar-check-fill fs-1"></i>
        </div>
        <h3 class="fw-bold text-navy mb-1">Appointment {{ ucfirst($appointment->status) }}</h3>
        <p class="text-secondary small mb-4">Your clinical consultation slot has been reserved with our RCI-certified audiologist. We'll confirm on WhatsApp shortly.</p>

        <div class="card rounded-3 border bg-light p-3 text-start small mb-4">
          <div class="d-flex justify-content-between mb-2">
            <span class="text-muted">Booking Reference:</span>
            <strong class="text-orange">{{ $appointment->appointment_number }}</strong>
          </div>
          <div class="d-flex justify-content-between mb-2">
            <span class="text-muted">Service:</span>
            <strong class="text-navy">{{ $appointment->service?->name ?? 'Clinical Consultation' }}</strong>
          </div>
          <div class="d-flex justify-content-between mb-2">
            <span class="text-muted">Date &amp; Time:</span>
            <strong class="text-navy">
              {{ $appointment->appointment_date->format('D, d M Y') }} &bull;
              {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
            </strong>
          </div>
          <div class="d-flex justify-content-between mb-2">
            <span class="text-muted">Patient:</span>
            <strong class="text-navy">{{ $appointment->name }} &bull; {{ $appointment->phone }}</strong>
          </div>
          <div class="d-flex justify-content-between mb-2">
            <span class="text-muted">Status:</span>
            <span>{!! $appointment->status_badge !!}</span>
          </div>
          <div class="d-flex justify-content-between mb-2">
            <span class="text-muted">Location:</span>
            <strong class="text-navy text-end ps-3">{{ $siteAddress ?? site_address() }}</strong>
          </div>
          <div class="d-flex justify-content-between mb-0">
            <span class="text-muted">Clinic Contact:</span>
            <strong class="text-navy">{{ $sitePhone ?? site_phone() }}</strong>
          </div>
        </div>

        <div class="d-flex justify-content-center flex-wrap gap-2">
          <button class="tm-btn tm-btn-primary tm-btn-sm" onclick="window.print()"><i class="bi bi-printer"></i> Print Slip</button>
          <a href="https://wa.me/{{ $siteWhatsApp ?? site_whatsapp() }}?text={{ rawurlencode('Hi ' . ($siteName ?? site_name()) . ', my appointment reference is ' . $appointment->appointment_number) }}"
             target="_blank" rel="noopener" class="tm-btn tm-btn-navy tm-btn-sm"><i class="bi bi-whatsapp"></i> Send to WhatsApp</a>
          @auth
            <a href="{{ route('account.appointments') }}" class="tm-btn tm-btn-outline-navy tm-btn-sm">My Appointments</a>
          @else
            <a href="{{ route('home') }}" class="tm-btn tm-btn-outline-navy tm-btn-sm">Return to Home</a>
          @endauth
        </div>
      </div>
    </div>
  </section>
@endsection
