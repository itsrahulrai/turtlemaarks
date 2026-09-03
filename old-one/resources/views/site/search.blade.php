@extends('site.layouts.app')

@section('meta_description', 'Search digital hearing aids, diagnostic audiological tests, speech therapy, and hearing aid accessories.')
@section('active_nav', 'products')

@section('content')
<!-- HERO BANNER -->
  <section class="tm-page-hero text-center position-relative">
    <div class="container">
      <nav aria-label="breadcrumb" class="d-inline-flex mb-2">
        <div class="tm-breadcrumb-pill">
          <a href="{{ route('home') }}"><i class="bi bi-house-door"></i> Home</a>
          <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
          <span class="tm-breadcrumb-current" aria-current="page">Search</span>
        </div>
      </nav>
      <h1 class="display-6 fw-bold text-white mb-3 font-heading">Search Catalog &amp; Services</h1>
      <form class="mx-auto" style="max-width: 600px;" method="get" action="{{ route('search') }}">
        <div class="input-group bg-white rounded-pill p-1 shadow-sm">
          <input type="text" name="q" id="tmSearchPageInput" value="{{ $q }}"
                 class="form-control border-0 rounded-pill ps-3 ps-sm-4"
                 placeholder="Search Phonak, Oticon, PTA, BERA, batteries...">
          <button class="tm-btn tm-btn-primary rounded-pill px-3 px-sm-4" type="submit"><i class="bi bi-search"></i><span class="d-none d-sm-inline ms-1">Search</span></button>
        </div>
      </form>
    </div>
  </section>

<!-- RESULTS -->
<section class="py-5 bg-light">
  <div class="container">
    <h2 class="h5 fw-bold text-navy mb-4" id="tmSearchResultsTitle">
      Found {{ count($results) }} Results for &ldquo;{{ $q !== '' ? $q : 'All Products' }}&rdquo;
    </h2>
    <div class="row g-3" id="tmSearchPageResultsGrid">
      @if (!$results)
        <div class="col-12 text-center text-muted py-5">
          <i class="bi bi-search fs-1 mb-2 d-block"></i>
          No matching hearing devices or accessories found. Try searching &ldquo;Phonak&rdquo;, &ldquo;Oticon&rdquo;, &ldquo;RIC&rdquo;, or &ldquo;Invisible&rdquo;.
        </div>
      @else
        @include('site.partials.product-grid', ['products' => $results, 'col' => 'col-xl-3 col-lg-4 col-md-6'])
      @endif
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
  /* Live refinement without a page reload (progressive enhancement — the
     form above still works with JavaScript disabled). */
  (function () {
    const input = document.getElementById('tmSearchPageInput');
    const grid  = document.getElementById('tmSearchPageResultsGrid');
    const title = document.getElementById('tmSearchResultsTitle');
    if (!input || !grid || typeof TurtleProducts === 'undefined') return;

    let timer = null;
    input.addEventListener('input', () => {
      clearTimeout(timer);
      timer = setTimeout(() => {
        const q = input.value.trim();
        const matches = TurtleProducts.filter({ search: q });
        title.textContent = `Found ${matches.length} Results for \u201C${q || 'All Products'}\u201D`;

        if (matches.length === 0) {
          grid.innerHTML = '<div class="col-12 text-center text-muted py-5"><i class="bi bi-search fs-1 mb-2 d-block"></i>No matching hearing devices or accessories found.</div>';
          return;
        }
        grid.innerHTML = matches.map(item =>
          TurtleProducts.renderCard(item, { colClass: 'col-xl-3 col-lg-4 col-md-6' })
        ).join('');
        if (typeof Wishlist !== 'undefined' && Wishlist.updateIcons) Wishlist.updateIcons();
      }, 200);
    });
  })();
</script>
@endpush
