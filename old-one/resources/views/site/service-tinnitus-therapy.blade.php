@extends('site.layouts.app')

@section('title', 'Tinnitus Retraining & Masking Therapy — Turtle Maarks')
@section('meta_description', 'Relief from ear ringing, buzzing, and humming with acoustic pitch-matching, sound therapy, and TRT habituation counseling in Greater Noida West.')
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
          <span class="tm-breadcrumb-current" aria-current="page">Tinnitus Therapy</span>
        </div>
      </nav>

      <div class="row align-items-center g-4">
        <div class="col-lg-8">
          <h1 class="display-6 fw-bold text-white mb-2 font-heading">Tinnitus Retraining &amp; Sound Masking Therapy</h1>
          <p class="text-white-50 mb-3" style="max-width: 680px;">Chronic ringing, buzzing, roaring, or clicking in your ears can disrupt sleep, focus, and mental peace. Our clinical protocols combine computerized pitch matching, notch sound therapy, and neuro-habituation counseling.</p>
          <div class="d-flex flex-wrap gap-3 text-white-50 small">
            <div><i class="bi bi-clock-fill text-orange"></i> <strong>Session:</strong> 45 Mins Clinical Evaluation</div>
            <div><i class="bi bi-tag-fill text-orange"></i> <strong>Fee:</strong> ₹1,500 / Session</div>
            <div><i class="bi bi-shield-check text-orange"></i> <strong>Goal:</strong> Habituation & Long-Term Relief</div>
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
            <h4 class="fw-bold text-navy mb-3">Understanding & Calming Your Tinnitus</h4>
            <p class="text-secondary">Tinnitus is not a disease by itself, but rather a neurological symptom arising from inner ear hair-cell damage, acoustic trauma, or auditory nerve hyperactivity. When external sound input is reduced, the brain overcompensates by amplifying internal neural noise.</p>
            <p class="text-secondary mb-0">At <strong>Turtle Maarks Hearing Health</strong>, we use evidence-based Tinnitus Retraining Therapy (TRT) and customized sound maskers from Phonak & Signia to teach your auditory cortex to filter out phantom ringing sounds.</p>
          </div>

          <!-- 4-Step Clinical Process -->
          <div class="card rounded-4 border p-4 bg-white shadow-xs mb-4">
            <h4 class="fw-bold text-navy mb-4">Our Tinnitus Management Protocol</h4>
            
            <div class="tm-service-process-step">
              <div class="tm-service-step-num">1</div>
              <h6 class="fw-bold text-navy mb-1">Tinnitus Pitch & Loudness Matching</h6>
              <p class="small text-secondary mb-0">Using our clinical audiometer to identify the exact pitch frequency (e.g. 4000 Hz whistle or white noise) and decibel loudness of your tinnitus.</p>
            </div>

            <div class="tm-service-process-step">
              <div class="tm-service-step-num">2</div>
              <h6 class="fw-bold text-navy mb-1">Minimum Masking Level (MML) Test</h6>
              <p class="small text-secondary mb-0">Determining the softest level of therapeutic sound (ocean waves, pink noise, modulated tones) needed to mask the ringing sensation.</p>
            </div>

            <div class="tm-service-process-step">
              <div class="tm-service-step-num">3</div>
              <h6 class="fw-bold text-navy mb-1">Notch Therapy Sound Programming</h6>
              <p class="small text-secondary mb-0">Programming discreet hearing aid maskers or sound generator ear devices that suppress the exact hyperactivity frequency in the auditory pathway.</p>
            </div>

            <div class="tm-service-process-step">
              <div class="tm-service-step-num">4</div>
              <h6 class="fw-bold text-navy mb-1">Cognitive Habituation & Sleep Support</h6>
              <p class="small text-secondary mb-0">Guiding you through sleep soundscapes and habituation techniques to rewire brain response and eliminate tinnitus-related anxiety.</p>
            </div>
          </div>

          <!-- Frequently Encountered Tinnitus Types -->
          <div class="card rounded-4 border p-4 bg-white shadow-xs mb-4">
            <h4 class="fw-bold text-navy mb-3">Symptoms We Successfully Treat</h4>
            <div class="row row-cols-1 row-cols-md-2 g-3">
              <div class="col">
                <div class="p-3 bg-light rounded-3 border h-100">
                  <h6 class="fw-bold text-navy mb-1"><i class="bi bi-bell text-orange me-1"></i> High-Pitched Ringing</h6>
                  <p class="small text-secondary mb-0">Constant whistle or tea-kettle tone commonly associated with sensorineural high-frequency hearing loss.</p>
                </div>
              </div>
              <div class="col">
                <div class="p-3 bg-light rounded-3 border h-100">
                  <h6 class="fw-bold text-navy mb-1"><i class="bi bi-water text-orange me-1"></i> Ocean Roaring & Static</h6>
                  <p class="small text-secondary mb-0">Low-frequency rushing sound frequently seen in Meniere's disease or middle-ear pressure imbalances.</p>
                </div>
              </div>
              <div class="col">
                <div class="p-3 bg-light rounded-3 border h-100">
                  <h6 class="fw-bold text-navy mb-1"><i class="bi bi-heart-pulse text-orange me-1"></i> Pulsatile Tinnitus</h6>
                  <p class="small text-secondary mb-0">Rhythmic whooshing sound that beats in time with your pulse or heartbeat.</p>
                </div>
              </div>
              <div class="col">
                <div class="p-3 bg-light rounded-3 border h-100">
                  <h6 class="fw-bold text-navy mb-1"><i class="bi bi-moon-stars text-orange me-1"></i> Bedtime Sleep Disruption</h6>
                  <p class="small text-secondary mb-0">Ringing becoming overwhelmingly loud when trying to fall asleep in a silent bedroom.</p>
                </div>
              </div>
            </div>
          </div>

        </div>

        <!-- Right: Interactive Sticky Booking Card -->
        <div class="col-lg-4 tm-service-sidebar">
          <div class="tm-booking-sidebar-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h5 class="fw-bold text-navy mb-0">Book Tinnitus Slot</h5>
              <span class="badge bg-primary-subtle text-primary fw-bold">₹1,500 / Session</span>
            </div>

            <form onsubmit="event.preventDefault(); showToast('Session Scheduled!', 'Our tinnitus specialist has reserved your diagnostic slot.', 'success'); this.reset();">
              
              <div class="mb-3">
                <label class="form-label small fw-bold text-navy mb-1">1. Choose Date</label>
                <input type="date" class="form-control" required id="bookingDate">
              </div>

              <div class="mb-3">
                <label class="form-label small fw-bold text-navy mb-1">2. Choose Time Slot</label>
                <div class="tm-slot-grid">
                  <button type="button" class="tm-slot-btn active" onclick="selectSlotSidebar(this)">11:30 AM</button>
                  <button type="button" class="tm-slot-btn" onclick="selectSlotSidebar(this)">02:00 PM</button>
                  <button type="button" class="tm-slot-btn" onclick="selectSlotSidebar(this)">04:00 PM</button>
                  <button type="button" class="tm-slot-btn" onclick="selectSlotSidebar(this)">06:30 PM</button>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label small fw-bold text-navy mb-1">3. Ringing Sound Type</label>
                <select class="form-select">
                  <option>High-Pitched Ringing / Whistle</option>
                  <option>Static Buzzing / Humming</option>
                  <option>Pulsatile Heartbeat Sound</option>
                  <option>Cricket Chirping / Roaring</option>
                </select>
              </div>

              <div class="mb-3">
                <label class="form-label small fw-bold text-navy mb-1">4. Patient Full Name</label>
                <input type="text" class="form-control" placeholder="Enter patient name" required>
              </div>

              <div class="mb-3">
                <label class="form-label small fw-bold text-navy mb-1">5. Mobile Number</label>
                <input type="tel" pattern="[0-9]{10}" class="form-control" placeholder="10-digit mobile number" required>
              </div>

              <button type="submit" class="tm-btn tm-btn-primary w-100 py-2 mb-3">
                <i class="bi bi-calendar2-check-fill"></i> Confirm Tinnitus Slot
              </button>
            </form>

            <div class="border-top pt-3 text-center">
              <div class="small text-muted mb-2">Need advice from our doctor right now?</div>
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
