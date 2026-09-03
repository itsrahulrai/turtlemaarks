@extends('site.layouts.app')

@section('title', 'Clinical Infrastructure & Facilities Gallery — Turtle Maarks')
@section('meta_description', 'Take a virtual tour of our ANSI-calibrated soundproof booths, diagnostic audiology suites, digital hearing aid fitting labs, and compassionate patient care in Greater Noida West.')
@section('active_nav', 'gallery')

@section('content')
@php
// Complete Clinical Gallery Repository (15 verified facilities & equipment photos)
$gallery_items = [
    [
        'img'      => tm_asset('images/gallery/01.webp'),
        'title'    => 'ANSI-Certified Soundproof Audiometry Booth',
        'category' => 'booths',
        'cat_name' => 'Soundproof Booth',
        'desc'     => 'Double-walled acoustic chamber calibrated to international audiometric standards for zero-noise diagnostic threshold testing.'
    ],
    [
        'img'      => tm_asset('images/gallery/02.webp'),
        'title'    => 'Real-Ear Measurement (REM) Verification Suite',
        'category' => 'devices',
        'cat_name' => 'Fitting Lab',
        'desc'     => 'Live in-situ probe microphone measurement verifying precise target acoustic amplification tailored to each patient’s ear canal resonance.'
    ],
    [
        'img'      => tm_asset('images/gallery/03.webp'),
        'title'    => 'Senior & Pediatric Consultation Chamber',
        'category' => 'clinic',
        'cat_name' => 'Clinic Suite',
        'desc'     => 'Spacious, peaceful, and barrier-free consultation room designed for patient comfort, family counseling, and detailed audiogram reviews.'
    ],
    [
        'img'      => tm_asset('images/gallery/04.webp'),
        'title'    => 'Precision 3D Ear-Impression Casting Lab',
        'category' => 'devices',
        'cat_name' => 'Custom Lab',
        'desc'     => 'Medical-grade silicone canal impression casting for 100% invisible IIC, CIC, and custom earmold fabrications.'
    ],
    [
        'img'      => tm_asset('images/gallery/05.webp'),
        'title'    => 'Digital Otoacoustic Emissions (OAE) Screener',
        'category' => 'diagnostics',
        'cat_name' => 'Diagnostics',
        'desc'     => 'High-precision cochlear outer hair cell diagnostics providing objective hearing checks for infants, children, and adults.'
    ],
    [
        'img'      => tm_asset('images/gallery/06.webp'),
        'title'    => 'Auditory Brainstem Response (BERA) Workstation',
        'category' => 'diagnostics',
        'cat_name' => 'Diagnostics',
        'desc'     => 'Advanced electrophysiological recording station for auditory nerve integrity and brainstem threshold mapping.'
    ],
    [
        'img'      => tm_asset('images/gallery/07.webp'),
        'title'    => 'Ultrasonic Hearing Aid Sanitizing & Dehumidifier Lab',
        'category' => 'devices',
        'cat_name' => 'Care & Lab',
        'desc'     => 'Deep vacuum moisture extraction and UV sterilization ensuring prolonged performance and peak acoustic clarity.'
    ],
    [
        'img'      => tm_asset('images/gallery/08.webp'),
        'title'    => 'Doctor Consultation & Audiogram Counseling Suite',
        'category' => 'clinic',
        'cat_name' => 'Consultation',
        'desc'     => 'Comprehensive patient counseling on pure tone audiograms, speech recognition scores, and lifestyle hearing expectations.'
    ],
    [
        'img'      => tm_asset('images/gallery/09.webp'),
        'title'    => 'High-Definition Digital Video Otoscopy',
        'category' => 'diagnostics',
        'cat_name' => 'Otoscopy',
        'desc'     => 'Live digital visualization of the tympanic membrane, ear canal health, and wax obstruction inspection.'
    ],
    [
        'img'      => tm_asset('images/services/pta-pure-tone-audiometry.webp'),
        'title'    => 'Clinical Diagnostic Audiometer & Acoustic Headsets',
        'category' => 'diagnostics',
        'cat_name' => 'Diagnostics',
        'desc'     => 'Multi-frequency air and bone conduction diagnostic testing determining the exact degree and type of hearing loss.'
    ],
    [
        'img'      => tm_asset('images/services/bera-brain.jpg'),
        'title'    => 'Neurological Auditory Pathway & Waveform Analysis',
        'category' => 'diagnostics',
        'cat_name' => 'Neurology',
        'desc'     => 'Specialized wave latency evaluation for retrocochlear assessment and newborn auditory pathway verification.'
    ],
    [
        'img'      => tm_asset('images/ear-model.jpg'),
        'title'    => 'Anatomical Ear Models for Patient Education',
        'category' => 'clinic',
        'cat_name' => 'Patient Education',
        'desc'     => 'Interactive 3D ear anatomy models used by our clinicians to explain hearing mechanics and ear canal care to patients.'
    ],
    [
        'img'      => tm_asset('images/team/team-01.webp'),
        'title'    => 'Dr. Ritu Verma — Chief Clinical Audiologist',
        'category' => 'team',
        'cat_name' => 'Senior Clinician',
        'desc'     => 'RCI-registered senior audiology clinician with 14+ years of specialized diagnostic and hearing aid fitting expertise.'
    ],
    [
        'img'      => tm_asset('images/team/team-02.webp'),
        'title'    => 'Senior Speech-Language Pathologist',
        'category' => 'team',
        'cat_name' => 'Speech Therapy',
        'desc'     => 'Post-fitting auditory training and rehabilitation helping patients adapt smoothly to speech in complex noisy environments.'
    ],
    [
        'img'      => tm_asset('images/team/team-03.webp'),
        'title'    => 'Doorstep Care & Patient Fitting Coordinator',
        'category' => 'team',
        'cat_name' => 'Patient Care',
        'desc'     => 'Dedicated coordinators managing compassionate clinic sessions and doorstep home visits across Delhi NCR.'
    ]
];
@endphp
<!-- =========================================================================
     HERO & OVERVIEW
     ========================================================================= -->
