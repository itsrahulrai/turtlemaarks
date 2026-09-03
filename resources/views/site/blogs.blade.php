@extends('site.layouts.app')

@section('title', 'Hearing Health Blogs & Audiology Guides — Turtle Maarks')
@section('meta_description', 'Expert audiology articles, hearing aid buying guides, diagnostic testing walkthroughs, and ear care advice from certified audiologists in Noida Extension.')
@section('active_nav', 'blogs')

@section('content')
@php
    /** Build a blogs URL that keeps the active filters. */
    $blogUrl = function (array $overrides = []) {
        $params = array_filter(array_merge([
            'category' => request('category'),
            'q'        => request('q'),
            'sort'     => request('sort'),
        ], $overrides), fn ($v) => $v !== null && $v !== '' && $v !== 'All' && $v !== 'newest');
        return route('blog.index', $params);
    };
    $selected_category = request('category', 'All') ?: 'All';
    $search_query      = request('q', '');
    $sort_order        = request('sort', 'newest') ?: 'newest';
@endphp
<!-- HERO BANNER -->
  <section class="tm-page-hero text-center position-relative">
    <div class="container">
      <nav aria-label="breadcrumb" class="d-inline-flex mb-2">
        <div class="tm-breadcrumb-pill">
          <a href="{{ route('home') }}"><i class="bi bi-house-door"></i> Home</a>
          <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
          <span class="tm-breadcrumb-current" aria-current="page">Health Blogs</span>
        </div>
      </nav>
      <h1 class="display-6 fw-bold text-white mb-2 font-heading">Hearing Health &amp; Audiology Blogs</h1>
      <p class="text-white-50 mx-auto small mb-0" style="max-width: 680px;">
        Evidence-based guides, hearing aid buying comparisons, clinical diagnostics insights, and practical ear care advice from certified audiologists.
      </p>
    </div>
  </section>

  <!-- MAIN BLOG CONTENT & PAGINATION -->
  <section class="pb-5 bg-light">
    <div class="container">
      
      <!-- ELEVATED MODERN FILTER & SEARCH CARD -->
      <div class="tm-blog-filter-card">
        
        <!-- Top Toolbar: Search & Sort -->
        <div class="row g-3 align-items-center justify-content-between mb-3">
          
          <div class="col-lg-5 col-md-6">
            <!-- Modern Search Box -->
            <form action="{{ route('blog.index') }}" method="GET" class="tm-blog-search-wrap">
              @if ($selected_category !== 'All')
                <input type="hidden" name="category" value="{{ $selected_category }}">
              @endif
              @if ($sort_order !== 'newest')
                <input type="hidden" name="sort" value="{{ $sort_order }}">
              @endif
              <i class="bi bi-search tm-blog-search-icon"></i>
              <input type="text" name="q" class="form-control tm-blog-search-input" placeholder="Search guides, tests, hearing aids..." value="{{ $search_query }}">
              @if (!empty($search_query))
                @php $clear_q_url = $blogUrl(['q' => null]); @endphp
                <a href="{{ $clear_q_url }}" class="tm-blog-search-clear" title="Clear Search">
                  <i class="bi bi-x-circle-fill"></i>
                </a>
              @endif
            </form>
          </div>

          <div class="col-lg-7 col-md-6">
            <div class="d-flex align-items-center justify-content-md-end gap-3 flex-wrap">
              <!-- Quick Sort Dropdown -->
              <div class="d-flex align-items-center gap-2">
                <label for="blogSortSelect" class="small text-muted fw-bold text-nowrap"><i class="bi bi-sort-down text-orange me-1"></i> Sort:</label>
                <select id="blogSortSelect" class="form-select form-select-sm rounded-3 border-light-subtle shadow-xs text-navy" style="width: auto; min-width: 160px;" onchange="window.location.href=this.value">
                                    <option value="{{ $blogUrl(['sort' => null]) }}" {{ $sort_order === 'newest' ? 'selected' : '' }}>Latest Articles</option>
                  <option value="{{ $blogUrl(['sort' => 'oldest']) }}" {{ $sort_order === 'oldest' ? 'selected' : '' }}>Oldest Articles</option>
                  <option value="{{ $blogUrl(['sort' => 'popular']) }}" {{ $sort_order === 'popular' ? 'selected' : '' }}>Most Read</option>
                </select>
              </div>

              <!-- Quick Reset Link (if active filters exist) -->
              @if ($selected_category !== 'All' || !empty($search_query) || $sort_order !== 'newest')
                <a href="{{ route('blog.index') }}" class="btn btn-sm btn-outline-danger rounded-pill px-3 py-1 text-nowrap d-inline-flex align-items-center gap-1">
                  <i class="bi bi-arrow-counterclockwise"></i> Reset Filters
                </a>
              @endif
            </div>
          </div>

        </div>

        <!-- Category Filter Pills Bar -->
        <div class="pt-2">
          <div class="tm-filter-scroll">
            @foreach ($categories as $cat)
              @php
                $isActive = ($selected_category === $cat['name']);
                $icon     = $category_icons[$cat['name']] ?? 'bi-tag-fill';
                $count    = $cat['count'];
                $cat_url  = $blogUrl(['category' => $cat['name'] === 'All' ? null : $cat['slug']]);
              @endphp
              <a href="{{ $cat_url }}" class="tm-filter-pill-btn {{ $isActive ? 'active' : '' }}">
                <i class="bi {{ $icon }}"></i>
                <span>{{ $cat['name'] }}</span>
                <span class="tm-filter-count">{{ $count }}</span>
              </a>
            @endforeach
          </div>
        </div>

        <!-- Active Filter Indicator Tags (if filtered) -->
        @if ($selected_category !== 'All' || !empty($search_query))
          <div class="tm-active-chips-strip">
            <span class="small text-muted fw-bold">Active filters:</span>
            @if ($selected_category !== 'All')
              @php $remove_cat_url = $blogUrl(['category' => null]); @endphp
              <span class="tm-active-chip">
                <span>Category: <strong>{{ $selected_category }}</strong></span>
                <a href="{{ $remove_cat_url }}" title="Remove Category Filter"><i class="bi bi-x-circle-fill"></i></a>
              </span>
            @endif

            @if (!empty($search_query))
              @php $remove_q_url = $blogUrl(['q' => null]); @endphp
              <span class="tm-active-chip">
                <span>Search: &ldquo;<strong>{{ $search_query }}</strong>&rdquo;</span>
                <a href="{{ $remove_q_url }}" title="Remove Search Query"><i class="bi bi-x-circle-fill"></i></a>
              </span>
            @endif
          </div>
        @endif

      </div>

      <!-- Results Count Bar -->
      <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="small text-secondary">
          Showing <strong>{{ $blogs->total() ? $blogs->firstItem() : 0 }} &ndash; {{ $blogs->lastItem() ?? 0 }}</strong> of <strong>{{ $blogs->total() }}</strong> articles
          @if ($selected_category !== 'All')
            in <span class="badge bg-navy text-white rounded-pill ms-1">{{ $selected_category }}</span>
          @endif
          @if (!empty($search_query))
            matching &ldquo;<em>{{ $search_query }}</em>&rdquo;
          @endif
        </div>
        <div class="small text-muted d-none d-sm-block">
          Page <strong>{{ $blogs->currentPage() }}</strong> of <strong>{{ $blogs->lastPage() }}</strong>
        </div>
      </div>

      <!-- Blog Cards Grid (3 Columns on Large Screens) -->
      @if ($blogs->isEmpty())
        <div class="text-center py-5 bg-white rounded-4 border shadow-xs">
          <div class="rounded-circle bg-light p-3 d-inline-flex mb-3">
            <i class="bi bi-search text-orange fs-2"></i>
          </div>
          <h5 class="fw-bold text-navy mb-2">No Articles Found</h5>
          <p class="text-muted small mb-3">No blogs matched your search or selected filter category.</p>
          <a href="{{ route('blog.index') }}" class="tm-btn tm-btn-primary btn-sm">Clear All Filters</a>
        </div>
      @else
        <div class="row g-4 row-cols-1 row-cols-md-2 row-cols-lg-3 mb-5">
          @foreach ($blogs as $blog)
            <div class="col">
              <article class="tm-blog-card shadow-xs">
                <div class="tm-blog-img-wrap">
                  <img src="{{ $blog->thumbnail_url }}" alt="{{ $blog->title }}" loading="lazy">
                  <span class="tm-blog-badge">{{ $blog->blogCategory?->name ?? 'Hearing Health' }}</span>
                  <span class="tm-blog-read-time"><i class="bi bi-clock me-1"></i> {{ max(1, (int) ceil(str_word_count(strip_tags($blog->body)) / 200)) }} min read</span>
                </div>
                <div class="tm-blog-body">
                  <div class="tm-blog-meta">
                    <span class="tm-blog-meta-item"><i class="bi bi-calendar3 text-orange"></i> {{ optional($blog->published_at ?? $blog->created_at)->format('d M Y') }}</span>
                    <span class="tm-blog-meta-item text-secondary">•</span>
                    <span class="tm-blog-meta-item"><i class="bi bi-patch-check-fill text-success"></i> {{ $blog->admin?->name ?? SITE_SHORT }}</span>
                  </div>
                  <h3 class="tm-blog-title">
                    <a href="{{ route('blog.show', $blog->slug) }}" class="stretched-link">{{ $blog->title }}</a>
                  </h3>
                  <p class="tm-blog-desc">
                    {{ Str::limit(strip_tags($blog->excerpt ?: $blog->body), 140) }}
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
          @endforeach
        </div>
      @endif

      <!-- PAGINATION CONTROLS -->
      <div class="d-flex justify-content-center mb-5">
        {{ $blogs->links() }}
      </div>

      <!-- Bottom Interactive Help & Consultation Banner -->
      <div class="card rounded-3 border bg-white shadow-sm p-4 text-center text-md-start" style="border-color: #FED7AA !important;">
        <div class="row align-items-center g-3">
          <div class="col-md-8">
            <div class="d-flex align-items-center gap-2 mb-1 justify-content-center justify-content-md-start">
              <span class="rounded-circle bg-orange-subtle text-orange p-2 d-inline-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                <i class="bi bi-chat-dots-fill"></i>
              </span>
              <h5 class="fw-bold text-navy mb-0">Need Personalized Guidance for Your Hearing Health?</h5>
            </div>
            <p class="text-secondary small mb-0 ps-md-5">
              Connect directly with an RCI-certified audiologist. We provide free hearing consultations, audiogram reviews, and 7-day trials with zero obligations.
            </p>
          </div>
          <div class="col-md-4 text-md-end d-flex gap-2 justify-content-center justify-content-md-end flex-wrap">
            <a href="https://wa.me/{{ SITE_WHATSAPP }}" target="_blank" rel="noopener" class="tm-btn tm-btn-success btn-sm">
              <i class="bi bi-whatsapp me-1"></i> WhatsApp Doctor
            </a>
            <a href="{{ route('appointments.create') }}" class="tm-btn tm-btn-primary btn-sm">
              <i class="bi bi-calendar2-check me-1"></i> Book Free Trial
            </a>
          </div>
        </div>
      </div>

    </div>
  </section>
@endsection
