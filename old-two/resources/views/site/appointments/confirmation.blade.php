@extends('site.layouts.layout')
@section('title', 'Appointment Confirmation - Turtle Maarks Hearing Health')
@section('content')

<div class="breadcrumb-area" style="background-image: url('{{ asset('frontend-assets/images/breadcrumb.png') }}');">
    <div class="container">
        <div class="row justify-content-center">
            <nav aria-label="breadcrumb">
                <h2 class="page-title">Appointment Requested</h2>
                <ol class="breadcrumb text-center">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Confirmation</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="gallery-area padding-top-115 padding-bottom-110">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <i class="icofont-check-circled text-success" style="font-size:64px;"></i>
                <h3 class="mt-3">Thank you, {{ $appointment->name }}!</h3>
                <p class="text-muted">Your appointment request has been received. Our team will confirm your slot shortly.</p>

                <div class="border rounded-3 p-4 text-start mt-4">
                    <p><strong>Reference:</strong> {{ $appointment->appointment_number }}</p>
                    <p><strong>Service:</strong> {{ $appointment->service->name }}</p>
                    <p><strong>Date:</strong> {{ $appointment->appointment_date->format('d M Y') }}</p>
                    <p class="mb-0"><strong>Time:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</p>
                </div>

                <a href="{{ route('home') }}" class="btn2 mt-4">Back to Home</a>
            </div>
        </div>
    </div>
</div>

@endsection
