@extends('site.layouts.app')

@section('title', 'Book Audiology Appointment — Turtle Maarks Hearing Health')
@section('meta_description', 'Book your in-clinic consultation at Gaur City Mall or free senior citizen doorstep home visit with certified RCI-registered Audiologists.')
@section('active_nav', 'services')

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
        <span class="tm-breadcrumb-current" aria-current="page">Book Appointment</span>
      </div>
    </nav>

    <!-- Main Heading -->
    <h1 class="display-6 fw-bold text-white mb-2 font-heading">Book Your Appointment</h1>
    <p class="text-white-50 mx-auto small mb-0" style="max-width: 580px;">
      Follow our quick 4-step booking wizard to reserve your in-clinic consultation at Gaur City Mall or doorstep senior home visit.
    </p>

  </div>
</section>

<!-- =========================================================================
     4-STEP APPOINTMENT BOOKING SECTION (SAME AS HOMEPAGE)
     ========================================================================= -->
<section class="py-5 bg-light-subtle" id="bookAppointmentSection">
  <form method="POST" action="{{ route('appointments.store') }}" id="tmAppointmentForm">
    @csrf
    <input type="hidden" name="service_id" id="tmServiceIdInput" value="{{ old('service_id', $prefill['service'] ?? optional($services->first())->id) }}">
    <input type="hidden" name="appointment_date" id="tmAppointmentDateInput" value="{{ old('appointment_date', now()->toDateString()) }}">
    <input type="hidden" name="appointment_time" id="tmAppointmentTimeInput" value="{{ old('appointment_time') }}">
  <div class="container">
    
    <div class="row justify-content-center">
      <div class="col-xl-11">
        <div class="tm-booking-card-main">
          
          <!-- Top Stepper Navigation Bar -->
          <div class="tm-booking-stepper-bar">
            <div class="tm-booking-step-tab active" onclick="HomeBookingWizard.goToStep(1)">
              <span class="tm-step-badge">1</span>
              <span class="fw-bold small">1. Select Service</span>
            </div>
            <div class="text-white-50 small d-none d-sm-block"><i class="bi bi-chevron-right"></i></div>
            <div class="tm-booking-step-tab" onclick="HomeBookingWizard.goToStep(2)">
              <span class="tm-step-badge">2</span>
              <span class="fw-bold small">2. Select Location</span>
            </div>
            <div class="text-white-50 small d-none d-sm-block"><i class="bi bi-chevron-right"></i></div>
            <div class="tm-booking-step-tab" onclick="HomeBookingWizard.goToStep(3)">
              <span class="tm-step-badge">3</span>
              <span class="fw-bold small">3. Select Audiologist</span>
            </div>
            <div class="text-white-50 small d-none d-sm-block"><i class="bi bi-chevron-right"></i></div>
            <div class="tm-booking-step-tab" onclick="HomeBookingWizard.goToStep(4)">
              <span class="tm-step-badge">4</span>
              <span class="fw-bold small">4. Date &amp; Time</span>
            </div>
          </div>

          <!-- Card Body Content: Left Step Forms (Col-lg-8) + Right Live Summary (Col-lg-4) -->
          <div class="row g-0">
            <div class="col-lg-8 p-4 p-md-5">
              
              <!-- STEP 1: SELECT SERVICE -->
              <div id="tmBookingStepPane1" class="tm-booking-step-pane">
                <div class="d-flex justify-content-between align-items-center mb-1">
                  <h5 class="fw-bold text-navy mb-0">Step 1: Select Service</h5>
                  <span class="badge bg-orange-subtle text-orange small">Step 1 of 4</span>
                </div>
                <p class="text-secondary small mb-4">Choose from hearing evaluations, trials, consultations, therapy, or servicing.</p>

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-4">
                  @forelse ($services as $svc)
                  <div class="col">
                    <div class="tm-booking-option-card tm-booking-service-card {{ (int) ($prefill['service'] ?? optional($services->first())->id) === $svc->id ? 'selected' : '' }}"
                         data-service-id="{{ $svc->id }}"
                         data-service-title="{{ $svc->name }}"
                         data-service-desc="{{ $svc->short_description }}">
                      <span class="tm-booking-option-check"><i class="bi bi-check-lg"></i></span>
                      <div class="tm-booking-opt-icon"><i class="bi bi-soundwave"></i></div>
                      <h6 class="fw-bold text-navy mb-1">{{ $svc->name }}</h6>
                      <p class="text-secondary small mb-0">{{ Str::limit($svc->short_description, 70) }}</p>
                      @if ($svc->price > 0)
                        <span class="badge bg-orange-subtle text-orange mt-2">{{ inr($svc->price) }}</span>
                      @endif
                      @if ($svc->duration_minutes)
                        <span class="badge bg-light text-navy border mt-2">{{ $svc->duration_minutes }} mins</span>
                      @endif
                    </div>
                  </div>
                  @empty
                  <div class="col-12">
                    <div class="alert alert-warning small mb-0">
                      No clinical services are published yet. Please call {{ SITE_PHONE }} to book your appointment.
                    </div>
                  </div>
                  @endforelse
                </div>

                <div class="d-flex justify-content-end">
                  <button type="button" class="tm-btn tm-btn-primary px-4" onclick="HomeBookingWizard.nextStep()">
                    Continue to Location <i class="bi bi-arrow-right ms-1"></i>
                  </button>
                </div>
              </div>

              <!-- STEP 2: SELECT LOCATION -->
              <div id="tmBookingStepPane2" class="tm-booking-step-pane" style="display: none;">
                <div class="d-flex justify-content-between align-items-center mb-1">
                  <h5 class="fw-bold text-navy mb-0">Step 2: Select Location</h5>
                  <span class="badge bg-orange-subtle text-orange small">Step 2 of 4</span>
                </div>
                <p class="text-secondary small mb-4">Choose in-clinic sound-booth testing or a convenient doorstep home visit.</p>

                <div class="row g-3 mb-4">
                  <!-- Location 1: Clinic -->
                  <div class="col-md-6">
                    <div class="tm-booking-option-card tm-booking-location-card selected" data-location-title="Clinic Visit (Gaur City Centre)" data-location-type="clinic">
                      <span class="tm-booking-option-check"><i class="bi bi-check-lg"></i></span>
                      <div class="tm-booking-opt-icon"><i class="bi bi-building"></i></div>
                      <h6 class="fw-bold text-navy mb-1">Clinic Visit</h6>
                      <p class="text-secondary small mb-2">Turtle Maarks Hearing Centre, Gaur City, Greater Noida West</p>
                      <div class="small text-muted mb-1"><i class="bi bi-check-circle-fill text-success me-1"></i> Calibrated Sound-Treated Booth</div>
                      <div class="small text-muted"><i class="bi bi-check-circle-fill text-success me-1"></i> Full Range of 50+ Trial Hearing Aids</div>
                    </div>
                  </div>

                  <!-- Location 2: Home Visit -->
                  <div class="col-md-6">
                    <div class="tm-booking-option-card tm-booking-location-card" data-location-title="Home Visit (Greater Noida West & Noida)" data-location-type="home">
                      <span class="tm-booking-option-check"><i class="bi bi-check-lg"></i></span>
                      <div class="tm-booking-opt-icon"><i class="bi bi-house-heart-fill"></i></div>
                      <h6 class="fw-bold text-navy mb-1">Home Visit</h6>
                      <p class="text-secondary small mb-2">Doorstep audiologist visit across Greater Noida West &amp; Noida</p>
                      <div class="small text-muted mb-1"><i class="bi bi-check-circle-fill text-success me-1"></i> Portable Calibrated Audiometry Kit</div>
                      <div class="small text-muted"><i class="bi bi-check-circle-fill text-success me-1"></i> 100% Free for Senior Citizens</div>
                    </div>
                  </div>
                </div>

                <div class="d-flex justify-content-between">
                  <button type="button" class="tm-btn tm-btn-outline-navy px-4" onclick="HomeBookingWizard.prevStep()">
                    <i class="bi bi-arrow-left me-1"></i> Back
                  </button>
                  <button type="button" class="tm-btn tm-btn-primary px-4" onclick="HomeBookingWizard.nextStep()">
                    Continue to Audiologist <i class="bi bi-arrow-right ms-1"></i>
                  </button>
                </div>
              </div>

              <!-- STEP 3: SELECT AUDIOLOGIST -->
              <div id="tmBookingStepPane3" class="tm-booking-step-pane" style="display: none;">
                <div class="d-flex justify-content-between align-items-center mb-1">
                  <h5 class="fw-bold text-navy mb-0">Step 3: Select Audiologist</h5>
                  <span class="badge bg-orange-subtle text-orange small">Step 3 of 4</span>
                </div>
                <p class="text-secondary small mb-4">Choose an RCI-registered audiologist or select any available clinician for the fastest slot.</p>

                <div class="row g-3 mb-4">
                  <!-- Doctor 1: Any Available -->
                  <div class="col-md-6">
                    <div class="tm-booking-option-card tm-booking-doctor-card selected" data-doctor-name="Any Available Senior Audiologist">
                      <span class="tm-booking-option-check"><i class="bi bi-check-lg"></i></span>
                      <div class="d-flex align-items-center gap-3 mb-2">
                        <div class="tm-booking-opt-icon mb-0"><i class="bi bi-lightning-charge-fill text-warning"></i></div>
                        <div>
                          <h6 class="fw-bold text-navy mb-0">Any Available Audiologist</h6>
                          <span class="badge bg-success-subtle text-success small">Fastest Slot Booking</span>
                        </div>
                      </div>
                      <p class="text-secondary small mb-0">Allocates the earliest available RCI-certified senior clinician.</p>
                    </div>
                  </div>

                  <!-- Doctor 2: Dr. Ritu Verma -->
                  <div class="col-md-6">
                    <div class="tm-booking-option-card tm-booking-doctor-card" data-doctor-name="Dr. Ritu Verma, MASLP">
                      <span class="tm-booking-option-check"><i class="bi bi-check-lg"></i></span>
                      <div class="d-flex align-items-center gap-3 mb-2">
                        <img src="{{ tm_asset('images/about-us.jpg') }}" alt="Dr. Ritu Verma" class="rounded-circle border" style="width: 44px; height: 44px; object-fit: cover;">
                        <div>
                          <h6 class="fw-bold text-navy mb-0">Dr. Ritu Verma, MASLP</h6>
                          <span class="small text-orange fw-bold">Senior Clinical Audiologist (14+ Yrs)</span>
                        </div>
                      </div>
                      <p class="text-secondary small mb-0">Adult audiology, Real-Ear Measurement &amp; digital programming expert.</p>
                    </div>
                  </div>

                  <!-- Doctor 3: Dr. Saurabh Mishra -->
                  <div class="col-md-6">
                    <div class="tm-booking-option-card tm-booking-doctor-card" data-doctor-name="Dr. Saurabh Mishra, BASLP">
                      <span class="tm-booking-option-check"><i class="bi bi-check-lg"></i></span>
                      <div class="d-flex align-items-center gap-3 mb-2">
                        <img src="{{ tm_asset('images/team/team-02.webp') }}" alt="Dr. Saurabh Mishra" class="rounded-circle border" style="width: 44px; height: 44px; object-fit: cover;">
                        <div>
                          <h6 class="fw-bold text-navy mb-0">Dr. Saurabh Mishra, BASLP</h6>
                          <span class="small text-orange fw-bold">Pediatric &amp; Electrophysiology (10+ Yrs)</span>
                        </div>
                      </div>
                      <p class="text-secondary small mb-0">BERA/ABR, OAE testing &amp; pediatric hearing assessment specialist.</p>
                    </div>
                  </div>

                  <!-- Doctor 4: Dr. Meenakshi Sundaram -->
                  <div class="col-md-6">
                    <div class="tm-booking-option-card tm-booking-doctor-card" data-doctor-name="Dr. Meenakshi Sundaram, MASLP">
                      <span class="tm-booking-option-check"><i class="bi bi-check-lg"></i></span>
                      <div class="d-flex align-items-center gap-3 mb-2">
                        <img src="{{ tm_asset('images/ear-model.jpg') }}" alt="Dr. Meenakshi Sundaram" class="rounded-circle border" style="width: 44px; height: 44px; object-fit: cover;">
                        <div>
                          <h6 class="fw-bold text-navy mb-0">Dr. Meenakshi Sundaram, MASLP</h6>
                          <span class="small text-orange fw-bold">Speech-Language Pathologist (12+ Yrs)</span>
                        </div>
                      </div>
                      <p class="text-secondary small mb-0">Speech therapy, child language delay &amp; tinnitus acoustic therapy.</p>
                    </div>
                  </div>
                </div>

                <div class="d-flex justify-content-between">
                  <button type="button" class="tm-btn tm-btn-outline-navy px-4" onclick="HomeBookingWizard.prevStep()">
                    <i class="bi bi-arrow-left me-1"></i> Back
                  </button>
                  <button type="button" class="tm-btn tm-btn-primary px-4" onclick="HomeBookingWizard.nextStep()">
                    Continue to Date &amp; Time <i class="bi bi-arrow-right ms-1"></i>
                  </button>
                </div>
              </div>

              <!-- STEP 4: SELECT DATE & TIME + PATIENT DETAILS -->
              <div id="tmBookingStepPane4" class="tm-booking-step-pane" style="display: none;">
                <div class="d-flex justify-content-between align-items-center mb-1">
                  <h5 class="fw-bold text-navy mb-0">Step 4: Select Date &amp; Time</h5>
                  <span class="badge bg-orange-subtle text-orange small">Step 4 of 4</span>
                </div>
                <p class="text-secondary small mb-3">Choose your slot and provide patient contact details for instant confirmation.</p>

                <!-- Date Selector Strip -->
                <label class="fw-bold text-navy small mb-2 d-block"><i class="bi bi-calendar-event text-orange me-1"></i> Select Date:</label>
                <div id="tmHomeBookingDateStrip" class="d-flex gap-2 overflow-auto pb-2 mb-3">
                  <!-- Rendered dynamically by HomeBookingWizard.generateDatePills() -->
                </div>

                <!-- Time Slots -->
                <label class="fw-bold text-navy small mb-2 d-block"><i class="bi bi-clock text-orange me-1"></i> Select Time Slot:</label>
                <div class="row row-cols-2 row-cols-sm-4 g-2 mb-4" id="tmSlotContainer">
                  <div class="col-12 text-muted small py-2" id="tmSlotLoading">
                    <span class="spinner-border spinner-border-sm me-2"></span> Loading available slots…
                  </div>
                </div>

                <!-- Patient Information Fields -->
                <div class="p-3 bg-light rounded-3 border mb-4">
                  <h6 class="fw-bold text-navy mb-2 small"><i class="bi bi-person-fill text-orange me-1"></i> Patient Contact Information:</h6>
                  <div class="row g-2">
                    <div class="col-md-6">
                      <label class="form-label small text-muted mb-1">Patient Full Name *</label>
                      <input type="text" name="name" id="tmHomePatientName" class="form-control form-control-sm" value="{{ old('name', $prefill['name'] ?? optional(auth()->user())->name) }}" placeholder="e.g. Ramesh Sharma" required>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label small text-muted mb-1">Mobile / WhatsApp Number *</label>
                      <input type="tel" name="phone" id="tmHomePatientPhone" class="form-control form-control-sm" value="{{ old('phone', $prefill['phone'] ?? optional(auth()->user())->phone) }}" placeholder="e.g. 9876543210" required>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label small text-muted mb-1">Email Address (Optional)</label>
                      <input type="email" name="email" class="form-control form-control-sm" value="{{ old('email', optional(auth()->user())->email) }}" placeholder="name@example.com">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label small text-muted mb-1">Special Notes / Symptoms (Optional)</label>
                      <input type="text" name="notes" id="tmHomePatientNotes" class="form-control form-control-sm" value="{{ old('notes') }}" placeholder="e.g. Tinnitus in left ear, senior citizen home visit requested...">
                    </div>
                  </div>
                </div>

                <div class="d-flex justify-content-between">
                  <button type="button" class="tm-btn tm-btn-outline-navy px-4" onclick="HomeBookingWizard.prevStep()">
                    <i class="bi bi-arrow-left me-1"></i> Back
                  </button>
                  <button type="submit" class="tm-btn tm-btn-primary px-4 fw-bold" id="tmConfirmAppointmentBtn">
                    Confirm Appointment <i class="bi bi-check-circle-fill ms-1"></i>
                  </button>
                </div>
              </div>

            </div>

            <!-- RIGHT: LIVE BOOKING SUMMARY PREVIEW (Col-lg-4) -->
            <div class="col-lg-4">
              <div class="tm-booking-summary-pane tm-booking-summary-sidebar">
                <div class="d-flex align-items-center gap-2 mb-3">
                  <i class="bi bi-clipboard2-check text-orange fs-5"></i>
                  <h6 class="fw-bold text-navy mb-0">Live Booking Summary</h6>
                </div>

                <div class="tm-summary-row">
                  <span class="text-muted">Service:</span>
                  <strong class="text-navy" id="tmLiveSummaryService">Hearing Test</strong>
                </div>

                <div class="tm-summary-row">
                  <span class="text-muted">Location:</span>
                  <strong class="text-navy text-end ps-2" id="tmLiveSummaryLocation">Clinic Visit</strong>
                </div>

                <div class="tm-summary-row">
                  <span class="text-muted">Audiologist:</span>
                  <strong class="text-navy text-end ps-2" id="tmLiveSummaryDoctor">Any Available</strong>
                </div>

                <div class="tm-summary-row">
                  <span class="text-muted">Date &amp; Time:</span>
                  <strong class="text-orange text-end ps-2" id="tmLiveSummaryDateTime">Today • 10:00 AM</strong>
                </div>

                <div class="mt-4 p-3 bg-white rounded-3 border">
                  <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="bi bi-patch-check-fill text-success fs-5"></i>
                    <span class="fw-bold text-navy small">Guaranteed Benefits</span>
                  </div>
                  <ul class="list-unstyled small text-secondary mb-0">
                    <li class="mb-1">✓ Zero waiting time at clinic</li>
                    <li class="mb-1">✓ Same-day audiometry diagnostic report</li>
                    <li class="mb-1">✓ 7-day free trial on recommended aids</li>
                    <li>✓ 100% Free home visit for senior citizens</li>
                  </ul>
                </div>

                <div class="mt-auto pt-4 text-center">
                  <div class="small text-muted mb-1">Need immediate doctor guidance?</div>
                  <a href="tel:{{ $sitePhoneRaw ?? site_phone_raw() }}" class="text-navy fw-bold small text-decoration-none">
                    <i class="bi bi-telephone-fill text-orange me-1"></i> {{ $sitePhone ?? site_phone() }}
                  </a>
                </div>

              </div>
            </div>

          </div>

        </div>
      </div>
    </div>

  </div>
  </form>
