@extends('site.layouts.app')

@section('title', 'About Us — Turtle Maarks Hearing Health Clinic')
@section('meta_description', 'Learn about Turtle Maarks Hearing Health in Greater Noida West. Over 20 years of clinical excellence with RCI-registered Audiologists. Free home visits for senior citizens.')
@section('active_nav', 'about')

@section('content')
<!-- =========================================================================
       HERO HEADER (CLEAN & MINIMAL)
       ========================================================================= -->
  <section class="tm-about-hero py-4 text-center">
    <div class="container py-1">
      <!-- Modern Frosted Breadcrumb Pill -->
      <nav aria-label="breadcrumb" class="d-inline-flex mb-2">
        <div class="tm-breadcrumb-pill">
          <a href="{{ route('home') }}"><i class="bi bi-house-door"></i> Home</a>
          <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
          <span class="tm-breadcrumb-current" aria-current="page">About Us</span>
        </div>
      </nav>

      <h1 class="display-6 fw-bold text-white mb-2">Turtle Maarks</h1>
      <p class="text-white-50 mx-auto small mb-0" style="max-width: 520px;">
        Over 20 years of trusted audiological and hearing healthcare in Delhi NCR.
      </p>
    </div>
  </section>

  <!-- =========================================================================
       1. OUR CLINIC STORY & HEALTHCARE PHILOSOPHY
       ========================================================================= -->
  <section class="py-5 bg-white">
    <div class="container">
      <div class="row align-items-center g-5">
        
        <!-- Left: Clinic Photo -->
        <div class="col-lg-6">
          <div class="position-relative">
            <img src="{{ tm_asset('images/about-us.jpg') }}" alt="Turtle Maarks Clinic - Gaur City Mall" class="rounded-4 border shadow-sm w-100 object-fit-cover" style="max-height: 420px;">
            <div class="position-absolute bottom-0 start-0 m-3 p-3 bg-white rounded-3 shadow border d-flex align-items-center gap-3">
              <div class="rounded-circle bg-orange text-white d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; font-size: 1.25rem;">
                <i class="bi bi-patch-check-fill"></i>
              </div>
              <div>
                <strong class="text-navy small d-block">Authorized Clinic Center</strong>
                <span class="small text-secondary" style="font-size: 0.8rem;">Phonak • Oticon • Signia • Widex</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Right: Story & Values -->
        <div class="col-lg-6">
          <span class="tm-pill tm-pill-orange mb-2"><i class="bi bi-heart-pulse-fill"></i> Our Legacy &amp; Mission</span>
          <h2 class="tm-section-title mb-3">Healthcare Grounded in <span>Empathy &amp; Science</span></h2>
          
          <p class="text-secondary small mb-3 leading-relaxed">
            At Turtle Maarks Hearing Health, we understand that hearing loss affects relationships, social confidence, and mental well-being. For over 20 years, our clinic has provided patients across Delhi NCR with evidence-based audiological diagnosis and personalized digital hearing rehabilitation.
          </p>
          <p class="text-secondary small mb-4 leading-relaxed">
            Located conveniently on the <strong>15th Floor of Gaur City Mall, Greater Noida West</strong>, our modern facility features ANSI/ISO calibrated soundproof testing booths, advanced Real-Ear Measurement (REM) equipment, and an experienced medical panel of <strong>RCI-registered audiologists and speech pathologists</strong>.
          </p>

          <!-- 3 Clean Value Checkpoints -->
          <div class="d-flex flex-column gap-2 mb-4">
            <div class="d-flex align-items-center gap-2">
              <i class="bi bi-check-circle-fill text-success fs-5"></i>
              <span class="small text-navy fw-semibold">100% RCI-Registered Audiologists with Master's &amp; Bachelor's Degrees</span>
            </div>
            <div class="d-flex align-items-center gap-2">
              <i class="bi bi-check-circle-fill text-success fs-5"></i>
              <span class="small text-navy fw-semibold">ANSI/ISO Calibrated Double-Walled Soundproof Diagnostic Chambers</span>
            </div>
            <div class="d-flex align-items-center gap-2">
              <i class="bi bi-check-circle-fill text-success fs-5"></i>
              <span class="small text-navy fw-semibold">Lifetime Complimentary Device Fine-Tuning &amp; Vacuum Servicing</span>
            </div>
          </div>

          <div class="d-flex flex-wrap gap-3">
            <a href="{{ route('appointments.create') }}" class="tm-btn tm-btn-primary"><i class="bi bi-calendar2-check me-1"></i> Book Appointment</a>
            <a href="https://wa.me/{{ SITE_WHATSAPP }}?text={{ urlencode('Hello, I would like to consult an audiologist at Turtle Maarks.') }}" target="_blank" rel="noopener" class="tm-btn tm-btn-outline-navy">
              <i class="bi bi-whatsapp text-success me-1"></i> Consult on WhatsApp
            </a>
          </div>

        </div>
      </div>
    </div>
  </section>

  <!-- =========================================================================
       2. SPECIAL SPOTLIGHT: FREE HOME VISITS FOR SENIOR CITIZENS (CLEAN & AWESOME)
       ========================================================================= -->
  <section class="py-5 bg-light">
    <div class="container">
      
      <div class="tm-senior-clean-card">
        <div class="row align-items-center g-4">
          
          <!-- Left Content -->
          <div class="col-lg-7">
            <div class="d-flex align-items-center gap-2 mb-3">
              <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 fw-bold small">
                <i class="bi bi-house-heart-fill me-1"></i> Special Elderly Care Initiative
              </span>
              <span class="badge bg-light text-navy border rounded-pill px-2 py-1 small">
                100% Free
              </span>
            </div>

            <!-- Prominent Exact User Headline -->
            <h2 class="h3 fw-bold text-navy mb-2">
              Home visit available for Senior citizens free of cost.
            </h2>
            <p class="text-secondary small mb-4">
              We understand that elderly grandparents and seniors often face knee pain, mobility challenges, or traffic exhaustion. Turtle Maarks brings hospital-grade portable audiometers, video otoscopes, and digital trial hearing aids straight to your living room at <strong>zero service charge</strong>.
            </p>

            <!-- 4 Clean Feature Items -->
            <div class="row g-2">
              <div class="col-sm-6">
                <div class="tm-clean-feature-item">
                  <div class="tm-clean-feature-icon">
                    <i class="bi bi-armchair-fill"></i>
                  </div>
                  <div>
                    <strong class="text-navy small d-block">Zero Travel Strain</strong>
                    <span class="text-secondary" style="font-size: 0.8rem;">Testing done comfortably in their living room armchair.</span>
                  </div>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="tm-clean-feature-item">
                  <div class="tm-clean-feature-icon">
                    <i class="bi bi-tv-fill"></i>
                  </div>
                  <div>
                    <strong class="text-navy small d-block">Living Room Tuning</strong>
                    <span class="text-secondary" style="font-size: 0.8rem;">Calibrated to their TV volume and family conversations.</span>
                  </div>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="tm-clean-feature-item">
                  <div class="tm-clean-feature-icon">
                    <i class="bi bi-soundwave"></i>
                  </div>
                  <div>
                    <strong class="text-navy small d-block">Multi-Brand Live Trial</strong>
                    <span class="text-secondary" style="font-size: 0.8rem;">Experience Phonak, Oticon &amp; Signia devices live.</span>
                  </div>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="tm-clean-feature-item">
                  <div class="tm-clean-feature-icon">
                    <i class="bi bi-people-fill"></i>
                  </div>
                  <div>
                    <strong class="text-navy small d-block">Family Guidance</strong>
                    <span class="text-secondary" style="font-size: 0.8rem;">Doctor explains the audiogram clearly to all family members.</span>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <!-- Right Booking Box -->
          <div class="col-lg-5">
            <div class="p-4 bg-light rounded-4 border">
              <h5 class="fw-bold text-navy mb-1">Book Free Senior Home Visit</h5>
              <p class="small text-secondary mb-3">Serving Greater Noida West, Noida, Crossing Republik, Indirapuram &amp; Ghaziabad.</p>

              <div class="d-grid gap-2">
                <a href="{{ route('appointments.create') }}" class="tm-btn tm-btn-primary justify-content-center">
                  <i class="bi bi-calendar2-check me-1"></i> Book Free Home Visit Slot
                </a>
                <a href="tel:{{ $sitePhoneRaw ?? site_phone_raw() }}" class="tm-btn tm-btn-outline-navy justify-content-center">
                  <i class="bi bi-telephone-fill me-1"></i> Call {{ $sitePhone ?? site_phone() }}
                </a>
                <a href="https://wa.me/{{ $siteWhatsApp ?? site_whatsapp() }}?text={{ urlencode('Hello, I would like to book a free home visit for a senior citizen.') }}" target="_blank" rel="noopener" class="btn btn-sm btn-success rounded-3 py-2 d-flex align-items-center justify-content-center gap-1">
                  <i class="bi bi-whatsapp"></i> WhatsApp for Senior Visit
                </a>
              </div>

              <div class="text-center mt-3">
                <span class="text-muted" style="font-size: 0.75rem;">
                  <i class="bi bi-shield-check text-success"></i> 100% Free • No purchase obligation • Sanitized equipment
                </span>
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </section>



  
  <!-- =========================================================================
       3. MEET OUR SENIOR AUDIOLOGISTS (CLEAN DOCTOR CARDS)
       ========================================================================= -->

         <section class="py-5 bg-white position-relative">
    <div class="container">
      
      <!-- Section Header -->
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end tm-section-head mb-4 gap-3">
        <div>
          <span class="tm-pill tm-pill-orange mb-2"><i class="bi bi-patch-check-fill"></i> Clinical Leadership</span>
          <h2 class="tm-section-title mb-1">Meet Our <span>Senior Audiologists</span></h2>
          <p class="tm-section-sub mb-0">RCI-registered hearing rehabilitation specialists, diagnostic electrophysiologists, and speech therapists</p>
        </div>
        <div class="d-flex align-items-center gap-2">
          <span class="badge bg-light text-navy border px-3 py-2 rounded-pill small fw-bold d-none d-lg-inline-flex">
            <i class="bi bi-shield-fill-check text-success me-1"></i> 100% RCI Registered Team
          </span>
          <a href="{{ route('about-us') }}" class="tm-btn tm-btn-outline-navy tm-btn-sm">Clinical Profile <i class="bi bi-arrow-right"></i></a>
        </div>
      </div>

      <!-- Doctor Cards Grid -->
      <div class="row g-4">
        
        <!-- Doctor 1: Dr. Ritu Verma -->
        <div class="col-lg-4 col-md-6">
          <div class="tm-doctor-card">
            
            <!-- Photo Media Frame -->
            <div class="tm-doctor-media">
              <img src="{{ tm_asset('images/doctor-single.png') }}" alt="Dr. Ritu Verma - Senior Clinical Audiologist" loading="lazy">
              <div class="tm-doctor-media-overlay">
                <div class="tm-doctor-media-top">
                  <span class="tm-doctor-badge-rci"><i class="bi bi-patch-check-fill"></i> RCI: A14829</span>
                  <span class="tm-doctor-badge-exp"><i class="bi bi-star-fill text-warning me-1"></i> 14+ Yrs Exp</span>
                </div>
                <div class="tm-doctor-media-bottom">
                  <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill small px-2">
                    <span class="tm-live-pulse" style="width:6px;height:6px;"></span> In-Clinic Today
                  </span>
                  <span class="badge bg-white-20 text-white rounded-pill px-2 py-1 small">
                    AIISH Alum
                  </span>
                </div>
              </div>
            </div>

            <!-- Doctor Body Content -->
            <div class="tm-doctor-body">
              <h4 class="tm-doctor-name">Dr. Ritu Verma</h4>
              <div class="tm-doctor-title">Senior Clinical Audiologist &amp; MASLP</div>
              
              <div class="tm-doctor-meta-strip">
                <span><i class="bi bi-mortarboard-fill text-orange me-1"></i> MASLP (Audiology)</span>
                <span class="fw-semibold text-navy"><i class="bi bi-geo-alt-fill text-danger me-1"></i> Gaur City Mall</span>
              </div>

              <p class="tm-doctor-bio">
                Specializes in Real-Ear Measurement (REM), high-precision computer fine-tuning, and severe-to-profound sensorineural hearing rehabilitation for adults and seniors.
              </p>
              
              <div class="tm-doctor-specialties">
                <span class="tm-doctor-spec-chip">Adult Audiology</span>
                <span class="tm-doctor-spec-chip">REM Fitting</span>
                <span class="tm-doctor-spec-chip">Phonak / Oticon Expert</span>
                <span class="tm-doctor-spec-chip">Tinnitus Masking</span>
              </div>

              <div class="tm-doctor-avail">
                <i class="bi bi-calendar2-check text-orange"></i> Available for: Sound Booth &amp; VIP Home Visit
              </div>
            </div>

          </div>
        </div>

        <!-- Doctor 2: Dr. Sumit Kumar Singh -->
        <div class="col-lg-4 col-md-6">
          <div class="tm-doctor-card">
            
            <!-- Photo Media Frame -->
            <div class="tm-doctor-media">
              <img src="{{ tm_asset('images/team/team-02.webp') }}" alt="Dr. Sumit Kumar Singh - Lead Audiologist & Fitting Specialist" loading="lazy">
              <div class="tm-doctor-media-overlay">
                <div class="tm-doctor-media-top">
                  <span class="tm-doctor-badge-rci"><i class="bi bi-patch-check-fill"></i> RCI: A28193</span>
                  <span class="tm-doctor-badge-exp"><i class="bi bi-star-fill text-warning me-1"></i> 10+ Yrs Exp</span>
                </div>
                <div class="tm-doctor-media-bottom">
                  <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill small px-2">
                    <span class="tm-live-pulse" style="width:6px;height:6px;"></span> Fitting Specialist
                  </span>
                  <span class="badge bg-white-20 text-white rounded-pill px-2 py-1 small">
                    Signia / Widex Pro
                  </span>
                </div>
              </div>
            </div>

            <!-- Doctor Body Content -->
            <div class="tm-doctor-body">
              <h4 class="tm-doctor-name">Dr. Sumit Kumar Singh</h4>
              <div class="tm-doctor-title">Senior Audiologist &amp; Device Specialist</div>
              
              <div class="tm-doctor-meta-strip">
                <span><i class="bi bi-mortarboard-fill text-orange me-1"></i> BASLP (Audiology)</span>
                <span class="fw-semibold text-navy"><i class="bi bi-geo-alt-fill text-danger me-1"></i> Clinic &amp; Doorstep</span>
              </div>

              <p class="tm-doctor-bio">
                Recognized leader in digital hearing aid acoustics, deep canal Invisible (IIC/CIC) ear-mould fabrication, and lifestyle adaptation for active working professionals.
              </p>
              
              <div class="tm-doctor-specialties">
                <span class="tm-doctor-spec-chip">IIC / CIC Invisible</span>
                <span class="tm-doctor-spec-chip">Pure Tone (PTA)</span>
                <span class="tm-doctor-spec-chip">Signia / Widex</span>
                <span class="tm-doctor-spec-chip">Bluetooth Hearables</span>
              </div>

              <div class="tm-doctor-avail">
                <i class="bi bi-calendar2-check text-orange"></i> Available for: Clinic &amp; Home Free Trial
              </div>
            </div>

          </div>
        </div>

        <!-- Doctor 3: Dr. Saurabh Mishra -->
        <div class="col-lg-4 col-md-6">
          <div class="tm-doctor-card">
            
            <!-- Photo Media Frame -->
            <div class="tm-doctor-media">
              <img src="{{ tm_asset('images/team/team-03.webp') }}" alt="Dr. Saurabh Mishra - Pediatric Audiologist & Electrophysiologist" loading="lazy">
              <div class="tm-doctor-media-overlay">
                <div class="tm-doctor-media-top">
                  <span class="tm-doctor-badge-rci"><i class="bi bi-patch-check-fill"></i> RCI: A19482</span>
                  <span class="tm-doctor-badge-exp"><i class="bi bi-star-fill text-warning me-1"></i> 12+ Yrs Exp</span>
                </div>
                <div class="tm-doctor-media-bottom">
                  <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill small px-2">
                    <span class="tm-live-pulse" style="width:6px;height:6px;"></span> Pediatric Unit
                  </span>
                  <span class="badge bg-white-20 text-white rounded-pill px-2 py-1 small">
                    BERA / OAE Lead
                  </span>
                </div>
              </div>
            </div>

            <!-- Doctor Body Content -->
            <div class="tm-doctor-body">
              <h4 class="tm-doctor-name">Dr. Saurabh Mishra</h4>
              <div class="tm-doctor-title">Pediatric Audiologist &amp; Speech Pathologist</div>
              
              <div class="tm-doctor-meta-strip">
                <span><i class="bi bi-mortarboard-fill text-orange me-1"></i> MASLP (Speech &amp; Hearing)</span>
                <span class="fw-semibold text-navy"><i class="bi bi-geo-alt-fill text-danger me-1"></i> Diagnostic Lab</span>
              </div>

              <p class="tm-doctor-bio">
                Expert in infant &amp; child hearing assessment (BERA/ABR, OAE), middle ear Tympanometry, speech delay rehabilitation, and chronic tinnitus notch therapy protocols.
              </p>
              
              <div class="tm-doctor-specialties">
                <span class="tm-doctor-spec-chip">BERA / ABR Test</span>
                <span class="tm-doctor-spec-chip">OAE Screening</span>
                <span class="tm-doctor-spec-chip">Child Speech Delay</span>
                <span class="tm-doctor-spec-chip">Tympanometry</span>
              </div>

              <div class="tm-doctor-avail">
                <i class="bi bi-calendar2-check text-orange"></i> Available for: Diagnostic Suite &amp; Speech Therapy
              </div>
            </div>

          </div>
        </div>

      </div>

      <!-- Bottom Reassurance Strip -->
      <div class="mt-4 p-3 p-md-4 rounded-4 border bg-light d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 shadow-xs">
        <div class="d-flex align-items-center gap-3">
          <div class="rounded-circle bg-orange text-white d-flex align-items-center justify-content-center flex-shrink-0" style="width: 48px; height: 48px; font-size: 1.35rem;">
            <i class="bi bi-headset"></i>
          </div>
          <div>
            <h6 class="fw-bold text-navy mb-0">Unsure which specialist or test is right for you?</h6>
            <span class="small text-secondary">Our clinic coordinator will assess your symptoms and connect you with the appropriate doctor.</span>
          </div>
        </div>
        <div class="d-flex gap-2 text-nowrap">
          <a href="tel:{{ $sitePhoneRaw ?? site_phone_raw() }}" class="tm-btn tm-btn-outline-navy btn-sm">
            <i class="bi bi-telephone-fill me-1"></i> Call {{ $sitePhone ?? site_phone() }}
          </a>
          <a href="https://wa.me/{{ $siteWhatsApp ?? site_whatsapp() }}?text={{ urlencode('Hello, I need help selecting the right hearing doctor.') }}" target="_blank" rel="noopener" class="btn btn-sm btn-success rounded-pill px-3 d-flex align-items-center gap-1">
            <i class="bi bi-whatsapp"></i> Quick Advice
          </a>
        </div>
      </div>

    </div>
  </section>

  <!-- =========================================================================
       CLINICAL HEARING HEALTH STATS & MILESTONES (SPACIOUS & AWESOME)
       ========================================================================= -->
  <section class="py-5 bg-light-subtle border-top">
    <div class="container">
      
      <!-- Section Header -->
      <div class="text-center mb-4">
        <span class="tm-pill tm-pill-orange mb-2 d-inline-flex align-items-center gap-1">
          <i class="bi bi-award-fill"></i> Clinical Milestones &amp; Patient Impact
        </span>
        <h2 class="display-6 fw-bold text-navy mb-2">Transforming Lives Through <span class="text-orange">Clinical Precision</span></h2>
        <p class="text-secondary small mx-auto mb-0" style="max-width: 640px;">
          Behind every milestone is a restored conversation, renewed family confidence, and evidence-based audiological care trusted across Delhi NCR for over two decades.
        </p>
      </div>

      <!-- 4 Distinct Soft Light Themed Milestone Cards -->
      <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-3 g-lg-4">
        
        <!-- Milestone 1: Warm Soft Amber / Diagnostics -->
        <div class="col">
          <div class="tm-milestone-card tm-milestone-card-amber">
            <div class="tm-milestone-icon-wrap">
              <i class="bi bi-soundwave"></i>
            </div>
            <div class="tm-milestone-val">15,000<span class="text-orange">+</span></div>
            <div class="tm-milestone-label">Diagnostic Evaluations</div>
            <span class="tm-milestone-tag">ANSI/ISO Sound Booths</span>
          </div>
        </div>

        <!-- Milestone 2: Sky Blue / Speech Restorations -->
        <div class="col">
          <div class="tm-milestone-card tm-milestone-card-sky">
            <div class="tm-milestone-icon-wrap">
              <i class="bi bi-ear-fill"></i>
            </div>
            <div class="tm-milestone-val">10,000<span class="text-orange">+</span></div>
            <div class="tm-milestone-label">Speech Restorations</div>
            <span class="tm-milestone-tag">Phonak • Oticon • Signia</span>
          </div>
        </div>

        <!-- Milestone 3: Mint Emerald / RCI Specialists -->
        <div class="col">
          <div class="tm-milestone-card tm-milestone-card-emerald">
            <div class="tm-milestone-icon-wrap">
              <i class="bi bi-patch-check-fill"></i>
            </div>
            <div class="tm-milestone-val">100<span class="text-orange">%</span></div>
            <div class="tm-milestone-label">RCI-Certified Specialists</div>
            <span class="tm-milestone-tag">Master's &amp; Doctorate Panel</span>
          </div>
        </div>

        <!-- Milestone 4: Soft Rose / Senior Home Visits -->
        <div class="col">
          <div class="tm-milestone-card tm-milestone-card-rose">
            <div class="tm-milestone-icon-wrap">
              <i class="bi bi-house-heart-fill"></i>
            </div>
            <div class="tm-milestone-val">5,000<span class="text-orange">+</span></div>
            <div class="tm-milestone-label">Senior Home Visits</div>
            <span class="tm-milestone-tag">100% Free Doorstep Care</span>
          </div>
        </div>

      </div>

    </div>
  </section>
@endsection
