@extends('site.layouts.layout')
@section('title', 'Book an Appointment - Turtle Maarks Hearing Health')
@section('description', 'Book a hearing test, fitting or repair appointment online.')
@section('content')

<!-- breadcrumb area -->
<div class="breadcrumb-area" style="background-image: url('{{ asset('frontend-assets/images/breadcrumb.png') }}');">
    <div class="container">
        <div class="row justify-content-center">
            <nav aria-label="breadcrumb">
                <h2 class="page-title">Book an Appointment</h2>
                <ol class="breadcrumb text-center">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Book Appointment</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="gallery-area padding-top-115 padding-bottom-110">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('appointments.store') }}" method="POST" id="appointment-form">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Service</label>
                        <select name="service_id" class="form-control" required>
                            <option value="">Select a service</option>
                            @foreach($services as $svc)
                                <option value="{{ $svc->id }}" {{ (old('service_id', $prefill['service'] ?? null) == $svc->id) ? 'selected' : '' }}>
                                    {{ $svc->name }} (₹{{ number_format($svc->price, 2) }}, {{ $svc->duration_minutes }} min)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" required
                                   value="{{ old('name', $prefill['name'] ?? '') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" name="phone" class="form-control" required
                                   value="{{ old('phone', $prefill['phone'] ?? '') }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email (optional)</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Preferred Date</label>
                            <input type="date" name="appointment_date" id="appointment-date" class="form-control"
                                   min="{{ now()->toDateString() }}" value="{{ old('appointment_date') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Available Time Slots</label>
                            <select name="appointment_time" id="appointment-time" class="form-control" required>
                                <option value="">Select a date first</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Notes (optional)</label>
                        <textarea name="notes" class="form-control" rows="3">{{ old('notes') }}</textarea>
                    </div>

                    <button type="submit" class="btn2 w-100">Confirm Booking</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const dateInput = document.getElementById('appointment-date');
    const timeSelect = document.getElementById('appointment-time');

    function loadSlots() {
        const date = dateInput.value;
        if (!date) return;

        timeSelect.innerHTML = '<option value="">Loading...</option>';

        fetch(`{{ route('appointments.slots') }}?date=${date}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
            .then(r => r.json())
            .then(data => {
                if (!data.slots || data.slots.length === 0) {
                    timeSelect.innerHTML = '<option value="">No slots available for this date</option>';
                    return;
                }
                timeSelect.innerHTML = '<option value="">Select a time</option>' +
                    data.slots.map(s => `<option value="${s}">${s}</option>`).join('');
            })
            .catch(() => {
                timeSelect.innerHTML = '<option value="">Could not load slots, please try again</option>';
            });
    }

    dateInput.addEventListener('change', loadSlots);
    if (dateInput.value) loadSlots();
});
</script>
@endpush
