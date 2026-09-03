@extends('site.layouts.app')

@section('title', 'Specialized Speech & Language Therapy — Turtle Maarks')
@section('meta_description', 'Certified pediatric & adult speech therapy in Greater Noida West for speech delay, stammering, articulation issues, autism spectrum, and stroke recovery.')
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
          <span class="tm-breadcrumb-current" aria-current="page">Speech Therapy</span>
        </div>
      </nav>

      <div class="row align-items-center g-4">
        <div class="col-lg-8">
          <h1 class="display-6 fw-bold text-white mb-2 font-heading">Specialized Speech &amp; Language Therapy</h1>
          <p class="text-white-50 mb-3" style="max-width: 680px;">Individualized therapy programs designed for children with delayed speech development, stammering, autism spectrum communication challenges, and adult post-stroke aphasia recovery.</p>
          <div class="d-flex flex-wrap gap-3 text-white-50 small">
            <div><i class="bi bi-clock-fill text-orange"></i> <strong>Session:</strong> 45 Mins 1-on-1</div>
            <div><i class="bi bi-tag-fill text-orange"></i> <strong>Fee:</strong> ₹1,000 / Session</div>
            <div><i class="bi bi-person-check-fill text-orange"></i> <strong>Specialist:</strong> Certified Speech-Language Pathologist</div>
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
            <h4 class="fw-bold text-navy mb-3">Empowering Clear, Confident Communication</h4>
            <p class="text-secondary">Speech and language development is central to a child's learning, social interaction, and self-confidence. At <strong>Turtle Maarks Hearing Health</strong>, our speech therapy clinic provides a warm, sensory-friendly environment equipped with modern phonetic learning tools, oral motor exercise kits, and interactive communication software.</p>
            <p class="text-secondary mb-0">We work closely with parents to provide structured home exercise routines, ensuring continuous developmental progress between clinical sessions.</p>
          </div>

          <!-- Treatment Areas -->
          <div class="card rounded-4 border p-4 bg-white shadow-xs mb-4">
            <h4 class="fw-bold text-navy mb-3">Core Treatment Programs</h4>
            <div class="row row-cols-1 row-cols-md-2 g-3">
              <div class="col">
                <div class="p-3 bg-light rounded-3 border h-100">
                  <h6 class="fw-bold text-navy mb-1"><i class="bi bi-stars text-orange me-1"></i> Pediatric Speech Delay</h6>
                  <p class="small text-secondary mb-0">Helping toddlers and young children build vocabulary, sentence structure, and active verbal responses.</p>
                </div>
              </div>
              <div class="col">
                <div class="p-3 bg-light rounded-3 border h-100">
                  <h6 class="fw-bold text-navy mb-1"><i class="bi bi-mic text-orange me-1"></i> Stammering & Stuttering</h6>
                  <p class="small text-secondary mb-0">Fluency shaping techniques, breathing regulation, and rate-control exercises to eliminate blocks and repetitions.</p>
                </div>
              </div>
              <div class="col">
                <div class="p-3 bg-light rounded-3 border h-100">
                  <h6 class="fw-bold text-navy mb-1"><i class="bi bi-soundwave text-orange me-1"></i> Articulation & Mispronunciation</h6>
                  <p class="small text-secondary mb-0">Correcting tongue placement and phonetic clarity for sounds like /r/, /s/, /th/, /k/, and /l/.</p>
                </div>
              </div>
              <div class="col">
                <div class="p-3 bg-light rounded-3 border h-100">
                  <h6 class="fw-bold text-navy mb-1"><i class="bi bi-heart-pulse text-orange me-1"></i> Adult Stroke & Voice Recovery</h6>
                  <p class="small text-secondary mb-0">Rehabilitating language comprehension, vocal fold strain, and expressive speech for stroke and aphasia patients.</p>
                </div>
              </div>
            </div>
          </div>

          <!-- 4-Step Clinical Process -->
          <div class="card rounded-4 border p-4 bg-white shadow-xs mb-4">
            <h4 class="fw-bold text-navy mb-4">Our Speech Assessment & Therapy Flow</h4>
            
            <div class="tm-service-process-step">
              <div class="tm-service-step-num">1</div>
              <h6 class="fw-bold text-navy mb-1">Baseline Speech-Language Assessment</h6>
              <p class="small text-secondary mb-0">Our therapist conducts standardized diagnostic tests to determine the child's receptive and expressive language age.</p>
            </div>

            <div class="tm-service-process-step">
              <div class="tm-service-step-num">2</div>
              <h6 class="fw-bold text-navy mb-1">Individualized Therapy Plan (IEP)</h6>
              <p class="small text-secondary mb-0">A customized goal sheet with measurable weekly targets (e.g. 20 new words, clear sentence formation, reduced repetition).</p>
            </div>

            <div class="tm-service-process-step">
              <div class="tm-service-step-num">3</div>
              <h6 class="fw-bold text-navy mb-1">Interactive 1-on-1 Sessions</h6>
              <p class="small text-secondary mb-0">45 minutes of engaging play-based therapy, flashcards, phonetic drills, and oral motor stimulation.</p>
            </div>

            <div class="tm-service-process-step">
              <div class="tm-service-step-num">4</div>
              <h6 class="fw-bold text-navy mb-1">Monthly Progress Evaluation & Parent Training</h6>
              <p class="small text-secondary mb-0">Parents receive video guidance and printable worksheets to reinforce lessons during daily conversations at home.</p>
            </div>
          </div>

        </div>

        <!-- Right: Interactive Sticky Booking Card -->
        <div class="col-lg-4 tm-service-sidebar">
          <div class="tm-booking-sidebar-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h5 class="fw-bold text-navy mb-0">Book Therapy Slot</h5>
              <span class="badge bg-primary-subtle text-primary fw-bold">₹1,000 / Session</span>
            </div>

            <form onsubmit="event.preventDefault(); showToast('Session Booked!', 'Your speech therapy slot has been reserved. Our clinic will contact you.', 'success'); this.reset();">
              
              <div class="mb-3">
                <label class="form-label small fw-bold text-navy mb-1">1. Choose Date</label>
                <input type="date" class="form-control" required id="bookingDate">
              </div>

              <div class="mb-3">
                <label class="form-label small fw-bold text-navy mb-1">2. Choose Time Slot</label>
                <div class="tm-slot-grid">
                  <button type="button" class="tm-slot-btn active" onclick="selectSlotSidebar(this)">11:00 AM</button>
                  <button type="button" class="tm-slot-btn" onclick="selectSlotSidebar(this)">01:00 PM</button>
                  <button type="button" class="tm-slot-btn" onclick="selectSlotSidebar(this)">03:30 PM</button>
                  <button type="button" class="tm-slot-btn" onclick="selectSlotSidebar(this)">05:00 PM</button>
                  <button type="button" class="tm-slot-btn" onclick="selectSlotSidebar(this)">06:30 PM</button>
                  <button type="button" class="tm-slot-btn" onclick="selectSlotSidebar(this)">07:15 PM</button>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label small fw-bold text-navy mb-1">3. Patient Full Name</label>
                <input type="text" class="form-control" placeholder="Enter patient name" required>
              </div>

              <div class="mb-3">
                <label class="form-label small fw-bold text-navy mb-1">4. Patient Age</label>
                <input type="number" min="1" max="99" class="form-control" placeholder="e.g. 4 years" required>
              </div>

              <div class="mb-3">
                <label class="form-label small fw-bold text-navy mb-1">5. Mobile Number</label>
                <input type="tel" pattern="[0-9]{10}" class="form-control" placeholder="10-digit mobile number" required>
              </div>

              <button type="submit" class="tm-btn tm-btn-primary w-100 py-2 mb-3">
                <i class="bi bi-calendar2-check-fill"></i> Confirm Therapy Slot
              </button>
            </form>

            <div class="border-top pt-3 text-center">
              <div class="small text-muted mb-2">Have questions for our therapist?</div>
              <div class="d-flex gap-2">
                <a href="tel:{{ $sitePhoneRaw ?? site_phone_raw() }}" class="tm-btn tm-btn-outline-navy w-100 tm-btn-sm"><i class="bi bi-telephone-fill"></i> Call Clinic</a>
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
