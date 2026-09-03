@extends('layouts.admin')

@section('title', 'Services')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Service Management</h4>
            <p class="text-muted mb-0">Hearing tests, fittings, repairs and other bookable services</p>
        </div>
        <a href="{{ route('admin.services.create') }}" class="btn btn-admin-primary text-white">
            <i class="bi bi-plus-circle me-2"></i>Add Service
        </a>
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
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Duration</th>
                            <th>Status</th>
                            <th width="150">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($services as $service)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ $service->image_url }}" width="60" height="40" class="rounded-3 border" style="object-fit:cover;"></td>
                            <td>{{ $service->name }}</td>
                            <td>₹{{ number_format($service->price, 2) }}</td>
                            <td>{{ $service->duration_minutes }} min</td>
                            <td>
                                @if($service->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Delete this service?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <h6>No Services Found</h6>
                                <p class="text-muted mb-0">Add your first bookable service.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $services->links() }}
        </div>
    </div>
</div>
@endsection
