<title>Testimonials - Nexa Health Consult - Your Smart Healthcare Consultants</title>
<x-app-layout>
    <div class="py-0">
        <div class="container-fluid">
            <div class="row min-vh-100">
                <!-- Sidebar -->
                @include('admin-sidebar')

                <!-- Main content -->
                <main class="col-12 col-md-9 col-lg-10 bg-white p-4">

                    <!-- Breadcrumb -->
                    <div class="card border rounded">
                        <div class="card-body">
                            <h5 class="card-title fw-bold" style="color:#314E52;">Testimonials</h5>
                            <nav aria-label="breadcrumb" class="mb-0">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('dashboard') }}" class="fw-semibold" style="color:#314E52;">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.testimonials.create') }}" class="fw-semibold" style="color:#000;">Add Testimonial</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    <!-- Testimonials Table -->
                    <div class="card rounded mt-3">
                        <div class="card-header d-flex justify-content-between" style="background-color:#d4a017 ; color:white;">
                            <h5 class="mb-0">All Testimonials</h5>
                            <a href="{{ route('admin.testimonials.create') }}" class="btn btn-sm" style="background-color:#000; color:white;">+ Add New</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead style="background-color:#AF905F; color:white;">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Image</th>
                                        <th>Rating</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($testimonials as $key => $testimonial)
                                   
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $testimonial->name }}</td>
                                            <td>{{ $testimonial->designation ?? '-' }}</td>
                                            <td>
                                                @if($testimonial->image)
                                                    <img src="{{ static_asset($testimonial->image) }}" alt="{{ $testimonial->name }}" style="max-width:80px; border-radius:6px;">
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ $testimonial->rating ?? '-' }}</td>  
                                            <td>
                                                @if($testimonial->status == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="btn btn-sm" style="background-color:#000; color:white;">Edit</a>
                                                <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">No testimonials found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            <div class="mt-3">
                                {{ $testimonials->links('pagination.custom') }}
                            </div>
                        </div>
                    </div>

                </main>
            </div>
        </div>
    </div>
</x-app-layout>
