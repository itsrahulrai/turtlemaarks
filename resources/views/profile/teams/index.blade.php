<title>Teams -  Nexa Health Consult - Your Smart Healthcare Consultants</title>
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
                            <h5 class="card-title fw-bold" style="color:#314E52;">Teams</h5>
                            <nav aria-label="breadcrumb" class="mb-0">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('dashboard') }}" class="fw-semibold" style="color:#314E52;">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.teams.create') }}" class="fw-semibold" style="color:#000;">Add Team Member</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    <!-- Teams Table -->
                    <div class="card rounded mt-3">
                        <div class="card-header d-flex justify-content-between" style="background-color:#d4a017; color:white;">
                            <h5 class="mb-0">All Team Members</h5>
                            <a href="{{ route('admin.teams.create') }}" class="btn btn-sm" style="background-color:#000; color:white;">+ Add New</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead style="background-color:#AF905F; color:white;">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($teams as $key => $team)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $team->name }}</td>
                                            <td>{{ $team->designation ?? '-' }}</td>
                                            <td>
                                                @if($team->image)
                                                    <img src="{{ static_asset($team->image) }}" alt="{{ $team->name }}" style="max-width:80px; border-radius:6px;">
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if($team->status == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.teams.edit', $team->id) }}" class="btn btn-sm" style="background-color:#000; color:white;">Edit</a>

                                                <form action="{{ route('admin.teams.destroy', $team->id) }}" method="POST" style="display:inline-block;">
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
                                            <td colspan="6" class="text-center text-muted">No team members found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <!-- Custom Pagination -->
                            <div class="mt-3">
                                {{ $teams->links('pagination.custom') }}
                            </div>
                        </div>
                    </div>

                </main>
            </div>
        </div>
    </div>
</x-app-layout>
