@extends('site.layouts.app')

@section('title', $p['name'] . ' — ' . SITE_NAME)
@section('meta_description', $p['name'] . ' (' . $p['brand'] . ', ' . ($p['brandOrigin'] ?? 'Global') . ') — ' . $p['style'] . ' digital hearing aid with ' . (int) $p['channels'] . ' processing channels. Official manufacturer warranty, sound-booth calibration, and lifetime fine-tuning in Greater Noida West.')

@section('active_nav', 'products')

@section('content')
@php
    $price        = (float) $p['price'];
    $mrp          = (float) ($p['mrp'] ?? $p['price']);
    $savings      = max(0, $mrp - $price);
    $savePct      = $mrp > $price ? (int) round((($mrp - $price) / $mrp) * 100) : 0;
    $image        = $p['image'] ?: asset('frontend-assets/images/no-product/no-product.png');
    $jsItem       = "{id:'" . js_str($p['id']) . "', name:'" . js_str($p['name']) . "', brand:'" . js_str($p['brand'])
                  . "', price:" . (int) $price . ", mrp:" . (int) $mrp . ", image:'" . js_str($image) . "'}";
    $warrantyText = $product->warranty_months 
        ? ($product->warranty_months >= 12 
            ? (round($product->warranty_months / 12) . ' Years Warranty') 
            : ($product->warranty_months . ' Months Warranty')) 
        : '4 Years Warranty';
    $galleryImages = $product->images;
@endphp
<!-- HERO BANNER -->
  <section class="tm-page-hero text-center position-relative">
    <div class="container">
      <nav aria-label="breadcrumb" class="d-inline-flex mw-100 mb-2">
        <div class="tm-breadcrumb-pill">
          <a href="{{ route('home') }}"><i class="bi bi-house-door"></i> Home</a>
          <span class="tm-breadcrumb-sep d-none d-sm-inline-flex"><i class="bi bi-chevron-right"></i></span>
          <a href="{{ route('products') }}" class="d-none d-sm-inline-flex">Products</a>
          <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
          <a href="{{ route('products', ['brand' => $p['brand']]) }}">{{ $p['brand'] }}</a>
          <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
          <span class="tm-breadcrumb-current" aria-current="page">{{ $p['name'] }}</span>
        </div>
      </nav>
      <h1 class="display-6 fw-bold text-white mb-2 font-heading">{{ $p['name'] }}</h1>
      <p class="text-white-50 mx-auto small mb-0" style="max-width: 680px;">Official {{ $p['brand'] }} ({{ $p['brandOrigin'] ?? 'Denmark' }}) {{ $p['style'] }} digital hearing aid with {{ (int) $p['channels'] }} DSP processing channels.</p>
    </div>
  </section>

<!-- =========================================================================
     PRODUCT HERO & BUYING SHOWCASE
     ========================================================================= -->
