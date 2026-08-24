@extends('frontend.layouts.layout')
@section('title', 'Products - Turtle Maarks Hearing Health')
@section('description', 'Hearing Aid supplier of all leading brands. Please connect for premium care and services.')
@section('keywords', 'Hearing Aid supplier of all leading brands. Please connect for premium care and services.')
@section('content')

  

<!-- breadcrumb area -->
<div class="breadcrumb-area" style="background-image: url('{{ asset('assets/images/breadcrumb.png') }}');">
    <div class="container">
        <div class="row justify-content-center">
            <nav aria-label="breadcrumb">
                <h2 class="page-title">Products
                </h2>
                <ol class="breadcrumb text-center">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Products</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- gallery area -->
<div class="gallery-area padding-top-115 padding-bottom-110">
    <div class="gallery-shapes">
        <img src="{{ asset('assets/images/gallery-vec.png') }}" alt="" class="vec1 item-zooming">
    </div>
    <div class="container">
        <div class="row justify-content-center margin-bottom-45">
            <div class="col-lg-6">
                <div class="common-title text-center">
                    <h2>Hearing Aids <span>Available</span></h2>
                    <p class="margin-top-20">
                        We offer a diverse range of hearing aids to suit individual needs, preferences, and lifestyles.
                    </p>
                </div>
            </div>
        </div>
        <div class="gallery-wrapper">
            <div class="row port-galleries gx-3 gy-4">
                <div class="col-lg-2 col-md-4 col-6 mb-2">
                    <div class="bg-danger rounded p-2 h-100">
                        <div class="single-gallery">
                            <img class="img-fluid rounded" src="{{ asset('assets/images/hearing-aid/bte.webp') }}" alt="">
                        </div>
                        <h6 class="text-center text-white">BTE Hearing Aid</h6>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 mb-2">
                    <div class="bg-danger rounded p-2 h-100">
                        <div class="single-gallery">
                            <img class="img-fluid rounded" src="{{ asset('assets/images/hearing-aid/ric.webp') }}" alt="">
                        </div>
                        <h6 class="text-center text-white">RIC Hearing Aid</h6>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 mb-2">
                    <div class="bg-danger rounded p-2 h-100">
                        <div class="single-gallery">
                            <img class="img-fluid rounded" src="{{ asset('assets/images/hearing-aid/cic.webp') }}" alt="">
                        </div>
                        <h6 class="text-center text-white">CIC Hearing Aid</h6>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 mb-2">
                    <div class="bg-danger rounded p-2 h-100">
                        <div class="single-gallery">
                            <img class="img-fluid rounded" src="{{ asset('assets/images/hearing-aid/itc.webp') }}" alt="">
                        </div>
                        <h6 class="text-center text-white">ITC Hearing Aid</h6>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 mb-2">
                    <div class="bg-danger rounded p-2 h-100">
                        <div class="single-gallery">
                            <img class="img-fluid rounded" src="{{ asset('assets/images/hearing-aid/ite.webp') }}" alt="">
                        </div>
                        <h6 class="text-center text-white">ITE Hearing Aid</h6>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 mb-2">
                    <div class="bg-danger rounded p-2 h-100">
                        <div class="single-gallery">
                            <img class="img-fluid rounded" src="{{ asset('assets/images/hearing-aid/iic.webp') }}" alt="">
                        </div>
                        <h6 class="text-center text-white">IIC Hearing Aid</h6>
                    </div>
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
                <img src="{{ asset('assets/images/subs-vec.png') }}" alt="" class="vec1">
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
