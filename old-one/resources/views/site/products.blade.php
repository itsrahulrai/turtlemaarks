@extends('site.layouts.app')

@section('title', 'Products — Turtle Maarks Hearing Health')
@section('meta_description', 'Explore 50+ world-class digital hearing solutions from Phonak, Oticon, ReSound, Signia, Starkey, Widex with official warranty and lifetime expert care in Noida Extension.')
@section('active_nav', 'products')

@section('content')
@php
    $tmStyleLabels = [
        'RIC' => 'Receiver-In-Canal (RIC)',
        'BTE' => 'Behind-The-Ear (BTE)',
        'CIC' => 'Completely-In-Canal (CIC)',
        'IIC' => '100% Invisible (IIC)',
        'ITC' => 'In-The-Canal (ITC)',
        'ITE' => 'In-The-Ear (ITE)',
        'Accessory' => 'Chargers & Care Kits',
    ];
@endphp
<!-- HERO BANNER -->
  <section class="tm-page-hero text-center position-relative">
    <div class="container">
      <nav aria-label="breadcrumb" class="d-inline-flex mb-2">
        <div class="tm-breadcrumb-pill">
          <a href="{{ route('home') }}"><i class="bi bi-house-door"></i> Home</a>
          <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
          <span class="tm-breadcrumb-current" aria-current="page">Products</span>
        </div>
      </nav>
      <h1 class="display-6 fw-bold text-white mb-2 font-heading">Products</h1>
      <p class="text-white-50 mx-auto small mb-0" style="max-width: 650px;">Explore 50+ world-class digital hearing solutions with official brand warranty, precision clinical fitting, and lifetime expert care.</p>
    </div>
  </section>

  <!-- CATALOG & FILTER WRAPPER -->
  <section class="py-4 bg-light">
    <div class="container">
      <div class="row g-4">
        
        <!-- Filter Sidebar — slides in as an offcanvas below lg, sticky column above -->
        <div class="col-lg-3 tm-filter-sidebar-col">
          <div class="offcanvas-lg offcanvas-start" tabindex="-1" id="tmFilterPanel" aria-labelledby="tmFilterPanelLabel">
            <div class="offcanvas-header border-bottom">
              <h6 class="offcanvas-title fw-bold text-navy mb-0" id="tmFilterPanelLabel">Filter Hearing Aids</h6>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#tmFilterPanel" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body p-3 p-lg-0">
              <div class="card rounded-4 border p-4 bg-white shadow-xs tm-filter-sticky-card w-100">
            <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
              <h6 class="fw-bold text-navy mb-0"><i class="bi bi-funnel text-orange me-1"></i> Filter By</h6>
              <button class="btn btn-sm btn-link text-orange p-0 small" id="tmClearFiltersBtn">Reset All</button>
            </div>

            <!-- 1. Category Filter -->
            <div class="mb-4">
              <label class="form-label small fw-bold text-navy text-uppercase tracking-wider d-flex justify-content-between align-items-center mb-2">
                <span><i class="bi bi-grid-fill text-orange me-1"></i> Category</span>
              </label>
              <div class="d-flex flex-column gap-2 small">
                @php
                  $reqCategories = (array) request('category', []);
                @endphp
                @forelse ($categories as $cat)
                <div class="form-check d-flex align-items-center justify-content-between">
                  <div>
                    <input class="form-check-input filter-category-checkbox" type="checkbox" value="{{ $cat->slug }}" id="cat-{{ $cat->slug }}"
                           @checked(in_array($cat->slug, $reqCategories, true))>
                    <label class="form-check-label" for="cat-{{ $cat->slug }}">{{ $cat->name }}</label>
                  </div>
                  <span class="badge bg-light text-muted border rounded-pill">{{ $categoryCounts[$cat->slug] ?? ($cat->products_count ?? 0) }}</span>
                </div>
                @empty
                  <div class="text-muted small py-1">No categories available yet.</div>
                @endforelse
              </div>
            </div>

            <!-- 2. Subcategory Filter -->
            <div class="mb-4">
              <label class="form-label small fw-bold text-navy text-uppercase tracking-wider d-flex justify-content-between align-items-center mb-2">
                <span><i class="bi bi-diagram-3-fill text-orange me-1"></i> Subcategory</span>
              </label>
              <div class="d-flex flex-column gap-2 small">
                @php
                  $reqSubcategories = (array) request('subcategory', []);
                @endphp
                @forelse ($subcategories as $sub)
                <div class="form-check d-flex align-items-center justify-content-between">
                  <div>
                    <input class="form-check-input filter-subcategory-checkbox" type="checkbox" value="{{ $sub->slug }}" id="sub-{{ $sub->slug }}"
                           @checked(in_array($sub->slug, $reqSubcategories, true))>
                    <label class="form-check-label" for="sub-{{ $sub->slug }}">{{ $sub->name }}</label>
                  </div>
                  <span class="badge bg-light text-muted border rounded-pill">{{ $subcategoryCounts[$sub->slug] ?? ($sub->products_count ?? 0) }}</span>
                </div>
                @empty
                  <div class="text-muted small py-1 fst-italic">
                    <i class="bi bi-info-circle me-1"></i> No subcategories added yet
                  </div>
                @endforelse
              </div>
            </div>

            <!-- 3. Form Factor (Style) Filter -->
            <div class="mb-4">
              <label class="form-label small fw-bold text-navy text-uppercase tracking-wider d-flex justify-content-between align-items-center mb-2">
                <span><i class="bi bi-soundwave text-orange me-1"></i> Form Factor</span>
              </label>
              <div class="d-flex flex-column gap-2 small">
                @php
                  $reqStyles = (array) request('style', []);
                @endphp
                @forelse ($styles as $st)
                <div class="form-check d-flex align-items-center justify-content-between">
                  <div>
                    <input class="form-check-input filter-style-checkbox" type="checkbox" value="{{ $st['style'] }}" id="style-{{ Str::slug($st['style']) }}"
                           @checked(in_array($st['style'], $reqStyles, true))>
                    <label class="form-check-label" for="style-{{ Str::slug($st['style']) }}">{{ $tmStyleLabels[$st['style']] ?? $st['style'] }}</label>
                  </div>
                  <span class="badge bg-light text-muted border rounded-pill">{{ $st['count'] }}</span>
                </div>
                @empty
                <span class="text-muted small">No form factors published yet.</span>
                @endforelse
              </div>
            </div>

            <!-- 4. Manufacturer Brands Filter -->
            <div class="mb-4">
              <label class="form-label small fw-bold text-navy text-uppercase tracking-wider mb-2">
                <i class="bi bi-patch-check-fill text-orange me-1"></i> Brand
              </label>
              <div class="d-flex flex-column gap-2 small">
                @php
                  $reqBrands = (array) request('brand', []);
                @endphp
                @forelse ($catalogueBrands as $br)
                <div class="form-check d-flex align-items-center justify-content-between">
                  <div>
                    <input class="form-check-input filter-brand-checkbox" type="checkbox" value="{{ $br['name'] }}" id="brand-{{ Str::slug($br['name']) }}"
                           @checked(in_array($br['name'], $reqBrands, true) || in_array($br['slug'] ?? '', $reqBrands, true) || in_array(Str::slug($br['name']), $reqBrands, true))>
                    <label class="form-check-label" for="brand-{{ Str::slug($br['name']) }}">
                      {{ $br['name'] }} @if(!empty($br['origin']))<span class="text-muted">({{ $br['origin'] }})</span>@endif
                    </label>
                  </div>
                  <span class="badge bg-light text-muted border rounded-pill">{{ $br['count'] }}</span>
                </div>
                @empty
                <span class="text-muted small">No brands published yet.</span>
                @endforelse
              </div>
            </div>

            <!-- Price Slider -->
            <div class="mb-3">
              <label class="form-label small fw-bold text-navy text-uppercase tracking-wider">Max Price Range</label>
              <input type="range" class="form-range" min="{{ $priceBounds['min'] }}" max="{{ $priceBounds['max'] }}" step="1000" id="tmPriceRangeInput" value="{{ request('max_price', $priceBounds['max']) }}">
              <div class="d-flex justify-content-between small text-muted">
                <span>{{ inr($priceBounds['min']) }}</span>
                <span class="fw-bold text-navy" id="tmPriceRangeDisplay">{{ inr(request('max_price', $priceBounds['max'])) }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

        <!-- Products Grid (Right) -->
        <div class="col-lg-9">
          <!-- Filter Controls Bar -->
          <div class="card rounded-3 border p-3 bg-white mb-3 shadow-xs d-flex flex-column flex-sm-row gap-2 justify-content-between align-items-sm-center tm-filter-controls-bar">
            <div class="d-flex align-items-center gap-2">
              <button class="tm-btn tm-btn-outline-navy btn-sm d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#tmFilterPanel" aria-controls="tmFilterPanel">
                <i class="bi bi-funnel"></i> Filters
              </button>
              <span class="small text-muted fw-bold" id="tmProductsMatchCount">
                Showing <strong>{{ $total ? $from : 0 }} &ndash; {{ $to }}</strong> of <strong>{{ $total }}</strong> models (Page <strong>{{ $currentPage }}</strong> of <strong>{{ $lastPage }}</strong>)
              </span>
            </div>
            <div class="d-flex align-items-center gap-2">
              <span class="small text-muted d-none d-sm-inline">Sort:</span>
              <select class="form-select form-select-sm" id="tmSortSelect" style="width: 170px;">
                <option value="featured" @selected(request('sort') === 'featured' || !request('sort'))>Featured First</option>
                <option value="price-low" @selected(request('sort') === 'price-low')>Price: Low to High</option>
                <option value="price-high" @selected(request('sort') === 'price-high')>Price: High to Low</option>
                <option value="rating" @selected(request('sort') === 'rating')>Highest Rated</option>
              </select>
            </div>
          </div>

          <!-- Dynamic Products Grid -->
          <div class="row g-3" id="tmProductsGrid">
            @include('site.partials.product-grid', ['products' => $products, 'col' => 'col-xl-4 col-lg-4 col-md-6'])
          </div>

          <!-- PAGINATION CONTROLS (DESIGNED SAME LIKE BLOGS PAGE) -->
          <div id="tmProductsPaginationWrap">
            @if ($lastPage > 1)
              <nav aria-label="Product pagination" class="d-flex justify-content-center mt-4 mb-4">
                <ul class="tm-pagination shadow-xs rounded-3 p-1 bg-white border">

                  <li class="page-item {{ $currentPage <= 1 ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ tm_page_url($currentPage - 1) }}" aria-label="Previous">
                      <i class="bi bi-chevron-left"></i>
                    </a>
                  </li>

                  @for ($pg = 1; $pg <= $lastPage; $pg++)
                    <li class="page-item {{ $pg === $currentPage ? 'active' : '' }}">
                      <a class="page-link" href="{{ tm_page_url($pg) }}">{{ $pg }}</a>
                    </li>
                  @endfor

                  <li class="page-item {{ $currentPage >= $lastPage ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ tm_page_url($currentPage + 1) }}" aria-label="Next">
                      <i class="bi bi-chevron-right"></i>
                    </a>
                  </li>

                </ul>
              </nav>
            @endif
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection

@push('scripts')
<script src="{{ tm_asset('js/filter.js') }}"></script>
@endpush