<section class="py-4 py-lg-5 bg-light-subtle">
  <div class="container">
    <div class="row g-4 g-lg-5">

      <!-- Left: Media & Clinical Trust Badges -->
      <div class="col-lg-6">
        <div class="card rounded-4 border p-3 p-md-4 tm-pd-gallery-card sticky-lg-top" style="top: 90px;">
          

          <!-- Main Product Image Showcase with Interactive Pan-Zoom -->
          <div class="tm-pd-image-stage my-3" id="tmProductImageStage" onclick="openProductLightbox()" title="Click to open Fullscreen Inspector">
            
            <!-- Fullscreen Trigger Button -->
            <button type="button" class="tm-fullscreen-trigger-btn" onclick="event.stopPropagation(); openProductLightbox();" title="Expand Fullscreen High-Res">
              <i class="bi bi-arrows-fullscreen"></i>
            </button>

            <!-- Main High-Res Image -->
            <img src="{{ $image }}" id="tmMainProductImg" onerror="this.onerror=null;this.src='{{ asset('frontend-assets/images/no-product/no-product.png') }}';" alt="{{ $p['name'] }}" class="tm-pd-main-img">

            <!-- Floating Zoom & Inspection Pill -->
            <div class="tm-zoom-badge">
              <i class="bi bi-zoom-in"></i> Roll over to zoom &bull; Click to inspect
            </div>
          </div>

          <!-- Secondary Image Thumbnails -->
          <div class="tm-pd-thumbs-wrap mb-4">
            <button type="button" class="tm-pd-thumb-btn active" onclick="switchProductImage('{{ $image }}', this)" title="Main View">
              <img src="{{ $image }}" onerror="this.onerror=null;this.src='{{ asset('frontend-assets/images/no-product/no-product.png') }}';" alt="{{ $p['name'] }} Main View">
            </button>
            @if($galleryImages && $galleryImages->count() > 0)
              @foreach ($galleryImages as $idx => $gImg)
                <button type="button" class="tm-pd-thumb-btn" onclick="switchProductImage('{{ $gImg->url }}', this)" title="{{ $gImg->alt_text ?: ($p['name'] . ' View ' . ($idx + 2)) }}">
                  <img src="{{ $gImg->url }}" alt="{{ $gImg->alt_text ?: ($p['name'] . ' - View ' . ($idx + 2)) }}">
                </button>
              @endforeach
            @else
              @php
                $angles = [
                  ['file' => 'hearing-aid/ric.webp', 'label' => 'Side Profile View'],
                  ['file' => 'hearing-aid/bte.webp', 'label' => 'Behind-The-Ear Angle'],
                  ['file' => 'hearing-aid/cic.webp', 'label' => 'In-Ear Fitment'],
                ];
              @endphp
              @foreach ($angles as $ang)
                <button type="button" class="tm-pd-thumb-btn" onclick="switchProductImage('{{ tm_asset('images/' . $ang['file']) }}', this)" title="{{ $ang['label'] }}">
                  <img src="{{ tm_asset('images/' . $ang['file']) }}" alt="{{ $p['name'] }} - {{ $ang['label'] }}">
                </button>
              @endforeach
            @endif
          </div>

        </div>
      </div>

      <!-- Right: Buying Panel & Specifications -->
      <div class="col-lg-6">
        <div class="card rounded-4 border p-4 p-md-5 bg-white shadow-xs">
          
          <!-- Brand & Category Header -->
          <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
            <span class="badge bg-light text-navy border px-3 py-2 fw-semibold">
              <i class="bi bi-award-fill text-orange me-1"></i> {{ $p['brand'] }} ({{ $p['brandOrigin'] ?? 'Global' }})
            </span>
            @if($product->category)
              <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 fw-semibold">
                <i class="bi bi-tag-fill me-1"></i> {{ $product->category->name }}
              </span>
            @endif
            @if($product->form_factor || $p['style'])
              <span class="badge bg-secondary-subtle text-secondary border px-2 py-2 fw-semibold">
                {{ $product->form_factor ?: $p['style'] }}
              </span>
            @endif
          </div>

          <!-- Product Title -->
          <h2 class="h3 fw-bold text-navy mb-2 font-heading">{{ $p['name'] }}</h2>

          <!-- Reviews & Rating -->
          <div class="d-flex align-items-center flex-wrap gap-2 mb-3">
            @php
              $stars = max(0, min(5, (int) round((float) $p['rating'])));
            @endphp
            <div class="text-warning small">{{ str_repeat('★', $stars) . str_repeat('☆', 5 - $stars) }}</div>
            <span class="small fw-bold text-navy">{{ number_format((float) $p['rating'], 1) }} / 5.0</span>
            <span class="small text-muted">&bull; {{ (int) $p['reviews'] }} Verified Patient Reviews</span>
          </div>

          <!-- Pricing & Stock Highlight Box -->
          <div class="card rounded-3 border-0 bg-light p-3 mb-4">
            <div class="d-flex align-items-baseline flex-wrap gap-3 mb-2">
              <span class="fs-2 fw-bold text-navy font-heading">{{ inr($price) }}</span>
              @if ($mrp > $price)
                <span class="text-muted text-decoration-line-through fs-5">{{ inr($mrp) }}</span>
                <span class="badge bg-success text-white px-2 py-1 fw-bold">Save {{ inr($savings) }} ({{ $savePct }}% OFF)</span>
              @endif
            </div>
            <div class="d-flex flex-wrap align-items-center gap-3">
              @if($product->isInStock())
                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 small">
                  <i class="bi bi-check-circle-fill me-1"></i> In Stock &amp; Ready for Calibration
                </span>
              @else
                <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3 py-1 small">
                  <i class="bi bi-x-circle-fill me-1"></i> Out of Stock
                </span>
              @endif
              @if($product->sku)
                <span class="text-muted small"><strong>SKU:</strong> <code>{{ $product->sku }}</code></span>
              @endif
              @if($product->model_number)
                <span class="text-muted small"><strong>Model:</strong> {{ $product->model_number }}</span>
              @endif
            </div>
          </div>

          <!-- Short Description -->
          @if(!empty($product->short_description))
            <div class="tm-pd-short-desc mb-4">
              <div class="p-3 bg-light-subtle rounded-3 border-start border-3 border-orange">
                <p class="text-secondary leading-relaxed mb-0" style="font-size: 0.92rem;">
                  {!! nl2br(e($product->short_description)) !!}
                </p>
              </div>
            </div>
          @endif

          <!-- Action Buttons (7-Day Trial Button Removed) -->
          <!-- Action Buttons -->
          <div class="d-flex flex-column flex-sm-row flex-wrap gap-2 gap-sm-3 mb-3">
            <button type="button" class="tm-btn tm-btn-primary tm-btn-lg flex-grow-1 d-flex align-items-center justify-content-center gap-2" onclick="Cart.addItem({!! $jsItem !!})">
              <i class="bi bi-cart-plus fs-5"></i> Add to Cart
            </button>
            <a href="https://wa.me/{{ SITE_WHATSAPP }}?text={{ rawurlencode('Hi ' . SITE_SHORT . ', I would like details and pricing for ' . $p['name']) }}"
               target="_blank" rel="noopener" class="tm-btn tm-btn-whatsapp-outline tm-btn-lg flex-grow-1 d-flex align-items-center justify-content-center gap-2">
              <span class="tm-wa-icon-box"><i class="bi bi-whatsapp"></i></span>
              <span>Consult on WhatsApp</span>
            </a>
          </div>
          <!-- Clinical Fitting & Quality Guarantee Notice (Why Order from Turtle Maarks) -->
          <div class="tm-why-order-box p-3 bg-white mt-2">
            
            <!-- Card Header with Verified Dispenser Badge -->
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-1 pb-2 mb-1 border-bottom">
              <div class="d-flex align-items-center gap-2">
                <div class="rounded-circle bg-orange-subtle text-orange d-flex align-items-center justify-content-center" style="width: 24px; height: 24px;">
                  <i class="bi bi-shield-fill-check" style="font-size: 0.78rem;"></i>
                </div>
                <span class="fw-bold text-navy" style="font-size: 0.85rem;">Why Order from Turtle Maarks?</span>
              </div>
            </div>

            <!-- Features Rows (Compact) -->
            <div class="d-flex flex-column" style="font-size: 0.78rem;">
              
              <!-- 1. Authentic Factory Sealed -->
              <div class="tm-why-feature-row">
                <div class="tm-why-feature-icon">
                  <i class="bi bi-award-fill"></i>
                </div>
                <div>
                  <strong class="text-navy d-block" style="font-size: 0.8rem;">100% Genuine Factory Sealed</strong>
                  <span class="text-secondary">Official {{ $p['brand'] }} pack with verified serial number &amp; international warranty.</span>
                </div>
              </div>

              <!-- 2. Acoustic Match & Audiogram Programming -->
              <div class="tm-why-feature-row">
                <div class="tm-why-feature-icon icon-navy">
                  <i class="bi bi-soundwave"></i>
                </div>
                <div>
                  <strong class="text-navy d-block" style="font-size: 0.8rem;">Sound-Booth Calibration</strong>
                  <span class="text-secondary">Pre-programmed to your audiogram test report by RCI audiologists before dispatch.</span>
                </div>
              </div>

              <!-- 3. Complete Accessories & Lifetime Care -->
              <div class="tm-why-feature-row">
                <div class="tm-why-feature-icon icon-green">
                  <i class="bi bi-box-seam-fill"></i>
                </div>
                <div>
                  <strong class="text-navy d-block" style="font-size: 0.8rem;">Full Kit &amp; Lifetime Care</strong>
                  <span class="text-secondary">Includes case, wax filters, domes &amp; free lifetime clinic acoustic fine-tuning.</span>
                </div>
              </div>

            </div>

          </div>

        </div>
      </div>

    </div>
  </div>
