@extends('site.layouts.app')

@section('title', '7-Day Free Hearing Aid Trial & Fitting — Turtle Maarks')
@section('meta_description', 'Experience 7-day risk-free hearing aid trial in Greater Noida West with Real-Ear Measurement (REM) fitting from top brands: Phonak, Oticon, Signia, Widex.')
@section('active_nav', 'services')

@section('content')
<!-- SERVICE HERO -->
  <section class="tm-service-hero">
    <div class="container">
      <!-- Unified Frosted Breadcrumb Pill -->
      <nav aria-label="breadcrumb" class="d-inline-flex mb-2">
        <div class="tm-breadcrumb-pill">
          <a href="{{ route('home') }}"><i class="bi bi-house-door"></i> Home</a>
          <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
          <a href="{{ route('services.index') }}">Services</a>
          <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
          <span class="tm-breadcrumb-current" aria-current="page">Hearing Aid Trial</span>
        </div>
      </nav>

      <div class="row align-items-center g-4">
        <div class="col-lg-8">
          <h1 class="display-6 fw-bold text-white mb-2 font-heading">7-Day Free Hearing Aid Trial &amp; Digital Fitting</h1>
          <p class="text-white-50 mb-3" style="max-width: 680px;">Experience true speech clarity, active background noise cancellation, and invisible comfort before you buy. Fitted with computerized Real-Ear Measurement (REM) by certified audiologists.</p>
          <div class="d-flex flex-wrap gap-3 text-white-50 small">
            <div><i class="bi bi-clock-fill text-orange"></i> <strong>Duration:</strong> 45 Mins Session</div>
            <div><i class="bi bi-tag-fill text-orange"></i> <strong>Fee:</strong> 100% Free Consultation</div>
            <div><i class="bi bi-award-fill text-orange"></i> <strong>Brands:</strong> Phonak, Oticon, Signia, Widex, ReSound</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- MAIN SERVICE CONTENT & BOOKING SIDEBAR -->
  <section class="py-5 bg-light">
    <div class="container">
      <div class="row g-4 tm-service-layout-row">
        
        <!-- Left: Clinical Content -->
        <div class="col-lg-8 tm-service-main-col">
          
          <div class="card rounded-4 border p-4 bg-white shadow-xs mb-4">
            <h4 class="fw-bold text-navy mb-3">What is the 7-Day Hearing Aid Trial?</h4>
            <p class="text-secondary">At <strong>Turtle Maarks Hearing Health</strong>, we believe choosing a hearing aid should never be a guess. Our 7-Day Free Trial allows you or your elderly parents to test the world's most advanced digital hearing aids in real life — at home, during family conversations, watching TV, in traffic, and at social gatherings.</p>
            <p class="text-secondary mb-0">Our RCI-registered audiologists program the hearing aids specifically to match your audiogram threshold frequencies, ensuring no sharpness, no whistling feedback, and pure crystal-clear vocal intelligibility.</p>
          </div>

          <!-- 4-Step Clinical Process -->
          <div class="card rounded-4 border p-4 bg-white shadow-xs mb-4">
            <h4 class="fw-bold text-navy mb-4">Our 4-Step Fitting Procedure</h4>
            
            <div class="tm-service-process-step">
              <div class="tm-service-step-num">1</div>
              <h6 class="fw-bold text-navy mb-1">Pure Tone Audiometry (PTA) Evaluation</h6>
              <p class="small text-secondary mb-0">We measure your precise hearing threshold across bass, mid, and treble frequencies in our calibrated soundproof testing booth.</p>
            </div>

            <div class="tm-service-process-step">
              <div class="tm-service-process-step-num tm-service-step-num">2</div>
              <h6 class="fw-bold text-navy mb-1">Lifestyle & Form Factor Selection</h6>
              <p class="small text-secondary mb-0">We help you choose between Invisible-in-Canal (IIC), Receiver-in-Canal (RIC), and Behind-the-Ear (BTE) models based on your degree of loss and daily activity.</p>
            </div>

            <div class="tm-service-process-step">
              <div class="tm-service-step-num">3</div>
              <h6 class="fw-bold text-navy mb-1">Real-Ear Measurement (REM) Live Tuning</h6>
              <p class="small text-secondary mb-0">We place a micro-probe microphone in your ear canal to verify that the sound amplification precisely matches your ear's natural acoustic resonance.</p>
            </div>

            <div class="tm-service-process-step">
              <div class="tm-service-step-num">4</div>
              <h6 class="fw-bold text-navy mb-1">7-Day Home Trial with Free Fine-Tuning</h6>
              <p class="small text-secondary mb-0">Take the programmed devices home. We follow up with you on Day 3 and Day 7 to fine-tune the noise filters and bluetooth streaming controls.</p>
            </div>
          </div>

          <!-- Who Needs This -->
          <div class="card rounded-4 border p-4 bg-white shadow-xs mb-4">
            <h4 class="fw-bold text-navy mb-3">Who Should Book This Service?</h4>
            <div class="row row-cols-1 row-cols-md-2 g-3">
              <div class="col">
                <div class="d-flex align-items-start gap-2">
                  <i class="bi bi-check-circle-fill text-orange fs-5"></i>
                  <span class="small text-secondary">People who struggle to understand speech in noisy restaurants or family gatherings.</span>
                </div>
              </div>
              <div class="col">
                <div class="d-flex align-items-start gap-2">
                  <i class="bi bi-check-circle-fill text-orange fs-5"></i>
                  <span class="small text-secondary">Seniors who keep the TV volume unusually high or ask others to repeat sentences.</span>
                </div>
              </div>
              <div class="col">
                <div class="d-flex align-items-start gap-2">
                  <i class="bi bi-check-circle-fill text-orange fs-5"></i>
                  <span class="small text-secondary">First-time users looking to compare Phonak, Oticon, Signia, and Widex back-to-back.</span>
                </div>
              </div>
              <div class="col">
                <div class="d-flex align-items-start gap-2">
                  <i class="bi bi-check-circle-fill text-orange fs-5"></i>
                  <span class="small text-secondary">Existing hearing aid wearers needing an upgrade to rechargeability and Bluetooth calling.</span>
                </div>
              </div>
            </div>
          </div>

        </div>

        <!-- Right: Interactive Sticky Booking Card -->
        <div class="col-lg-4 tm-service-sidebar">
          <div class="tm-booking-sidebar-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h5 class="fw-bold text-navy mb-0">Book Trial Slot</h5>
              <span class="badge bg-success-subtle text-success fw-bold">100% Free</span>
            </div>

            <form onsubmit="event.preventDefault(); showToast('Appointment Booked!', 'Your 7-Day Trial slot has been confirmed. Our clinic audiologist will call you.', 'success'); this.reset();">
              
              <div class="mb-3">
                <label class="form-label small fw-bold text-navy mb-1">1. Choose Date</label>
                <input type="date" class="form-control" required id="bookingDate">
              </div>

              <div class="mb-3">
                <label class="form-label small fw-bold text-navy mb-1">2. Choose Time Slot</label>
                <div class="tm-slot-grid">
                  <button type="button" class="tm-slot-btn active" onclick="selectSlotSidebar(this)">10:30 AM</button>
                  <button type="button" class="tm-slot-btn" onclick="selectSlotSidebar(this)">12:00 PM</button>
                  <button type="button" class="tm-slot-btn" onclick="selectSlotSidebar(this)">02:30 PM</button>
                  <button type="button" class="tm-slot-btn" onclick="selectSlotSidebar(this)">04:30 PM</button>
                  <button type="button" class="tm-slot-btn" onclick="selectSlotSidebar(this)">06:00 PM</button>
                  <button type="button" class="tm-slot-btn" onclick="selectSlotSidebar(this)">07:00 PM</button>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label small fw-bold text-navy mb-1">3. Patient Full Name</label>
                <input type="text" class="form-control" placeholder="Enter patient name" required>
              </div>

              <div class="mb-3">
                <label class="form-label small fw-bold text-navy mb-1">4. Mobile Number</label>
                <input type="tel" pattern="[0-9]{10}" class="form-control" placeholder="10-digit mobile number" required>
              </div>

              <div class="mb-3">
                <label class="form-label small fw-bold text-navy mb-1">5. Consultation Location</label>
                <select class="form-select">
                  <option selected>Greater Noida West Clinic (Gaur City)</option>
                  <option>Senior Citizen Home Visit (Doorstep)</option>
                </select>
              </div>

              <button type="submit" class="tm-btn tm-btn-primary w-100 py-2 mb-3">
                <i class="bi bi-calendar2-check-fill"></i> Confirm Free Trial Slot
              </button>
            </form>

            <div class="border-top pt-3 text-center">
              <div class="small text-muted mb-2">Need immediate assistance?</div>
              <div class="d-flex gap-2">
                <a href="tel:{{ $sitePhoneRaw ?? site_phone_raw() }}" class="tm-btn tm-btn-outline-navy w-100 tm-btn-sm"><i class="bi bi-telephone-fill"></i> Call Doctor</a>
                <a href="https://wa.me/{{ $siteWhatsApp ?? site_whatsapp() }}" target="_blank" class="tm-btn tm-btn-outline-navy w-100 tm-btn-sm" style="color: #25D366; border-color: #25D366;"><i class="bi bi-whatsapp"></i> WhatsApp</a>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>
  </section>

  <script>
    function selectSlotSidebar(btn) {
      btn.parentElement.querySelectorAll('.tm-slot-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
    }
    const today = new Date().toISOString().split('T')[0];
    const dateInput = document.getElementById('bookingDate');
    if (dateInput) {
      dateInput.value = today;
      dateInput.min = today;
    }
  </script>
@endsection
