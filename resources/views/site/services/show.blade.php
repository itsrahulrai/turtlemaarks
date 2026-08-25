@extends('site.layouts.layout')
@section('title', $service->meta_title ?: ($service->name . ' - Turtle Maarks Hearing Health'))
@section('description', $service->meta_description ?: $service->short_description)
@section('content')

<!-- breadcrumb area -->
<div class="breadcrumb-area" style="background-image: url('{{ asset('frontend-assets/images/breadcrumb.png') }}');">
    <div class="container">
        <div class="row justify-content-center">
            <nav aria-label="breadcrumb">
                <h2 class="page-title">{{ $service->name }}</h2>
                <ol class="breadcrumb text-center">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('services.index') }}">Services</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $service->name }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="gallery-area padding-top-115 padding-bottom-110">
    <div class="container">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row g-5">
            <div class="col-lg-6">
                <img src="{{ $service->image_url }}" class="img-fluid rounded-3" alt="{{ $service->name }}">
            </div>
            <div class="col-lg-6">
                <h2 class="mb-3">{{ $service->name }}</h2>
                <div class="fw-bold fs-4 mb-3">₹{{ number_format($service->price, 2) }} <span class="text-muted fs-6">/ {{ $service->duration_minutes }} min</span></div>
                <div class="mb-4">{!! nl2br(e($service->description ?: $service->short_description)) !!}</div>

                <div class="d-flex gap-2 mb-4">
                    <form action="{{ route('services.add-to-cart', $service->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn2">Add to Cart</button>
                    </form>
                    <a href="{{ route('appointments.create', ['service' => $service->id]) }}" class="btn2">Book an Appointment</a>
                </div>
            </div>
        </div>

        @if($related->count())
        <div class="row justify-content-center margin-top-60 margin-bottom-30">
            <div class="col-lg-6">
                <div class="common-title text-center">
                    <h2>Related <span>Services</span></h2>
                </div>
            </div>
        </div>
        <div class="row g-4">
            @foreach($related as $rs)
            <div class="col-lg-4 col-md-6">
                <div class="border rounded-3 h-100 p-3 text-center">
                    <img src="{{ $rs->image_url }}" class="img-fluid rounded mb-3" style="height:150px;object-fit:cover;width:100%;" alt="{{ $rs->name }}">
                    <h6>{{ $rs->name }}</h6>
                    <div class="fw-bold mb-2">₹{{ number_format($rs->price, 2) }}</div>
                    <a href="{{ route('services.show', $rs->slug) }}" class="btn2">View Details</a>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

@endsection
