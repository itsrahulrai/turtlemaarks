  <title>Add Categories - Nexa Health Consult - Your Smart Healthcare Consultants</title>
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
                                       {{ session('success') }}
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
                            <h5 class="card-title fw-bold text-dark">Add New Category</h5>
                            <nav aria-label="breadcrumb" class="mb-0">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('dashboard') }}" class="text-primary fw-semibold">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('categories.index') }}" class="text-primary fw-semibold">Categories</a>
                                    </li>
                                    <li class="breadcrumb-item active text-muted" aria-current="page">
                                        Add New
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    <!-- Form Card -->
                    <div class="card rounded shadow-sm border-0">
                        <div class="card-header" style="background-color:#1276B7; color:#fff;">
                            <h5 class="mb-0">{{ isset($category) ? 'Edit Category' : 'Add New Category' }}</h5>
                        </div>
                        <div class="card-body">
                            @if (isset($category))
                                <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                            @else
                                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                            @endif
                                @csrf

                                <div class="row g-4">
                                    <!-- Category Name -->
                                    <div class="col-md-6">
                                        <label for="name" class="form-label fw-semibold">Category Name <span class="text-danger">*</span></label>
                                        <input type="text" id="name" name="name" class="form-control form-control-lg"
                                            value="{{ old('name', $category->name ?? '') }}" placeholder="Enter category name" required>
                                    </div>

                                    <!-- Slug -->
                                    <div class="col-md-6">
                                        <label for="slug" class="form-label fw-semibold">Slug <small class="text-muted">(auto/manual)</small></label>
                                        <input type="text" id="slug" name="slug" class="form-control form-control-lg"
                                            value="{{ old('slug', $category->slug ?? '') }}" placeholder="e.g. digital-marketing">
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold d-block">Status</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status_active" value="1"
                                                {{ old('status', $category->status ?? 1) == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status_active">Active</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status_inactive" value="0"
                                                {{ old('status', $category->status ?? 1) == 0 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status_inactive">Inactive</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end mt-4">
                                    <button type="submit" class="btn btn-lg" style="background-color:#1276B7;; color:#fff;">
                                        {{ isset($category) ? 'Update' : 'Submit' }}
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

<!-- Slug Auto Generate -->
<script>
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');

    nameInput.addEventListener('input', function() {
        if (!slugInput.dataset.manual) {
            slugInput.value = slugify(this.value);
        }
    });

    slugInput.addEventListener('input', function() {
        slugInput.dataset.manual = true;
    });

    function slugify(text) {
        return text.toString().toLowerCase().trim()
            .replace(/\s+/g, '-')       // spaces to dash
            .replace(/[^\w\-]+/g, '')   // remove non-word chars
            .replace(/\-\-+/g, '-');    // multiple dashes
    }
</script>

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
