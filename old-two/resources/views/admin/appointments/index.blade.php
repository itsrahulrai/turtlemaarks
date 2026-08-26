@extends('layouts.admin')

@section('title', 'Appointments')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Appointments</h4>
            <p class="text-muted mb-0">Manage appointment requests and bookings</p>
        </div>
        <a href="{{ route('admin.appointments.settings') }}" class="btn btn-light border rounded-3">
            <i class="bi bi-clock me-1"></i> Working Hours &amp; Blocked Dates
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4 mb-3">
        <div class="card-body">
            <form method="GET" class="row g-2 align-items-end">
                <div class="col-md-3">
                    <label class="form-label small">Search</label>
                    <input type="text" name="search" class="form-control rounded-3" placeholder="Name, phone, ref no."
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label small">Status</label>
                    <select name="status" class="form-select rounded-3">
                        <option value="">All</option>
                        @foreach(['pending','confirmed','rejected','rescheduled','cancelled','completed'] as $status)
                            <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label small">Date</label>
                    <input type="date" name="date" class="form-control rounded-3" value="{{ request('date') }}">
                </div>
                <div class="col-md-3">
                    <button class="btn btn-admin-primary text-white w-100" type="submit">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table align-middle table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Ref No.</th>
                            <th>Customer</th>
                            <th>Service</th>
                            <th>Date &amp; Time</th>
                            <th>Status</th>
                            <th width="100">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->appointment_number }}</td>
                            <td>{{ $appointment->name }}<br><span class="text-muted small">{{ $appointment->phone }}</span></td>
                            <td>{{ $appointment->service->name }}</td>
                            <td>{{ $appointment->appointment_date->format('d M Y') }} at {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td>
                            <td>{!! $appointment->status_badge !!}</td>
                            <td>
                                <a href="{{ route('admin.appointments.show', $appointment->id) }}" class="btn btn-sm btn-outline-dark">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <h6>No Appointments Found</h6>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $appointments->links() }}
        </div>
    </div>
</div>
@endsection