</section>

<!-- =========================================================================
     COMPREHENSIVE AUDIOLOGICAL DEEP DIVE — TABBED DETAILS
     ========================================================================= -->
<section class="py-5 bg-white border-top">
  <div class="container">
    
    <div class="row g-4">
      <div class="col-lg-8">
        
        <!-- Tab Navigation Bar -->
        <ul class="nav tm-pd-tabs mb-4 overflow-auto flex-nowrap" id="productDetailTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="descriptions-tab" data-bs-toggle="tab" data-bs-target="#tabDescriptions" type="button" role="tab" aria-controls="tabDescriptions" aria-selected="true">
              <i class="bi bi-file-text me-1"></i> Descriptions
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#tabReviews" type="button" role="tab" aria-controls="tabReviews" aria-selected="false">
              <i class="bi bi-star-fill text-warning me-1"></i> Reviews ({{ (int) $p['reviews'] }})
            </button>
          </li>
        </ul>

        <!-- Tab Content Panes -->
        <div class="tab-content" id="productDetailTabContent">

          <!-- TAB 1: PRODUCT DESCRIPTIONS -->
          <div class="tab-pane fade show active" id="tabDescriptions" role="tabpanel" aria-labelledby="descriptions-tab">

            @if(!empty($product->description))
              <div class="text-secondary leading-relaxed mb-4 product-full-description tm-rich-content overflow-auto">
                {!! $product->description !!}
              </div>
            @else
              <p class="text-secondary leading-relaxed mb-4">
                No detailed description provided for this product.
              </p>
            @endif
          </div>

          <!-- TAB 2: COMPREHENSIVE PATIENT REVIEW SYSTEM -->
          <div class="tab-pane fade" id="tabReviews" role="tabpanel" aria-labelledby="reviews-tab">
            
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
              <div>
                <h3 class="h5 fw-bold text-navy mb-1">Patient Reviews &amp; Clinical Feedback</h3>
                <p class="text-secondary small mb-0">Verified experiences from patients fitted at our Gaur City clinic &amp; doorstep home visits</p>
              </div>
              <button class="tm-btn tm-btn-primary btn-sm d-flex align-items-center gap-2" type="button" data-bs-toggle="collapse" data-bs-target="#tmWriteReviewCollapse" aria-expanded="false" aria-controls="tmWriteReviewCollapse">
                <i class="bi bi-pencil-square"></i> Write a Patient Review
              </button>
            </div>

            <!-- Review Summary & Score Breakdown Box -->
            <div class="card rounded-4 border p-4 bg-light-subtle mb-4">
              <div class="row g-4 align-items-center">
                
                <!-- Overall Score -->
                <div class="col-md-4 text-center border-end-md">
                  <div class="display-4 fw-bold text-navy font-heading">{{ number_format((float) $p['rating'], 1) }}</div>
                  <div class="text-warning fs-5 mb-1">
                    @php
