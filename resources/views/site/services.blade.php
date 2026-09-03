@extends('site.layouts.app')

@section('title', 'Clinical Services & Diagnostic Hearing Tests — Turtle Maarks')
@section('meta_description', 'Comprehensive clinical audiology in Greater Noida West: PTA, Tympanometry, BERA, OAE, Video Otoscopy, 7-Day Hearing Aid Trials, Speech Therapy & Doorstep Home Visits.')
@section('active_nav', 'services')

@section('content')
<!-- HERO BANNER -->
  <section class="tm-page-hero text-center position-relative">
    <div class="container">
      <nav aria-label="breadcrumb" class="d-inline-flex mb-2">
        <div class="tm-breadcrumb-pill">
          <a href="{{ route('home') }}"><i class="bi bi-house-door"></i> Home</a>
          <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
          <span class="tm-breadcrumb-current" aria-current="page">Services</span>
        </div>
      </nav>
      <h1 class="display-6 fw-bold text-white mb-2 font-heading">Clinical Audiology &amp; Diagnostic Services</h1>
      <p class="text-white-50 mx-auto small mb-3" style="max-width: 680px;">RCI-certified audiological assessments, sound-treated booth testing, precision digital hearing aid fittings, and speech rehabilitation in Greater Noida West.</p>
      
      <div class="d-flex flex-wrap justify-content-center gap-2 pt-1">
        <span class="badge bg-white bg-opacity-10 text-white border border-white-15 px-3 py-2 small fw-normal">
          <i class="bi bi-soundwave text-warning me-1"></i> Sound-Treated Booth
        </span>
        <span class="badge bg-white bg-opacity-10 text-white border border-white-15 px-3 py-2 small fw-normal">
          <i class="bi bi-patch-check-fill text-warning me-1"></i> RCI-Certified Specialists
        </span>
        <span class="badge bg-white bg-opacity-10 text-white border border-white-15 px-3 py-2 small fw-normal">
          <i class="bi bi-file-earmark-medical text-warning me-1"></i> Same-Day Printed Reports
        </span>
        <span class="badge bg-white bg-opacity-10 text-white border border-white-15 px-3 py-2 small fw-normal">
          <i class="bi bi-house-heart-fill text-warning me-1"></i> Senior Doorstep Visits
        </span>
      </div>
    </div>
  </section>

  <!-- ASSURANCE & CLINICAL TRUST STRIP -->
  <section class="py-4 bg-white border-bottom shadow-xs">
    <div class="container">
      <div class="row g-3 g-md-4">
        <div class="col-6 col-lg-3">
          <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-orange-subtle text-orange d-flex align-items-center justify-content-center flex-shrink-0" style="width: 44px; height: 44px; font-size: 1.25rem;">
              <i class="bi bi-clock-history"></i>
            </div>
            <div>
              <div class="fw-bold text-navy small">Zero Waiting Time</div>
              <div class="text-muted extra-small">Guaranteed entry at your confirmed slot</div>
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-3">
          <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 44px; height: 44px; font-size: 1.25rem;">
              <i class="bi bi-person-badge"></i>
            </div>
            <div>
              <div class="fw-bold text-navy small">Senior Audiologists</div>
              <div class="text-muted extra-small">10+ years premier hospital experience</div>
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-3">
          <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-success-subtle text-success d-flex align-items-center justify-content-center flex-shrink-0" style="width: 44px; height: 44px; font-size: 1.25rem;">
              <i class="bi bi-shield-check"></i>
            </div>
            <div>
              <div class="fw-bold text-navy small">100% Calibrated Lab</div>
              <div class="text-muted extra-small">ISO certified digital diagnostic equipment</div>
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-3">
          <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-info-subtle text-info d-flex align-items-center justify-content-center flex-shrink-0" style="width: 44px; height: 44px; font-size: 1.25rem;">
              <i class="bi bi-geo-alt-fill"></i>
            </div>
            <div>
              <div class="fw-bold text-navy small">Gaur City Clinic</div>
              <div class="text-muted extra-small">15th Flr, Gaur City Mall + Home Visits</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- MAIN SERVICES HUB -->
  <section class="py-5 bg-light">
    <div class="container">

      <!-- Category Filter Tabs -->
      <div class="tm-service-tabs-nav">
        <button type="button" class="tm-service-tab-btn active" onclick="filterServices('all', this)">
          <i class="bi bi-grid-fill"></i> All Clinical Services <span class="badge bg-light text-navy ms-1">11</span>
        </button>
        <button type="button" class="tm-service-tab-btn" onclick="filterServices('diagnostic', this)">
          <i class="bi bi-soundwave"></i> Diagnostic Hearing Tests <span class="badge bg-light text-navy ms-1">5</span>
        </button>
        <button type="button" class="tm-service-tab-btn" onclick="filterServices('fitting', this)">
          <i class="bi bi-earbuds"></i> Hearing Aids &amp; Fitting <span class="badge bg-light text-navy ms-1">3</span>
        </button>
        <button type="button" class="tm-service-tab-btn" onclick="filterServices('therapy', this)">
          <i class="bi bi-heart-pulse"></i> Therapy &amp; Care <span class="badge bg-light text-navy ms-1">3</span>
        </button>
      </div>

      <!-- Services Cards Grid -->
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="servicesGrid">

        <!-- 1. PTA (Pure Tone Audiometry) -->
        <div class="col service-item" data-category="diagnostic">
          <div class="tm-service-hub-card">
            <div class="tm-service-hub-img-wrap">
              <img src="{{ tm_asset('images/services/pta.webp') }}" alt="PTA (Pure Tone Audiometry)" class="tm-service-hub-img" loading="lazy">
              <span class="tm-service-hub-badge-top badge bg-white text-navy shadow-sm">
                <i class="bi bi-clock text-orange me-1"></i> 30 Mins
              </span>
              <span class="tm-service-hub-price-tag">₹1,200</span>
            </div>
            <div class="tm-service-hub-body">
              <span class="text-orange small fw-bold text-uppercase mb-1" style="font-size: 0.72rem; letter-spacing: 0.5px;">Diagnostic Hearing Test</span>
              <h4 class="tm-service-hub-title">PTA (Pure Tone Audiometry)</h4>
              <p class="tm-service-hub-desc">Gold-standard hearing threshold test measuring air and bone conduction across frequencies (250Hz - 8000Hz) in a certified sound-treated booth.</p>
              
              <ul class="tm-service-hub-features">
                <li><i class="bi bi-check-circle-fill"></i> Acoustically isolated sound-treated booth</li>
                <li><i class="bi bi-check-circle-fill"></i> Air &amp; bone conduction differential threshold</li>
                <li><i class="bi bi-check-circle-fill"></i> Immediate printed audiogram report</li>
              </ul>

              <div class="tm-service-hub-actions">
                <button type="button" class="tm-btn tm-btn-primary tm-btn-sm flex-grow-1" onclick="openBookingModal('PTA (Pure Tone Audiometry)', '₹1,200')">
                  <i class="bi bi-calendar2-check-fill me-1"></i> Book Test
                </button>
                <a href="{{ route('pta-pure-tone-audiometry') }}" class="tm-btn tm-btn-outline-navy tm-btn-sm flex-grow-1 text-center">
                  Full Details <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- 2. Tymp (Tympanometry) -->
        <div class="col service-item" data-category="diagnostic">
          <div class="tm-service-hub-card">
            <div class="tm-service-hub-img-wrap">
              <img src="{{ tm_asset('images/services/tymp.webp') }}" alt="Tymp (Tympanometry)" class="tm-service-hub-img" loading="lazy">
              <span class="tm-service-hub-badge-top badge bg-white text-navy shadow-sm">
                <i class="bi bi-clock text-orange me-1"></i> 15 Mins
              </span>
              <span class="tm-service-hub-price-tag">₹800</span>
            </div>
            <div class="tm-service-hub-body">
              <span class="text-primary small fw-bold text-uppercase mb-1" style="font-size: 0.72rem; letter-spacing: 0.5px;">Middle Ear Diagnostics</span>
              <h4 class="tm-service-hub-title">Tymp (Tympanometry)</h4>
              <p class="tm-service-hub-desc">Rapid, objective examination evaluating middle ear pressure, eardrum mobility, fluid effusion, and Eustachian tube function.</p>
              
              <ul class="tm-service-hub-features">
                <li><i class="bi bi-check-circle-fill"></i> Fluid &amp; infection detection behind eardrum</li>
                <li><i class="bi bi-check-circle-fill"></i> Eustachian tube pressure compliance check</li>
                <li><i class="bi bi-check-circle-fill"></i> Computerized graph (Type A, B, C curves)</li>
              </ul>

              <div class="tm-service-hub-actions">
                <button type="button" class="tm-btn tm-btn-primary tm-btn-sm flex-grow-1" onclick="openBookingModal('Tymp (Tympanometry)', '₹800')">
                  <i class="bi bi-calendar2-check-fill me-1"></i> Book Test
                </button>
                <a href="{{ route('tymp-tympanometry') }}" class="tm-btn tm-btn-outline-navy tm-btn-sm flex-grow-1 text-center">
                  Full Details <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- 3. BERA (Brain Evoked Response Audiometry) -->
        <div class="col service-item" data-category="diagnostic">
          <div class="tm-service-hub-card">
            <div class="tm-service-hub-img-wrap">
              <img src="{{ tm_asset('images/services/bera.webp') }}" alt="BERA (Brain Evoked Response Audiometry)" class="tm-service-hub-img" loading="lazy">
              <span class="tm-service-hub-badge-top badge bg-white text-navy shadow-sm">
                <i class="bi bi-clock text-orange me-1"></i> 60 Mins
              </span>
              <span class="tm-service-hub-price-tag">₹3,500</span>
            </div>
            <div class="tm-service-hub-body">
              <span class="text-info small fw-bold text-uppercase mb-1" style="font-size: 0.72rem; letter-spacing: 0.5px;">Electrophysiology &amp; Pediatrics</span>
              <h4 class="tm-service-hub-title">BERA (Brain Evoked Response)</h4>
              <p class="tm-service-hub-desc">Objective electrophysiological hearing assessment recording brainstem electrical waves in response to sound. Ideal for infants and uncooperative patients.</p>
              
              <ul class="tm-service-hub-features">
                <li><i class="bi bi-check-circle-fill"></i> 100% objective testing during natural infant sleep</li>
                <li><i class="bi bi-check-circle-fill"></i> Auditory nerve &amp; brainstem pathway integrity</li>
                <li><i class="bi bi-check-circle-fill"></i> Detailed waveform latency &amp; amplitude map</li>
              </ul>

              <div class="tm-service-hub-actions">
                <button type="button" class="tm-btn tm-btn-primary tm-btn-sm flex-grow-1" onclick="openBookingModal('BERA (Brain Evoked Response Audiometry)', '₹3,500')">
                  <i class="bi bi-calendar2-check-fill me-1"></i> Book Test
                </button>
                <a href="{{ route('bera-brain-evoked-response-audiometry') }}" class="tm-btn tm-btn-outline-navy tm-btn-sm flex-grow-1 text-center">
                  Full Details <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- 4. OAE (Oto Acoustic Emission) -->
        <div class="col service-item" data-category="diagnostic">
          <div class="tm-service-hub-card">
            <div class="tm-service-hub-img-wrap">
              <img src="{{ tm_asset('images/services/oae.webp') }}" alt="OAE (Oto Acoustic Emission)" class="tm-service-hub-img" loading="lazy">
              <span class="tm-service-hub-badge-top badge bg-white text-navy shadow-sm">
                <i class="bi bi-clock text-orange me-1"></i> 20 Mins
              </span>
              <span class="tm-service-hub-price-tag">₹1,500</span>
            </div>
            <div class="tm-service-hub-body">
              <span class="text-success small fw-bold text-uppercase mb-1" style="font-size: 0.72rem; letter-spacing: 0.5px;">Cochlear Screening</span>
              <h4 class="tm-service-hub-title">OAE (Oto Acoustic Emission)</h4>
              <p class="tm-service-hub-desc">Non-invasive test measuring acoustic echo waves generated by healthy cochlear outer hair cells in response to click sounds. Universal newborn screening.</p>
              
              <ul class="tm-service-hub-features">
                <li><i class="bi bi-check-circle-fill"></i> Painless 5-minute pediatric inner ear check</li>
                <li><i class="bi bi-check-circle-fill"></i> Universal Newborn Hearing Screening (UNHS)</li>
                <li><i class="bi bi-check-circle-fill"></i> Early ototoxicity &amp; noise damage monitoring</li>
              </ul>

              <div class="tm-service-hub-actions">
                <button type="button" class="tm-btn tm-btn-primary tm-btn-sm flex-grow-1" onclick="openBookingModal('OAE (Oto Acoustic Emission)', '₹1,500')">
                  <i class="bi bi-calendar2-check-fill me-1"></i> Book Test
                </button>
                <a href="{{ route('oae-oto-acoustic-emission') }}" class="tm-btn tm-btn-outline-navy tm-btn-sm flex-grow-1 text-center">
                  Full Details <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- 5. HD Video Otoscopy Exam -->
        <div class="col service-item" data-category="diagnostic">
          <div class="tm-service-hub-card">
            <div class="tm-service-hub-img-wrap">
              <img src="{{ tm_asset('images/services/oticon-hearing-aid-clinic-in-noida-extension.png') }}" alt="HD Video Otoscopy Exam" class="tm-service-hub-img" loading="lazy">
              <span class="tm-service-hub-badge-top badge bg-white text-navy shadow-sm">
                <i class="bi bi-clock text-orange me-1"></i> 15 Mins
              </span>
              <span class="tm-service-hub-price-tag">₹500</span>
            </div>
            <div class="tm-service-hub-body">
              <span class="text-secondary small fw-bold text-uppercase mb-1" style="font-size: 0.72rem; letter-spacing: 0.5px;">Visual Ear Inspection</span>
              <h4 class="tm-service-hub-title">HD Video Otoscopy Exam</h4>
              <p class="tm-service-hub-desc">High-definition fiberoptic camera inspection of your ear canal and eardrum, displayed live on a large patient monitor in real time.</p>
              
              <ul class="tm-service-hub-features">
                <li><i class="bi bi-check-circle-fill"></i> Live 1080p high-resolution screen display</li>
                <li><i class="bi bi-check-circle-fill"></i> Immediate wax impaction &amp; tear diagnosis</li>
                <li><i class="bi bi-check-circle-fill"></i> Digital photo record for clinical tracking</li>
              </ul>

              <div class="tm-service-hub-actions">
                <button type="button" class="tm-btn tm-btn-primary tm-btn-sm flex-grow-1" onclick="openBookingModal('HD Video Otoscopy Exam', '₹500')">
                  <i class="bi bi-calendar2-check-fill me-1"></i> Book Exam
                </button>
                <a href="{{ route('service-video-otoscopy') }}" class="tm-btn tm-btn-outline-navy tm-btn-sm flex-grow-1 text-center">
                  Full Details <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- 6. Hearing Aid Trial & Fitting -->
        <div class="col service-item" data-category="fitting">
          <div class="tm-service-hub-card">
            <div class="tm-service-hub-img-wrap">
              <img src="{{ tm_asset('images/services/hearing-aid-clinic-in-noida-extension.png') }}" alt="Hearing Aid Trial & Fitting" class="tm-service-hub-img" loading="lazy">
              <span class="tm-service-hub-badge-top badge bg-success text-white shadow-sm">
                <i class="bi bi-check-circle me-1"></i> 7-Day Free Trial
              </span>
              <span class="tm-service-hub-price-tag" style="background: rgba(16, 185, 129, 0.92);">FREE TRIAL</span>
            </div>
            <div class="tm-service-hub-body">
              <span class="text-success small fw-bold text-uppercase mb-1" style="font-size: 0.72rem; letter-spacing: 0.5px;">Dispensing &amp; Fitting</span>
              <h4 class="tm-service-hub-title">Hearing Aid Trial &amp; Fitting</h4>
              <p class="tm-service-hub-desc">Try top global hearing aids (Phonak, Oticon, Signia, Widex, ReSound) in clinic and at home before making any purchase decision.</p>
              
              <ul class="tm-service-hub-features">
                <li><i class="bi bi-check-circle-fill"></i> Real-Ear Measurement (REM) clinical verification</li>
                <li><i class="bi bi-check-circle-fill"></i> Multi-brand sound comparison in real time</li>
                <li><i class="bi bi-check-circle-fill"></i> 7-day risk-free home listening trial</li>
              </ul>

              <div class="tm-service-hub-actions">
                <button type="button" class="tm-btn tm-btn-primary tm-btn-sm flex-grow-1" onclick="openBookingModal('Hearing Aid Trial & Fitting', 'Free Trial')">
                  <i class="bi bi-calendar2-check-fill me-1"></i> Book Free Trial
                </button>
                <a href="{{ route('service-hearing-aid-trial') }}" class="tm-btn tm-btn-outline-navy tm-btn-sm flex-grow-1 text-center">
                  Full Details <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- 7. Custom Silicone Ear Moulds -->
        <div class="col service-item" data-category="fitting">
          <div class="tm-service-hub-card">
            <div class="tm-service-hub-img-wrap">
              <img src="{{ tm_asset('images/services/horizon-hearing-aid-clinic-in-noida-extension.png') }}" alt="Custom Silicone Ear Moulds" class="tm-service-hub-img" loading="lazy">
              <span class="tm-service-hub-badge-top badge bg-white text-navy shadow-sm">
                <i class="bi bi-clock text-orange me-1"></i> 20 Mins
              </span>
              <span class="tm-service-hub-price-tag">₹900 / Mould</span>
            </div>
            <div class="tm-service-hub-body">
              <span class="text-orange small fw-bold text-uppercase mb-1" style="font-size: 0.72rem; letter-spacing: 0.5px;">Custom Laboratory Ear Moulds</span>
              <h4 class="tm-service-hub-title">Custom Silicone Ear Moulds</h4>
              <p class="tm-service-hub-desc">Custom medical-grade hypoallergenic silicone impressions for BTE devices, hearing protection, swimmer earplugs, and musician in-ear monitors.</p>
              
              <ul class="tm-service-hub-features">
                <li><i class="bi bi-check-circle-fill"></i> Precision 3D ear canal impression taking</li>
                <li><i class="bi bi-check-circle-fill"></i> Perfect acoustic seal against whistling feedback</li>
                <li><i class="bi bi-check-circle-fill"></i> Ultra-soft medical silicone for all-day comfort</li>
              </ul>

              <div class="tm-service-hub-actions">
                <button type="button" class="tm-btn tm-btn-primary tm-btn-sm flex-grow-1" onclick="openBookingModal('Custom Silicone Ear Moulds', '₹900 / Mould')">
                  <i class="bi bi-calendar2-check-fill me-1"></i> Book Slot
                </button>
                <a href="{{ route('service-ear-moulds') }}" class="tm-btn tm-btn-outline-navy tm-btn-sm flex-grow-1 text-center">
                  Full Details <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- 8. Hearing Aid Repair & Care -->
        <div class="col service-item" data-category="fitting">
          <div class="tm-service-hub-card">
            <div class="tm-service-hub-img-wrap">
              <img src="{{ tm_asset('images/hearing-aid-repair-services.webp') }}" alt="Hearing Aid Repair & Care" class="tm-service-hub-img" loading="lazy">
              <span class="tm-service-hub-badge-top badge bg-white text-navy shadow-sm">
                <i class="bi bi-tools text-orange me-1"></i> Lab Service
              </span>
              <span class="tm-service-hub-price-tag">Free Checkup</span>
            </div>
            <div class="tm-service-hub-body">
              <span class="text-primary small fw-bold text-uppercase mb-1" style="font-size: 0.72rem; letter-spacing: 0.5px;">Acoustic Lab Maintenance</span>
              <h4 class="tm-service-hub-title">Hearing Aid Repair &amp; Care</h4>
              <p class="tm-service-hub-desc">Authorized acoustic lab repairs, ultrasonic moisture dehumidification, microphone &amp; receiver replacement for all major brands.</p>
              
              <ul class="tm-service-hub-features">
                <li><i class="bi bi-check-circle-fill"></i> Free diagnostic inspection &amp; repair quote</li>
                <li><i class="bi bi-check-circle-fill"></i> Original brand spares (Phonak, Oticon, Signia, etc.)</li>
                <li><i class="bi bi-check-circle-fill"></i> 90-day post-repair warranty on replaced parts</li>
              </ul>

              <div class="tm-service-hub-actions">
                <a href="{{ route('repair') }}" class="tm-btn tm-btn-primary tm-btn-sm flex-grow-1 text-center">
                  <i class="bi bi-tools me-1"></i> Request Repair
                </a>
                <a href="{{ route('repair') }}" class="tm-btn tm-btn-outline-navy tm-btn-sm flex-grow-1 text-center">
                  Pricing Guide <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- 9. Specialized Speech Therapy -->
        <div class="col service-item" data-category="therapy">
          <div class="tm-service-hub-card">
            <div class="tm-service-hub-img-wrap">
              <img src="{{ tm_asset('images/services/audiologist-in-gaur-city.png') }}" alt="Specialized Speech Therapy" class="tm-service-hub-img" loading="lazy">
              <span class="tm-service-hub-badge-top badge bg-white text-navy shadow-sm">
                <i class="bi bi-clock text-orange me-1"></i> 45 Mins
              </span>
              <span class="tm-service-hub-price-tag">₹1,000 / Session</span>
            </div>
            <div class="tm-service-hub-body">
              <span class="text-danger small fw-bold text-uppercase mb-1" style="font-size: 0.72rem; letter-spacing: 0.5px;">Speech &amp; Language Pathology</span>
              <h4 class="tm-service-hub-title">Specialized Speech Therapy</h4>
              <p class="tm-service-hub-desc">Personalized speech therapy for children and adults experiencing speech delay, stammering, articulation issues, autism spectrum, or stroke recovery.</p>
              
              <ul class="tm-service-hub-features">
                <li><i class="bi bi-check-circle-fill"></i> Certified Speech-Language Pathologist (SLP)</li>
                <li><i class="bi bi-check-circle-fill"></i> Child-friendly interactive therapy equipment</li>
                <li><i class="bi bi-check-circle-fill"></i> Monthly milestone and clarity progress tracking</li>
              </ul>

              <div class="tm-service-hub-actions">
                <button type="button" class="tm-btn tm-btn-primary tm-btn-sm flex-grow-1" onclick="openBookingModal('Specialized Speech Therapy', '₹1,000 / Session')">
                  <i class="bi bi-calendar2-check-fill me-1"></i> Book Session
                </button>
                <a href="{{ route('service-speech-therapy') }}" class="tm-btn tm-btn-outline-navy tm-btn-sm flex-grow-1 text-center">
                  Full Details <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- 10. Senior Citizen Home Visit -->
        <div class="col service-item" data-category="therapy">
          <div class="tm-service-hub-card">
            <div class="tm-service-hub-img-wrap">
              <img src="{{ tm_asset('images/services/hearing-test-in-noida-extension.png') }}" alt="Senior Citizen Home Visit" class="tm-service-hub-img" loading="lazy">
              <span class="tm-service-hub-badge-top badge bg-success text-white shadow-sm">
                <i class="bi bi-house-heart me-1"></i> Doorstep Service
              </span>
              <span class="tm-service-hub-price-tag" style="background: rgba(16, 185, 129, 0.92);">FREE SERVICE</span>
            </div>
            <div class="tm-service-hub-body">
              <span class="text-success small fw-bold text-uppercase mb-1" style="font-size: 0.72rem; letter-spacing: 0.5px;">Elderly Care At Home</span>
              <h4 class="tm-service-hub-title">Senior Citizen Home Visit</h4>
              <p class="tm-service-hub-desc">Doorstep hearing testing, device demonstrations, and fitting sessions across Greater Noida West and Noida for bedridden or elderly family members.</p>
              
              <ul class="tm-service-hub-features">
                <li><i class="bi bi-check-circle-fill"></i> Portable calibrated audiometer equipment</li>
                <li><i class="bi bi-check-circle-fill"></i> Full ear otoscopy &amp; hearing evaluation at home</li>
                <li><i class="bi bi-check-circle-fill"></i> Zero clinic travel stress for elderly parents</li>
              </ul>

              <div class="tm-service-hub-actions">
                <button type="button" class="tm-btn tm-btn-primary tm-btn-sm flex-grow-1" onclick="openBookingModal('Senior Citizen Home Visit', 'Free Doorstep Service')">
                  <i class="bi bi-house-door-fill me-1"></i> Request Home Visit
                </button>
                <a href="{{ route('service-home-visit') }}" class="tm-btn tm-btn-outline-navy tm-btn-sm flex-grow-1 text-center">
                  Full Details <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- 11. Tinnitus Retraining Therapy -->
        <div class="col service-item" data-category="therapy">
          <div class="tm-service-hub-card">
            <div class="tm-service-hub-img-wrap">
              <img src="{{ tm_asset('images/services/widex-hearing-aid-clinic-in-noida-extension.png') }}" alt="Tinnitus Retraining & Masking" class="tm-service-hub-img" loading="lazy">
              <span class="tm-service-hub-badge-top badge bg-white text-navy shadow-sm">
                <i class="bi bi-clock text-orange me-1"></i> 45 Mins
              </span>
              <span class="tm-service-hub-price-tag">₹1,500 / Session</span>
            </div>
            <div class="tm-service-hub-body">
              <span class="text-purple small fw-bold text-uppercase mb-1" style="font-size: 0.72rem; letter-spacing: 0.5px; color: #7C3AED;">Acoustic Habituation</span>
              <h4 class="tm-service-hub-title">Tinnitus Retraining Therapy</h4>
              <p class="tm-service-hub-desc">Specialized acoustic sound therapy, frequency pitch-matching, and psychological counseling to alleviate chronic ringing or buzzing in the ears.</p>
              
              <ul class="tm-service-hub-features">
                <li><i class="bi bi-check-circle-fill"></i> Precision pitch &amp; loudness match audit</li>
                <li><i class="bi bi-check-circle-fill"></i> Tailored fractal sound and notch masking</li>
                <li><i class="bi bi-check-circle-fill"></i> Habituation protocols for restful sleep</li>
              </ul>

              <div class="tm-service-hub-actions">
                <button type="button" class="tm-btn tm-btn-primary tm-btn-sm flex-grow-1" onclick="openBookingModal('Tinnitus Retraining Therapy', '₹1,500 / Session')">
                  <i class="bi bi-calendar2-check-fill me-1"></i> Book Session
                </button>
                <a href="{{ route('service-tinnitus-therapy') }}" class="tm-btn tm-btn-outline-navy tm-btn-sm flex-grow-1 text-center">
                  Full Details <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- HELP & DIRECT CLINICAL CONSULTATION BANNER -->
  <section class="py-5 bg-navy text-white">
    <div class="container">
      <div class="row align-items-center g-4">
        <div class="col-lg-8">
          <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-warning small fw-bold mb-2">
            <i class="bi bi-headset"></i> Unsure which service or test you need?
          </div>
          <h2 class="h3 fw-bold text-white mb-2 font-heading">Consult Our Senior Audiologist Before Booking</h2>
          <p class="text-white-50 mb-0" style="max-width: 640px;">Share your symptoms, previous audiogram, or ENT prescription. Our doctors will guide you toward the exact clinical test or hearing solution suited to your needs.</p>
        </div>
        <div class="col-lg-4 text-lg-end">
          <div class="d-flex flex-column flex-sm-row justify-content-lg-end gap-2">
            <a href="tel:{{ $sitePhoneRaw ?? site_phone_raw() }}" class="tm-btn tm-btn-primary">
              <i class="bi bi-telephone-fill me-1"></i> {{ $sitePhone ?? site_phone() }}
            </a>
            <a href="https://wa.me/{{ $siteWhatsApp ?? site_whatsapp() }}?text={{ rawurlencode('Hi ' . ($siteName ?? site_name()) . ', I would like clinical guidance on choosing the right hearing service or test.') }}" target="_blank" rel="noopener" class="tm-btn tm-btn-whatsapp">
              <i class="bi bi-whatsapp me-1"></i> WhatsApp Doctor
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- MODERN TIME-SLOT BOOKING MODAL -->
  <div class="modal fade" id="tmServiceSlotModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content rounded-4 border-0 shadow-lg overflow-hidden">
        <div class="modal-header bg-navy text-white border-0 py-3 px-4">
          <div>
            <h5 class="modal-title fw-bold text-white mb-0" id="modalServiceTitle">Book Clinical Appointment</h5>
            <span class="badge bg-orange text-white mt-1 fw-normal" id="modalServicePrice">Consultation</span>
          </div>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <form onsubmit="handleSlotBooking(event)">
            
            <div class="mb-3">
              <label class="form-label small fw-bold text-navy mb-1">1. Choose Date</label>
              <input type="date" id="modalDateInput" class="form-control" required>
            </div>

            <div class="mb-3">
              <label class="form-label small fw-bold text-navy mb-1">2. Preferred Time of Day</label>
              <div class="d-grid grid-cols-3 gap-2" style="display: grid; grid-template-columns: repeat(3, 1fr);">
                <button type="button" class="btn btn-sm btn-outline-navy active py-2" onclick="selectModalTime(this, '10:30 AM')">
                  <span class="d-block fw-bold">Morning</span>
                  <small class="text-muted">10:30 AM</small>
                </button>
                <button type="button" class="btn btn-sm btn-outline-navy py-2" onclick="selectModalTime(this, '02:30 PM')">
                  <span class="d-block fw-bold">Afternoon</span>
                  <small class="text-muted">02:30 PM</small>
                </button>
                <button type="button" class="btn btn-sm btn-outline-navy py-2" onclick="selectModalTime(this, '05:30 PM')">
                  <span class="d-block fw-bold">Evening</span>
                  <small class="text-muted">05:30 PM</small>
                </button>
              </div>
              <input type="hidden" id="modalSlotInput" value="10:30 AM">
            </div>

            <div class="mb-3">
              <label class="form-label small fw-bold text-navy mb-1">3. Patient Full Name</label>
              <input type="text" class="form-control" placeholder="Enter patient's full name" required>
            </div>

            <div class="mb-3">
              <label class="form-label small fw-bold text-navy mb-1">4. 10-Digit Mobile Number</label>
              <input type="tel" pattern="[0-9]{10}" class="form-control" placeholder="e.g. 9876543210" required>
            </div>

            <div class="mb-4">
              <label class="form-label small fw-bold text-navy mb-1">5. Location Preference</label>
              <select class="form-select">
                <option selected>Turtle Maarks Clinic — Gaur City Mall (15th Floor)</option>
                <option>Senior Citizen Doorstep Home Visit</option>
              </select>
            </div>

            <button type="submit" class="tm-btn tm-btn-primary w-100 py-2">
              <i class="bi bi-calendar2-check-fill me-1"></i> Confirm Appointment Slot
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Client-side category filtering
    function filterServices(category, btn) {
      document.querySelectorAll('.tm-service-tab-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      const items = document.querySelectorAll('#servicesGrid .service-item');
      items.forEach(item => {
        if (category === 'all' || item.getAttribute('data-category') === category) {
          item.style.display = '';
        } else {
          item.style.display = 'none';
        }
      });
    }

    function selectModalTime(btn, slot) {
      btn.parentElement.querySelectorAll('button').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      document.getElementById('modalSlotInput').value = slot;
    }

    function openBookingModal(serviceName, price) {
      document.getElementById('modalServiceTitle').textContent = serviceName;
      document.getElementById('modalServicePrice').textContent = price;
      
      const today = new Date().toISOString().split('T')[0];
      const dInput = document.getElementById('modalDateInput');
      dInput.value = today;
      dInput.min = today;

      const modal = new bootstrap.Modal(document.getElementById('tmServiceSlotModal'));
      modal.show();
    }

    function handleSlotBooking(e) {
      e.preventDefault();
      const service = document.getElementById('modalServiceTitle').textContent;
      const slot = document.getElementById('modalSlotInput').value;
      const date = document.getElementById('modalDateInput').value;
      const modalEl = document.getElementById('tmServiceSlotModal');
      const modal = bootstrap.Modal.getInstance(modalEl);
      if (modal) modal.hide();

      showToast('Appointment Reserved!', `Your appointment for ${service} on ${date} (${slot}) has been confirmed. Our team will contact you shortly.`, 'success');
      e.target.reset();
    }
  </script>
@endsection
