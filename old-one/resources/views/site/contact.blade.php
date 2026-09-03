@extends('site.layouts.app')

@section('title', 'Contact Us — ' . ($siteName ?? site_name()) . ' | Gaur City Mall')
@section('meta_description', 'Visit ' . ($siteName ?? site_name()) . ' Clinic at ' . ($siteAddress ?? site_address()) . '. Call ' . ($sitePhone ?? site_phone()) . ' or email ' . ($siteEmail ?? site_email()) . ' for appointments and home visits.')
@section('active_nav', 'contact')

@section('content')
<!-- =========================================================================
     HERO SECTION (CLEAN & MINIMAL)
     ========================================================================= -->
<section class="tm-page-hero text-center position-relative">
  <div class="container">
    
    <!-- Clean Breadcrumb Pill -->
    <nav aria-label="breadcrumb" class="d-inline-flex mb-2">
      <div class="tm-breadcrumb-pill">
        <a href="{{ route('home') }}"><i class="bi bi-house-door"></i> Home</a>
        <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
        <span class="tm-breadcrumb-current" aria-current="page">Contact Us</span>
      </div>
    </nav>

    <!-- Main Heading -->
    <h1 class="display-6 fw-bold text-white mb-2 font-heading">Contact Us</h1>
    <p class="text-white-50 mx-auto small mb-0" style="max-width: 560px;">
      Expert hearing care and personalized support, just a message away.
    </p>

  </div>
</section>

<!-- =========================================================================
     4 QUICK-CONTACT CLINICAL CARDS
     ========================================================================= -->
