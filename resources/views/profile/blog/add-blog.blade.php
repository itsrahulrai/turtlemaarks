 <title>Add Blogs -  Nexa Health Consult - Your Smart Healthcare Consultants</title>
<x-app-layout>
    <div class="py-0">
        <div class="container-fluid">
            <div class="row min-vh-100">

                <!-- Sidebar -->
                @include('admin-sidebar')

                <!-- Main content -->
                <main class="col-12 col-md-9 col-lg-10 bg-white p-4">

                    @if (session('success'))
                        <div class="position-fixed top-0 end-0 p-3" style="z-index: 1080">
                            <div class="toast align-items-center text-white" style="background-color:#000;" role="alert">
                                <div class="d-flex">
                                    <div class="toast-body">
                                         {{ session('success') }}
                                    </div>
                                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Breadcrumb -->
                    <div class="card border rounded mb-3">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Add New Blog</h5>
                            <nav aria-label="breadcrumb" class="mb-0">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-primary fw-semibold">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.blogs.index') }}" class="text-primary fw-semibold">Blogs</a></li>
                                    <li class="breadcrumb-item active text-muted" aria-current="page">Add New</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    <!-- Blog Form -->
                    <div class="card rounded mt-3 border" style="border-color:#000;">
                        <div class="card-header" style="background-color:#1276B7; color:#fff;">
                            <h5 class="mb-0">{{ isset($blog) ? 'Edit Blog' : 'Add New Blog' }}</h5>
                        </div>
                        <div class="card-body">
                            @if (isset($blog))
                                <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                            @else
                                <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                            @endif
                            @csrf

                            <div class="row g-4">
                                <!-- Blog Title -->
                                <div class="col-md-6">
                                    <label for="title" class="form-label">Blog Title <span class="text-danger">*</span></label>
                                    <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $blog->title ?? '') }}" placeholder="Enter blog title" required>
                                </div>

                                <!-- Slug -->
                                <div class="col-md-6">
                                    <label for="slug" class="form-label">Slug <small class="text-muted">(auto/manual)</small></label>
                                    <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug', $blog->slug ?? '') }}" placeholder="e.g. empowering-customer-success">
                                </div>

                                <!-- Category -->
                                <div class="col-md-6">
                                    <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                                    <select id="category_id" name="category_id" class="form-select" required>
                                        <option value="">-- Select Category --</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ old('category_id', $blog->category_id ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Blog Image -->
                                <div class="col-md-6">
                                    <label for="image" class="form-label">Blog Image</label>
                                    <input type="file" id="image" name="image" class="form-control">
                                    <div class="form-text">Upload featured image (e.g., 1200x600px).</div>
                                    @if (isset($blog) && $blog->image)
                                        <div class="mt-2">
                                            <img src="{{ static_asset($blog->image) }}" alt="Blog Image" class="img-thumbnail" width="120">
                                        </div>
                                    @endif
                                </div>

                                <!-- Blog Content -->
                                <div class="col-12">
                                    <label for="content" class="form-label">Blog Content <span class="text-danger">*</span></label>
                                    <textarea id="summernote" name="content" class="form-control" rows="10">{{ old('content', $blog->content ?? '') }}</textarea>
                                </div>

                                <!-- Short Content -->
                                <div class="col-12">
                                    <label for="short_content" class="form-label">Short Content</label>
                                    <textarea id="short_content" name="short_content" class="form-control" rows="2">{{ old('short_content', $blog->short_content ?? '') }}</textarea>
                                </div>

                                <!-- Tags -->
                                <div class="col-md-6">
                                    <label for="tags" class="form-label">Tags <small class="text-muted">(comma separated)</small></label>
                                    <input type="text" id="tags" name="tags" class="form-control" value="{{ old('tags', isset($blog->tags) ? implode(',', json_decode($blog->tags)) : '') }}" placeholder="e.g., Education, Startup">
                                </div>

                                <!-- Meta Title -->
                                <div class="col-md-6">
                                    <label for="meta_title" class="form-label">Meta Title</label>
                                    <input type="text" id="meta_title" name="meta_title" class="form-control" value="{{ old('meta_title', $blog->meta_title ?? '') }}" placeholder="SEO meta title">
                                </div>

                                <!-- Meta Description -->
                                <div class="col-12">
                                    <label for="meta_description" class="form-label">Meta Description</label>
                                    <textarea id="meta_description" name="meta_description" class="form-control" rows="2" placeholder="SEO description...">{{ old('meta_description', $blog->meta_description ?? '') }}</textarea>
                                </div>

                                <!-- Meta Keywords -->
                                <div class="col-md-6">
                                    <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                    <input type="text" id="meta_keywords" name="meta_keywords" class="form-control" value="{{ old('meta_keywords', $blog->meta_keywords ?? '') }}" placeholder="e.g., education, startup, learning">
                                </div>

                                <!-- Canonical URL -->
                                <div class="col-md-6">
                                    <label for="canonical_url" class="form-label">Canonical URL</label>
                                    <input type="url" id="canonical_url" name="canonical_url" class="form-control" value="{{ old('canonical_url', $blog->canonical_url ?? '') }}" placeholder="https://example.com/blog/blog-title">
                                </div>

                                <!-- Robots -->
                                <div class="col-md-6">
                                    <label for="robots" class="form-label">Robots</label>
                                    <select id="robots" name="robots" class="form-select">
                                        @php
                                            $robotsOptions = ['index, follow', 'noindex, follow', 'index, nofollow', 'noindex, nofollow'];
                                        @endphp
                                        @foreach($robotsOptions as $option)
                                            <option value="{{ $option }}" {{ old('robots', $blog->robots ?? 'index, follow') == $option ? 'selected' : '' }}>{{ $option }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Status -->
                                <div class="col-md-6">
                                    <label class="form-label d-block">Status</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="status_active" value="1" {{ old('status', $blog->status ?? 1) == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status_active">Active</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="status_inactive" value="0" {{ old('status', $blog->status ?? 1) == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status_inactive">Inactive</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="text-end mt-4">
                                <button type="submit" class="btn" style="background-color:#1276B7;; color:#fff;">{{ isset($blog) ? 'Update' : 'Submit' }}</button>
                            </div>
                            </form>
                        </div>
                    </div>

                </main>
            </div>
        </div>
    </div>

    <!-- Optional: slug auto-generation -->
    <script>
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');

        titleInput.addEventListener('input', function() {
            if (!slugInput.dataset.manual) {
                slugInput.value = this.value.toLowerCase().trim().replace(/\s+/g, '-').replace(/[^\w\-]+/g, '').replace(/\-\-+/g, '-');
            }
        });

        slugInput.addEventListener('input', function() {
            slugInput.dataset.manual = true;
        });
    </script>
</x-app-layout>
