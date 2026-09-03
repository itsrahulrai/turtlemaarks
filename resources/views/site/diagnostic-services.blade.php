@extends('site.layouts.app')

@section('title', 'Diagnostic Audiology Services — Turtle Maarks Hearing Health')
@section('meta_description', 'Certified diagnostic hearing tests in Noida Extension: Pure Tone Audiometry (PTA), Tympanometry, BERA/ABR, and OAE with same-day reports.')
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
          <span class="tm-breadcrumb-current" aria-current="page">Diagnostic Tests</span>
        </div>
      </nav>
      <h1 class="display-6 fw-bold text-white mb-2 font-heading">Diagnostic Hearing Tests</h1>
      <p class="text-white-50 mx-auto small mb-0" style="max-width: 620px;">Gold-standard hearing assessments conducted in calibrated ANSI-certified sound booths with same-day reports.</p>
    </div>
  </section>

  <!-- TESTS GRID -->
  <section class="py-5 bg-light">
    <div class="container">
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        
        <!-- PTA -->
        <div class="col" id="pta">
          <div class="tm-diag-card">
            <div>
              <div class="rounded-3 overflow-hidden mb-3" style="aspect-ratio: 16/10; background: #F1F5F9;">
                <a href="{{ route('pta-pure-tone-audiometry') }}"><img src="{{ tm_asset('images/services/pta.webp') }}" alt="PTA (Pure Tone Audiometry)" class="w-100 h-100 object-fit-cover"></a>
              </div>
              <h5 class="fw-bold text-navy mb-1"><a href="{{ route('pta-pure-tone-audiometry') }}" class="text-decoration-none text-navy">PTA (Pure Tone Audiometry)</a></h5>
              <p class="text-secondary small mb-3">Clinical benchmark test measuring air and bone conduction thresholds across 250Hz - 8000Hz.</p>
              <ul class="list-unstyled small text-muted mb-3">
                <li><i class="bi bi-check2 text-success me-1"></i> Air & Bone Conduction</li>
                <li><i class="bi bi-check2 text-success me-1"></i> Sound-Treated Booth</li>
                <li><i class="bi bi-check2 text-success me-1"></i> Doctor Verified Report</li>
              </ul>
            </div>
            <div>
              <div class="d-flex justify-content-between align-items-baseline mb-3 border-top pt-2">
                <span class="fw-bold text-navy fs-4">₹1,200</span>
                <span class="badge bg-light text-muted border">30 Mins</span>
              </div>
              <div class="d-grid gap-2">
                <button class="tm-btn tm-btn-primary tm-btn-sm" onclick="Cart.addItem({id:'diag-pta', name:'PTA Pure Tone Audiometry', brand:'Turtle Maarks', price:1200, type:'Diagnostic Test', image:'assets/images/services/pta.webp'})">
                  <i class="bi bi-cart-plus"></i> Add to Cart
                </button>
                <a href="{{ route('pta-pure-tone-audiometry') }}" class="tm-btn tm-btn-outline-navy tm-btn-sm">View Details &amp; Book</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Tymp -->
        <div class="col" id="tympanometry">
          <div class="tm-diag-card">
            <div>
              <div class="rounded-3 overflow-hidden mb-3" style="aspect-ratio: 16/10; background: #F1F5F9;">
                <a href="{{ route('tymp-tympanometry') }}"><img src="{{ tm_asset('images/services/tymp.webp') }}" alt="Tympanometry (Tymp)" class="w-100 h-100 object-fit-cover"></a>
              </div>
              <h5 class="fw-bold text-navy mb-1"><a href="{{ route('tymp-tympanometry') }}" class="text-decoration-none text-navy">Tymp (Tympanometry)</a></h5>
              <p class="text-secondary small mb-3">Objective assessment of middle ear pressure, eardrum mobility, and Eustachian tube function.</p>
              <ul class="list-unstyled small text-muted mb-3">
                <li><i class="bi bi-check2 text-success me-1"></i> Middle Ear Pressure</li>
                <li><i class="bi bi-check2 text-success me-1"></i> Fluid/Infection Check</li>
                <li><i class="bi bi-check2 text-success me-1"></i> Instant 5-Min Result</li>
              </ul>
            </div>
            <div>
              <div class="d-flex justify-content-between align-items-baseline mb-3 border-top pt-2">
                <span class="fw-bold text-navy fs-4">₹800</span>
                <span class="badge bg-light text-muted border">15 Mins</span>
              </div>
              <div class="d-grid gap-2">
                <button class="tm-btn tm-btn-primary tm-btn-sm" onclick="Cart.addItem({id:'diag-tymp', name:'Tympanometry (Tymp)', brand:'Turtle Maarks', price:800, type:'Diagnostic Test', image:'assets/images/services/tymp.webp'})">
                  <i class="bi bi-cart-plus"></i> Add to Cart
                </button>
                <a href="{{ route('tymp-tympanometry') }}" class="tm-btn tm-btn-outline-navy tm-btn-sm">View Details &amp; Book</a>
              </div>
            </div>
          </div>
        </div>

        <!-- BERA -->
        <div class="col" id="bera">
          <div class="tm-diag-card">
            <div>
              <div class="rounded-3 overflow-hidden mb-3" style="aspect-ratio: 16/10; background: #F1F5F9;">
                <a href="{{ route('bera-brain-evoked-response-audiometry') }}"><img src="{{ tm_asset('images/services/bera.webp') }}" alt="BERA Brainstem Evoked Response" class="w-100 h-100 object-fit-cover"></a>
              </div>
              <h5 class="fw-bold text-navy mb-1"><a href="{{ route('bera-brain-evoked-response-audiometry') }}" class="text-decoration-none text-navy">BERA (Brain Evoked Response Audiometry)</a></h5>
              <p class="text-secondary small mb-3">Brainstem evoked response audiometry for objective neural thresholds and pediatric screening.</p>
              <ul class="list-unstyled small text-muted mb-3">
                <li><i class="bi bi-check2 text-success me-1"></i> Objective Electrophysiology</li>
                <li><i class="bi bi-check2 text-success me-1"></i> Ideal for Infants & Toddlers</li>
                <li><i class="bi bi-check2 text-success me-1"></i> Neurological Pathway Map</li>
              </ul>
            </div>
            <div>
              <div class="d-flex justify-content-between align-items-baseline mb-3 border-top pt-2">
                <span class="fw-bold text-navy fs-4">₹3,500</span>
                <span class="badge bg-light text-muted border">60 Mins</span>
              </div>
              <div class="d-grid gap-2">
                <button class="tm-btn tm-btn-primary tm-btn-sm" onclick="Cart.addItem({id:'diag-bera', name:'BERA Brainstem Evoked Response', brand:'Turtle Maarks', price:3500, type:'Diagnostic Test', image:'assets/images/services/bera.webp'})">
                  <i class="bi bi-cart-plus"></i> Add to Cart
                </button>
                <a href="{{ route('bera-brain-evoked-response-audiometry') }}" class="tm-btn tm-btn-outline-navy tm-btn-sm">View Details &amp; Book</a>
              </div>
            </div>
          </div>
        </div>

        <!-- OAE -->
        <div class="col" id="oae">
          <div class="tm-diag-card">
            <div>
              <div class="rounded-3 overflow-hidden mb-3" style="aspect-ratio: 16/10; background: #F1F5F9;">
                <a href="{{ route('oae-oto-acoustic-emission') }}"><img src="{{ tm_asset('images/services/oae.webp') }}" alt="OAE Otoacoustic Emission" class="w-100 h-100 object-fit-cover"></a>
              </div>
              <h5 class="fw-bold text-navy mb-1"><a href="{{ route('oae-oto-acoustic-emission') }}" class="text-decoration-none text-navy">OAE (Oto Acoustic Emission)</a></h5>
              <p class="text-secondary small mb-3">Evaluates cochlear outer hair-cell function inside the inner ear. Painless universal screening.</p>
              <ul class="list-unstyled small text-muted mb-3">
                <li><i class="bi bi-check2 text-success me-1"></i> Inner Ear Cochlea Check</li>
                <li><i class="bi bi-check2 text-success me-1"></i> Newborn Hearing Screening</li>
                <li><i class="bi bi-check2 text-success me-1"></i> Quick & Painless</li>
              </ul>
            </div>
            <div>
              <div class="d-flex justify-content-between align-items-baseline mb-3 border-top pt-2">
                <span class="fw-bold text-navy fs-4">₹1,500</span>
                <span class="badge bg-light text-muted border">20 Mins</span>
              </div>
              <div class="d-grid gap-2">
                <button class="tm-btn tm-btn-primary tm-btn-sm" onclick="Cart.addItem({id:'diag-oae', name:'OAE Otoacoustic Emission', brand:'Turtle Maarks', price:1500, type:'Diagnostic Test', image:'assets/images/services/oae.webp'})">
                  <i class="bi bi-cart-plus"></i> Add to Cart
                </button>
                <a href="{{ route('oae-oto-acoustic-emission') }}" class="tm-btn tm-btn-outline-navy tm-btn-sm">View Details &amp; Book</a>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection
