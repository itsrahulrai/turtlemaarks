@extends('site.layouts.app')

@section('title', 'Custom Silicone Ear Moulds & Noise Protection Plugs — Turtle Maarks')
@section('meta_description', 'Custom 3D anatomical ear moulds, swimming earplugs, musicians in-ear monitors, and industrial noise reduction plugs in Greater Noida West.')
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
          <span class="tm-breadcrumb-current" aria-current="page">Custom Ear Moulds</span>
        </div>
      </nav>

      <div class="row align-items-center g-4">
        <div class="col-lg-8">
          <h1 class="display-6 fw-bold text-white mb-2 font-heading">Custom 3D Silicone Ear Moulds &amp; Noise Plugs</h1>
          <p class="text-white-50 mb-3" style="max-width: 680px;">Custom-crafted anatomical ear impressions made with German hypoallergenic soft silicone. Eliminates hearing aid whistling feedback and shields ears from loud industrial noise and swimming water.</p>
          <div class="d-flex flex-wrap gap-3 text-white-50 small">
            <div><i class="bi bi-clock-fill text-orange"></i> <strong>Impression Time:</strong> 20 Mins</div>
            <div><i class="bi bi-tag-fill text-orange"></i> <strong>Price:</strong> ₹900 / Mould (Pair ₹1,700)</div>
            <div><i class="bi bi-patch-check-fill text-orange"></i> <strong>Material:</strong> Biocompatible Medical Silicone</div>
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
            <h4 class="fw-bold text-navy mb-3">Why Custom Ear Moulds Matter</h4>
            <p class="text-secondary">Generic rubber domes frequently slip out of the ear canal or cause high-pitched whistling feedback when the hearing aid volume is turned up. A custom-fitted silicone ear mould is made from an exact physical impression of your unique ear canal contours.</p>
            <p class="text-secondary mb-0">It creates a secure acoustic seal, maximizes bass response, prevents sound leakage, and stays comfortably seated during chewing, talking, and exercising.</p>
          </div>

          <!-- Types of Moulds -->
          <div class="card rounded-4 border p-4 bg-white shadow-xs mb-4">
            <h4 class="fw-bold text-navy mb-3">Custom Mould Categories</h4>
            <div class="row row-cols-1 row-cols-md-2 g-3">
              <div class="col">
                <div class="p-3 bg-light rounded-3 border h-100">
                  <h6 class="fw-bold text-navy mb-1"><i class="bi bi-earbuds text-orange me-1"></i> BTE & RIC Hearing Aid Moulds</h6>
                  <p class="small text-secondary mb-0">Skeleton, Canal, or Full-Shell styles with acoustic vents tailored to your frequency loss.</p>
                </div>
              </div>
              <div class="col">
                <div class="p-3 bg-light rounded-3 border h-100">
                  <h6 class="fw-bold text-navy mb-1"><i class="bi bi-water text-orange me-1"></i> Waterproof Swimming Earplugs</h6>
                  <p class="small text-secondary mb-0">Floatable silicone plugs preventing water entry in patients with eardrum perforations or ear tubes.</p>
                </div>
              </div>
              <div class="col">
                <div class="p-3 bg-light rounded-3 border h-100">
                  <h6 class="fw-bold text-navy mb-1"><i class="bi bi-music-note-beamed text-orange me-1"></i> Musicians' In-Ear Monitors (IEM)</h6>
                  <p class="small text-secondary mb-0">Flat-attenuation filters preserving full musical frequency balance while capping decibel levels.</p>
                </div>
              </div>
              <div class="col">
                <div class="p-3 bg-light rounded-3 border h-100">
                  <h6 class="fw-bold text-navy mb-1"><i class="bi bi-moon-stars text-orange me-1"></i> Sleeping & Noise Plugs</h6>
                  <p class="small text-secondary mb-0">Ultra-soft micro-silicone plugs providing up to 32 dB noise reduction for restful deep sleep.</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Impression Steps -->
          <div class="card rounded-4 border p-4 bg-white shadow-xs mb-4">
            <h4 class="fw-bold text-navy mb-4">The 20-Minute Impression Procedure</h4>
            
            <div class="tm-service-process-step">
              <div class="tm-service-step-num">1</div>
              <h6 class="fw-bold text-navy mb-1">Otoscopic Canal Examination</h6>
              <p class="small text-secondary mb-0">Verifying the ear canal is clear of obstruction and inspecting the eardrum integrity.</p>
            </div>

            <div class="tm-service-process-step">
              <div class="tm-service-step-num">2</div>
              <h6 class="fw-bold text-navy mb-1">Oto-Dam Foam Placement</h6>
              <p class="small text-secondary mb-0">A soft protective cotton dam is gently placed in the canal to protect the eardrum.</p>
            </div>

            <div class="tm-service-process-step">
              <div class="tm-service-step-num">3</div>
              <h6 class="fw-bold text-navy mb-1">Silicone Material Injection</h6>
              <p class="small text-secondary mb-0">Medical-grade dual-paste silicone cures inside the ear in 4-5 minutes, capturing every microscopic contour.</p>
            </div>

            <div class="tm-service-process-step">
              <div class="tm-service-step-num">4</div>
              <h6 class="fw-bold text-navy mb-1">Laboratory 3D Curing & Delivery</h6>
              <p class="small text-secondary mb-0">Your custom finished mould is ready within 24 to 48 hours with a guaranteed perfect fit warranty.</p>
            </div>
          </div>

        </div>

        <!-- Right: Interactive Sticky Booking Card -->
        <div class="col-lg-4 tm-service-sidebar">
          <div class="tm-booking-sidebar-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h5 class="fw-bold text-navy mb-0">Book Impression Slot</h5>
              <span class="badge bg-primary-subtle text-primary fw-bold">₹900 / Mould</span>
            </div>

            <form onsubmit="event.preventDefault(); showToast('Impression Slot Booked!', 'Our lab technician and audiologist have scheduled your impression session.', 'success'); this.reset();">
              
              <div class="mb-3">
                <label class="form-label small fw-bold text-navy mb-1">1. Choose Date</label>
                <input type="date" class="form-control" required id="bookingDate">
              </div>

              <div class="mb-3">
                <label class="form-label small fw-bold text-navy mb-1">2. Choose Time Slot</label>
                <div class="tm-slot-grid">
                  <button type="button" class="tm-slot-btn active" onclick="selectSlotSidebar(this)">10:00 AM</button>
                  <button type="button" class="tm-slot-btn" onclick="selectSlotSidebar(this)">12:30 PM</button>
                  <button type="button" class="tm-slot-btn" onclick="selectSlotSidebar(this)">03:00 PM</button>
                  <button type="button" class="tm-slot-btn" onclick="selectSlotSidebar(this)">05:30 PM</button>
                  <button type="button" class="tm-slot-btn" onclick="selectSlotSidebar(this)">06:45 PM</button>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label small fw-bold text-navy mb-1">3. Mould Type</label>
                <select class="form-select">
                  <option>Hearing Aid Custom Silicone Mould</option>
                  <option>Waterproof Swimming Plugs (Pair)</option>
                  <option>Musicians' In-Ear Monitor Plugs</option>
                  <option>Noise Reduction Sleep Plugs</option>
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
                <i class="bi bi-calendar2-check-fill"></i> Confirm Impression Slot
              </button>
            </form>

            <div class="border-top pt-3 text-center">
              <div class="small text-muted mb-2">Questions about mould materials?</div>
              <div class="d-flex gap-2">
                <a href="tel:{{ $sitePhoneRaw ?? site_phone_raw() }}" class="tm-btn tm-btn-outline-navy w-100 tm-btn-sm"><i class="bi bi-telephone-fill"></i> Call Lab</a>
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
