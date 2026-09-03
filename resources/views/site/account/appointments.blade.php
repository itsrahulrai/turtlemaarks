@extends('site.layouts.app')

@section('title', 'My Appointments — ' . SITE_NAME)
@section('meta_description', 'View and manage your booked audiology appointments at Turtle Maarks Hearing Health.')

@section('content')

  <section class="tm-page-hero text-center position-relative">
    <div class="container">
      <nav aria-label="breadcrumb" class="d-inline-flex mb-2">
        <div class="tm-breadcrumb-pill">
          <a href="{{ route('home') }}"><i class="bi bi-house-door"></i> Home</a>
          <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
          <a href="{{ route('account.dashboard') }}">Account</a>
          <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
          <span class="tm-breadcrumb-current" aria-current="page">Appointments</span>
        </div>
      </nav>
      <h1 class="display-6 fw-bold text-white mb-1 font-heading">My Clinic Appointments</h1>
      <p class="text-white-50 mx-auto small mb-0" style="max-width: 580px;">Your sound-booth evaluations, fittings, therapy sessions, and home visits.</p>
    </div>
  </section>

  <section class="py-5 bg-light">
    <div class="container">
      <div class="row g-4">

        @include('site.partials.account-sidebar', ['active_tab' => 'appointments'])

        <div class="col-lg-9">

          <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
            <h5 class="fw-bold text-navy mb-0 font-heading">Booked Appointments</h5>
            <a href="{{ route('appointments.create') }}" class="tm-btn tm-btn-primary tm-btn-sm">
              <i class="bi bi-calendar-plus me-1"></i> Book New Appointment
            </a>
          </div>

          @forelse ($appointments as $appt)
          <div class="card rounded-4 border p-4 bg-white shadow-xs mb-3">
            <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 border-bottom pb-3 mb-3">
              <div>
                <span class="badge bg-orange-subtle text-orange fw-bold px-2 py-1 small mb-1">
                  <i class="bi bi-hash"></i>{{ $appt->appointment_number }}
                </span>
                <h6 class="fw-bold text-navy mb-0 font-heading">{{ $appt->service?->name ?? 'Clinical Consultation' }}</h6>
              </div>
              <div class="text-end">{!! $appt->status_badge !!}</div>
            </div>

            <div class="row g-3 small">
              <div class="col-md-4">
                <div class="text-muted mb-1">Date &amp; Time</div>
                <strong class="text-navy">
                  {{ $appt->appointment_date->format('D, d M Y') }} &bull;
                  {{ \Carbon\Carbon::parse($appt->appointment_time)->format('h:i A') }}
                </strong>
              </div>
              <div class="col-md-4">
                <div class="text-muted mb-1">Patient</div>
                <strong class="text-navy">{{ $appt->name }}</strong>
                <div class="text-muted">{{ $appt->phone }}</div>
              </div>
              <div class="col-md-4">
                <div class="text-muted mb-1">Location</div>
                <strong class="text-navy">Turtle Maarks Clinic, Gaur City</strong>
              </div>
              @if ($appt->notes)
              <div class="col-12">
                <div class="p-3 bg-light rounded-3">
                  <strong class="text-navy d-block mb-1">Your notes</strong>
                  <span class="text-secondary">{{ $appt->notes }}</span>
                </div>
              </div>
              @endif
              @if ($appt->admin_notes)
              <div class="col-12">
                <div class="p-3 bg-light rounded-3 border-start border-orange border-3">
                  <strong class="text-navy d-block mb-1"><i class="bi bi-reply-fill text-orange me-1"></i> Note from the clinic</strong>
                  <span class="text-secondary">{{ $appt->admin_notes }}</span>
                </div>
              </div>
              @endif
            </div>

            <div class="d-flex flex-wrap justify-content-end gap-2 border-top pt-3 mt-3">
              <a href="{{ route('appointments.confirmation', $appt->appointment_number) }}" class="tm-btn tm-btn-outline-navy tm-btn-sm">
                <i class="bi bi-ticket-perforated me-1"></i> View Slip
              </a>
              <a href="tel:{{ $sitePhoneRaw ?? site_phone_raw() }}" class="tm-btn tm-btn-primary tm-btn-sm">
                <i class="bi bi-telephone-fill me-1"></i> Reschedule by Call
              </a>
            </div>
          </div>
          @empty
          <div class="card rounded-4 border p-5 bg-white shadow-xs text-center">
            <i class="bi bi-calendar2-x text-muted fs-1 mb-2"></i>
            <h5 class="fw-bold text-navy mb-1">No appointments yet</h5>
            <p class="small text-secondary mb-3">Book a sound-booth hearing evaluation, a hearing aid trial, or a free senior citizen home visit.</p>
            <div><a href="{{ route('appointments.create') }}" class="tm-btn tm-btn-primary tm-btn-sm">Book an Appointment</a></div>
          </div>
          @endforelse

          <div class="mt-4">{{ $appointments->links() }}</div>

        </div>
      </div>
    </div>
  </section>
@endsection