<section class="tm-page-hero text-center position-relative">
  <div class="container position-relative">
    <nav aria-label="breadcrumb" class="d-inline-flex mb-2">
      <div class="tm-breadcrumb-pill">
        <a href="{{ route('home') }}"><i class="bi bi-house-door"></i> Home</a>
        <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
        <span class="tm-breadcrumb-current" aria-current="page">Clinic Tour</span>
      </div>
    </nav>

    <h1 class="display-6 fw-bold text-white mb-2 font-heading">Clinic &amp; Facilities Gallery</h1>
    <p class="text-white-50 mx-auto small mb-0" style="max-width: 580px;">
      Explore our clinical facilities, soundproof audiometry booths, fitting suites, and patient care photos in Greater Noida West.
    </p>
  </div>
</section>

<!-- =========================================================================
     IMAGE GALLERY & FILTERING (CLEAN PHOTO GRID)
     ========================================================================= -->
<section class="py-5 bg-light-subtle">
  <div class="container">
    
    <!-- Filter Navigation Pills -->
    <div class="d-flex justify-content-center flex-wrap gap-2 mb-4 pb-2">
      <button class="tm-gallery-filter-pill active" data-filter="all">
        <i class="bi bi-grid-fill me-1"></i> All Photos (<span id="tmGalleryVisibleCount">{{ count($gallery_items) }}</span>)
      </button>
      <button class="tm-gallery-filter-pill" data-filter="booths">
        <i class="bi bi-soundwave me-1"></i> Soundproof Booths
      </button>
      <button class="tm-gallery-filter-pill" data-filter="diagnostics">
        <i class="bi bi-activity me-1"></i> Diagnostic Technology
      </button>
      <button class="tm-gallery-filter-pill" data-filter="devices">
        <i class="bi bi-tools me-1"></i> 3D Fitting &amp; Lab
      </button>
      <button class="tm-gallery-filter-pill" data-filter="clinic">
        <i class="bi bi-hospital me-1"></i> Clinic &amp; Suites
      </button>
      <button class="tm-gallery-filter-pill" data-filter="team">
        <i class="bi bi-person-check me-1"></i> Audiologists &amp; Team
      </button>
    </div>

    <!-- Clean Image Grid (No Cluttered Text) -->
    <div class="row g-3 g-md-4" id="tmGalleryGrid">
      @foreach ($gallery_items as $index => $item)
        <div class="col-6 col-md-4 col-lg-3 tm-gallery-item"
             data-category="{{ $item['category'] }}"
             data-category-label="{{ $item['cat_name'] }}"
             data-title="{{ $item['title'] }}"
             data-img-src="{{ $item['img'] }}">
          
          <div class="tm-gallery-card h-100 shadow-xs" onclick="GalleryViewer.openLightbox({{ $index }})" title="{{ $item['title'] }}">
            
            <!-- Category Tag (Discreet Top Pill) -->
            <div class="tm-gallery-badge-top">
              <span class="badge bg-white text-navy border shadow-xs px-2 py-1 small fw-semibold" style="font-size: 0.72rem;">
                {{ $item['cat_name'] }}
              </span>
            </div>

            <!-- Pure Image Stage with Zoom Hover -->
            <div class="tm-gallery-img-wrap" style="height: 250px;">
              <img src="{{ $item['img'] }}" alt="{{ $item['title'] }}" class="tm-gallery-img" loading="lazy">
              
              <!-- Hover Overlay with Zoom Icon -->
              <div class="tm-gallery-overlay">
                <div class="tm-gallery-zoom-btn" title="View Fullscreen">
                  <i class="bi bi-arrows-fullscreen"></i>
                </div>
              </div>
            </div>

          </div>

        </div>
      @endforeach
    </div>

  </div>
</section>



<!-- =========================================================================
     INTERACTIVE FULLSCREEN LIGHTBOX MODAL
     ========================================================================= -->
<div class="modal fade" id="tmGalleryLightboxModal" tabindex="-1" aria-labelledby="tmLightboxTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content rounded-4 border-0 shadow-lg overflow-hidden bg-white">
      
      <!-- Modal Header -->
      <div class="modal-header border-bottom py-3 px-4 bg-light d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-2">
          <span class="badge bg-orange text-white rounded-pill px-2 py-1 small fw-semibold" id="tmLightboxCategory">Photo</span>
          <h5 class="modal-title fw-bold text-navy fs-6 mb-0" id="tmLightboxTitle">Facility View</h5>
        </div>
        <div class="d-flex align-items-center gap-3">
          <span class="badge bg-white text-navy border fw-bold px-2 py-1 small" id="tmLightboxCounter">1 / 15</span>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      </div>

      <!-- Modal Body (Centered Image & Navigation Arrows) -->
      <div class="modal-body p-0 position-relative bg-dark d-flex align-items-center justify-content-center overflow-hidden" style="min-height: 520px; max-height: 75vh;">
        
        <!-- Left Prev Arrow Button -->
        <button type="button" class="btn btn-dark position-absolute start-0 top-50 translate-middle-y ms-3 rounded-circle shadow p-2 text-white border-0 z-3"
                onclick="GalleryViewer.prev()" style="width: 44px; height: 44px; background: rgba(0,0,0,0.6);" title="Previous Photo">
          <i class="bi bi-chevron-left fs-5"></i>
        </button>

        <!-- Main Display Image -->
        <img src="" id="tmLightboxImg" class="img-fluid" style="max-height: 72vh; max-width: 100%; object-fit: contain;" alt="Facility Photo">

        <!-- Right Next Arrow Button -->
        <button type="button" class="btn btn-dark position-absolute end-0 top-50 translate-middle-y me-3 rounded-circle shadow p-2 text-white border-0 z-3"
                onclick="GalleryViewer.next()" style="width: 44px; height: 44px; background: rgba(0,0,0,0.6);" title="Next Photo">
          <i class="bi bi-chevron-right fs-5"></i>
        </button>

      </div>

      <!-- Modal Footer Controls -->
      <div class="modal-footer border-top py-2 px-4 bg-light d-flex justify-content-between align-items-center">
        <span class="text-muted small">Use keyboard arrows &larr; &rarr; to browse</span>
        <div class="d-flex gap-2">
          <button type="button" class="btn btn-sm btn-outline-secondary rounded-3" onclick="GalleryViewer.prev()">
            <i class="bi bi-arrow-left me-1"></i> Prev
          </button>
          <button type="button" class="btn btn-sm btn-outline-secondary rounded-3" onclick="GalleryViewer.next()">
            Next <i class="bi bi-arrow-right ms-1"></i>
          </button>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="{{ tm_asset('js/gallery.js') }}"></script>
@endpush
