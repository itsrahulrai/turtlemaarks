<title>{{ isset($gallery) ? 'Edit Gallery' : 'Add Gallery' }} - Nexa Health Consult - Your Smart Healthcare Consultants</title>
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
                            <div id="successToast" class="toast align-items-center text-white bg-success border-0 show"
                                role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="d-flex">
                                    <div class="toast-body">
                                        ✅ {{ session('success') }}
                                    </div>
                                    <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                        data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Breadcrumb -->
                    <div class="card border-0 rounded mb-3 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-dark">
                                {{ isset($gallery) ? 'Edit Gallery' : 'Add New Gallery' }}
                            </h5>
                            <nav aria-label="breadcrumb" class="mb-0">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('dashboard') }}" class="text-primary fw-semibold">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.gallery.index') }}" class="text-primary fw-semibold">Gallery</a>
                                    </li>
                                    <li class="breadcrumb-item active text-muted" aria-current="page">
                                        {{ isset($gallery) ? 'Edit' : 'Add New' }}
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    <!-- Form Card -->
                    <div class="card rounded shadow-sm border-0">
                        <div class="card-header" style="background-color:#d4a017; color:#fff;">
                            <h5 class="mb-0">{{ isset($gallery) ? 'Edit Gallery' : 'Add New Gallery' }}</h5>
                        </div>
                        <div class="card-body">
                            @if (isset($gallery))
                                <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                            @else
                                <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                            @endif
                                @csrf

                                <div class="row g-4">
                                    <!-- Gallery Title -->
                                    <!-- <div class="col-md-6">
                                        <label for="title" class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                                        <input type="text" id="title" name="title" class="form-control form-control-lg"
                                            value="{{ old('title', $gallery->title ?? '') }}" placeholder="Enter gallery title" required>
                                    </div> -->

                                    <!-- File Upload -->
                                    <div class="col-md-6">
                                        <label for="image" class="form-label fw-semibold">Image <span class="text-danger">*</span></label>
                                        <input type="file" id="image" name="image" class="form-control form-control-lg"
                                            {{ isset($gallery) ? '' : 'required' }}>
                                        @if(isset($gallery) && $gallery->image)
                                            <div class="mt-2">
                                                <img src="{{ static_asset($gallery->image) }}" alt="Gallery Image" 
                                                     class="img-thumbnail" style="max-width: 150px;">
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="text-end mt-4">
                                    <button type="submit" class="btn btn-lg" style="background-color:#d4a017; color:#fff;">
                                        {{ isset($gallery) ? 'Update' : 'Submit' }}
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
    body {
        font-family: 'Rubik', sans-serif;
    }
    .form-control:focus {
        border-color: #B58B5D;
        box-shadow: 0 0 0 0.2rem rgba(181, 139, 93, 0.25);
    }
    .form-label {
        color: #314E52;
    }
    .card {
        border-radius: 12px;
    }
    .breadcrumb a {
        color: #314E52 !important;
    }
    .breadcrumb-item.active {
        color: #B58B5D !important;
    }
    .btn:hover {
        opacity: 0.9;
    }
</style>