<section class="py-4 py-md-5 bg-light-subtle">
  <div class="container">
    
    <div class="row g-3 g-md-4 mb-5">
      
      <!-- 1. Address Card (Light Amber/Orange) -->
      <div class="col-sm-6 col-lg-3">
        <div class="tm-contact-info-card tm-contact-card-orange">
          <div class="tm-contact-icon-circle mb-3">
            <i class="bi bi-geo-alt-fill"></i>
          </div>
          <h6 class="fw-bold text-navy mb-1">Clinic Address</h6>
          <p class="small text-secondary mb-3" style="font-size: 0.82rem; line-height: 1.45;">
            {{ $siteAddress ?? site_address() }}
          </p>
          <a href="#tmContactMapSection" class="small fw-bold text-orange text-decoration-none">
            View on Map <i class="bi bi-arrow-down-short"></i>
          </a>
        </div>
      </div>

      <!-- 2. Phone Helpline (Light Trust Blue) -->
      <div class="col-sm-6 col-lg-3">
        <div class="tm-contact-info-card tm-contact-card-blue">
          <div class="tm-contact-icon-circle mb-3">
            <i class="bi bi-telephone-fill"></i>
          </div>
          <h6 class="fw-bold text-navy mb-1">Doctor Helpline</h6>
          <p class="small text-secondary mb-2" style="font-size: 0.82rem;">
            Mon &ndash; Sat: 10:00 AM &ndash; 7:30 PM<br>
            <span class="text-muted">Sunday: Prior Appointment Only</span>
          </p>
          <a href="tel:{{ $sitePhoneRaw ?? site_phone_raw() }}" class="fw-bold text-navy text-decoration-none fs-6">
            {{ $sitePhone ?? site_phone() }}
          </a>
        </div>
      </div>

      <!-- 3. WhatsApp Specialist (Light Emerald Mint) -->
      <div class="col-sm-6 col-lg-3">
        <div class="tm-contact-info-card tm-contact-card-green">
          <div class="tm-contact-icon-circle mb-3">
            <i class="bi bi-whatsapp"></i>
          </div>
          <h6 class="fw-bold text-navy mb-1">WhatsApp Chat</h6>
          <p class="small text-secondary mb-3" style="font-size: 0.82rem; line-height: 1.45;">
            Instant assistance from senior clinical audiologists. Share your audiogram for review.
          </p>
          <a href="https://wa.me/{{ $siteWhatsApp ?? site_whatsapp() }}?text={{ rawurlencode('Hi ' . ($siteName ?? site_name()) . ', I would like to inquire about hearing tests and hearing aids.') }}" target="_blank" rel="noopener" class="small fw-bold text-success text-decoration-none">
            Chat on WhatsApp <i class="bi bi-arrow-up-right-short"></i>
          </a>
        </div>
      </div>

      <!-- 4. Email Support (Light Lavender Indigo) -->
      <div class="col-sm-6 col-lg-3">
        <div class="tm-contact-info-card tm-contact-card-purple">
          <div class="tm-contact-icon-circle mb-3">
            <i class="bi bi-envelope-fill"></i>
          </div>
          <h6 class="fw-bold text-navy mb-1">Email Consultation</h6>
          <p class="small text-secondary mb-2" style="font-size: 0.82rem;">
            Send reports or corporate / institutional inquiries. Fast response within 2 hours.
          </p>
          <a href="mailto:{{ $siteEmail ?? site_email() }}" class="fw-bold text-navy text-decoration-none small text-break">
            {{ $siteEmail ?? site_email() }}
          </a>
        </div>
      </div>

    </div>

    <!-- =========================================================================
         MAIN SECTION: INQUIRY FORM (LEFT) + GOOGLE MAP & VISITING GUIDE (RIGHT)
         ========================================================================= -->
    <div class="row g-4 align-items-stretch" id="tmContactMapSection">
      
      <!-- Left: Consultation & Inquiry Form -->
      <div class="col-lg-6 d-flex flex-column">
        <div class="card rounded-4 border p-4 p-md-5 bg-white shadow-xs h-100 d-flex flex-column">
          
          <div class="d-flex align-items-center gap-2 mb-2">
            <span class="badge bg-orange-subtle text-orange rounded-2 px-3 py-1 fw-bold small">
              <i class="bi bi-chat-left-dots-fill me-1"></i> Patient Support
            </span>
          </div>
          <h3 class="fw-bold text-navy mb-2 font-heading">Book an Appointment or Inquiry</h3>
          <p class="text-secondary small mb-4">
            Fill in your details below. Our senior audiological care coordinator will call or WhatsApp you within 2 hours to confirm your slot.
          </p>

          <form method="POST" action="{{ route('contact.send') }}" class="d-flex flex-column flex-grow-1 justify-content-between">
            @csrf
            <div class="row g-3">
              
              <div class="col-md-6">
                <label class="form-label small fw-bold text-navy">Full Name *</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" required placeholder="e.g. Ramesh Kumar">
              </div>

              <div class="col-md-6">
                <label class="form-label small fw-bold text-navy">Mobile Number *</label>
                <div class="input-group">
                  <span class="input-group-text bg-light text-muted small">+91</span>
                  <input type="tel" name="phone" value="{{ old('phone') }}" class="form-control" required placeholder="8130495476" pattern="[0-9]{10}">
                </div>
              </div>

              <div class="col-md-6">
                <label class="form-label small fw-bold text-navy">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" required placeholder="name@example.com">
              </div>

              <div class="col-md-6">
                <label class="form-label small fw-bold text-navy">Subject</label>
                <input type="text" name="subject" value="{{ old('subject') }}" class="form-control" placeholder="e.g. Hearing Aid / Clinic Inquiry">
              </div>

              <div class="col-12">
                <label class="form-label small fw-bold text-navy">Message *</label>
                <textarea name="message" class="form-control" rows="4" required placeholder="How can we help you? Write your message here...">{{ old('message') }}</textarea>
              </div>

              <div class="col-12 mt-4">
                <button type="submit" class="tm-btn tm-btn-primary tm-btn-lg w-100 justify-content-center">
                  <i class="bi bi-send-fill me-2"></i> Submit Inquiry
                </button>
              </div>

            </div>
          </form>

        </div>
      </div>

      <!-- Right: Embedded Google Map (Height matches Form Card) -->
      <div class="col-lg-6 d-flex flex-column">
        <div class="card rounded-4 border p-4 p-md-5 bg-white shadow-xs h-100 d-flex flex-column">
          
          <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-2">
            <span class="badge bg-success-subtle text-success rounded-2 px-3 py-1 small fw-bold">
              <i class="bi bi-check-circle-fill me-1"></i> Verified Google Business Location
            </span>
          </div>

          <h3 class="fw-bold text-navy mb-3 font-heading">Find Us on Google Maps</h3>

          <!-- Map stretches 100% to match the exact height of the form card on the left! -->
          <div class="flex-grow-1 w-100 rounded-3 overflow-hidden border position-relative" style="min-height: 420px;">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.7994222767175!2d77.4299678!3d28.605793499999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cef575eaa2019%3A0x13228af08a69d9af!2sTurtle%20Maarks%20Hearing%20Health!5e0!3m2!1sen!2sin!4v1788005744109!5m2!1sen!2sin"
                    class="position-absolute top-0 start-0 w-100 h-100 border-0"
                    allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
          </div>

        </div>
      </div>

    </div>

  </div>
</section>
@endsection
