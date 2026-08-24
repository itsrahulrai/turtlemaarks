<title>{{ isset($team) ? 'Edit Team Member' : 'Add Team Member' }} - Nexa Health Consult - Your Smart Healthcare Consultants</title>
<x-app-layout>
    <div class="py-0" style="background-color:#f8f9fa;">
        <div class="container-fluid">
            <div class="row min-vh-100">

                <!-- Sidebar -->
                @include('admin-sidebar')

                <!-- Main content -->
                <main class="col-12 col-md-9 col-lg-10 p-4">

                    @if (session('success'))
                        <div class="position-fixed top-0 end-0 p-3" style="z-index: 1080">
                            <div class="toast align-items-center text-white bg-success border-0 show" role="alert">
                                <div class="d-flex">
                                    <div class="toast-body">✅ {{ session('success') }}</div>
                                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Breadcrumb -->
                    <div class="card border-0 rounded mb-3 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-dark">
                                {{ isset($team) ? 'Edit Team Member' : 'Add New Team Member' }}
                            </h5>
                            <nav aria-label="breadcrumb" class="mb-0">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('dashboard') }}" class="text-primary fw-semibold">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.teams.index') }}" class="text-primary fw-semibold">Team</a>
                                    </li>
                                    <li class="breadcrumb-item active text-muted" aria-current="page">
                                        {{ isset($team) ? 'Edit' : 'Add New' }}
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    <!-- Form Card -->
                    <div class="card rounded shadow-sm border-0">
                        <div class="card-header" style="background-color:#d4a017; color:#fff;">
                            <h5 class="mb-0">{{ isset($team) ? 'Edit Team Member' : 'Add New Team Member' }}</h5>
                        </div>
                        <div class="card-body">
                            @if (isset($team))
                                <form action="{{ route('admin.teams.update', $team->id) }}" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                            @else
                                <form action="{{ route('admin.teams.store') }}" method="POST" enctype="multipart/form-data">
                            @endif
                                @csrf

                                <div class="row g-4">
                                    <!-- Name -->
                                    <div class="col-md-6">
                                        <label for="name" class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                                        <input type="text" id="name" name="name" class="form-control form-control-lg"
                                               value="{{ old('name', $team->name ?? '') }}" placeholder="Enter full name" required>
                                    </div>

                                    <!-- Designation -->
                                    <div class="col-md-6">
                                        <label for="designation" class="form-label fw-semibold">Designation</label>
                                        <input type="text" id="designation" name="designation" class="form-control form-control-lg"
                                               value="{{ old('designation', $team->designation ?? '') }}" placeholder="Enter designation">
                                    </div>

                                    <!-- Image Upload -->
                                    <div class="col-md-6">
                                        <label for="image" class="form-label fw-semibold">Image</label>
                                        <input type="file" id="image" name="image" class="form-control form-control-lg">
                                        @if(isset($team) && $team->image)
                                            <div class="mt-2">
                                                <img src="{{ static_asset($team->image) }}" alt="Team Image" 
                                                     class="img-thumbnail" style="max-width: 150px;">
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Social Links -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Social Links</label>
                                        <input type="url" name="twitter" class="form-control mb-2" 
                                               placeholder="Twitter URL" value="{{ old('twitter', $team->twitter ?? '') }}">
                                        <input type="url" name="instagram" class="form-control mb-2" 
                                               placeholder="Instagram URL" value="{{ old('instagram', $team->instagram ?? '') }}">
                                        <input type="url" name="pinterest" class="form-control mb-2" 
                                               placeholder="Pinterest URL" value="{{ old('pinterest', $team->pinterest ?? '') }}">
                                        <input type="url" name="facebook" class="form-control" 
                                               placeholder="Facebook URL" value="{{ old('facebook', $team->facebook ?? '') }}">
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-6">
                                        <label for="status" class="form-label fw-semibold">Status</label>
                                        <select name="status" id="status" class="form-select form-select-lg">
                                            <option value="1" {{ (isset($team) && $team->status==1) ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ (isset($team) && $team->status==0) ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="text-end mt-4">
                                    <button type="submit" class="btn btn-lg" style="background-color:#d4a017; color:#fff;">
                                        {{ isset($team) ? 'Update' : 'Submit' }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    body { font-family: 'Rubik', sans-serif; }
    .form-control:focus { border-color: #B58B5D; box-shadow: 0 0 0 0.2rem rgba(181, 139, 93, 0.25); }
    .form-label { color: #314E52; }
    .card { border-radius: 12px; }
    .breadcrumb a { color: #314E52 !important; }
    .breadcrumb-item.active { color: #B58B5D !important; }
    .btn:hover { opacity: 0.9; }
</style>
