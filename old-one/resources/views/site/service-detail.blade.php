@extends('site.layouts.app')

@section('title', ($service->meta_title ?: $service->name) . ' — ' . SITE_NAME)
@section('meta_description', $service->meta_description ?: Str::limit(strip_tags($service->short_description ?: $service->description), 155))
@section('active_nav', 'services')

@section('content')

  <!-- HERO BANNER -->
  <section class="tm-page-hero text-center position-relative">
    <div class="container">
      <nav aria-label="breadcrumb" class="d-inline-flex mb-2">
        <div class="tm-breadcrumb-pill">
          <a href="{{ route('home') }}"><i class="bi bi-house-door"></i> Home</a>
          <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
          <a href="{{ route('services.index') }}">Services</a>
          <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
          <span class="tm-breadcrumb-current" aria-current="page">{{ $service->name }}</span>
        </div>
      </nav>
      <h1 class="display-6 fw-bold text-white mb-2 font-heading">{{ $service->name }}</h1>
      <p class="text-white-50 mx-auto small mb-0" style="max-width: 650px;">{{ $service->short_description }}</p>
    </div>
  </section>

  <section class="py-5 bg-light">
    <div class="container">
      <div class="row g-4">

        <div class="col-lg-8">
          <div class="card rounded-4 border p-4 p-md-5 bg-white shadow-xs mb-4">
            @if ($service->image)
              <img src="{{ $service->image_url }}" alt="{{ $service->name }}" class="rounded-3 w-100 mb-4" style="max-height: 380px; object-fit: cover;">
            @endif

            <div class="d-flex flex-wrap gap-2 mb-4">
              @if ($service->price > 0)
                <span class="badge bg-orange-subtle text-orange px-3 py-2 fw-bold">{{ inr($service->price) }}</span>
              @else
                <span class="badge bg-success-subtle text-success px-3 py-2 fw-bold">Free Consultation</span>
              @endif
              @if ($service->duration_minutes)
                <span class="badge bg-light text-navy border px-3 py-2"><i class="bi bi-clock me-1"></i> {{ $service->duration_minutes }} minutes</span>
              @endif
              <span class="badge bg-light text-navy border px-3 py-2"><i class="bi bi-shield-check text-orange me-1"></i> RCI Certified Audiologist</span>
            </div>

            <div class="tm-article-content">
              {!! $service->description !!}
            </div>
          </div>

          @if ($related->isNotEmpty())
          <div class="mb-2">
            <h4 class="fw-bold text-navy mb-3">Other Clinical Services</h4>
            <div class="row g-3">
              @foreach ($related as $rel)
              <div class="col-md-4">
                <a href="{{ route('services.show', $rel->slug) }}" class="card rounded-4 border p-3 bg-white shadow-xs h-100 text-decoration-none">
                  <div class="tm-booking-opt-icon mb-2"><i class="bi bi-soundwave"></i></div>
                  <h6 class="fw-bold text-navy mb-1">{{ $rel->name }}</h6>
                  <p class="small text-secondary mb-0">{{ Str::limit($rel->short_description, 70) }}</p>
                </a>
              </div>
              @endforeach
            </div>
          </div>
          @endif
        </div>

        <!-- Booking sidebar -->
        <div class="col-lg-4">
          <div class="card rounded-4 border bg-white p-4 shadow-xs sticky-lg-top" style="top: 90px;">
            <h5 class="fw-bold text-navy mb-1 font-heading">Book This Service</h5>
            <p class="small text-secondary mb-3">Reserve a sound-booth slot at our Gaur City clinic or request a doorstep visit.</p>

            <div class="d-grid gap-2 mb-3">
              <a href="{{ route('appointments.create', ['service' => $service->id]) }}" class="tm-btn tm-btn-primary">
                <i class="bi bi-calendar-check me-1"></i> Book Appointment
              </a>

              @if ($service->price > 0)
              <form method="POST" action="{{ route('services.add-to-cart', $service->id) }}">
                @csrf
                <button type="submit" class="tm-btn tm-btn-outline-navy w-100">
                  <i class="bi bi-cart-plus me-1"></i> Add to Cart — {{ inr($service->price) }}
                </button>
              </form>
              @endif

              <a href="tel:{{ $sitePhoneRaw ?? site_phone_raw() }}" class="tm-btn tm-btn-outline-navy">
                <i class="bi bi-telephone-fill me-1"></i> Call {{ $sitePhone ?? site_phone() }}
              </a>
              <a href="https://wa.me/{{ $siteWhatsApp ?? site_whatsapp() }}?text={{ rawurlencode('Hi ' . ($siteName ?? site_name()) . ', I would like to know more about ' . $service->name) }}"
                 target="_blank" rel="noopener" class="tm-btn tm-btn-whatsapp">
                <i class="bi bi-whatsapp me-1"></i> WhatsApp Enquiry
              </a>
            </div>

            <div class="pt-3 border-top small text-muted">
              <div class="d-flex align-items-start gap-2 mb-2">
                <i class="bi bi-geo-alt-fill text-orange mt-1"></i>
                <span><strong>Clinic:</strong> {{ SITE_ADDRESS }}</span>
              </div>
              <div class="d-flex align-items-center gap-2">
                <i class="bi bi-clock-fill text-orange"></i>
                <span><strong>Hours:</strong> {!! SITE_HOURS_DAYS !!}: {!! SITE_HOURS_TIME !!}</span>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection
