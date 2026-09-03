@extends('site.layouts.app')

@section('title', 'Turtle Maarks Hearing Health — Modern Hearing Aids & Audiology Clinic')
@section('meta_description', 'Authorized clinic for Phonak, Oticon, ReSound, Signia, Starkey, Widex digital hearing aids & sound-booth diagnostic hearing tests in Greater Noida West & Noida.')
@section('active_nav', 'home')

@section('content')
<!-- ============ FULL-WIDTH HERO IMAGE BANNER ============ -->
  <!-- <section class="tm-hero-image-banner p-0 m-0 w-100">
    <a href="{{ route('appointments.create') }}" class="d-block w-100" title="Book Hearing Health Consultation">
      <picture class="w-100 d-block">
        <source media="(max-width: 767.98px)" srcset="{{ tm_asset('images/banners/mobile/mob-banner.png') }}">
        <img src="{{ tm_asset('images/banners/b7.png') }}" alt="Turtle Maarks Hearing Health — Authorized Clinic for Phonak, Oticon, ReSound, Signia, Starkey, Widex" class="w-100 d-block tm-hero-banner-img">
      </picture>
    </a>
  </section> -->

  <!-- ============ DYNAMIC HERO BANNER SLIDER ============ -->
<section class="tm-hero-image-banner p-0 m-0 w-100">

    @if($banners->isNotEmpty())

        <div id="tmHeroBannerCarousel"
             class="carousel slide"
             data-bs-ride="carousel"
             data-bs-interval="5000">

            <div class="carousel-inner">

                @foreach($banners as $index => $banner)

                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">

                        <a href="{{ $banner->link ?: route('appointments.create') }}"
                           class="d-block w-100"
                           title="{{ $banner->title ?: 'Book Hearing Health Consultation' }}">

                            <picture class="d-block w-100">

                                {{-- MOBILE --}}
                                @if(!empty($banner->mobile_image))
                                    <source
                                        media="(max-width: 767.98px)"
                                        srcset="{{ asset('/storage/' . $banner->mobile_image) }}">
                                @endif

                                {{-- DESKTOP --}}
                                <img
                                    src="{{ asset('/storage/' . $banner->image) }}"
                                    alt="{{ $banner->title ?: 'Turtle Maarks Hearing Health' }}"
                                    class="d-block w-100 tm-hero-banner-img"
                                    loading="{{ $index === 0 ? 'eager' : 'lazy' }}">
                                    
                            </picture>

                        </a>

                    </div>

                @endforeach

            </div>

            @if($banners->count() > 1)

                <button class="carousel-control-prev"
                        type="button"
                        data-bs-target="#tmHeroBannerCarousel"
                        data-bs-slide="prev">

                    <span class="carousel-control-prev-icon"></span>
                    <span class="visually-hidden">Previous</span>

                </button>

                <button class="carousel-control-next"
                        type="button"
                        data-bs-target="#tmHeroBannerCarousel"
                        data-bs-slide="next">

                    <span class="carousel-control-next-icon"></span>
                    <span class="visually-hidden">Next</span>

                </button>

            @endif

        </div>

    @else

        {{-- FALLBACK --}}
        <a href="{{ route('appointments.create') }}"
           class="d-block w-100">

            <picture class="d-block w-100">

                <source
                    media="(max-width: 767.98px)"
                    srcset="{{ tm_asset('images/banners/mobile/mob-banner.png') }}">

                <img
                    src="{{ tm_asset('images/banners/b7.png') }}"
                    alt="Turtle Maarks Hearing Health"
                    class="d-block w-100 tm-hero-banner-img">

            </picture>

        </a>

    @endif

