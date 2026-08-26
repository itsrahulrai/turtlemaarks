@extends('layouts.admin')

@section('title', 'Appointment ' . $appointment->appointment_number)

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Appointment {{ $appointment->appointment_number }}</h4>
            <p class="text-muted mb-0">Requested on {{ $appointment->created_at->format('d M Y, h:i A') }}</p>
        </div>
        <a href="{{ route('admin.appointments.index') }}" class="btn btn-light border rounded-3">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h6 class="fw-semibold mb-3">Appointment Details</h6>
                    <table class="table table-borderless mb-0">
                        <tr><th width="180">Status</th><td>{!! $appointment->status_badge !!}</td></tr>
                        <tr><th>Service</th><td>{{ $appointment->service->name }} (₹{{ number_format($appointment->service->price, 2) }})</td></tr>
                        <tr><th>Customer</th><td>{{ $appointment->name }}</td></tr>
                        <tr><th>Phone</th><td>{{ $appointment->phone }}</td></tr>
                        <tr><th>Email</th><td>{{ $appointment->email ?? '—' }}</td></tr>
                        <tr><th>Date</th><td>{{ $appointment->appointment_date->format('d M Y') }}</td></tr>
                        <tr><th>Time</th><td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td></tr>
                        <tr><th>Notes</th><td>{{ $appointment->notes ?? '—' }}</td></tr>
                        <tr><th>Account</th><td>{{ $appointment->user->name ?? 'Guest booking' }}</td></tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h6 class="fw-semibold mb-3">Update Status</h6>

                    <form method="POST" action="{{ route('admin.appointments.status', $appointment->id) }}" id="statusForm">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label class="form-label small fw-medium">Status</label>
                            <select name="status" id="statusSelect" class="form-select rounded-3">
                                @foreach(['pending','confirmed','rejected','rescheduled','cancelled','completed'] as $status)
                                    <option value="{{ $status }}" {{ $appointment->status === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="rescheduleFields" style="display:none;">
                            <div class="mb-3">
                                <label class="form-label small fw-medium">New Date</label>
                                <input type="date" name="appointment_date" class="form-control rounded-3"
                                       min="{{ now()->toDateString() }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-medium">New Time</label>
                                <input type="time" name="appointment_time" class="form-control rounded-3">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-medium">Admin Notes</label>
                            <textarea name="admin_notes" rows="3" class="form-control rounded-3">{{ $appointment->admin_notes }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-dark w-100 rounded-3 py-2">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const statusSelect = document.getElementById('statusSelect');
const rescheduleFields = document.getElementById('rescheduleFields');

function toggleReschedule() {
    rescheduleFields.style.display = statusSelect.value === 'rescheduled' ? 'block' : 'none';
}
statusSelect.addEventListener('change', toggleReschedule);
toggleReschedule();
</script>
@endpush
