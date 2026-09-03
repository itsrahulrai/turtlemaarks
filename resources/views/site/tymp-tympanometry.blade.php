@extends('site.layouts.app')

@section('title', 'Tymp (Tympanometry) — Turtle Maarks Hearing Health')
@section('meta_description', 'Tympanometry diagnostic test in Greater Noida West. Evaluate middle ear pressure, eardrum mobility, fluid effusion, and Eustachian tube function.')
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
          <span class="tm-breadcrumb-current" aria-current="page">Tymp (Tympanometry)</span>
        </div>
      </nav>
      <h1 class="display-6 fw-bold text-white mb-2 font-heading">Tymp (Tympanometry)</h1>
      <p class="text-white-50 mx-auto small mb-0" style="max-width: 680px;">A rapid, objective evaluation of middle ear pressure, eardrum compliance, and ossicular chain mobility with instant computer-generated tympanogram curves.</p>
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
              <img src="{{ tm_asset('images/services/tymp.webp') }}" alt="Tymp Tympanometry Test" class="w-100 h-100 object-fit-cover">
            </div>
            <div class="p-3 bg-white border-top d-flex justify-content-between align-items-center flex-wrap gap-2">
              <div class="d-flex align-items-center gap-3">
                <span class="badge bg-light text-navy border px-3 py-2 small fw-bold"><i class="bi bi-clock text-orange me-1"></i> 15 Mins Duration</span>
                <span class="badge bg-light text-navy border px-3 py-2 small fw-bold"><i class="bi bi-activity text-primary me-1"></i> Objective Middle Ear</span>
              </div>
            </div>
          </div>

          <!-- Overview Card -->
          <div class="card rounded-4 border p-4 p-md-5 bg-white shadow-xs mb-4">
            <h3 class="fw-bold text-navy mb-3 font-heading">What is Tympanometry?</h3>
            <p class="text-secondary" style="font-size: 1.025rem; line-height: 1.7;">
              Tympanometry is a quick and painless diagnostic test that evaluates the condition of the middle ear and the mobility of the eardrum (tympanic membrane). It helps detect problems such as fluid buildup, eustachian tube dysfunction, ear infections, or a perforated eardrum.
            </p>
            <p class="text-secondary" style="font-size: 1.025rem; line-height: 1.7;">
              During the test, a small probe is gently placed into the ear canal, which changes air pressure and measures the eardrum’s response. The results are recorded on a graph called a tympanogram.
            </p>
            <p class="text-secondary mb-0" style="font-size: 1.025rem; line-height: 1.7;">
              Tympanometry is especially useful for both children and adults who experience hearing difficulties, frequent ear infections, or a feeling of fullness in the ear. It's a valuable tool in diagnosing middle ear conditions and guiding effective treatment.
            </p>
          </div>

          <!-- Why is Tympanometry Important? Card -->
          <div class="card rounded-4 border p-4 p-md-5 bg-white shadow-xs mb-4">
            <h4 class="fw-bold text-navy mb-4 font-heading"><i class="bi bi-shield-check text-orange me-2"></i>Why is Tympanometry Important?</h4>
            
            <div class="d-flex flex-column gap-3">
              <div class="d-flex align-items-start gap-3 p-3 rounded-3 bg-light border">
                <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px;"><i class="bi bi-droplet-fill"></i></div>
                <div>
                  <h6 class="fw-bold text-navy mb-1">Fluid in the Middle Ear (Otitis Media with Effusion)</h6>
                  <p class="small text-secondary mb-0">Detects asymptomatic serous or glue-like fluid trapped behind the eardrum, a leading cause of conductive hearing loss in school-going children and adults following colds.</p>
                </div>
              </div>

              <div class="d-flex align-items-start gap-3 p-3 rounded-3 bg-light border">
                <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px;"><i class="bi bi-arrows-collapse"></i></div>
                <div>
                  <h6 class="fw-bold text-navy mb-1">Eustachian Tube Dysfunction (Pressure Imbalance)</h6>
                  <p class="small text-secondary mb-0">Identifies difficulty equalizing middle ear pressure with atmospheric pressure, commonly presenting as ear popping, clicking, pain during flights, or muffled hearing.</p>
                </div>
              </div>

              <div class="d-flex align-items-start gap-3 p-3 rounded-3 bg-light border">
                <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px;"><i class="bi bi-bandaid-fill"></i></div>
                <div>
                  <h6 class="fw-bold text-navy mb-1">Perforated (Ruptured) Eardrum</h6>
                  <p class="small text-secondary mb-0">Measures physical ear canal volume (ECV) to accurately identify microscopic or hidden tympanic membrane tears and monitor healing progression.</p>
                </div>
              </div>

              <div class="d-flex align-items-start gap-3 p-3 rounded-3 bg-light border">
                <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px;"><i class="bi bi-disc-fill"></i></div>
                <div>
                  <h6 class="fw-bold text-navy mb-1">Earwax Blockage &amp; Canal Obstruction</h6>
                  <p class="small text-secondary mb-0">Confirms whether deep cerumen impaction or foreign bodies are preventing sound waves from reaching the tympanic membrane.</p>
                </div>
              </div>

              <div class="d-flex align-items-start gap-3 p-3 rounded-3 bg-light border">
                <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px;"><i class="bi bi-diagram-3-fill"></i></div>
                <div>
                  <h6 class="fw-bold text-navy mb-1">Ossicular Chain Abnormalities</h6>
                  <p class="small text-secondary mb-0">Diagnoses stiffness (such as Otosclerosis) or discontinuity/disarticulation of the three tiny middle ear bones (Malleus, Incus, Stapes).</p>
                </div>
              </div>
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
              <a href="{{ route('tymp-tympanometry') }}" class="tm-diag-nav-item active">
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
              <span class="badge bg-orange text-white fw-bold px-3 py-2 fs-6">₹800</span>
            </div>

            <div class="p-4">
              <form onsubmit="event.preventDefault(); showToast('Appointment Confirmed!', 'Your Tympanometry test has been scheduled.', 'success'); this.reset();">
                
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
                        <span class="text-secondary extra-small">Sound-Treated Booth &bull; 15th Floor</span>
                      </div>
                    </div>
                  </div>
                  <div class="tm-vert-option-card" onclick="selectVertCard(this)">
                    <span class="tm-booking-option-check"><i class="bi bi-check-lg"></i></span>
                    <div class="d-flex align-items-center gap-2">
                      <div class="tm-booking-opt-icon"><i class="bi bi-house-heart-fill"></i></div>
                      <div>
                        <div class="fw-bold text-navy small">Doorstep Home Visit</div>
                        <span class="text-secondary extra-small">Elderly Care &bull; Portable Diagnostic</span>
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
                        <span class="text-secondary extra-small">RCI Specialist &bull; 10+ Yrs Exp</span>
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
                    <button type="button" class="tm-slot-btn" onclick="selectSlotSidebar(this)">11:30 AM</button>
                    <button type="button" class="tm-slot-btn" onclick="selectSlotSidebar(this)">01:00 PM</button>
                    <button type="button" class="tm-slot-btn" onclick="selectSlotSidebar(this)">03:30 PM</button>
                    <button type="button" class="tm-slot-btn" onclick="selectSlotSidebar(this)">05:00 PM</button>
                    <button type="button" class="tm-slot-btn" onclick="selectSlotSidebar(this)">06:30 PM</button>
                  </div>
                </div>

                <!-- STEP 4: Patient Details -->
                <div class="mb-3">
                  <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="tm-step-badge-vert">4</span>
                    <label class="fw-bold text-navy small mb-0">Patient Contact Information</label>
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
                    <span class="fw-bold text-navy extra-small">Tympanometry (Tymp)</span>
                  </div>
                  <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted extra-small">Total Fee:</span>
                    <span class="fw-bold text-navy extra-small">₹800 (Pay at Clinic)</span>
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
            <h5 class="fw-bold text-white mb-1">Need Clinical Advice?</h5>
            <p class="text-white-50 small mb-3">Speak with our audiologist about eardrum fullness, pain, or fluid concerns.</p>
            <div class="d-grid gap-2">
              <a href="tel:{{ $sitePhoneRaw ?? site_phone_raw() }}" class="tm-btn tm-btn-primary tm-btn-sm"><i class="bi bi-telephone-fill me-1"></i> Call {{ $sitePhone ?? site_phone() }}</a>
              <a href="https://wa.me/{{ $siteWhatsApp ?? site_whatsapp() }}?text={{ rawurlencode('Hi ' . ($siteName ?? site_name()) . ', I would like information regarding the Tympanometry (Tymp) test.') }}" target="_blank" rel="noopener" class="tm-btn tm-btn-whatsapp tm-btn-sm"><i class="bi bi-whatsapp me-1"></i> WhatsApp Consultation</a>
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
