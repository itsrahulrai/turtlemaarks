<title>{{ isset($testimonial) ? 'Edit Testimonial' : 'Add Testimonial' }} - Nexa Health Consult - Your Smart Healthcare Consultants</title>
<x-app-layout>
    <div class="py-0" style="background-color:#f8f9fa;">
        <div class="container-fluid">
            <div class="row min-vh-100">
                @include('admin-sidebar')

                <main class="col-12 col-md-9 col-lg-10 p-4">

                    @if (session('success'))
                        <div class="position-fixed top-0 end-0 p-3" style="z-index:1080">
                            <div class="toast align-items-center text-white bg-success border-0 show" role="alert">
                                <div class="d-flex">
                                    <div class="toast-body">{{ session('success') }}</div>
                                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Breadcrumb -->
                    <div class="card border-0 rounded mb-3 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-dark">{{ isset($testimonial) ? 'Edit Testimonial' : 'Add New Testimonial' }}</h5>
                            <nav aria-label="breadcrumb" class="mb-0">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('dashboard') }}" class="text-primary fw-semibold">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.testimonials.index') }}" class="text-primary fw-semibold">Testimonials</a>
                                    </li>
                                    <li class="breadcrumb-item active text-muted">{{ isset($testimonial) ? 'Edit' : 'Add New' }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    <!-- Form Card -->
                    <div class="card rounded shadow-sm border-0">
                        <div class="card-header" style="background-color:#d4a017; color:#fff;">
                            <h5 class="mb-0">{{ isset($testimonial) ? 'Edit Testimonial' : 'Add New Testimonial' }}</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ isset($testimonial) ? route('admin.testimonials.update', $testimonial->id) : route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if(isset($testimonial)) @method('PUT') @endif

                                <div class="row g-4">
                                    <!-- Name -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control form-control-lg" value="{{ old('name', $testimonial->name ?? '') }}" required>
                                    </div>

                                    <!-- Designation -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Designation</label>
                                        <input type="text" name="designation" class="form-control form-control-lg" value="{{ old('designation', $testimonial->designation ?? '') }}">
                                    </div>

                                    <!-- Image -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Image</label>
                                        <input type="file" name="image" class="form-control form-control-lg">
                                        @if(isset($testimonial) && $testimonial->image)
                                            <div class="mt-2">
                                                <img src="{{ static_asset($testimonial->image) }}" class="img-thumbnail" style="max-width:150px;">
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Text / Content -->
                                    <div class="col-md-12">
                                        <label class="form-label fw-semibold">Testimonial Text <span class="text-danger">*</span></label>
                                        <textarea name="text" class="form-control form-control-lg" rows="4" required>{{ old('text', $testimonial->text ?? '') }}</textarea>
                                    </div>

                                    <!-- Rating -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Rating <span class="text-danger">*</span></label>
                                        <select name="rating" class="form-select form-select-lg" required>
                                            @for($i = 1; $i <= 5; $i++)
                                                <option value="{{ $i }}" {{ (isset($testimonial) && $testimonial->rating == $i) ? 'selected' : '' }}>{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                                            @endfor
                                        </select>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Status</label>
                                        <select name="status" class="form-select form-select-lg">
                                            <option value="1" {{ (isset($testimonial) && $testimonial->status==1) ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ (isset($testimonial) && $testimonial->status==0) ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="text-end mt-4">
                                    <button type="submit" class="btn btn-lg" style="background-color:#d4a017; color:#fff;">
                                        {{ isset($testimonial) ? 'Update' : 'Submit' }}
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
    body { font-family:'Rubik',sans-serif; }
    .form-control:focus { border-color:#B58B5D; box-shadow:0 0 0 0.2rem rgba(181,139,93,0.25); }
    .form-label { color:#314E52; }
    .card { border-radius:12px; }
    .breadcrumb a { color:#314E52 !important; }
    .breadcrumb-item.active { color:#B58B5D !important; }
    .btn:hover { opacity:0.9; }
</style>
