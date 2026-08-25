 <title>Blogs - Nexa Health Consult - Your Smart Healthcare Consultants</title>
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
                            <h5 class="card-title fw-bold" style="color:#1276B7;">Blogs</h5>
                            <nav aria-label="breadcrumb" class="mb-0">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('dashboard') }}" class="fw-semibold" style="color:#314E52;">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.blogs.create') }}" class="fw-semibold" style="color:#1C3B7A;">Add Blogs</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    <div class="card rounded mt-3">
                        <div class="card-header d-flex justify-content-between" style="background-color:#1276B7;; color:white;">
                            <h5 class="mb-0">All Blogs</h5>
                            <a href="{{ route('admin.blogs.create') }}" class="btn btn-sm" style="background-color:#000; color:white;">+ Add New</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead style="background-color:#0C6161;; color:white;">
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Keyword</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($blogs as $key => $blog)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $blog->title }}</td>
                                            <td>{{ $blog->category->name ?? '-' }}</td>
                                            <td>{{ $blog->meta_title }}</td>
                                           <td>
                                                @if ($blog->status == 1)
                                                    <span class="badge bg-success">Active</span> <!-- Green -->
                                                @else
                                                    <span class="badge bg-danger">Inactive</span> <!-- Red -->
                                                @endif
                                            </td>
                                          
                                            <td>
                                                <div class="d-flex gap-2"> <!-- Use flexbox with gap -->
                                                    <a href="{{ route('admin.blogs.edit', $blog->id) }}" 
                                                    class="btn btn-sm" 
                                                    style="background-color:#000; color:white;">
                                                    Edit
                                                    </a>

                                                    <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" style="margin:0;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>


                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">No blogs found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <!-- Custom Pagination -->
                            <div class="mt-3">
                                {{ $blogs->links('pagination.custom') }}
                            </div>

                        </div>
                    </div>

                </main>
            </div>
        </div>
    </div>
</x-app-layout>
