@extends('site.layouts.layout')
@section('title', 'Gallery - Turtle Maarks Hearing Health')
@section('description', 'Hearing Aid supplier of all leading brands. Please connect for premium care and services.')
@section('keywords', 'Hearing Aid supplier of all leading brands. Please connect for premium care and services.')
@section('content')

<!-- breadcrumb area -->
<div class="breadcrumb-area" style="background-image: url('{{ asset('frontend-assets/images/breadcrumb.png') }}');">
    <div class="container">
        <div class="row justify-content-center">
            <nav aria-label="breadcrumb">
                <h2 class="page-title">Gallery 
                </h2>
                <ol class="breadcrumb text-center">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Gallery</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- gallery area -->
<div class="gallery-area padding-top-115 padding-bottom-110">
    <div class="gallery-shapes">
        <img src="{{ asset('frontend-assets/images/gallery-vec.png') }}" alt="" class="vec1 item-zooming">
    </div>
    <div class="container">
        <div class="row justify-content-center margin-bottom-45">
            <div class="col-lg-6">
                <div class="common-title text-center">
                    <h2>our <span>gallery</span></h2>
                    <p class="margin-top-20">
                        Our gallery captures the essence of the support and solutions we provide every day.
                    </p>
                </div>
            </div>
        </div>
        <div class="gallery-wrapper">
            <div class="row port-galleries">
                <div class="col-lg-4 col-md-4 col-12">
                    <a href="{{ asset('frontend-assets/images/gallery/01.webp') }}" target="_blank">
                        <div class="single-gallery">
                            <img src="{{ asset('frontend-assets/images/gallery/01.webp') }}" class="img-fluid rounded" alt="">
                            <span><i class="far fa-image"></i></span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-8 col-md-8 col-12"> <a href="{{ asset('frontend-assets/images/gallery/02.webp') }}" target="_blank">
                        <div class="single-gallery">
                            <img src="{{ asset('frontend-assets/images/gallery/02.webp') }}" class="img-fluid rounded" alt="">
                            <span><i class="far fa-image"></i></span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <a href="{{ asset('frontend-assets/images/gallery/03.webp') }}" target="_blank">
                        <div class="single-gallery">
                            <img class="img-fluid" src="{{ asset('frontend-assets/images/gallery/03.webp') }}" alt=""> <span><i
                                    class="far fa-image"></i></span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 col-12"> <a href="{{ asset('frontend-assets/images/gallery/04.webp') }}" target="_blank">
                        <div class="single-gallery">
                            <img class="img-fluid" src="{{ asset('frontend-assets/images/gallery/04.webp') }}" alt="">
                            <span><i class="far fa-image"></i></span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 col-12"><a href="{{ asset('frontend-assets/images/gallery/05.webp') }}" target="_blank">
                        <div class="single-gallery">
                            <img class="img-fluid" src="{{ asset('frontend-assets/images/gallery/05.webp') }}" alt=""> <span><i
                                    class="far fa-image"></i></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- subs area -->
<div class="subs-area">
    <div class="container">
        <div class="row subs-wrapper">
            <div class="subs-shape">
                <img src="{{ asset('frontend-assets/images/subs-vec.png') }}" alt="" class="vec1">
            </div>
            <div class="col-lg-12">
                <div class="row align-items-center">
                    <div class="col-lg-5 col-xl-6 col-12">
                        <div class="subs-content">
                            <h2>subscribe to our newsletter</h2>
                        </div>
                    </div>
                    <div class="col-lg-7 col-xl-6 col-12">
                        <div class="subs-form">
                            <form action="#">
                                <input type="email" placeholder="Enter your email address">
                                <button type="submit">subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection     
