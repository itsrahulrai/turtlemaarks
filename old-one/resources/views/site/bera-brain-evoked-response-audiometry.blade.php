@extends('site.layouts.app')

@section('title', 'BERA (Brain Evoked Response Audiometry) — Turtle Maarks Hearing Health')
@section('meta_description', 'Brain Evoked Response Audiometry (BERA / ABR) electrophysiological hearing test in Greater Noida West. Objective infant and neurological hearing thresholds.')
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
          <span class="tm-breadcrumb-current" aria-current="page">BERA (Brain Evoked Response)</span>
        </div>
      </nav>
      <h1 class="display-6 fw-bold text-white mb-2 font-heading">BERA (Brain Evoked Response Audiometry)</h1>
      <p class="text-white-50 mx-auto small mb-0" style="max-width: 680px;">An objective electrophysiological diagnostic test evaluating auditory nerve transmission and brainstem pathway integrity in newborns, infants, and non-verbal adults.</p>
    </div>
  </section>

  <!-- MAIN SERVICE CONTENT & SIDEBAR -->
  <section class="py-5 bg-light">
    <div class="container">
      <div class="row g-4 tm-service-layout-row">
        
        <!-- Left: Clinical Content -->
        <div class="col-lg-8 tm-service-main-col">
          
          <!-- Featured Image Card -->
          <div class="card rounded-4 border overflow-hidden bg-white shadow-xs mb-4">
            <div style="aspect-ratio: 16/9; background: #F8FAFC; overflow: hidden;">
              <img src="{{ tm_asset('images/services/bera.webp') }}" alt="BERA Brainstem Evoked Response Audiometry Test" class="w-100 h-100 object-fit-cover">
            </div>
            <div class="p-3 bg-white border-top d-flex justify-content-between align-items-center flex-wrap gap-2">
              <div class="d-flex align-items-center gap-3">
                <span class="badge bg-light text-navy border px-3 py-2 small fw-bold"><i class="bi bi-clock text-orange me-1"></i> 45 Mins Duration</span>
                <span class="badge bg-light text-navy border px-3 py-2 small fw-bold"><i class="bi bi-cpu text-info me-1"></i> Brainstem Electrophysiology</span>
              </div>
            </div>
          </div>

          <!-- Overview Card -->
          <div class="card rounded-4 border p-4 p-md-5 bg-white shadow-xs mb-4">
            <h3 class="fw-bold text-navy mb-3 font-heading">What is BERA (Brain Evoked Response Audiometry)?</h3>
            <p class="text-secondary" style="font-size: 1.025rem; line-height: 1.7;">
              BERA, or Brain Evoked Response Audiometry, is a non-invasive diagnostic test that measures the brain’s electrical activity in response to sound stimuli. It is especially useful in assessing hearing in newborns, young children, and individuals who are unable to respond to conventional hearing tests.
            </p>
            <p class="text-secondary" style="font-size: 1.025rem; line-height: 1.7;">
              By placing small electrodes on the scalp, the test records how sound signals travel along the auditory nerve to the brainstem. BERA helps detect hearing loss, neurological issues, and auditory pathway disorders with precision. It is safe, painless, and plays a crucial role in early hearing detection and intervention.
            </p>
            <p class="text-secondary mb-0" style="font-size: 1.025rem; line-height: 1.7;">
              BERA, or Brain Evoked Response Audiometry, is an advanced, objective hearing test that evaluates how sound signals travel from the ear through the auditory nerve to the brainstem. This test is especially beneficial for individuals who cannot provide reliable behavioral responses to traditional hearing tests — such as newborns, infants, individuals with developmental delays, or unconscious patients.
            </p>
          </div>

          <!-- Key Benefits of BERA Testing Card -->
          <div class="card rounded-4 border p-4 p-md-5 bg-white shadow-xs mb-4">
            <h4 class="fw-bold text-navy mb-4 font-heading"><i class="bi bi-patch-check-fill text-orange me-2"></i>Key Benefits of BERA Testing</h4>
            
            <div class="d-flex flex-column gap-3">
              <div class="d-flex align-items-start gap-3 p-3 rounded-3 bg-light border">
                <div class="rounded-circle bg-info-subtle text-info d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px;"><i class="bi bi-heart-pulse-fill"></i></div>
                <div>
                  <h6 class="fw-bold text-navy mb-1">Early Diagnosis in Infants &amp; Neonates</h6>
                  <p class="small text-secondary mb-0">It is one of the most effective methods to identify hearing impairment in newborns and babies, allowing for timely clinical and habilitative intervention before critical speech milestones.</p>
                </div>
              </div>

              <div class="d-flex align-items-start gap-3 p-3 rounded-3 bg-light border">
                <div class="rounded-circle bg-info-subtle text-info d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px;"><i class="bi bi-check2-circle"></i></div>
                <div>
                  <h6 class="fw-bold text-navy mb-1">Objective and 100% Reliable</h6>
                  <p class="small text-secondary mb-0">No active verbal or motor response is required from the patient, making it suitable for infants during natural sleep, sedated patients, or individuals with cognitive impairments.</p>
                </div>
              </div>

              <div class="d-flex align-items-start gap-3 p-3 rounded-3 bg-light border">
                <div class="rounded-circle bg-info-subtle text-info d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px;"><i class="bi bi-diagram-2-fill"></i></div>
                <div>
                  <h6 class="fw-bold text-navy mb-1">Neurological Pathway Insight</h6>
                  <p class="small text-secondary mb-0">It helps evaluate retrocochlear and neurological pathologies, such as acoustic neuroma (vestibular schwannoma), auditory neuropathy spectrum disorder (ANSD), and brainstem lesions.</p>
                </div>
              </div>

              <div class="d-flex align-items-start gap-3 p-3 rounded-3 bg-light border">
                <div class="rounded-circle bg-info-subtle text-info d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px;"><i class="bi bi-shield-check"></i></div>
                <div>
                  <h6 class="fw-bold text-navy mb-1">Non-Invasive &amp; Completely Painless</h6>
                  <p class="small text-secondary mb-0">Surface sticker electrodes rest lightly on the forehead and mastoid bones. The procedure is entirely safe, with no radiation, discomfort, or risks involved.</p>
                </div>
              </div>
            </div>

            <div class="alert alert-info border-0 mt-4 mb-0 small">
              <i class="bi bi-info-circle-fill me-1"></i> At our center, BERA testing is conducted by RCI-certified senior audiologists using computerized multichannel neuro-diagnostic equipment to ensure clinical precision.
            </div>

          </div>

        </div>

        <!-- Right: Diagnostic Services Sidebar -->
        <div class="col-lg-4 tm-service-sidebar">
          
          <!-- 1. Diagnostic Services Navigation Widget -->
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
              <a href="{{ route('bera-brain-evoked-response-audiometry') }}" class="tm-diag-nav-item active">
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
              <a href="{{ route('service-video-otoscopy') }}" class="tm-diag-nav-item">
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

          <!-- 2. Book Your Test (Vertical Wizard Card matching Book Your Appointment) -->
          <div class="tm-vert-booking-card">
            <!-- Header -->
            <div class="bg-navy p-3 px-4 text-white d-flex justify-content-between align-items-center">
              <div>
                <span class="text-white-50 extra-small text-uppercase fw-bold tracking-wider d-block">Quick Booking</span>
                <h5 class="fw-bold text-white mb-0 font-heading"><i class="bi bi-calendar2-check text-orange me-2"></i>Book Your Test</h5>
              </div>
              <span class="badge bg-orange text-white fw-bold px-3 py-2 fs-6">₹3,500</span>
            </div>

            <div class="p-4">
              <form onsubmit="event.preventDefault(); showToast('Appointment Confirmed!', 'Your BERA test has been scheduled.', 'success'); this.reset();">
                
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
                        <span class="text-secondary extra-small">Sound-Treated Booth &bull; Lab Testing</span>
                      </div>
                    </div>
                  </div>
                  <div class="tm-vert-option-card" onclick="selectVertCard(this)">
                    <span class="tm-booking-option-check"><i class="bi bi-check-lg"></i></span>
                    <div class="d-flex align-items-center gap-2">
                      <div class="tm-booking-opt-icon"><i class="bi bi-house-heart-fill"></i></div>
                      <div>
                        <div class="fw-bold text-navy small">Doorstep Home Visit</div>
                        <span class="text-secondary extra-small">Elderly &bull; Portable Neuro Unit</span>
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
                        <div class="fw-bold text-navy small">Dr. Saurabh Mishra, BASLP</div>
                        <span class="text-secondary extra-small">Pediatric &amp; Neuro BERA Expert</span>
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
                    <button type="button" class="tm-slot-btn" onclick="selectSlotSidebar(this)">01:30 PM</button>
                    <button type="button" class="tm-slot-btn" onclick="selectSlotSidebar(this)">03:30 PM</button>
                    <button type="button" class="tm-slot-btn" onclick="selectSlotSidebar(this)">05:15 PM</button>
                    <button type="button" class="tm-slot-btn" onclick="selectSlotSidebar(this)">06:45 PM</button>
                  </div>
                </div>

                <!-- STEP 4: Patient Details -->
                <div class="mb-3">
                  <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="tm-step-badge-vert">4</span>
                    <label class="fw-bold text-navy small mb-0">Patient / Child Details</label>
                  </div>
                  <div class="mb-2">
                    <input type="text" class="form-control form-control-sm" placeholder="Full Name (or Child Name)" required>
                  </div>
                  <div>
                    <input type="tel" pattern="[0-9]{10}" class="form-control form-control-sm" placeholder="10-Digit Mobile / WhatsApp" required>
                  </div>
                </div>

                <!-- Live Summary Pill -->
                <div class="p-2 px-3 rounded-3 bg-light border small mb-3">
                  <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="text-muted extra-small">Test:</span>
                    <span class="fw-bold text-navy extra-small">BERA (Brain Evoked Response)</span>
                  </div>
                  <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted extra-small">Total Fee:</span>
                    <span class="fw-bold text-navy extra-small">₹3,500 (Pay at Clinic)</span>
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

          <!-- 3. Direct Clinical Assistance Card -->
          <div class="card rounded-4 border p-4 bg-navy text-white shadow-xs text-center tm-service-assistance-card">
            <div class="rounded-circle bg-white bg-opacity-10 d-inline-flex align-items-center justify-content-center mx-auto mb-2" style="width: 50px; height: 50px;">
              <i class="bi bi-headset text-orange fs-4"></i>
            </div>
            <h5 class="fw-bold text-white mb-1">Need Pediatric Consultation?</h5>
            <p class="text-white-50 small mb-3">Speak with our senior pediatric audiologist about preparing infants for natural sleep BERA.</p>
            <div class="d-grid gap-2">
              <a href="tel:{{ $sitePhoneRaw ?? site_phone_raw() }}" class="tm-btn tm-btn-primary tm-btn-sm"><i class="bi bi-telephone-fill me-1"></i> Call {{ $sitePhone ?? site_phone() }}</a>
              <a href="https://wa.me/{{ $siteWhatsApp ?? site_whatsapp() }}?text={{ rawurlencode('Hi ' . ($siteName ?? site_name()) . ', I would like guidance regarding BERA (Brain Evoked Response Audiometry) testing.') }}" target="_blank" rel="noopener" class="tm-btn tm-btn-whatsapp tm-btn-sm"><i class="bi bi-whatsapp me-1"></i> WhatsApp Consultation</a>
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
    const dInput = document.getElementById('bookingDate');
    if (dInput) {
      dInput.value = today;
      dInput.min = today;
    }
  </script>
@endsection
