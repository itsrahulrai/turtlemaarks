@extends('site.layouts.app')

@section('title', ($blog->meta_title ?: $blog->title) . ' — ' . SITE_NAME)
@section('meta_description', $blog->meta_description ?: Str::limit(strip_tags($blog->excerpt ?: $blog->body), 155))
@section('og_image', $blog->thumbnail_url)

@section('active_nav', 'blogs')

@section('content')
@php
    $readTime   = max(1, (int) ceil(str_word_count(strip_tags($blog->body)) / 200)) . ' min read';
    $share_url  = url()->current();
    $share_text = rawurlencode($blog->title . ' — ' . $share_url);
@endphp
<!-- ARTICLE HEADER HERO -->
  <section class="tm-page-hero text-white position-relative">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 mx-auto text-center">
          <!-- Unified Frosted Breadcrumb Pill -->
          <nav aria-label="breadcrumb" class="d-inline-flex mb-2">
            <div class="tm-breadcrumb-pill">
              <a href="{{ route('home') }}"><i class="bi bi-house-door"></i> Home</a>
              <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
              <a href="{{ route('blog.index') }}">Blogs</a>
              <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
              <span class="tm-breadcrumb-current" aria-current="page">{{ $blog->blogCategory?->name ?? 'Hearing Health' }}</span>
            </div>
          </nav>

          <h1 class="display-6 fw-bold text-white mb-3 lh-sm font-heading">{{ $blog->title }}</h1>

          <div class="d-flex flex-wrap align-items-center justify-content-center gap-3 text-white-50 small">
            <span class="badge bg-orange-subtle text-orange rounded-pill px-3 py-1 fw-bold">
              <i class="bi bi-tag-fill me-1"></i> {{ $blog->blogCategory?->name ?? 'Hearing Health' }}
            </span>
            <div><i class="bi bi-calendar3 text-orange me-1"></i> {{ optional($blog->published_at ?? $blog->created_at)->format('d M Y') }}</div>
            <span class="text-white-20">•</span>
            <div><i class="bi bi-clock me-1"></i> {{ $readTime }}</div>
            <span class="text-white-20">•</span>
            <div><i class="bi bi-person-check-fill text-success me-1"></i> {{ $blog->admin?->name ?? SITE_SHORT }}</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- MAIN ARTICLE & SIDEBAR LAYOUT -->
  <section class="py-5 bg-light">
    <div class="container">
      <div class="row g-4 g-xl-5">
        
        <!-- LEFT: MAIN ARTICLE CONTENT -->
        <div class="col-lg-8">
          <article class="tm-blog-detail-article p-3 p-md-4 p-lg-5 mb-4">
            
            <!-- Featured Image -->
            <div class="rounded-4 overflow-hidden mb-4 border shadow-xs bg-navy">
              <img src="{{ $blog->thumbnail_url }}" alt="{{ $blog->title }}" class="tm-blog-detail-hero-img">
            </div>

            <!-- Lead Excerpt -->
            <p class="lead fw-semibold text-navy mb-4" style="font-size: 1.075rem; line-height: 1.7;">
              {{ $blog->excerpt }}
            </p>

            <hr class="border-light-subtle my-4">

            <!-- Body Content -->
            <div class="tm-blog-content">
              {!! $blog->body !!}
            </div>

            <!-- Tags Cloud -->
            @if (!empty($blog->tags))
              <div class="pt-4 mt-4 border-top">
                <div class="d-flex flex-wrap align-items-center gap-1">
                  <span class="fw-bold text-navy small me-2"><i class="bi bi-tags-fill text-orange me-1"></i> Topics:</span>
                  @foreach ($blog->tags as $tag)
                    <a href="{{ route('blog.index', ['q' => $tag]) }}" class="tm-blog-tag-pill">
                      #{{ $tag }}
                    </a>
                  @endforeach
                </div>
              </div>
            @endif

            <!-- Social Share Row -->
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 pt-3 mt-3 border-top bg-light p-3 rounded-3">
              <span class="small fw-bold text-navy"><i class="bi bi-share-fill text-orange me-1"></i> Share This Guide:</span>
              <div class="d-flex gap-2">
                <a href="https://api.whatsapp.com/send?text={{ $share_text }}" target="_blank" rel="noopener" class="btn btn-sm btn-success rounded-pill px-3" title="Share on WhatsApp">
                  <i class="bi bi-whatsapp me-1"></i> WhatsApp
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($share_url) }}" target="_blank" rel="noopener" class="btn btn-sm btn-primary rounded-pill px-3" title="Share on Facebook">
                  <i class="bi bi-facebook me-1"></i> Share
                </a>
                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode($share_url) }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-navy rounded-pill px-3" title="Share on LinkedIn">
                  <i class="bi bi-linkedin me-1"></i> LinkedIn
                </a>
                <button type="button" class="btn btn-sm btn-light border rounded-pill px-3" onclick="navigator.clipboard.writeText('{{ js_str($share_url) }}'); alert('Link copied to clipboard!');" title="Copy Link">
                  <i class="bi bi-link-45deg"></i>
                </button>
              </div>
            </div>

            <!-- Doctor Author Bio Card -->
            <div class="tm-blog-author-card mt-4">
              <div class="d-flex flex-column flex-sm-row align-items-sm-center gap-3">
                <div class="rounded-circle bg-orange text-white d-flex align-items-center justify-content-center fs-3 fw-bold flex-shrink-0" style="width: 64px; height: 64px;">
                  <i class="bi bi-person-badge"></i>
                </div>
                <div class="flex-grow-1">
                  <div class="d-flex align-items-center gap-2 mb-1">
                    <h5 class="fw-bold text-navy mb-0">{{ $blog->admin?->name ?? SITE_SHORT }}</h5>
                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill small px-2">Verified Audiologist</span>
                  </div>
                  <div class="text-orange small fw-semibold mb-2">Clinical Audiologist &bull; Turtle Maarks Hearing Health</div>
                  <p class="small text-secondary mb-0">Specializing in digital hearing aid fitting, Real-Ear Measurement (REM), Pure Tone Audiometry, and personalized hearing rehabilitation in Greater Noida West & Noida.</p>
                </div>
                <div class="text-sm-end">
                  <a href="{{ route('appointments.create') }}" class="tm-btn tm-btn-primary btn-sm text-nowrap">
                    Consult Doctor
                  </a>
                </div>
              </div>
            </div>

            <!-- Previous & Next Article Navigation -->
            <div class="row g-3 pt-4 mt-3 border-top">
              <div class="col-sm-6">
                @if ($prevBlog)
                  <a href="{{ route('blog.show', $prevBlog->slug) }}" class="card p-3 rounded-3 border bg-white h-100 text-decoration-none shadow-xs text-start">
                    <span class="small text-muted mb-1"><i class="bi bi-arrow-left me-1"></i> Previous Article</span>
                    <strong class="text-navy small line-clamp-2">{{ $prevBlog->title }}</strong>
                  </a>
                @endif
              </div>
              <div class="col-sm-6 text-sm-end">
                @if ($nextBlog)
                  <a href="{{ route('blog.show', $nextBlog->slug) }}" class="card p-3 rounded-3 border bg-white h-100 text-decoration-none shadow-xs text-sm-end">
                    <span class="small text-muted mb-1">Next Article <i class="bi bi-arrow-right ms-1"></i></span>
                    <strong class="text-navy small line-clamp-2">{{ $nextBlog->title }}</strong>
                  </a>
                @endif
              </div>
            </div>

          </article>

          <!-- RELATED ARTICLES SECTION -->
          @if ($related->isNotEmpty())
            <div class="mb-4">
              <div class="d-flex align-items-center justify-content-between mb-3">
                <h4 class="fw-bold text-navy mb-0">Related Guides &amp; Insights</h4>
                <a href="{{ route('blog.index') }}" class="small text-orange fw-bold">View All Articles &rarr;</a>
              </div>
              <div class="row g-3">
                @foreach ($related as $rel)
                  <div class="col-md-6">
                    <article class="tm-blog-card shadow-xs h-100">
                      <div class="tm-blog-img-wrap" style="height: 160px;">
                        <img src="{{ $rel->thumbnail_url }}" alt="{{ $rel->title }}" loading="lazy">
                        <span class="tm-blog-badge">{{ $rel->blogCategory?->name ?? 'Hearing Health' }}</span>
                        <span class="tm-blog-read-time"><i class="bi bi-clock me-1"></i> {{ max(1, (int) ceil(str_word_count(strip_tags($rel->body)) / 200)) }} min read</span>
                      </div>
                      <div class="tm-blog-body p-3">
                        <div class="tm-blog-meta mb-2">
                          <span class="tm-blog-meta-item"><i class="bi bi-calendar3 text-orange"></i> {{ optional($rel->published_at ?? $rel->created_at)->format('d M Y') }}</span>
                        </div>
                        <h6 class="tm-blog-title mb-2">
                          <a href="{{ route('blog.show', $rel->slug) }}" class="stretched-link">{{ $rel->title }}</a>
                        </h6>
                        <p class="tm-blog-desc small mb-0">
                          {{ Str::limit(strip_tags($rel->excerpt ?: $rel->body), 110) }}
                        </p>
                      </div>
                    </article>
                  </div>
                @endforeach
              </div>
            </div>
          @endif

        </div>

        <!-- RIGHT: STICKY SIDEBAR -->
        <div class="col-lg-4">
          <aside class="tm-blog-sidebar">
            
            <!-- WIDGET 1: ALL BLOG CATEGORIES (REQUESTED BY USER) -->
            <div class="tm-sidebar-widget">
              <h5 class="tm-sidebar-widget-title">
                <i class="bi bi-folder2-open text-orange"></i>
                <span>Blog Categories</span>
              </h5>
              
              <ul class="tm-sidebar-cat-list">
                <!-- All Categories Link -->
                <li class="tm-sidebar-cat-item">
                  <a href="{{ route('blog.index') }}">
                    <span class="d-flex align-items-center gap-2">
                      <i class="bi bi-grid-fill text-muted"></i>
                      <span>All Articles</span>
                    </span>
                    <span class="tm-sidebar-cat-count">{{ $totalBlogs }}</span>
                  </a>
                </li>
                <!-- Category Items -->
                @foreach ($categories as $catItem)
                  @php $isCurrent = ($catItem['id'] === $blog->blog_category_id); @endphp
                  <li class="tm-sidebar-cat-item {{ $isCurrent ? 'active' : '' }}">
                    <a href="{{ route('blog.index', ['category' => $catItem['slug']]) }}">
                      <span class="d-flex align-items-center gap-2">
                        <i class="bi {{ $catItem['icon'] }} {{ $isCurrent ? 'text-orange' : 'text-muted' }}"></i>
                        <span>{{ $catItem['name'] }}</span>
                      </span>
                      <span class="tm-sidebar-cat-count">{{ $catItem['count'] }}</span>
                    </a>
                  </li>
                @endforeach
              </ul>
            </div>

            <!-- WIDGET 2: RECENT ARTICLES -->
            <div class="tm-sidebar-widget">
              <h5 class="tm-sidebar-widget-title">
                <i class="bi bi-clock-history text-orange"></i>
                <span>Recent Insights</span>
              </h5>
              
              <div class="d-flex flex-column">
                @foreach ($recentPosts as $recent)
                  <a href="{{ route('blog.show', $recent->slug) }}" class="tm-sidebar-recent-item">
                    <img src="{{ $recent->thumbnail_url }}" alt="{{ $recent->title }}" class="tm-sidebar-recent-thumb">
                    <div>
                      <div class="tm-sidebar-recent-title">{{ $recent->title }}</div>
                      <div class="tm-sidebar-recent-date">
                        <i class="bi bi-calendar3 me-1"></i> {{ optional($recent->published_at ?? $recent->created_at)->format('d M Y') }} &bull; {{ max(1, (int) ceil(str_word_count(strip_tags($recent->body)) / 200)) }} min read
                      </div>
                    </div>
                  </a>
                @endforeach
              </div>
            </div>

            <!-- WIDGET 3: AWESOME VISIT OUR CLINIC CARD -->
            <div class="tm-clinic-card-awesome">
              
             

              <!-- Card Body Content -->
              <div class="tm-clinic-card-body">
                
                <div class="d-flex align-items-center justify-content-between mb-2">
                  <h5 class="fw-bold text-navy mb-0">Visit Our Clinic</h5>
                </div>

                <div class="fw-bold text-navy small mb-3">
                  Turtle Maarks Hearing Health <i class="bi bi-patch-check-fill text-orange"></i>
                </div>

                <!-- Address Row -->
                <div class="tm-clinic-info-row">
                  <div class="tm-clinic-icon-box">
                    <i class="bi bi-geo-alt-fill"></i>
                  </div>
                  <div class="small">
                    <strong class="text-navy d-block mb-1">{{ $siteName ?? site_name() }} Clinic</strong>
                    <span class="text-secondary lh-sm d-block">{{ $siteAddress ?? site_address() }}</span>
                  </div>
                </div>

                <!-- Call to Actions -->
                <div class="d-grid gap-2">
                  <a href="https://maps.google.com/?q={{ urlencode($siteAddress ?? site_address()) }}" target="_blank" rel="noopener" class="tm-btn tm-btn-primary btn-sm justify-content-center">
                    <i class="bi bi-pin-map-fill me-1"></i> Get Directions on Google Maps
                  </a>
                  <div class="d-flex gap-2">
                    <a href="tel:{{ $sitePhoneRaw ?? site_phone_raw() }}" class="tm-btn tm-btn-outline-navy btn-sm flex-fill justify-content-center">
                      <i class="bi bi-telephone-fill me-1"></i> Call Clinic
                    </a>
                    <a href="https://wa.me/{{ $siteWhatsApp ?? site_whatsapp() }}?text={{ urlencode('Hello Doctor, I would like to visit the ' . ($siteName ?? site_name()) . ' clinic.') }}" target="_blank" rel="noopener" class="btn btn-sm btn-success rounded-3 flex-fill justify-content-center d-flex align-items-center gap-1">
                      <i class="bi bi-whatsapp"></i> WhatsApp
                    </a>
                  </div>
                </div>

              </div>
            </div>

          </aside>
        </div>

      </div>
    </div>
  </section>
@endsection
