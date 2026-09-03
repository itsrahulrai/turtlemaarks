@extends('site.layouts.app')

@section('title', ($page->meta_title ?: $page->title) . ' — ' . SITE_NAME)
@section('meta_description', $page->meta_description ?: '')

@section('content')
  <section class="tm-page-hero text-center position-relative">
    <div class="container">
      <nav aria-label="breadcrumb" class="d-inline-flex mb-2">
        <div class="tm-breadcrumb-pill">
          <a href="{{ route('home') }}"><i class="bi bi-house-door"></i> Home</a>
          <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
          <span class="tm-breadcrumb-current" aria-current="page">{{ $page->title }}</span>
        </div>
      </nav>
      <h1 class="display-6 fw-bold text-white mb-1 font-heading">{{ $page->title }}</h1>
    </div>
  </section>

  <section class="py-5 bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="card rounded-4 border p-4 p-md-5 bg-white shadow-xs tm-article-content tm-rich-content">
            {!! $page->content !!}
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
