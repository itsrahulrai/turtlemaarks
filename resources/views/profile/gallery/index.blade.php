<title>Gallery - Nexa Health Consult - Your Smart Healthcare Consultants</title>
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
                            <h5 class="card-title fw-bold" style="color:#314E52;">Gallery</h5>
                            <nav aria-label="breadcrumb" class="mb-0">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('dashboard') }}" class="fw-semibold" style="color:#314E52;">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.gallery.create') }}" class="fw-semibold" style="color:#ee3638;">Add Gallery</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    <div class="card rounded mt-3">
                        <div class="card-header d-flex justify-content-between" style="background-color:#d4a017; color:white;">
                            <h5 class="mb-0">All Galleries</h5>
                            <a href="{{ route('admin.gallery.create') }}" class="btn btn-sm" style="background-color:#000; color:white;">+ Add New</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead style="background-color:#AF905F; color:white;">
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($galleries as $key => $gallery)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                             <td>
                                                <img src="{{ static_asset($gallery->image) }}" alt="{{ $gallery->title }}" style="width:100px; height:auto; object-fit:cover;">
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.gallery.edit', $gallery->id) }}" class="btn btn-sm" style="background-color:#AF905F; color:white;">Edit</a>

                                                <form action="{{ route('admin.gallery.destroy', $gallery->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">No galleries found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <!-- Optional Pagination -->
                            <div class="mt-3">
                                {{-- If you use pagination: $galleries->links('pagination.custom') --}}
                            </div>

                        </div>
                    </div>

                </main>
            </div>
        </div>
    </div>
</x-app-layout>