$rstars = max(0, min(5, (int) round((float) $p['rating'])));
@endphp
                    {{ str_repeat('★', $rstars) . str_repeat('☆', 5 - $rstars) }}
                  </div>
                  <div class="small fw-bold text-navy">Overall Patient Satisfaction</div>
                  <div class="text-muted small">Based on {{ (int) $p['reviews'] }} verified clinical fittings</div>
                  <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill mt-2 px-2 py-1 small">
                    <i class="bi bi-check-circle-fill me-1"></i> 97% Recommend this Model
                  </span>
                </div>

                <!-- Star Rating Progress Bars -->
                <div class="col-md-4">
                  <div class="d-flex flex-column gap-2 small">
                    @foreach ([5, 4, 3, 2, 1] as $starLevel)
                      @php $pct = $ratingBreakdown[$starLevel] ?? 0; @endphp
                      <div class="d-flex align-items-center gap-2">
                        <span class="text-nowrap text-muted" style="width: 45px;">{{ $starLevel }} ★</span>
                        <div class="progress flex-grow-1" style="height: 8px;">
                          <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $pct }}%;" aria-valuenow="{{ $pct }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="text-muted small" style="width: 32px;">{{ $pct }}%</span>
                      </div>
                    @endforeach
                  </div>
                </div>

                <!-- Feature Rating Metrics -->
                <div class="col-md-4">
                  <div class="d-flex flex-column gap-2 small bg-white p-3 rounded-3 border">
                    <div class="d-flex justify-content-between">
                      <span class="text-muted">Speech in Noise Clarity:</span>
                      <strong class="text-navy">4.9 / 5.0</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                      <span class="text-muted">In-Ear Comfort &amp; Fit:</span>
                      <strong class="text-navy">4.8 / 5.0</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                      <span class="text-muted">Battery &amp; Charging Life:</span>
                      <strong class="text-navy">4.8 / 5.0</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                      <span class="text-muted">Bluetooth Call Quality:</span>
                      <strong class="text-navy">4.7 / 5.0</strong>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <!-- Collapsible Write Review Form -->
            <div class="collapse mb-4" id="tmWriteReviewCollapse">
              <div class="card rounded-4 border p-4 p-md-5 bg-white shadow-sm position-relative overflow-hidden">
                <div class="position-absolute top-0 start-0 w-100 bg-orange" style="height: 4px;"></div>

                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-4 pb-3 border-bottom">
                  <div>
                    <span class="badge bg-orange-subtle text-orange rounded-pill px-3 py-1 fw-bold small mb-2">
                      <i class="bi bi-chat-heart-fill me-1"></i> Patient Experience
                    </span>
                    <h4 class="fw-bold text-navy mb-1">Share Your Experience</h4>
                    <p class="text-secondary small mb-0">Help other patients and families by sharing how this hearing aid helped your daily conversations.</p>
                  </div>
                  <button type="button" class="btn-close" data-bs-toggle="collapse" data-bs-target="#tmWriteReviewCollapse" aria-label="Close"></button>
                </div>

                @guest
                <div class="alert alert-info small mb-4">
                  <i class="bi bi-info-circle-fill me-1"></i>
                  Please <a href="{{ route('login') }}" class="fw-bold text-decoration-none">sign in to your patient account</a> to post a verified review.
                </div>
                @endguest
                <form id="tmPatientReviewForm" method="POST" action="{{ route('reviews.store', $product->id) }}">
                  @csrf
                  <div class="row g-3 g-md-4">
                    
                    <!-- 1. Star Rating Selector (Interactive Stars) -->
                    <div class="col-12">
                      <div class="p-3 bg-light rounded-3 border d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                        <div>
                          <label class="form-label fw-bold text-navy mb-0 d-block">1. How would you rate this hearing aid?</label>
                          <span class="small text-muted" id="tmStarScoreText">★★★★★ Excellent — Life-changing speech clarity</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                          <input type="hidden" name="rating" id="tmSelectedRatingVal" value="5">
                          <div class="tm-star-rating-box" id="tmStarRatingWidget">
                            <span class="star-item selected" data-value="1" title="1 Star - Poor">★</span>
                            <span class="star-item selected" data-value="2" title="2 Stars - Fair">★</span>
                            <span class="star-item selected" data-value="3" title="3 Stars - Good">★</span>
                            <span class="star-item selected" data-value="4" title="4 Stars - Very Good">★</span>
                            <span class="star-item selected" data-value="5" title="5 Stars - Excellent">★</span>
                          </div>
                          <span class="badge bg-white text-navy border fw-bold px-2 py-1" id="tmStarScoreBadge">5.0 / 5</span>
                        </div>
                      </div>
                    </div>

                    <!-- 2. Product Badge (Readonly Chip) -->
                    <div class="col-md-6">
                      <label class="form-label small fw-bold text-navy mb-1">Device Being Reviewed</label>
                      <div class="p-2 px-3 bg-light border rounded-3 d-flex align-items-center gap-2">
                        <i class="bi bi-soundwave text-orange fs-5"></i>
                        <span class="fw-semibold text-navy small text-truncate">{{ $p['name'] }}</span>
                      </div>
                    </div>

                    <!-- 3. Full Name -->
                    <div class="col-md-6">
                      <label class="form-label small fw-bold text-navy mb-1">Your Name</label>
                      <input type="text" class="form-control rounded-3" value="{{ auth()->user()->name ?? '' }}" placeholder="e.g. Ramesh Sharma" readonly>
                    </div>

                    <!-- 4. Location / City -->
                    <div class="col-md-6">
                      <label class="form-label small fw-bold text-navy mb-1">Your City / Area</label>
                      <input type="text" name="city" class="form-control rounded-3" placeholder="e.g. Gaur City, Noida, Ghaziabad">
                    </div>

                    <!-- 5. Headline / Summary -->
                    <div class="col-md-6">
                      <label class="form-label small fw-bold text-navy mb-1">Review Headline <span class="text-danger">*</span></label>
                      <input type="text" name="title" value="{{ old('title') }}" class="form-control rounded-3" placeholder="e.g. Clear conversations at family dinner" required>
                    </div>

                    <!-- 6. Detailed Story / Feedback -->
                    <div class="col-12">
                      <div class="d-flex justify-content-between align-items-center mb-1">
                        <label class="form-label small fw-bold text-navy mb-0">Your Experience &amp; Story <span class="text-danger">*</span></label>
                        <span class="small text-muted" style="font-size: 0.75rem;">Simple &amp; honest feedback</span>
                      </div>
                      <textarea name="body" class="form-control rounded-3" id="tmReviewExperienceText" rows="4" placeholder="Tell us how your hearing improved. For example: How does it sound while watching TV, talking to family, or in noisy places?" required>{{ old('body') }}</textarea>
                    </div>

                    <!-- Submit Row -->
                    <div class="col-12 pt-2">
                      <button type="submit" class="tm-btn tm-btn-primary tm-btn-lg text-nowrap px-4" @disabled(!auth()->check())>
                        <i class="bi bi-send-fill me-2"></i> Submit My Review
                      </button>
                    </div>

                  </div>
                </form>

                <!-- Success Confirmation Message -->
                <div id="tmReviewSuccessMsg" class="alert alert-success border-success-subtle mt-4 {{ session('success') ? '' : 'd-none' }} mb-0 p-3 rounded-3 d-flex align-items-center gap-3">
                  <i class="bi bi-check-circle-fill text-success fs-3"></i>
                  <div>
                    <h6 class="fw-bold text-success mb-0">Thank you for your feedback!</h6>
                    <span class="small text-secondary">Your review has been submitted and will appear shortly after a quick quality verification.</span>
                  </div>
                </div>

              </div>
            </div>

            <!-- Verified Patient Reviews Feed (live from the database) -->
            <div class="d-flex flex-column gap-3">
              @forelse ($reviews as $review)
              <div class="card rounded-4 border p-4 bg-white shadow-xs">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
                  <div>
                    <div class="d-flex align-items-center gap-2">
                      <h6 class="fw-bold text-navy mb-0">{{ $review->user?->name ?? 'Verified Patient' }}</h6>
                      <span class="badge bg-success-subtle text-success border border-success-subtle small px-2 py-0">
                        <i class="bi bi-shield-check me-1"></i> Verified Patient
                      </span>
                    </div>
                    <div class="text-muted small mt-1">Reviewed {{ optional($review->created_at)->format('d F Y') }}</div>
                  </div>
                  @php $rs = max(0, min(5, (int) round((float) $review->rating))); @endphp
                  <div class="text-warning">{{ str_repeat('★', $rs) . str_repeat('☆', 5 - $rs) }}</div>
                </div>

                @if ($review->title)
                  <h6 class="fw-bold text-navy mt-2 mb-1">{{ $review->title }}</h6>
                @endif
                <p class="small text-secondary mb-0">{{ $review->body }}</p>

              </div>
              @empty
              <div class="card rounded-4 border p-5 bg-white shadow-xs text-center">
                <i class="bi bi-chat-square-heart text-muted fs-1 mb-2"></i>
                <h6 class="fw-bold text-navy mb-1">No patient reviews yet for this model</h6>
                <p class="small text-secondary mb-0">Be the first to share your fitting experience after your trial.</p>
              </div>
              @endforelse
            </div>

          </div>

        </div>

      </div>

      <!-- Right Column: Audiologist Consultation & Contact Card -->
      <div class="col-lg-4">
        <div class="card rounded-4 border bg-light p-4 sticky-lg-top" style="top: 90px;">
          
          <div class="d-flex align-items-center gap-3 mb-3">
            <div class="rounded-circle bg-navy text-white d-flex align-items-center justify-content-center fw-bold fs-5" style="width: 54px; height: 54px;">
              <i class="bi bi-person-badge"></i>
            </div>
            <div>
              <h6 class="fw-bold text-navy mb-0">Dr. Ritu Verma</h6>
              <div class="text-orange small fw-bold">Senior Clinical Audiologist</div>
              <div class="text-muted" style="font-size: 0.75rem;">RCI Regd. Master's in Audiology</div>
            </div>
          </div>

          <p class="small text-secondary mb-3">
            Not sure if <strong>{{ $p['name'] }}</strong> matches your specific hearing loss pattern? Send us your audiogram or schedule a clinic consultation for an acoustic recommendation.
          </p>

          <div class="d-grid gap-2 mb-3">
            <a href="{{ route('appointments.create') }}" class="tm-btn tm-btn-primary">
              <i class="bi bi-calendar-check me-1"></i> Book Audiology Consultation
            </a>
            <a href="tel:{{ $sitePhoneRaw ?? site_phone_raw() }}" class="tm-btn tm-btn-outline-navy">
              <i class="bi bi-telephone me-1"></i> Call {{ $sitePhone ?? site_phone() }}
            </a>
          </div>

          <div class="pt-3 border-top small text-muted">
            <div class="d-flex align-items-start gap-2 mb-2">
              <i class="bi bi-geo-alt-fill text-orange mt-1"></i>
              <span><strong>Clinic:</strong> {{ $siteAddress ?? site_address() }}</span>
            </div>
            <div class="d-flex align-items-center gap-2">
              <i class="bi bi-clock-fill text-orange"></i>
              <span><strong>Hours:</strong> Mon &ndash; Sat: 10:00 AM &ndash; 7:30 PM</span>
            </div>
          </div>

        </div>
      </div>

    </div>

  </div>
</section>

<!-- =========================================================================
     SIMILAR / RELATED HEARING AID MODELS
     ========================================================================= -->
@if ($related)
<section class="py-5 bg-light border-top">
  <div class="container">
    <div class="text-center tm-section-head mb-4">
      <span class="badge bg-white text-navy border px-3 py-1 rounded-pill small fw-semibold shadow-xs mb-2">
        <i class="bi bi-soundwave text-orange me-1"></i> Clinical Alternatives
      </span>
      <h2 class="tm-section-title h4 mb-1">Similar <span>Hearing Aid Models</span></h2>
      <p class="tm-section-sub small mb-0">Other high-performance models commonly evaluated alongside this one</p>
    </div>
    <div class="row g-3">
      @include('site.partials.product-grid', ['products' => $related, 'col' => 'col-xl-3 col-lg-4 col-md-6'])
    </div>
  </div>
</section>
@endif

<!-- =========================================================================
     HIGH-RES PRODUCT IMAGE LIGHTBOX MODAL
     ========================================================================= -->
<div class="modal fade" id="tmProductLightboxModal" tabindex="-1" aria-labelledby="tmProductLightboxModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content rounded-4 border-0 shadow-lg overflow-hidden bg-white">
      
      <!-- Modal Header -->
      <div class="modal-header border-bottom py-3 px-4 bg-light d-flex align-items-center justify-content-between">
        <div>
          <span class="badge bg-orange text-white rounded-pill px-2 py-1 small fw-semibold me-2">High-Res Inspection</span>
          <strong class="text-navy fs-6" id="tmProductLightboxModalLabel">{{ $p['name'] }}</strong>
        </div>
        <div class="d-flex align-items-center gap-2">
          <!-- Zoom Controls -->
          <div class="btn-group btn-group-sm me-2">
            <button type="button" class="btn btn-outline-secondary" onclick="zoomLightbox(0.35)" title="Zoom In">
              <i class="bi bi-zoom-in"></i> Zoom In
            </button>
            <button type="button" class="btn btn-outline-secondary" onclick="zoomLightbox(-0.35)" title="Zoom Out">
              <i class="bi bi-zoom-out"></i> Zoom Out
            </button>
            <button type="button" class="btn btn-outline-secondary" onclick="resetLightboxZoom()" title="Reset Zoom">
              <i class="bi bi-arrow-counterclockwise"></i> Reset
            </button>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      </div>

      <!-- Modal Body (Canvas) -->
      <div class="modal-body p-4 text-center overflow-auto position-relative bg-light-subtle" style="min-height: 480px; max-height: 72vh; display: flex; align-items: center; justify-content: center;">
        <img src="{{ $image }}" id="tmLightboxImg" alt="{{ $p['name'] }} High-Res View" style="max-height: 60vh; max-width: 88%; object-fit: contain; transition: transform 0.2s ease;">
      </div>

      <!-- Modal Footer with Angle Switcher -->
      <div class="modal-footer border-top py-2 px-4 bg-light d-flex justify-content-between align-items-center flex-wrap">
        <div class="text-muted small">
          <i class="bi bi-shield-check text-success me-1"></i> Original manufacturer photography with authentic housing details.
        </div>
        <div class="d-flex align-items-center gap-2">
          <span class="text-navy small fw-semibold">Switch Angle:</span>
          <button type="button" class="btn btn-sm btn-outline-secondary p-1 rounded-2" onclick="document.getElementById('tmLightboxImg').src='{{ $image }}'; resetLightboxZoom();" title="Main View">
            <img src="{{ $image }}" style="width: 32px; height: 32px; object-fit: contain;">
          </button>
          @if($galleryImages && $galleryImages->count() > 0)
            @foreach ($galleryImages as $idx => $gImg)
              <button type="button" class="btn btn-sm btn-outline-secondary p-1 rounded-2" onclick="document.getElementById('tmLightboxImg').src='{{ $gImg->url }}'; resetLightboxZoom();" title="View {{ $idx + 2 }}">
                <img src="{{ $gImg->url }}" style="width: 32px; height: 32px; object-fit: contain;">
              </button>
            @endforeach
          @else
            @foreach (['hearing-aid/ric.webp', 'hearing-aid/bte.webp', 'hearing-aid/cic.webp'] as $thumb)
              <button type="button" class="btn btn-sm btn-outline-secondary p-1 rounded-2" onclick="document.getElementById('tmLightboxImg').src='{{ tm_asset('images/' . $thumb) }}'; resetLightboxZoom();">
                <img src="{{ tm_asset('images/' . $thumb) }}" style="width: 32px; height: 32px; object-fit: contain;">
              </button>
            @endforeach
          @endif
        </div>
      </div>

    </div>
  </div>
</div>

<script>
// Switch Main Product Image & Thumbnail Active State
function switchProductImage(src, btn) {
  const mainImg = document.getElementById('tmMainProductImg');
  if (mainImg) mainImg.src = src;
  
  const lbImg = document.getElementById('tmLightboxImg');
  if (lbImg) lbImg.src = src;

  document.querySelectorAll('.tm-pd-thumb-btn').forEach(el => el.classList.remove('active'));
  if (btn) btn.classList.add('active');
}

// Lightbox Open & Zoom Controller
let currentLightboxZoom = 1;

function openProductLightbox() {
  const mainSrc = document.getElementById('tmMainProductImg').src;
  const lbImg = document.getElementById('tmLightboxImg');
  if (lbImg) {
    lbImg.src = mainSrc;
    currentLightboxZoom = 1;
    lbImg.style.transform = 'scale(1)';
  }
  const modalEl = document.getElementById('tmProductLightboxModal');
  if (modalEl) {
    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
    modal.show();
  }
}

function zoomLightbox(delta) {
  const lbImg = document.getElementById('tmLightboxImg');
  if (!lbImg) return;
  currentLightboxZoom = Math.max(0.75, Math.min(3.5, currentLightboxZoom + delta));
  lbImg.style.transform = `scale(${currentLightboxZoom})`;
}

function resetLightboxZoom() {
  const lbImg = document.getElementById('tmLightboxImg');
  if (!lbImg) return;
  currentLightboxZoom = 1;
  lbImg.style.transform = 'scale(1)';
}

document.addEventListener('DOMContentLoaded', () => {
  // 1. Stage Pan-Zoom on Hover
  const stage = document.getElementById('tmProductImageStage');
  const mainImg = document.getElementById('tmMainProductImg');

  if (stage && mainImg) {
    stage.addEventListener('mousemove', (e) => {
      const rect = stage.getBoundingClientRect();
      const x = ((e.clientX - rect.left) / rect.width) * 100;
      const y = ((e.clientY - rect.top) / rect.height) * 100;
      mainImg.style.transformOrigin = `${x}% ${y}%`;
      mainImg.style.transform = 'scale(2.2)';
    });

    stage.addEventListener('mouseleave', () => {
      mainImg.style.transform = 'scale(1)';
      mainImg.style.transformOrigin = 'center center';
    });
  }

  // 2. Patient Review Star Widget
  const widget = document.getElementById('tmStarRatingWidget');
  const badge = document.getElementById('tmStarScoreBadge');
  const label = document.getElementById('tmStarScoreText');
  const hiddenInput = document.getElementById('tmSelectedRatingVal');
  if (!widget) return;

  const stars = widget.querySelectorAll('.star-item');
  const starLabels = {
    1: '★☆☆☆☆ Poor — Sound was harsh or uncomfortable',
    2: '★★☆☆☆ Fair — Needs fine-tuning for noisy places',
    3: '★★★☆☆ Good — Helps with everyday conversations',
    4: '★★★★☆ Very Good — Very clear speech and comfortable fit',
    5: '★★★★★ Excellent — Life-changing speech clarity!'
  };

  stars.forEach(star => {
    star.addEventListener('mouseenter', () => {
      const val = parseInt(star.getAttribute('data-value'), 10);
      stars.forEach(s => {
        const sVal = parseInt(s.getAttribute('data-value'), 10);
        s.classList.toggle('hovered', sVal <= val);
      });
      if (label && starLabels[val]) label.textContent = starLabels[val];
    });

    star.addEventListener('mouseleave', () => {
      stars.forEach(s => s.classList.remove('hovered'));
      const current = parseInt(hiddenInput.value, 10) || 5;
      if (label && starLabels[current]) label.textContent = starLabels[current];
    });

    star.addEventListener('click', () => {
      const val = parseInt(star.getAttribute('data-value'), 10);
      hiddenInput.value = val;
      if (badge) badge.textContent = val.toFixed(1) + ' / 5';
      if (label && starLabels[val]) label.textContent = starLabels[val];
      stars.forEach(s => {
        const sVal = parseInt(s.getAttribute('data-value'), 10);
        s.classList.toggle('selected', sVal <= val);
      });
    });
  });
});
</script>
@endsection