</section>

<!-- =========================================================================
     SENIOR CITIZEN HOME VISITS & CLINIC VISITING PERKS
     ========================================================================= -->
<section class="py-5 bg-white border-top">
  <div class="container">
    <div class="row g-4">
      
      <!-- Perk 1: Doorstep Home Visits -->
      <div class="col-md-4">
        <div class="tm-perk-card tm-perk-card-orange">
          <div class="d-flex align-items-center gap-3 mb-3">
            <div class="tm-perk-icon">
              <i class="bi bi-house-heart-fill"></i>
            </div>
            <div>
              <h5 class="fw-bold text-navy mb-1 font-heading">Doorstep Home Visits</h5>
              <span class="badge bg-orange-subtle text-orange rounded-pill px-2.5 py-1 small fw-semibold">For Senior Citizens</span>
            </div>
          </div>
          <p class="small text-secondary mb-3 flex-grow-1">
            Certified audiologists visit homes across Noida, Greater Noida, and Delhi NCR with portable calibrated audiometers.
          </p>
          <div class="pt-2 border-top border-orange-subtle d-flex align-items-center gap-2 text-orange small fw-bold">
            <i class="bi bi-check-circle-fill"></i> 100% Free Doorstep Consultation
          </div>
        </div>
      </div>

      <!-- Perk 2: Calibrated Sound Booth -->
      <div class="col-md-4">
        <div class="tm-perk-card tm-perk-card-blue">
          <div class="d-flex align-items-center gap-3 mb-3">
            <div class="tm-perk-icon">
              <i class="bi bi-soundwave"></i>
            </div>
            <div>
              <h5 class="fw-bold text-navy mb-1 font-heading">Calibrated Sound Booth</h5>
              <span class="badge bg-primary-subtle text-primary rounded-pill px-2.5 py-1 small fw-semibold">ANSI S3.1 Certified</span>
            </div>
          </div>
          <p class="small text-secondary mb-3 flex-grow-1">
            Experience high-precision pure-tone audiometry, tympanometry, and speech audiometry in our sound-isolated booth.
          </p>
          <div class="pt-2 border-top border-primary-subtle d-flex align-items-center gap-2 text-primary small fw-bold">
            <i class="bi bi-check-circle-fill"></i> Zero Ambient Sound Interference
          </div>
        </div>
      </div>

      <!-- Perk 3: RCI-Registered Doctors -->
      <div class="col-md-4">
        <div class="tm-perk-card tm-perk-card-green">
          <div class="d-flex align-items-center gap-3 mb-3">
            <div class="tm-perk-icon">
              <i class="bi bi-shield-check"></i>
            </div>
            <div>
              <h5 class="fw-bold text-navy mb-1 font-heading">RCI-Registered Doctors</h5>
              <span class="badge bg-success-subtle text-success rounded-pill px-2.5 py-1 small fw-semibold">Clinical Excellence</span>
            </div>
          </div>
          <p class="small text-secondary mb-3 flex-grow-1">
            Consult experienced audiologists specializing in pediatric testing, tinnitus management, and advanced digital aids.
          </p>
          <div class="pt-2 border-top border-success-subtle d-flex align-items-center gap-2 text-success small fw-bold">
            <i class="bi bi-check-circle-fill"></i> 14+ Years Clinical Experience
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
/**
 * TURTLE MAARKS — APPOINTMENT BOOKING WIZARD (server-backed)
 * Steps, live summary and real slot availability from AppointmentService.
 */
