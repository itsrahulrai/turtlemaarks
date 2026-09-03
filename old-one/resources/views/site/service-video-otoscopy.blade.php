@extends('site.layouts.app')

@section('title', 'HD Video Otoscopy Ear Canal & Eardrum Examination — Turtle Maarks')
@section('meta_description', 'High-definition 1080p fiberoptic ear canal and tympanic membrane examination in Greater Noida West with live patient display screen.')
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
          <span class="tm-breadcrumb-current" aria-current="page">Video Otoscopy</span>
        </div>
      </nav>

      <div class="row align-items-center g-4">
        <div class="col-lg-8">
          <h1 class="display-6 fw-bold text-white mb-2 font-heading">HD Video Otoscopy Ear Canal &amp; Eardrum Exam</h1>
          <p class="text-white-50 mb-3" style="max-width: 680px;">See inside your own ear canal in real time. Our high-resolution medical fiberoptic otoscope inspects for impacted earwax, fungal infection, moisture, eardrum redness, and perforations.</p>
          <div class="d-flex flex-wrap gap-3 text-white-50 small">
            <div><i class="bi bi-clock-fill text-orange"></i> <strong>Duration:</strong> 15 Mins Quick Exam</div>
            <div><i class="bi bi-tag-fill text-orange"></i> <strong>Fee:</strong> ₹500 (Free with Hearing Aid Trials)</div>
            <div><i class="bi bi-display text-orange"></i> <strong>Output:</strong> 1080p Live Screen + Digital Report</div>
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
            <h4 class="fw-bold text-navy mb-3">Live Visual Ear Canal Transparency</h4>
            <p class="text-secondary">Traditional handheld otoscopes only allow the doctor to look inside your ear. At <strong>Turtle Maarks Hearing Health</strong>, our video otoscope features an ultra-slim medical fiberoptic camera that transmits a live 1080p high-definition image to a large monitor right in front of you.</p>
            <p class="text-secondary mb-0">You and your family can clearly see the ear canal walls, whether wax is obstructing sound transmission, and verify that the tympanic membrane (eardrum) is intact and healthy.</p>
          </div>

          <!-- 3-Step Process -->
          <div class="card rounded-4 border p-4 bg-white shadow-xs mb-4">
            <h4 class="fw-bold text-navy mb-4">The 15-Minute Exam Experience</h4>
            
            <div class="tm-service-process-step">
              <div class="tm-service-step-num">1</div>
              <h6 class="fw-bold text-navy mb-1">Sanitized Micro-Speculum Placement</h6>
              <p class="small text-secondary mb-0">A single-use disposable soft tip is attached to the camera probe to ensure absolute clinical hygiene and zero discomfort.</p>
            </div>

            <div class="tm-service-process-step">
              <div class="tm-service-step-num">2</div>
              <h6 class="fw-bold text-navy mb-1">Live 1080p Screen Inspection</h6>
              <p class="small text-secondary mb-0">The doctor guides the probe down the ear canal while you watch on screen. We capture high-res snapshots for your medical records.</p>
            </div>

            <div class="tm-service-process-step">
              <div class="tm-service-step-num">3</div>
              <h6 class="fw-bold text-navy mb-1">Clinical Assessment & Next Steps</h6>
              <p class="small text-secondary mb-0">If impacted wax or foreign body is detected, we advise appropriate microsuction or proceed immediately to audiometric hearing tests.</p>
            </div>
          </div>

          <!-- Common Findings -->
          <div class="card rounded-4 border p-4 bg-white shadow-xs mb-4">
            <h4 class="fw-bold text-navy mb-3">Conditions Detected on Video Otoscopy</h4>
            <div class="row row-cols-1 row-cols-md-2 g-3">
              <div class="col">
                <div class="p-3 bg-light rounded-3 border h-100">
                  <h6 class="fw-bold text-navy mb-1"><i class="bi bi-shield-exclamation text-orange me-1"></i> Impacted Cerumen (Earwax)</h6>
                  <p class="small text-secondary mb-0">Dense wax plugs that can cause temporary 15-30 dB conductive hearing loss and ear fullness.</p>
                </div>
              </div>
              <div class="col">
                <div class="p-3 bg-light rounded-3 border h-100">
                  <h6 class="fw-bold text-navy mb-1"><i class="bi bi-bandaid text-orange me-1"></i> Tympanic Perforation (Eardrum Hole)</h6>
                  <p class="small text-secondary mb-0">Checking eardrum structural integrity before recommending hearing aid receiver types or water exposure.</p>
                </div>
              </div>
              <div class="col">
                <div class="p-3 bg-light rounded-3 border h-100">
                  <h6 class="fw-bold text-navy mb-1"><i class="bi bi-droplet text-orange me-1"></i> Otitis Externa & Infection</h6>
                  <p class="small text-secondary mb-0">Detecting canal swelling, fungus, or bacterial redness for timely ENT referral.</p>
                </div>
              </div>
              <div class="col">
                <div class="p-3 bg-light rounded-3 border h-100">
                  <h6 class="fw-bold text-navy mb-1"><i class="bi bi-check2-all text-orange me-1"></i> Hearing Aid Receiver Fit Verification</h6>
                  <p class="small text-secondary mb-0">Ensuring custom ear moulds or RIC domes seat deeply at the correct acoustic angle without touching sensitive canal bends.</p>
                </div>
              </div>
            </div>
          </div>

        </div>

        <!-- Right: Interactive Sticky Booking Card -->
        <div class="col-lg-4 tm-service-sidebar">

          <!-- Diagnostic Services Navigation Widget -->
          <div class="tm-diag-nav-card">
            <div class="tm-diag-nav-header">
              <h5 class="tm-diag-nav-title">
                <i class="bi bi-soundwave text-orange"></i> Diagnostic Tests
              </h5>
              <span class="badge bg-light text-navy border extra-small">All Procedures</span>
            </div>
            <div class="tm-diag-nav-list">
              
              <!-- PTA -->
              <a href="{{ route('pta-pure-tone-audiometry') }}" class="tm-diag-nav-item">
                <div class="tm-diag-nav-item-left">
                  <div class="tm-diag-nav-icon"><i class="bi bi-soundwave"></i></div>
                  <div>
                    <div class="tm-diag-nav-name">PTA</div>
                    <span class="tm-diag-nav-sub">Pure Tone Audiometry</span>
                  </div>
                </div>
                <span class="tm-diag-nav-badge">₹1,200</span>
              </a>

              <!-- Tymp -->
              <a href="{{ route('tymp-tympanometry') }}" class="tm-diag-nav-item">
                <div class="tm-diag-nav-item-left">
                  <div class="tm-diag-nav-icon"><i class="bi bi-activity"></i></div>
                  <div>
                    <div class="tm-diag-nav-name">Tymp</div>
                    <span class="tm-diag-nav-sub">Tympanometry</span>
                  </div>
                </div>
                <span class="tm-diag-nav-badge">₹800</span>
              </a>

              <!-- BERA -->
              <a href="{{ route('bera-brain-evoked-response-audiometry') }}" class="tm-diag-nav-item">
                <div class="tm-diag-nav-item-left">
                  <div class="tm-diag-nav-icon"><i class="bi bi-cpu"></i></div>
                  <div>
                    <div class="tm-diag-nav-name">BERA</div>
                    <span class="tm-diag-nav-sub">Brain Evoked Response</span>
                  </div>
                </div>
                <span class="tm-diag-nav-badge">₹3,500</span>
              </a>

              <!-- OAE -->
              <a href="{{ route('oae-oto-acoustic-emission') }}" class="tm-diag-nav-item">
                <div class="tm-diag-nav-item-left">
                  <div class="tm-diag-nav-icon"><i class="bi bi-earbuds"></i></div>
                  <div>
                    <div class="tm-diag-nav-name">OAE</div>
                    <span class="tm-diag-nav-sub">Oto Acoustic Emission</span>
                  </div>
                </div>
                <span class="tm-diag-nav-badge">₹1,500</span>
              </a>

              <!-- Video Otoscopy -->
              <a href="{{ route('service-video-otoscopy') }}" class="tm-diag-nav-item active">
                <div class="tm-diag-nav-item-left">
                  <div class="tm-diag-nav-icon"><i class="bi bi-camera-video"></i></div>
                  <div>
                    <div class="tm-diag-nav-name">Video Otoscopy</div>
                    <span class="tm-diag-nav-sub">HD Eardrum Examination</span>
                  </div>
                </div>
                <span class="tm-diag-nav-badge">₹500</span>
              </a>

            </div>
            
            <div class="pt-3 mt-3 border-top text-center">
              <a href="{{ route('diagnostic-services') }}" class="small text-decoration-none fw-bold text-navy">
                <i class="bi bi-grid me-1 text-orange"></i> View All Diagnostic Services &rarr;
              </a>
            </div>
          </div>

          <!-- Book Your Test (Vertical Wizard Card matching Book Your Appointment) -->
          <div class="tm-vert-booking-card">
            <!-- Header -->
            <div class="bg-navy p-3 px-4 text-white d-flex justify-content-between align-items-center">
              <div>
                <span class="text-white-50 extra-small text-uppercase fw-bold tracking-wider d-block">Quick Booking</span>
                <h5 class="fw-bold text-white mb-0 font-heading"><i class="bi bi-calendar2-check text-orange me-2"></i>Book Your Test</h5>
              </div>
              <span class="badge bg-orange text-white fw-bold px-3 py-2 fs-6">₹500</span>
            </div>

            <div class="p-4">
              <form onsubmit="event.preventDefault(); showToast('Appointment Confirmed!', 'Your HD Video Otoscopy exam has been scheduled.', 'success'); this.reset();">
                
                <!-- STEP 1: Location -->
                <div class="mb-3">
                  <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="tm-step-badge-vert">1</span>
                    <label class="fw-bold text-navy small mb-0">Select Location</label>
                  </div>
                  <div class="tm-vert-option-card selected" onclick="selectVertCard(this)">
                    <span class="tm-booking-option-check"><i class="bi bi-check-lg"></i></span>
                    <div class="d-flex align-items-center gap-2">
                      <div class="tm-booking-opt-icon"><i class="bi bi-building"></i></div>
                      <div>
                        <div class="fw-bold text-navy small">Clinic Visit (Gaur City)</div>
                        <span class="text-secondary extra-small">HD Video Monitor &bull; 15th Floor</span>
                      </div>
                    </div>
                  </div>
                  <div class="tm-vert-option-card" onclick="selectVertCard(this)">
                    <span class="tm-booking-option-check"><i class="bi bi-check-lg"></i></span>
                    <div class="d-flex align-items-center gap-2">
                      <div class="tm-booking-opt-icon"><i class="bi bi-house-heart-fill"></i></div>
                      <div>
                        <div class="fw-bold text-navy small">Doorstep Home Visit</div>
                        <span class="text-secondary extra-small">Elderly &bull; Portable Video Otoscope</span>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- STEP 2: Audiologist -->
                <div class="mb-3">
                  <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="tm-step-badge-vert">2</span>
                    <label class="fw-bold text-navy small mb-0">Select Audiologist</label>
                  </div>
                  <div class="tm-vert-option-card selected" onclick="selectVertCard(this)">
                    <span class="tm-booking-option-check"><i class="bi bi-check-lg"></i></span>
                    <div class="d-flex align-items-center gap-2">
                      <div class="tm-booking-opt-icon"><i class="bi bi-lightning-charge-fill text-warning"></i></div>
                      <div>
                        <div class="fw-bold text-navy small">Any Senior Audiologist</div>
                        <span class="badge bg-success-subtle text-success extra-small">Fastest Available Slot</span>
                      </div>
                    </div>
                  </div>
                  <div class="tm-vert-option-card" onclick="selectVertCard(this)">
                    <span class="tm-booking-option-check"><i class="bi bi-check-lg"></i></span>
                    <div class="d-flex align-items-center gap-2">
                      <div class="tm-booking-opt-icon"><i class="bi bi-person-badge-fill text-primary"></i></div>
                      <div>
                        <div class="fw-bold text-navy small">Dr. Ritu Verma, MASLP</div>
                        <span class="text-secondary extra-small">Senior Specialist &bull; 14+ Yrs Exp</span>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- STEP 3: Date & Time -->
                <div class="mb-3">
                  <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="tm-step-badge-vert">3</span>
                    <label class="fw-bold text-navy small mb-0">Date &amp; Preferred Time</label>
                  </div>
                  <input type="date" class="form-control form-control-sm mb-2" required id="bookingDate">
                  <div class="tm-slot-grid">
                    <button type="button" class="tm-slot-btn active" onclick="selectSlotSidebar(this)">10:00 AM</button>
                    <button type="button" class="tm-slot-btn" onclick="selectSlotSidebar(this)">11:45 AM</button>
                    <button type="button" class="tm-slot-btn" onclick="selectSlotSidebar(this)">01:15 PM</button>
                    <button type="button" class="tm-slot-btn" onclick="selectSlotSidebar(this)">03:45 PM</button>
                    <button type="button" class="tm-slot-btn" onclick="selectSlotSidebar(this)">05:15 PM</button>
                    <button type="button" class="tm-slot-btn" onclick="selectSlotSidebar(this)">06:45 PM</button>
                  </div>
                </div>

                <!-- STEP 4: Patient Details -->
                <div class="mb-3">
                  <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="tm-step-badge-vert">4</span>
                    <label class="fw-bold text-navy small mb-0">Patient Information</label>
                  </div>
                  <div class="mb-2">
                    <input type="text" class="form-control form-control-sm" placeholder="Full Patient Name" required>
                  </div>
                  <div>
                    <input type="tel" pattern="[0-9]{10}" class="form-control form-control-sm" placeholder="10-Digit Mobile / WhatsApp" required>
                  </div>
                </div>

                <!-- Live Summary Pill -->
                <div class="p-2 px-3 rounded-3 bg-light border small mb-3">
                  <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="text-muted extra-small">Test:</span>
                    <span class="fw-bold text-navy extra-small">HD Video Otoscopy</span>
                  </div>
                  <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted extra-small">Total Fee:</span>
                    <span class="fw-bold text-navy extra-small">₹500 (Pay at Clinic)</span>
                  </div>
                </div>

                <button type="submit" class="tm-btn tm-btn-primary w-100 py-2 fw-bold mb-2">
                  <i class="bi bi-calendar2-check-fill me-1"></i> Confirm Appointment
                </button>
                <div class="text-center text-muted extra-small">
                  <i class="bi bi-shield-check text-success me-1"></i> Instant confirmation &bull; Zero cancellation fee
                </div>
              </form>
            </div>
          </div>

            <div class="card rounded-4 border p-4 bg-navy text-white shadow-xs text-center mt-3 tm-service-assistance-card">
              <div class="rounded-circle bg-white bg-opacity-10 d-inline-flex align-items-center justify-content-center mx-auto mb-2" style="width: 44px; height: 44px;">
                <i class="bi bi-headset text-orange fs-5"></i>
              </div>
              <h6 class="fw-bold text-white mb-1">Need Clinical Advice?</h6>
              <p class="text-white-50 small mb-3">Speak with our senior clinical audiologist about your eardrum checkup.</p>
              <div class="d-grid gap-2">
                <a href="tel:{{ $sitePhoneRaw ?? site_phone_raw() }}" class="tm-btn tm-btn-primary tm-btn-sm"><i class="bi bi-telephone-fill me-1"></i> Call {{ $sitePhone ?? site_phone() }}</a>
                <a href="https://wa.me/{{ $siteWhatsApp ?? site_whatsapp() }}?text={{ rawurlencode('Hi ' . ($siteName ?? site_name()) . ', I would like information regarding Video Otoscopy examination.') }}" target="_blank" rel="noopener" class="tm-btn tm-btn-whatsapp tm-btn-sm"><i class="bi bi-whatsapp me-1"></i> WhatsApp Consultation</a>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>
  </section>

  <script>
    function selectVertCard(card) {
      const parent = card.parentElement;
      parent.querySelectorAll('.tm-vert-option-card').forEach(c => c.classList.remove('selected'));
      card.classList.add('selected');
    }
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
