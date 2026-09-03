@extends('site.layouts.app')

@section('title', 'Rechargeable Hearing Aids Category — Turtle Maarks')
@section('meta_description', 'Explore lithium-ion rechargeable hearing aids with 30-hour battery life and portable fast chargers from Phonak, Oticon, ReSound, Signia, and Widex.')
@section('active_nav', 'products')

@section('content')
<!-- HERO BANNER -->
  <section class="tm-page-hero text-center position-relative">
    <div class="container">
      <nav aria-label="breadcrumb" class="d-inline-flex mb-2">
        <div class="tm-breadcrumb-pill">
          <a href="{{ route('home') }}"><i class="bi bi-house-door"></i> Home</a>
          <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
          <a href="{{ route('products') }}">Products</a>
          <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
          <span class="tm-breadcrumb-current" aria-current="page">Rechargeable</span>
        </div>
      </nav>
      <h1 class="display-6 fw-bold text-white mb-2 font-heading">Rechargeable Hearing Aids</h1>
      <p class="text-white-50 mx-auto small mb-0" style="max-width: 580px;">Never change batteries again. Enjoy 24 to 30 hours of continuous speech clarity per 3-hour charge.</p>
    </div>
  </section>

  <!-- PRODUCTS GRID -->
  <section class="py-5 bg-light">
    <div class="container">
      <div class="row g-4" data-tm-products="rechargeable" data-tm-limit="8">
        @include('site.partials.product-grid', ['products' => $products, 'col' => 'col-xl-3 col-lg-4 col-md-6'])
      </div>
    </div>
  </section>
@endsection
