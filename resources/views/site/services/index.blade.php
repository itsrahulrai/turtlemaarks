@extends('site.layouts.layout')
@section('title', 'Our Services - Turtle Maarks Hearing Health')
@section('description', 'Hearing tests, fittings, repairs and other bookable services from Turtle Maarks Hearing Health.')
@section('content')

<!-- breadcrumb area -->
<div class="breadcrumb-area" style="background-image: url('{{ asset('frontend-assets/images/breadcrumb.png') }}');">
    <div class="container">
        <div class="row justify-content-center">
            <nav aria-label="breadcrumb">
                <h2 class="page-title">Our Services</h2>
                <ol class="breadcrumb text-center">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Services</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="gallery-area padding-top-115 padding-bottom-110">
    <div class="container">
        <div class="row justify-content-center margin-bottom-45">
            <div class="col-lg-6">
                <div class="common-title text-center">
                    <h2>Services We <span>Offer</span></h2>
                    <p class="margin-top-20">Book a hearing test, fitting, repair or consultation with our audiologists.</p>
                </div>
            </div>
        </div>

        <div class="row g-4">
            @forelse($services as $service)
            <div class="col-lg-4 col-md-6">
                <div class="border rounded-3 h-100 p-3 text-center">
                    <img src="{{ $service->image_url }}" class="img-fluid rounded mb-3" style="height:180px;object-fit:cover;width:100%;" alt="{{ $service->name }}">
                    <h5 class="mb-2">{{ $service->name }}</h5>
                    <p class="text-muted small">{{ $service->short_description }}</p>
                    <div class="fw-bold mb-3">₹{{ number_format($service->price, 2) }} &middot; {{ $service->duration_minutes }} min</div>
                    <div class="d-flex gap-2 justify-content-center">
                        <a href="{{ route('services.show', $service->slug) }}" class="btn2">View Details</a>
                        <a href="{{ route('appointments.create', ['service' => $service->id]) }}" class="btn2">Book Now</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <h6>No services available right now</h6>
                <p class="text-muted">Please check back soon, or contact us directly.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $services->links() }}
        </div>
    </div>
</div>

@endsection
