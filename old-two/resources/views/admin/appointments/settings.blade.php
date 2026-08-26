@extends('layouts.admin')

@section('title', 'Appointment Settings')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Working Hours &amp; Blocked Dates</h4>
            <p class="text-muted mb-0">Control when customers can book appointments</p>
        </div>
        <a href="{{ route('admin.appointments.index') }}" class="btn btn-light border rounded-3">
            <i class="bi bi-arrow-left me-1"></i> Back to Appointments
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <h6 class="fw-semibold mb-4">Weekly Working Hours</h6>

            <form method="POST" action="{{ route('admin.appointments.settings.update') }}">
                @csrf
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Day</th>
                                <th>Working?</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Slot Length (min)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($settings as $setting)
                            <tr>
                                <td>{{ $setting->day_name }}</td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input"
                                               name="days[{{ $setting->day_of_week }}][is_working_day]" value="1"
                                               {{ $setting->is_working_day ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td>
                                    <input type="time" class="form-control rounded-3"
                                           name="days[{{ $setting->day_of_week }}][start_time]"
                                           value="{{ \Carbon\Carbon::parse($setting->start_time)->format('H:i') }}">
                                </td>
                                <td>
                                    <input type="time" class="form-control rounded-3"
                                           name="days[{{ $setting->day_of_week }}][end_time]"
                                           value="{{ \Carbon\Carbon::parse($setting->end_time)->format('H:i') }}">
                                </td>
                                <td>
                                    <input type="number" min="5" max="240" class="form-control rounded-3"
                                           name="days[{{ $setting->day_of_week }}][slot_duration_minutes]"
                                           value="{{ $setting->slot_duration_minutes }}">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <button type="submit" class="btn btn-dark rounded-3 px-4 mt-2">Save Working Hours</button>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <h6 class="fw-semibold mb-4">Block a Date / Slot</h6>

            <form method="POST" action="{{ route('admin.appointments.blocks.store') }}" class="row g-2 align-items-end mb-4">
                @csrf
                <div class="col-md-2">
                    <label class="form-label small">Date</label>
                    <input type="date" name="date" class="form-control rounded-3" required min="{{ now()->toDateString() }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label small">Full Day?</label>
                    <div class="form-check form-switch mt-2">
                        <input type="checkbox" class="form-check-input" name="full_day" value="1" id="fullDay" checked>
                        <label class="form-check-label small" for="fullDay">Yes</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <label class="form-label small">Start Time</label>
                    <input type="time" name="start_time" class="form-control rounded-3">
                </div>
                <div class="col-md-2">
                    <label class="form-label small">End Time</label>
                    <input type="time" name="end_time" class="form-control rounded-3">
                </div>
                <div class="col-md-3">
                    <label class="form-label small">Reason</label>
                    <input type="text" name="reason" class="form-control rounded-3" placeholder="Holiday, leave, etc.">
                </div>
                <div class="col-md-1">
                    <button class="btn btn-admin-primary text-white w-100" type="submit"><i class="bi bi-plus"></i></button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table align-middle table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Time Range</th>
                            <th>Reason</th>
                            <th width="80">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($blocks as $block)
                        <tr>
                            <td>{{ $block->date->format('d M Y') }}</td>
                            <td>{{ $block->full_day ? 'Full day' : 'Partial' }}</td>
                            <td>{{ $block->full_day ? '—' : \Carbon\Carbon::parse($block->start_time)->format('h:i A') . ' - ' . \Carbon\Carbon::parse($block->end_time)->format('h:i A') }}</td>
                            <td>{{ $block->reason ?? '—' }}</td>
                            <td>
                                <form action="{{ route('admin.appointments.blocks.destroy', $block->id) }}" method="POST" onsubmit="return confirm('Remove this block?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center py-4 text-muted">No blocked dates.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $blocks->links() }}
        </div>
    </div>
</div>
@endsection
