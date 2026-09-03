@extends('site.layouts.app')

@section('title', 'Saved Wishlist — ' . SITE_NAME)
@section('meta_description', 'View your saved hearing aids and accessories on Turtle Maarks.')
@section('active_nav', 'products')

@section('content')

  <!-- HERO BANNER -->
  <section class="tm-page-hero text-center position-relative">
    <div class="container">
      <nav aria-label="breadcrumb" class="d-inline-flex mb-2">
        <div class="tm-breadcrumb-pill">
          <a href="{{ route('home') }}"><i class="bi bi-house-door"></i> Home</a>
          <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
          <span class="tm-breadcrumb-current" aria-current="page">Saved Wishlist</span>
        </div>
      </nav>
      <h1 class="display-6 fw-bold text-white mb-2 font-heading">My Saved Wishlist</h1>
      <p class="text-white-50 mx-auto small mb-0" style="max-width: 580px;">Your bookmarked hearing aids and diagnostic clinical services.</p>
    </div>
  </section>

  <!-- WISHLIST GRID -->
  <section class="py-5 bg-light">
    <div class="container">
      @if ($products)
      <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-2 pb-2 border-bottom" id="tmWishlistHeader">
        <div>
          <h4 class="fw-bold text-navy mb-0" id="tmWishlistCountHeading">{{ count($products) }} Saved {{ Str::plural('Product', count($products)) }}</h4>
          <span class="text-muted small">Manage your saved hearing aids and clinical accessories</span>
        </div>
        <form method="POST" action="{{ route('wishlist.clear') }}">
          @csrf
          @method('DELETE')
          <button type="submit" class="tm-btn tm-btn-outline-danger tm-btn-sm">
            <i class="bi bi-trash3 me-1"></i> Clear Wishlist
          </button>
        </form>
      </div>
      @endif

      <div class="row g-3" id="tmWishlistGrid">
        @forelse ($products as $p)
          @include('site.partials.product-card', ['p' => $p, 'col' => 'col-xl-3 col-lg-4 col-md-6', 'isWishlistPage' => true])
        @empty
          <div class="col-12 text-center py-5">
            <i class="bi bi-heart text-muted d-block mb-3" style="font-size: 3.5rem;"></i>
            <h5 class="fw-bold text-navy mb-1">Your wishlist is empty</h5>
            <p class="text-secondary small mb-3">
              @guest
                Sign in to save hearing aids you like and pick up where you left off.
              @else
                Tap the heart icon on any hearing aid to save it here for later.
              @endguest
            </p>
            @guest
              <a href="{{ route('login') }}" class="tm-btn tm-btn-primary mt-1">Sign In</a>
            @endguest
            <a href="{{ route('products') }}" class="tm-btn tm-btn-outline-navy mt-1">Explore Products</a>
          </div>
        @endforelse
      </div>
    </div>
  </section>
@endsection