const HomeBookingWizard = {
  currentStep: 1,
  data: {
    serviceId: document.getElementById('tmServiceIdInput')?.value || '',
    service: '',
    location: 'Clinic Visit (Gaur City, Greater Noida West)',
    audiologist: 'Any Available Senior Audiologist',
    date: document.getElementById('tmAppointmentDateInput')?.value || '',
    dateFormatted: 'Today',
    time: ''
  },

  init() {
    const selected = document.querySelector('.tm-booking-service-card.selected');
    if (selected) {
      this.data.service   = selected.getAttribute('data-service-title') || '';
      this.data.serviceId = selected.getAttribute('data-service-id') || this.data.serviceId;
    }
    this.generateDatePills();
    this.bindEvents();
    this.loadSlots();
    this.updateLiveSummary();
    this.updateStepUI();
  },

  bindEvents() {
    document.querySelectorAll('.tm-booking-service-card').forEach(card => {
      card.addEventListener('click', () => {
        document.querySelectorAll('.tm-booking-service-card').forEach(c => c.classList.remove('selected'));
        card.classList.add('selected');
        this.data.service   = card.getAttribute('data-service-title');
        this.data.serviceId = card.getAttribute('data-service-id');
        document.getElementById('tmServiceIdInput').value = this.data.serviceId;
        this.updateLiveSummary();
      });
    });

    document.querySelectorAll('.tm-booking-location-card').forEach(card => {
      card.addEventListener('click', () => {
        document.querySelectorAll('.tm-booking-location-card').forEach(c => c.classList.remove('selected'));
        card.classList.add('selected');
        this.data.location = card.getAttribute('data-location-title');
        this.updateLiveSummary();
      });
    });

    document.querySelectorAll('.tm-booking-doctor-card').forEach(card => {
      card.addEventListener('click', () => {
        document.querySelectorAll('.tm-booking-doctor-card').forEach(c => c.classList.remove('selected'));
        card.classList.add('selected');
        this.data.audiologist = card.getAttribute('data-doctor-name');
        this.updateLiveSummary();
      });
    });

    const form = document.getElementById('tmAppointmentForm');
    if (form) {
      form.addEventListener('submit', (e) => {
        const name  = document.getElementById('tmHomePatientName');
        const phone = document.getElementById('tmHomePatientPhone');
        const time  = document.getElementById('tmAppointmentTimeInput');

        if (!this.data.serviceId) {
          e.preventDefault();
          this.goToStep(1);
          if (typeof showToast === 'function') showToast('Select a service', 'Please choose the service you need.', 'warning');
          return;
        }
        if (!time.value) {
          e.preventDefault();
          this.goToStep(4);
          if (typeof showToast === 'function') showToast('Select a time slot', 'Please pick an available appointment time.', 'warning');
          return;
        }
        if (!name.value.trim()) {
          e.preventDefault(); this.goToStep(4); name.focus(); return;
        }
        if (!phone.value.trim() || phone.value.replace(/\D/g, '').length < 10) {
          e.preventDefault(); this.goToStep(4); phone.focus(); return;
        }
      });
    }
  },

  generateDatePills() {
    const container = document.getElementById('tmHomeBookingDateStrip');
    if (!container) return;

    const days   = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    const today  = new Date();
    let html = '';

    for (let i = 0; i < 7; i++) {
      const d = new Date();
      d.setDate(today.getDate() + i);
      const dayName  = i === 0 ? 'Today' : (i === 1 ? 'Tomorrow' : days[d.getDay()]);
      const isoDate  = `${d.getFullYear()}-${String(d.getMonth() + 1).padStart(2, '0')}-${String(d.getDate()).padStart(2, '0')}`;
      const label    = `${dayName}, ${months[d.getMonth()]} ${d.getDate()}`;

      if (i === 0) { this.data.date = isoDate; this.data.dateFormatted = label; }

      html += `
        <div class="tm-date-pill-card ${i === 0 ? 'selected' : ''}"
             data-date="${isoDate}" data-date-formatted="${label}"
             onclick="HomeBookingWizard.selectDate('${isoDate}', '${label}', this)">
          <span class="small d-block text-muted">${dayName}</span>
          <div class="fs-5 fw-bold my-1">${d.getDate()}</div>
          <span class="small d-block fw-semibold text-muted">${months[d.getMonth()]}</span>
        </div>`;
    }

    container.innerHTML = html;
    document.getElementById('tmAppointmentDateInput').value = this.data.date;
  },

  selectDate(isoDate, label, el) {
    document.querySelectorAll('.tm-date-pill-card').forEach(c => c.classList.remove('selected'));
    el.classList.add('selected');
    this.data.date = isoDate;
    this.data.dateFormatted = label;
    this.data.time = '';
    document.getElementById('tmAppointmentDateInput').value = isoDate;
    document.getElementById('tmAppointmentTimeInput').value = '';
    this.loadSlots();
    this.updateLiveSummary();
  },

  /** Pull genuinely free slots from the server (respects clinic hours, breaks, blocks, bookings). */
  async loadSlots() {
    const container = document.getElementById('tmSlotContainer');
    if (!container) return;

    container.innerHTML = '<div class="col-12 text-muted small py-2"><span class="spinner-border spinner-border-sm me-2"></span> Loading available slots…</div>';

    try {
      const res = await fetch(`${window.TM.routes.appointmentSlots}?date=${encodeURIComponent(this.data.date)}`, {
        headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
      });
      const json = await res.json();
      const slots = json.slots || [];

      if (!slots.length) {
        container.innerHTML = '<div class="col-12"><div class="alert alert-warning small mb-0">No slots left on this date. Please choose another day or call ' + @json(SITE_PHONE) + '.</div></div>';
        document.getElementById('tmAppointmentTimeInput').value = '';
        this.data.time = '';
        this.updateLiveSummary();
        return;
      }

      container.innerHTML = slots.map((slot, idx) => {
        const [h, m] = slot.split(':');
        const hour   = parseInt(h, 10);
        const ampm   = hour >= 12 ? 'PM' : 'AM';
        const disp   = `${((hour % 12) || 12)}:${m} ${ampm}`;
        return `<div class="col">
                  <button type="button" class="w-100 tm-time-slot-btn tm-booking-time-btn ${idx === 0 ? 'selected' : ''}"
                          data-time-slot="${slot}" onclick="HomeBookingWizard.selectTime('${slot}', '${disp}', this)">${disp}</button>
                </div>`;
      }).join('');

      const [fh, fm] = slots[0].split(':');
      const fhour = parseInt(fh, 10);
      const fdisp = `${((fhour % 12) || 12)}:${fm} ${fhour >= 12 ? 'PM' : 'AM'}`;
      this.data.time = fdisp;
      document.getElementById('tmAppointmentTimeInput').value = slots[0];
      this.updateLiveSummary();
    } catch (err) {
      container.innerHTML = '<div class="col-12"><div class="alert alert-danger small mb-0">Could not load slots. Please refresh or call ' + @json(SITE_PHONE) + '.</div></div>';
    }
  },

  selectTime(slot, display, el) {
    document.querySelectorAll('.tm-booking-time-btn').forEach(b => b.classList.remove('selected'));
    el.classList.add('selected');
    this.data.time = display;
    document.getElementById('tmAppointmentTimeInput').value = slot;
    this.updateLiveSummary();
  },

  goToStep(step) {
    this.currentStep = Math.min(4, Math.max(1, step));
    this.updateStepUI();
  },

  nextStep() { this.goToStep(this.currentStep + 1); },
  prevStep() { this.goToStep(this.currentStep - 1); },

  updateStepUI() {
    for (let i = 1; i <= 4; i++) {
      const pane = document.getElementById(`tmBookingStepPane${i}`);
      if (pane) pane.style.display = (i === this.currentStep) ? 'block' : 'none';
    }
    document.querySelectorAll('.tm-booking-step-tab').forEach((tab, idx) => {
      const n = idx + 1;
      tab.classList.remove('active', 'completed');
      if (n === this.currentStep) tab.classList.add('active');
      else if (n < this.currentStep) tab.classList.add('completed');
    });
    this.updateLiveSummary();
  },

  updateLiveSummary() {
    const set = (id, val) => { const el = document.getElementById(id); if (el) el.textContent = val; };
    set('tmLiveSummaryService', this.data.service || 'Select a service');
    set('tmLiveSummaryLocation', this.data.location);
    set('tmLiveSummaryDoctor', this.data.audiologist);
    set('tmLiveSummaryDateTime', `${this.data.dateFormatted} • ${this.data.time || 'Pick a slot'}`);
  }
};

document.addEventListener('DOMContentLoaded', () => HomeBookingWizard.init());
</script>
@endpush