</section>


  

  <!-- 1. EXPLORE BY FORM FACTOR & CATEGORY -->
  <section class="py-5 bg-white">
    <div class="container">
      <div class="d-flex justify-content-between align-items-end tm-section-head mb-4">
        <div>
          <span class="tm-pill tm-pill-orange mb-2"><i class="bi bi-grid-fill"></i> Hearing Solutions</span>
          <h2 class="tm-section-title mb-1">Explore by <span>Category</span></h2>
          <p class="tm-section-sub mb-0">Choose by form factor, clinical invisibility, high-power output, or care essentials</p>
        </div>
        <a href="{{ route('products') }}" class="tm-btn tm-btn-outline-navy tm-btn-sm d-none d-sm-inline-flex">View All Models <i class="bi bi-arrow-right"></i></a>
      </div>

      <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-2 g-md-3">
        @php
          $themeColors = ['orange', 'cyan', 'indigo', 'rose', 'emerald', 'amber'];
          $defaultBadges = ['Bestseller', 'Featured', 'Popular', 'Premium', 'Discreet', 'Essentials'];
        @endphp

        @forelse($categories->take(6) as $index => $category)
          @php
            $theme = $themeColors[$index % count($themeColors)];
            $badge = $defaultBadges[$index % count($defaultBadges)];
            $subCount = $category->subcategories ? $category->subcategories->count() : 0;
            $catImage = $category->image 
                ? asset('/storage/' . $category->image) 
                : tm_asset('images/hearing-aid/ric.webp');
          @endphp
          <div class="col">
            <a href="{{ route('products', ['category' => $category->slug]) }}" class="tm-cat-card-lux tm-cat-theme-{{ $theme }}">
              <span class="tm-cat-badge-top">
                @if($category->subcategories && $category->subcategories->isNotEmpty())
                  {{ $category->subcategories->first()->name }}
                @else
                  {{ $badge }}
                @endif
              </span>
              <div class="tm-cat-media-lux">
                <img src="{{ $catImage }}" 
                     alt="{{ $category->name }}" 
                     class="tm-cat-img-full"
                     onerror="this.onerror=null;this.src='{{ tm_asset('images/hearing-aid/ric.webp') }}';">
              </div>
              <div class="tm-cat-content-lux">
                <h6 class="tm-cat-title-lux">{{ $category->name }}</h6>
                <p class="tm-cat-desc-lux">{{ \Illuminate\Support\Str::limit($category->description ?: 'Explore genuine models with verified clinical warranty & trial', 70) }}</p>
                <div class="tm-cat-footer-lux">
                  <span class="tm-cat-count-badge">
                    @if($subCount > 0)
                      {{ $subCount }} {{ \Illuminate\Support\Str::plural('Model', $subCount) }}
                    @else
                      Explore
                    @endif
                  </span>
                  <span class="tm-cat-arrow-btn"><i class="bi bi-arrow-right"></i></span>
                </div>
              </div>
            </a>
          </div>
        @empty
          <div class="col-12 text-center py-4">
            <p class="text-muted">No categories available at the moment.</p>
          </div>
        @endforelse
      </div>

      <div class="text-center mt-3 d-sm-none">
        <a href="{{ route('products') }}" class="tm-btn tm-btn-outline-navy tm-btn-sm w-100">
          View All Models <i class="bi bi-arrow-right ms-1"></i>
        </a>
      </div>
    </div>
  </section>

  <!-- 2. CURATED FEATURED SHOWCASE (TABBED SINGLE-CODE ENGINE) -->
  <section class="py-5 tm-popular-section-bg border-top border-bottom">
    <div class="container">
      <div class="tm-section-head mb-3">
        <span class="tm-pill tm-pill-orange mb-2"><i class="bi bi-stars"></i> Curated Flagships</span>
        <h2 class="tm-section-title mb-1">Featured <span>Digital Hearing Aids</span></h2>
        <p class="tm-section-sub mb-0">Rechargeable models with AI neural noise suppression &amp; Bluetooth streaming</p>
      </div>

      <!-- Filter Navigation Pills Carousel (Single Line with Left & Right Arrows) -->
      <div class="tm-category-carousel-wrap mb-4">
        <button type="button" class="tm-category-nav-btn tm-category-prev-btn" id="tmCategoryPrevBtn" aria-label="Previous Categories" title="Scroll Left">
          <i class="bi bi-chevron-left"></i>
        </button>

        <div class="tm-filter-tabs-nav tm-category-tabs-strip" id="tmCategoryTabsStrip">
          <button class="tm-filter-tab-btn active" data-tm-filter-tab="all">
            <i class="bi bi-grid-fill text-orange"></i> All Products
          </button>
          @foreach($categories as $cat)
            @php
              $catIcon = 'bi-soundwave text-primary';
              $lowerName = strtolower($cat->name);
              if (str_contains($lowerName, 'charger') || str_contains($lowerName, 'batter')) {
                $catIcon = 'bi-battery-charging text-success';
              } elseif (str_contains($lowerName, 'invisible') || str_contains($lowerName, 'cic') || str_contains($lowerName, 'iic')) {
                $catIcon = 'bi-eye-slash text-info';
              } elseif (!empty($cat->icon)) {
                $catIcon = $cat->icon;
              }
            @endphp
            <button class="tm-filter-tab-btn" data-tm-filter-tab="{{ $cat->slug }}">
              <i class="bi {{ $catIcon }}"></i> {{ $cat->name }}
            </button>
          @endforeach
        </div>

        <button type="button" class="tm-category-nav-btn tm-category-next-btn" id="tmCategoryNextBtn" aria-label="Next Categories" title="Scroll Right">
          <i class="bi bi-chevron-right"></i>
        </button>
      </div>

      <!-- Unified Card Grid (Single Code Component Engine) -->
      <div id="tmInteractiveFeaturedGrid" data-tm-products="all" data-tm-limit="8" data-tm-col="col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-3" class="row g-3">
        @include('site.partials.product-grid', ['products' => $popularProducts, 'col' => 'col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-3'])
      </div>

      <div class="text-center mt-4">
        <a href="{{ route('products') }}" id="tmFeaturedViewAllBtn" class="tm-btn tm-btn-primary px-4 py-2">
          View All Products <i class="bi bi-arrow-right ms-1"></i>
        </a>
      </div>
    </div>
  </section>

  <!-- 3. INTERACTIVE BRAND ECOSYSTEM SHOWCASE -->
  <section class="py-5 bg-white border-bottom">
    <div class="container">
      
      <!-- Section Header -->
      <div class="text-center max-w-700 mx-auto mb-4">
        <span class="tm-pill tm-pill-orange mb-2"><i class="bi bi-patch-check-fill text-success"></i> 100% Authorized Dispenser</span>
        <h2 class="tm-section-title mb-2">Explore by <span class="text-orange">Brands</span></h2>
        <p class="tm-section-sub mb-0">Official dispensers for world-leading Swiss, Danish, German, American & Canadian hearing technology.</p>
      </div>

      <!-- Brand Switcher Logo Tabs with Left & Right Scroll Arrows -->
      <div class="tm-brand-carousel-wrap mb-4">
        <button type="button" class="tm-brand-nav-btn tm-brand-prev-btn" id="tmBrandPrevBtn" aria-label="Previous Brands" title="Scroll Left">
          <i class="bi bi-chevron-left"></i>
        </button>

        <div class="tm-brand-tabs-strip justify-content-lg-start" id="tmBrandTabsStrip">
          <div class="tm-brand-tab-card active"
               data-tm-brand-tab="all"
               data-tm-brand-origin="Global Premium Technology"
               data-tm-brand-usp="• Official warranty &amp; clinical precision across all global brands"
               data-tm-brand-url="{{ route('products') }}"
               title="All Authorized Brands">
            <span class="fw-bold text-navy text-nowrap"><i class="bi bi-grid-fill text-orange me-1"></i> All Brands</span>
          </div>
          @foreach ($brands as $i => $brand)
            @php
              $origin = \App\Support\TmCatalog::BRAND_ORIGINS[strtolower($brand->name)] ?? 'Global Manufacturer';
              $usp = !empty($brand->description) 
                  ? ('• ' . $brand->description) 
                  : ('• Official authorized dispenser for genuine ' . $brand->name . ' digital hearing aids & warranty');
            @endphp
            <div class="tm-brand-tab-card"
                 data-tm-brand-tab="{{ $brand->name }}"
                 data-tm-brand-origin="{{ $origin }}"
                 data-tm-brand-usp="{{ $usp }}"
                 data-tm-brand-url="{{ route('products', ['brand' => $brand->name]) }}"
                 title="{{ $brand->name }} Hearing Aids">
              <img src="{{ $brand->logo_url }}" alt="{{ $brand->name }}">
            </div>
          @endforeach
        </div>

        <button type="button" class="tm-brand-nav-btn tm-brand-next-btn" id="tmBrandNextBtn" aria-label="Next Brands" title="Scroll Right">
          <i class="bi bi-chevron-right"></i>
        </button>
      </div>

      <!-- Active Brand Information Banner -->
      <div class="tm-brand-hero-pill mb-4">
        <div class="d-flex flex-wrap align-items-center gap-2">
          <h4 class="fw-bold text-navy mb-0" id="tmActiveBrandName">All Authorized Brands</h4>
          <span class="badge bg-primary-subtle text-primary border rounded-pill px-3 py-1 small" id="tmActiveBrandOrigin">Global Premium Technology</span>
          <span class="text-secondary small d-none d-md-inline" id="tmActiveBrandUsp">• Official warranty &amp; clinical precision across all global brands</span>
        </div>
        <div>
          <a href="{{ route('products') }}" id="tmBrandViewAllBtn" class="tm-btn tm-btn-outline-navy btn-sm text-nowrap">
            Explore All Hearing Aids <i class="bi bi-arrow-right ms-1"></i>
          </a>
        </div>
      </div>

      <!-- Brand Products Grid (Single Code Component Engine) -->
      <div id="tmBrandShowcaseGrid" data-tm-products="all" data-tm-limit="4" data-tm-col="col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-3" class="row g-3">
        @include('site.partials.product-grid', ['products' => $brandProducts, 'col' => 'col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-3'])
      </div>

      <!-- Advertisement Banner -->
      <div class="mt-4 pt-2">
        <a href="{{ route('appointments.create') }}" class="d-block overflow-hidden rounded-4 shadow-sm border tm-ad-banner-link" title="Book Free Consultation">
          <img src="{{ tm_asset('images/banners/adds.png') }}" alt="Turtle Maarks Hearing Health — Good Hearing, Stronger Connections" class="w-100 d-block tm-ad-banner-img" loading="lazy">
        </a>
      </div>

    </div>
  </section>

  <!-- 5. SOUND-BOOTH DIAGNOSTIC HEARING TESTS -->
  <section class="py-5 bg-white tm-diagnostic-showcase-section border-top border-bottom" id="diagnosticHearingTests">
    <div class="container">
      
      <!-- Section Header -->
      <div class="d-flex justify-content-between align-items-end tm-section-head mb-4">
        <div>
          <span class="tm-pill tm-pill-teal mb-2"><i class="bi bi-soundwave"></i> Sound-Booth Precision Diagnostics</span>
          <h2 class="tm-section-title mb-1">Diagnostic <span>Hearing Tests</span></h2>
          <p class="tm-section-sub mb-0">Calibrated audiometer assessments with instant certified clinical reports</p>
        </div>
        <a href="{{ route('diagnostic-services') }}" class="tm-btn tm-btn-outline-navy tm-btn-sm d-none d-sm-inline-flex">All Tests <i class="bi bi-arrow-right ms-1"></i></a>
      </div>

      <!-- 4 Diagnostic Cards Grid -->
      <div class="row row-cols-2 row-cols-md-2 row-cols-lg-4 g-2 g-md-4">
        
        <!-- Service 1: PTA -->
        <div class="col">
          <div class="tm-diag-service-card">
            <a href="{{ route('pta-pure-tone-audiometry') }}" class="d-block w-100 tm-diag-service-img-wrap" title="Pure Tone Audiometry (PTA)">
              <img src="{{ tm_asset('images/services/pta.webp') }}" alt="PTA Pure Tone Audiometry" class="tm-diag-service-img" loading="lazy">
            </a>
            <h3 class="tm-diag-service-title">
              <a href="{{ route('pta-pure-tone-audiometry') }}" class="text-decoration-none text-reset">PTA</a>
            </h3>
            <p class="tm-diag-service-desc">Pure Tone Audiometry (PTA) is a fundamental hearing test used to evaluate</p>
            <a href="{{ route('pta-pure-tone-audiometry') }}" class="tm-diag-service-link">
              <span>Learn More</span> <i class="bi bi-chevron-right"></i>
            </a>
          </div>
        </div>

        <!-- Service 2: Tymp -->
        <div class="col">
          <div class="tm-diag-service-card">
            <a href="{{ route('tymp-tympanometry') }}" class="d-block w-100 tm-diag-service-img-wrap" title="Tympanometry (Tymp)">
              <img src="{{ tm_asset('images/services/tymp.webp') }}" alt="Tympanometry (Tymp)" class="tm-diag-service-img" loading="lazy">
            </a>
            <h3 class="tm-diag-service-title">
              <a href="{{ route('tymp-tympanometry') }}" class="text-decoration-none text-reset">Tymp</a>
            </h3>
            <p class="tm-diag-service-desc">Tympanometry is a quick and painless diagnostic test that evaluates</p>
            <a href="{{ route('tymp-tympanometry') }}" class="tm-diag-service-link">
              <span>Learn More</span> <i class="bi bi-chevron-right"></i>
            </a>
          </div>
        </div>

        <!-- Service 3: BERA -->
        <div class="col">
          <div class="tm-diag-service-card">
            <a href="{{ route('bera-brain-evoked-response-audiometry') }}" class="d-block w-100 tm-diag-service-img-wrap" title="Brain Evoked Response Audiometry (BERA)">
              <img src="{{ tm_asset('images/services/bera.webp') }}" alt="BERA Brain Evoked Response Audiometry" class="tm-diag-service-img" loading="lazy">
            </a>
            <h3 class="tm-diag-service-title">
              <a href="{{ route('bera-brain-evoked-response-audiometry') }}" class="text-decoration-none text-reset">BERA</a>
            </h3>
            <p class="tm-diag-service-desc">BERA, or Brain Evoked Response Audiometry, is a non-invasive diagnostic</p>
            <a href="{{ route('bera-brain-evoked-response-audiometry') }}" class="tm-diag-service-link">
              <span>Learn More</span> <i class="bi bi-chevron-right"></i>
            </a>
          </div>
        </div>

        <!-- Service 4: OAE -->
        <div class="col">
          <div class="tm-diag-service-card">
            <a href="{{ route('oae-oto-acoustic-emission') }}" class="d-block w-100 tm-diag-service-img-wrap" title="Oto Acoustic Emissions (OAE)">
              <img src="{{ tm_asset('images/services/oae.webp') }}" alt="OAE Oto Acoustic Emissions" class="tm-diag-service-img" loading="lazy">
            </a>
            <h3 class="tm-diag-service-title">
              <a href="{{ route('oae-oto-acoustic-emission') }}" class="text-decoration-none text-reset">OAE</a>
            </h3>
            <p class="tm-diag-service-desc">Oto Acoustic Emissions (OAE) is a quick, non-invasive test used</p>
            <a href="{{ route('oae-oto-acoustic-emission') }}" class="tm-diag-service-link">
              <span>Learn More</span> <i class="bi bi-chevron-right"></i>
            </a>
          </div>
        </div>

      </div>

      <div class="text-center mt-3 d-sm-none">
        <a href="{{ route('diagnostic-services') }}" class="tm-btn tm-btn-outline-navy tm-btn-sm w-100">
          All Tests <i class="bi bi-arrow-right ms-1"></i>
        </a>
      </div>

    </div>
  </section>

  <!-- 6. CLINICAL LEADERSHIP / MEET OUR SENIOR AUDIOLOGISTS -->
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
          <a href="tel:{{ SITE_PHONE_RAW }}" class="tm-btn tm-btn-outline-navy btn-sm">
            <i class="bi bi-telephone-fill me-1"></i> Call {{ SITE_PHONE }}
          </a>
          <a href="https://wa.me/{{ SITE_WHATSAPP }}?text={{ urlencode('Hello, I need help selecting the right hearing doctor.') }}" target="_blank" rel="noopener" class="btn btn-sm btn-success rounded-pill px-3 d-flex align-items-center gap-1">
            <i class="bi bi-whatsapp"></i> Quick Advice
          </a>
        </div>
      </div>

    </div>
  </section>

  <!-- =========================================================================
       8. TRANSFORMING LIVES THROUGH CLEAR SOUND (OFFICIAL YOUTUBE VIDEOS STAGE)
       ========================================================================= -->
  <section class="tm-luxury-reels-stage border-top border-bottom" id="patientStoriesSection">
    <div class="container position-relative z-2">
      
      <!-- Luxury Section Header with YouTube Badge -->
      <div class="text-center max-w-700 mx-auto mb-4">
        <a href="https://www.youtube.com/@TurtleMaarksHearingHealth" target="_blank" class="tm-pill tm-pill-orange mb-2 text-decoration-none shadow-xs d-inline-flex align-items-center gap-2">
          <i class="bi bi-youtube text-danger fs-6"></i> Official YouTube Channel @TurtleMaarksHearingHealth
        </a>
        <h2 class="tm-section-title mb-2">Transforming Lives <span class="text-orange">Through Clear Sound</span></h2>
        <p class="tm-section-sub mb-3">Watch real patient stories, doctor consultations, and hearing transformations directly from our official clinic recordings.</p>
        
        <!-- Trust & Rating Metrics Capsule -->
        <div class="d-inline-flex flex-wrap align-items-center justify-content-center gap-2 gap-md-3 px-4 py-2 rounded-pill bg-white border shadow-xs small">
          <span class="fw-bold text-navy"><i class="bi bi-star-fill text-warning me-1"></i>4.9 Rating (480+ Reviews)</span>
          <span class="text-muted d-none d-md-inline">•</span>
          <span class="fw-bold text-orange">10,000+ Fitted</span>
        </div>
      </div>

      <!-- 4 Premier Cinematic Video Cards Grid -->
      <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4 mb-4">
        
        <!-- Video Card 1: Wg Cdr SK Bhatia Shaurya Chakra -->
        <div class="col">
          <div class="tm-cinematic-card" onclick="openYouTubePatientVideo('vrF2ciqFfrg')">
            <div class="tm-cinematic-media">
              <img src="{{ tm_asset('images/youtube/yt_vrF2ciqFfrg.jpg') }}" alt="Wg Cdr SK Bhatia Testimonial" class="tm-cinematic-thumb">
              <div class="tm-cinematic-overlay"></div>
              
              <div class="tm-cinematic-badges">
                <span class="tm-badge-yt"><i class="bi bi-youtube"></i> Patient Story</span>
                <span class="tm-badge-duration"><i class="bi bi-play-circle-fill me-1"></i> 3:12</span>
              </div>

              <div class="tm-cinematic-play">
                <i class="bi bi-play-fill"></i>
              </div>
            </div>

            <div class="tm-cinematic-body">
              <div class="tm-cinematic-topic"><i class="bi bi-patch-check-fill text-success"></i> Veteran Testimonial</div>
              <h5 class="tm-cinematic-title">Clear Speech Restored for Veteran</h5>
              <div class="tm-cinematic-speaker">Wg Cdr S.K. Bhatia (Shaurya Chakra) shares his journey of natural hearing clarity.</div>
              
              <div class="tm-cinematic-footer">
                <span class="tm-cinematic-loc"><i class="bi bi-geo-alt-fill text-orange"></i> Noida Clinic</span>
                <span class="tm-cinematic-action">Watch Story <i class="bi bi-arrow-right"></i></span>
              </div>
            </div>
          </div>
        </div>

        <!-- Video Card 2: Better Hearing for Better Social Life -->
        <div class="col">
          <div class="tm-cinematic-card" onclick="openYouTubePatientVideo('juOmFzxFBMg')">
            <div class="tm-cinematic-media">
              <img src="{{ tm_asset('images/youtube/yt_juOmFzxFBMg.jpg') }}" alt="Better Hearing for Better Social Life" class="tm-cinematic-thumb">
              <div class="tm-cinematic-overlay"></div>
              
              <div class="tm-cinematic-badges">
                <span class="tm-badge-yt"><i class="bi bi-youtube"></i> Social Life</span>
                <span class="tm-badge-duration"><i class="bi bi-play-circle-fill me-1"></i> 1:15</span>
              </div>

              <div class="tm-cinematic-play">
                <i class="bi bi-play-fill"></i>
              </div>
            </div>

            <div class="tm-cinematic-body">
              <div class="tm-cinematic-topic"><i class="bi bi-patch-check-fill text-success"></i> Life Transformation</div>
              <h5 class="tm-cinematic-title">Better Hearing for Better Social Life</h5>
              <div class="tm-cinematic-speaker">Overcoming hearing loss to reconnect with family conversations and gatherings.</div>
              
              <div class="tm-cinematic-footer">
                <span class="tm-cinematic-loc"><i class="bi bi-geo-alt-fill text-orange"></i> Greater Noida</span>
                <span class="tm-cinematic-action">Watch Story <i class="bi bi-arrow-right"></i></span>
              </div>
            </div>
          </div>
        </div>

        <!-- Video Card 3: Do you feel People speak with slow voice? -->
        <div class="col">
          <div class="tm-cinematic-card" onclick="openYouTubePatientVideo('vkNae-Vqu0U')">
            <div class="tm-cinematic-media">
              <img src="{{ tm_asset('images/youtube/yt_vkNae-Vqu0U.jpg') }}" alt="Recognizing Early Hearing Loss" class="tm-cinematic-thumb">
              <div class="tm-cinematic-overlay"></div>
              
              <div class="tm-cinematic-badges">
                <span class="tm-badge-yt"><i class="bi bi-youtube"></i> Doctor Advice</span>
                <span class="tm-badge-duration"><i class="bi bi-play-circle-fill me-1"></i> 1:45</span>
              </div>

              <div class="tm-cinematic-play">
                <i class="bi bi-play-fill"></i>
              </div>
            </div>

            <div class="tm-cinematic-body">
              <div class="tm-cinematic-topic"><i class="bi bi-patch-check-fill text-success"></i> Clinical Guidance</div>
              <h5 class="tm-cinematic-title">Do Voices Sound Whispered?</h5>
              <div class="tm-cinematic-speaker">Doctor explains early symptoms of frequency loss & importance of timely PTA tests.</div>
              
              <div class="tm-cinematic-footer">
                <span class="tm-cinematic-loc"><i class="bi bi-geo-alt-fill text-orange"></i> Gaur City Clinic</span>
                <span class="tm-cinematic-action">Watch Story <i class="bi bi-arrow-right"></i></span>
              </div>
            </div>
          </div>
        </div>

        <!-- Video Card 4: 1 in 5 People in India Has Hearing Loss -->
        <div class="col">
          <div class="tm-cinematic-card" onclick="openYouTubePatientVideo('gL8awpcAedw')">
            <div class="tm-cinematic-media">
              <img src="{{ tm_asset('images/youtube/yt_gL8awpcAedw.jpg') }}" alt="Hearing Loss Awareness India" class="tm-cinematic-thumb">
              <div class="tm-cinematic-overlay"></div>
              
              <div class="tm-cinematic-badges">
                <span class="tm-badge-yt"><i class="bi bi-youtube"></i> Awareness</span>
                <span class="tm-badge-duration"><i class="bi bi-play-circle-fill me-1"></i> 1:30</span>
              </div>

              <div class="tm-cinematic-play">
                <i class="bi bi-play-fill"></i>
              </div>
            </div>

            <div class="tm-cinematic-body">
              <div class="tm-cinematic-topic"><i class="bi bi-patch-check-fill text-success"></i> Expert Insights</div>
              <h5 class="tm-cinematic-title">1 in 5 in India Has Hearing Loss</h5>
              <div class="tm-cinematic-speaker">Medical insights on invisible hearing aids, AI noise reduction & free home trials.</div>
              
              <div class="tm-cinematic-footer">
                <span class="tm-cinematic-loc"><i class="bi bi-geo-alt-fill text-orange"></i> Noida & G. Noida</span>
                <span class="tm-cinematic-action">Watch Story <i class="bi bi-arrow-right"></i></span>
              </div>
            </div>
          </div>
        </div>

      </div>

      <!-- YouTube Channel Subscribe & Extra Videos Banner -->
      <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 p-3 rounded-3 bg-white border shadow-xs mb-4 mx-auto" style="max-width: 880px;">
        <div class="d-flex align-items-center gap-3">
          <div class="rounded-circle bg-danger-subtle text-danger p-2 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
            <i class="bi bi-youtube fs-4"></i>
          </div>
          <div>
            <div class="fw-bold text-navy small">More Videos on Official YouTube Channel</div>
            <div class="text-secondary small">Official Theme Song • Gratification Ceremony • Patient Joy</div>
          </div>
        </div>
        <a href="https://www.youtube.com/@TurtleMaarksHearingHealth" target="_blank" class="tm-btn tm-btn-outline-navy btn-sm">
          <i class="bi bi-box-arrow-up-right me-1"></i> Visit YouTube Channel
        </a>
      </div>
    </div>
  </section>

  <!-- YOUTUBE PATIENT VIDEO PLAYER MODAL -->
  <div class="modal fade" id="tmYouTubeModal" tabindex="-1" aria-labelledby="tmYouTubeTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content rounded-4 border-0 shadow-2xl overflow-hidden bg-navy text-white">
        <div class="modal-header border-0 pb-0 px-4 pt-4 d-flex justify-content-between align-items-center">
          <div class="d-flex align-items-center gap-2">
            <span class="badge bg-danger text-white rounded-pill px-3 py-1 small" id="tmYouTubeBadge">
              <i class="bi bi-youtube me-1"></i> Patient Testimonial
            </span>
            <span class="text-white-50 small" id="tmYouTubeSpeaker">Wg Cdr S.K. Bhatia</span>
          </div>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <div class="modal-body p-3 p-md-4">
          <!-- 16:9 Responsive Video Iframe Wrapper -->
          <div class="ratio ratio-16x9 rounded-3 overflow-hidden shadow-lg mb-3 bg-black">
            <iframe id="tmYouTubeIframe" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
          </div>

          <h5 class="fw-bold text-white mb-2" id="tmYouTubeTitle">Patient Hearing Transformation</h5>
          <p class="text-white-50 small mb-3" id="tmYouTubeDesc">Watch real patient stories and hearing transformations with Turtle Maarks.</p>

          <!-- Conversion Actions Inside Modal -->
          <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center pt-2 border-top border-white-10">
            <div class="small text-white-50">
              <i class="bi bi-shield-check text-success me-1"></i> 7-Day Zero-Risk Free Trial Available
            </div>
            <div class="d-flex gap-2">
              <a href="https://wa.me/{{ $siteWhatsApp ?? site_whatsapp() }}" target="_blank" class="tm-btn tm-btn-success btn-sm" id="tmYouTubeWaBtn">
                <i class="bi bi-whatsapp me-1"></i> Ask Doctor on WhatsApp
              </a>
              <a href="{{ route('appointments.create') }}" class="tm-btn tm-btn-primary btn-sm">
                <i class="bi bi-calendar2-check me-1"></i> Book Free Trial
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- 9. FREQUENTLY ASKED QUESTIONS -->
  <section class="py-5 bg-light border-top position-relative">
    <div class="container">
      
      <div class="row g-4 g-lg-5">
        
        <!-- Left: Section Head & Doctor Help Card -->
        <div class="col-lg-4">
          <div class="tm-faq-support-card">
            
            <span class="tm-pill tm-pill-orange mb-2"><i class="bi bi-question-circle-fill"></i> Clear Answers</span>
            <h2 class="tm-section-title mb-2">Frequently Asked <span class="text-orange">Questions</span></h2>
            <p class="text-secondary small mb-4">
              Everything you need to know about hearing aid options, pricing, features, and brand warranties.

            </p>

            <div class="card rounded-3 border bg-light-subtle p-3 mb-3">
              <div class="d-flex align-items-center gap-3 mb-2">
                <div class="rounded-circle bg-orange text-white d-flex align-items-center justify-content-center flex-shrink-0" style="width: 44px; height: 44px; font-size: 1.25rem;">
                  <i class="bi bi-person-heart"></i>
                </div>
                <div>
                  <h6 class="fw-bold text-navy mb-0">Have a Question?</h6>
                  <span class="text-muted small">Talk to our Audiologist</span>
                </div>
              </div>
              <p class="small text-secondary mb-3">
                Get honest, medical-grade guidance about your audiogram report or hearing devices.
              </p>

              <div class="d-grid gap-2">
                <a href="https://wa.me/{{ SITE_WHATSAPP }}?text={{ urlencode('Hello Doctor, I have a question regarding hearing aids and testing.') }}" target="_blank" rel="noopener" class="btn btn-sm btn-success rounded-pill d-flex align-items-center justify-content-center gap-2 py-2 fw-semibold">
                  <i class="bi bi-whatsapp"></i> WhatsApp
                </a>
                <a href="tel:{{ SITE_PHONE_RAW }}" class="tm-btn tm-btn-outline-navy btn-sm justify-content-center py-2">
                  <i class="bi bi-telephone-fill me-1"></i> Call {{ SITE_PHONE }}
                </a>
              </div>
            </div>

            <!-- Trust Points -->
            <div class="pt-2">
              <div class="d-flex align-items-center gap-2 small text-secondary mb-2">
                <i class="bi bi-patch-check-fill text-success fs-6"></i>
                <span>RCI-Certified Audiologists</span>
              </div>
              <div class="d-flex align-items-center gap-2 small text-secondary mb-2">
                <i class="bi bi-award-fill text-orange fs-6"></i>
                <span>100% Genuine International Warranty</span>
              </div>
            </div>

          </div>
        </div>

        <!-- Right: Modern Accordion Items -->
        <div class="col-lg-8">
          <div class="accordion" id="tmModernFaq">
            
            <!-- FAQ 1 -->
            <div class="tm-faq-item">
              <h2 class="accordion-header" id="headingFaq1">
                <button class="tm-faq-btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFaq1" aria-expanded="true" aria-controls="collapseFaq1">
                  <span class="d-flex align-items-center">
                    <span class="tm-faq-num">01</span>
                    <span>How do I know which hearing aid model is right for my hearing loss?</span>
                  </span>
                  <span class="tm-faq-icon-circle"><i class="bi bi-chevron-down"></i></span>
                </button>
              </h2>
              <div id="collapseFaq1" class="accordion-collapse collapse show" aria-labelledby="headingFaq1" data-bs-parent="#tmModernFaq">
                <div class="tm-faq-body">
                  Our RCI-certified audiologist conducts a comprehensive Pure Tone Audiometry (PTA) test in our calibrated sound-treated booth. Based on your exact audiogram frequency loss, ear canal anatomy, and lifestyle requirements (business meetings, active outdoors, or quiet home environment), we program and trial suitable digital models from premier global manufacturers including <strong>Phonak, Oticon, Signia, Widex, ReSound, and Starkey</strong>.
                </div>
              </div>
            </div>

            <!-- FAQ 2 -->
            <div class="tm-faq-item">
              <h2 class="accordion-header" id="headingFaq2">
                <button class="tm-faq-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFaq2" aria-expanded="false" aria-controls="collapseFaq2">
                  <span class="d-flex align-items-center">
                    <span class="tm-faq-num">02</span>
                    <span>Can I take a free hearing aid trial before making a financial commitment?</span>
                  </span>
                  <span class="tm-faq-icon-circle"><i class="bi bi-chevron-down"></i></span>
                </button>
              </h2>
              <div id="collapseFaq2" class="accordion-collapse collapse" aria-labelledby="headingFaq2" data-bs-parent="#tmModernFaq">
                <div class="tm-faq-body">
                  Yes! Turtle Maarks provides a complimentary <strong>7-Day Free Trial</strong> program. You can wear the programmed digital hearing aids in your real-life environment—at home, watching television, during dining conversations, and on phone calls—to evaluate true speech clarity before making any final purchase decision.
                </div>
              </div>
            </div>

            <!-- FAQ 3 -->
            <div class="tm-faq-item">
              <h2 class="accordion-header" id="headingFaq3">
                <button class="tm-faq-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFaq3" aria-expanded="false" aria-controls="collapseFaq3">
                  <span class="d-flex align-items-center">
                    <span class="tm-faq-num">03</span>
                    <span>What is the price range of digital hearing aids in India?</span>
                  </span>
                  <span class="tm-faq-icon-circle"><i class="bi bi-chevron-down"></i></span>
                </button>
              </h2>
              <div id="collapseFaq3" class="accordion-collapse collapse" aria-labelledby="headingFaq3" data-bs-parent="#tmModernFaq">
                <div class="tm-faq-body">
                  Digital hearing aids range from basic digital models (₹18,500 – ₹35,000) for quiet home use, to advanced mid-tier rechargeable models (₹45,000 – ₹1,25,000) with Bluetooth streaming, up to premium AI-driven deep neural network devices (₹1,50,000+) designed for complex noisy environments. We offer 0% interest EMI options and transparent brand price matching.
                </div>
              </div>
            </div>

            <!-- FAQ 4 -->
            <div class="tm-faq-item">
              <h2 class="accordion-header" id="headingFaq4">
                <button class="tm-faq-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFaq4" aria-expanded="false" aria-controls="collapseFaq4">
                  <span class="d-flex align-items-center">
                    <span class="tm-faq-num">04</span>
                    <span>Do you provide doorstep home visits in Greater Noida West & Noida?</span>
                  </span>
                  <span class="tm-faq-icon-circle"><i class="bi bi-chevron-down"></i></span>
                </button>
              </h2>
              <div id="collapseFaq4" class="accordion-collapse collapse" aria-labelledby="headingFaq4" data-bs-parent="#tmModernFaq">
                <div class="tm-faq-body">
                  Yes, our senior audiologists provide doorstep consultations for elderly and mobility-impaired patients across Greater Noida West, Gaur City 1 & 2, Sector 4, Sector 50, 76, 121, 137, and Noida. We bring calibrated portable audiometers and trial hearing instruments straight to your living room.
                </div>
              </div>
            </div>

            <!-- FAQ 5 -->
            <div class="tm-faq-item">
              <h2 class="accordion-header" id="headingFaq5">
                <button class="tm-faq-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFaq5" aria-expanded="false" aria-controls="collapseFaq5">
                  <span class="d-flex align-items-center">
                    <span class="tm-faq-num">05</span>
                    <span>What warranty and aftercare support is included with the hearing aids?</span>
                  </span>
                  <span class="tm-faq-icon-circle"><i class="bi bi-chevron-down"></i></span>
                </button>
              </h2>
              <div id="collapseFaq5" class="accordion-collapse collapse" aria-labelledby="headingFaq5" data-bs-parent="#tmModernFaq">
                <div class="tm-faq-body">
                  All instruments purchased through Turtle Maarks come backed by <strong>2 to 4 years of 100% authentic international manufacturer warranty</strong>. Furthermore, you receive <strong>lifetime free acoustic fine-tuning</strong>, firmware updates, hearing profile recalibrations, and routine vacuum dehumidification at our clinic.
                </div>
              </div>
            </div>

            <!-- FAQ 6 -->
            <div class="tm-faq-item">
              <h2 class="accordion-header" id="headingFaq6">
                <button class="tm-faq-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFaq6" aria-expanded="false" aria-controls="collapseFaq6">
                  <span class="d-flex align-items-center">
                    <span class="tm-faq-num">06</span>
                    <span>How long does a comprehensive hearing test take, and is it painful?</span>
                  </span>
                  <span class="tm-faq-icon-circle"><i class="bi bi-chevron-down"></i></span>
                </button>
              </h2>
              <div id="collapseFaq6" class="accordion-collapse collapse" aria-labelledby="headingFaq6" data-bs-parent="#tmModernFaq">
                <div class="tm-faq-body">
                  The test is 100% non-invasive, completely painless, and takes approximately 30 to 45 minutes. It includes video otoscopic inspection of your ear canal, Pure Tone Audiometry (PTA) in our soundproof booth, and Tympanometry to check eardrum mobility. You receive your official medical audiogram report immediately upon completion.
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- 10. LATEST BLOGS & ARTICLES -->
  <section class="py-5 bg-white border-top position-relative">
    <div class="container">
      <div class="d-flex flex-column flex-md-row align-items-md-end justify-content-between mb-4 gap-3">
        <div class="tm-section-head mb-0">
          <span class="tm-pill tm-pill-orange mb-2"><i class="bi bi-journal-text"></i> Hearing Health Journal</span>
          <h2 class="tm-section-title mb-1">Latest Insights & <span>Expert Guides</span></h2>
          <p class="tm-section-sub mb-0">Evidence-based audiological advice, hearing aid technology updates, and practical ear wellness tips</p>
        </div>
        <div class="d-none d-md-block">
          <a href="{{ route('blog.index') }}" class="tm-btn tm-btn-outline-navy btn-sm">
            Explore All Insights <i class="bi bi-arrow-right ms-1"></i>
          </a>
        </div>
      </div>

      <!-- 4 Blog Cards Grid -->
      <div class="row g-4 row-cols-1 row-cols-md-2 row-cols-xl-4">
        
        <!-- Blog 1: Hearing Aid Selection Guide -->
        <div class="col">
          <article class="tm-blog-card shadow-xs">
            <div class="tm-blog-img-wrap">
              <img src="{{ tm_asset('images/services/hearing-aid-clinic-in-noida-extension.png') }}" alt="How to Choose the Right Hearing Aid" loading="lazy">
              <span class="tm-blog-badge tm-blog-badge-orange">Buying Guide</span>
              <span class="tm-blog-read-time"><i class="bi bi-clock me-1"></i> 5 min read</span>
            </div>
            <div class="tm-blog-body">
              <div class="tm-blog-meta">
                <span class="tm-blog-meta-item"><i class="bi bi-calendar3 text-orange"></i> Aug 24, 2026</span>
                <span class="tm-blog-meta-item text-secondary">•</span>
                <span class="tm-blog-meta-item"><i class="bi bi-patch-check-fill text-success"></i> Turtle Maarks</span>
              </div>
              <h3 class="tm-blog-title">
                <a href="{{ route('blog.index') }}" class="stretched-link">How to Choose the Right Hearing Aid: 2026 Digital Buyer Guide</a>
              </h3>
              <p class="tm-blog-desc">
                Discover the key differences between Invisible (IIC/CIC), Receiver-in-Canal (RIC), and Behind-the-Ear (BTE) models with AI-powered speech clarity.
              </p>
            </div>
            <div class="tm-blog-footer">
              <span class="tm-blog-link">
                Read Guide <i class="bi bi-arrow-right"></i>
              </span>
              <span class="tm-blog-author-avatar" title="Verified Audiologist"><i class="bi bi-person-fill"></i></span>
            </div>
          </article>
        </div>

        <!-- Blog 2: Pure Tone Audiometry & Diagnostics -->
        <div class="col">
          <article class="tm-blog-card shadow-xs">
            <div class="tm-blog-img-wrap">
              <img src="{{ tm_asset('images/services/hearing-test-in-noida-extension.png') }}" alt="Understanding Pure Tone Audiometry & Speech Tests" loading="lazy">
              <span class="tm-blog-badge tm-blog-badge-navy">Diagnostics</span>
              <span class="tm-blog-read-time"><i class="bi bi-clock me-1"></i> 4 min read</span>
            </div>
            <div class="tm-blog-body">
              <div class="tm-blog-meta">
                <span class="tm-blog-meta-item"><i class="bi bi-calendar3 text-orange"></i> Aug 18, 2026</span>
                <span class="tm-blog-meta-item text-secondary">•</span>
                <span class="tm-blog-meta-item"><i class="bi bi-patch-check-fill text-success"></i> Turtle Maarks</span>
              </div>
              <h3 class="tm-blog-title">
                <a href="{{ route('blog.index') }}" class="stretched-link">Understanding Pure Tone Audiometry (PTA) & Speech Tests</a>
              </h3>
              <p class="tm-blog-desc">
                Learn what actually happens inside a sound-treated booth during diagnostic testing and how to accurately interpret your frequency audiogram report.
              </p>
            </div>
            <div class="tm-blog-footer">
              <span class="tm-blog-link">
                Read Guide <i class="bi bi-arrow-right"></i>
              </span>
              <span class="tm-blog-author-avatar" title="Diagnostic Specialist"><i class="bi bi-person-fill"></i></span>
            </div>
          </article>
        </div>

        <!-- Blog 3: Age-Related Hearing Loss & Senior Care -->
        <div class="col">
          <article class="tm-blog-card shadow-xs">
            <div class="tm-blog-img-wrap">
              <img src="{{ tm_asset('images/services/audiologist-in-gaur-city.png') }}" alt="5 Early Signs of Age-Related Hearing Loss" loading="lazy">
              <span class="tm-blog-badge tm-blog-badge-teal">Senior Care</span>
              <span class="tm-blog-read-time"><i class="bi bi-clock me-1"></i> 4 min read</span>
            </div>
            <div class="tm-blog-body">
              <div class="tm-blog-meta">
                <span class="tm-blog-meta-item"><i class="bi bi-calendar3 text-orange"></i> Aug 10, 2026</span>
                <span class="tm-blog-meta-item text-secondary">•</span>
                <span class="tm-blog-meta-item"><i class="bi bi-patch-check-fill text-success"></i> Turtle Maarks</span>
              </div>
              <h3 class="tm-blog-title">
                <a href="{{ route('blog.index') }}" class="stretched-link">5 Early Signs of Age-Related Hearing Loss You Shouldn't Ignore</a>
              </h3>
              <p class="tm-blog-desc">
                Early intervention prevents cognitive fatigue and social isolation. Spot the subtle warning signs in daily conversation and learn about free home visits.
              </p>
            </div>
            <div class="tm-blog-footer">
              <span class="tm-blog-link">
                Read Guide <i class="bi bi-arrow-right"></i>
              </span>
              <span class="tm-blog-author-avatar" title="Senior Care Audiologist"><i class="bi bi-person-fill"></i></span>
            </div>
          </article>
        </div>

        <!-- Blog 4: Tinnitus & Sound Therapy -->
        <div class="col">
          <article class="tm-blog-card shadow-xs">
            <div class="tm-blog-img-wrap">
              <img src="{{ tm_asset('images/ear-model.jpg') }}" alt="Managing Tinnitus: Sound Therapy & Modern Relief" loading="lazy">
              <span class="tm-blog-badge tm-blog-badge-green">Therapy</span>
              <span class="tm-blog-read-time"><i class="bi bi-clock me-1"></i> 6 min read</span>
            </div>
            <div class="tm-blog-body">
              <div class="tm-blog-meta">
                <span class="tm-blog-meta-item"><i class="bi bi-calendar3 text-orange"></i> Jul 29, 2026</span>
                <span class="tm-blog-meta-item text-secondary">•</span>
                <span class="tm-blog-meta-item"><i class="bi bi-patch-check-fill text-success"></i> Turtle Maarks</span>
              </div>
              <h3 class="tm-blog-title">
                <a href="{{ route('blog.index') }}" class="stretched-link">Managing Tinnitus: Modern Sound Therapy & Digital Relief</a>
              </h3>
              <p class="tm-blog-desc">
                Effective clinical protocols and specialized notch therapy sound masking built into digital hearing aids to quiet persistent ringing in the ears.
              </p>
            </div>
            <div class="tm-blog-footer">
              <span class="tm-blog-link">
                Read Guide <i class="bi bi-arrow-right"></i>
              </span>
              <span class="tm-blog-author-avatar" title="Tinnitus Specialist"><i class="bi bi-person-fill"></i></span>
            </div>
          </article>
        </div>

      </div>

      <div class="text-center mt-3 d-md-none">
        <a href="{{ route('blog.index') }}" class="tm-btn tm-btn-outline-navy tm-btn-sm w-100">
          Explore All Insights <i class="bi bi-arrow-right ms-1"></i>
        </a>
      </div>

    </div>
  </section>
@endsection
