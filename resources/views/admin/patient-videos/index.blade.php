@extends('layouts.admin')

@section('title', 'Patient Story Videos')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Transforming Lives Through Clear Sound</h4>
            <p class="text-muted mb-0">Manage the YouTube patient story videos shown on the homepage.</p>
        </div>

        <a href="{{ route('admin.patient-videos.create') }}" class="btn btn-admin-primary text-white">
            <i class="bi bi-plus-circle me-2"></i>Add Video
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
                            <th>Thumbnail</th>
                            <th>Title</th>
                            <th>Badge</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th width="150">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($videos as $video)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}"
                                     width="120" height="70" class="rounded-3 border" style="object-fit:cover;">
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $video->title }}</div>
                                <div class="text-muted small">{{ $video->topic_label }} &middot; {{ $video->youtube_id }}</div>
                            </td>
                            <td><span class="badge bg-light text-dark border fw-semibold" style="color: #111 !important;">{{ $video->badge }}</span></td>
                            <td>{{ $video->sort_order }}</td>
                            <td>
                                @if($video->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.patient-videos.edit', $video) }}" class="btn btn-sm btn-warning">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('admin.patient-videos.destroy', $video) }}" method="POST"
                                          onsubmit="return confirm('Remove this video?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <h6>No videos yet</h6>
                                <p class="text-muted mb-0">Add your first patient story video to power this homepage section.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $videos->links() }}

        </div>
    </div>

</div>

@endsection
