 <title>Add Pages -  Nexa Health Consult - Your Smart Healthcare Consultants</title>
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
                                        ✅ {{ session('success') }}
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
                                    <li class="breadcrumb-item"><a href="{{ route('admin.blogs.index') }}" class="text-primary fw-semibold">Pages</a></li>
                                    <li class="breadcrumb-item active text-muted" aria-current="page">Add New</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    <!-- Blog Form -->
                    <div class="card rounded mt-3 border" style="border-color:#000;">
                        <div class="card-header" style="background-color:#1276B7;; color:#fff;">
                            <h5 class="mb-0">{{ isset($page) ? 'Edit Page' : 'Add New Page' }}</h5>
                        </div>

                        <div class="card-body">
                            @if (isset($page))
                                <form action="{{ route('admin.pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                            @else
                                <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data">
                            @endif
                            @csrf

                            <div class="row g-4">
                               <!-- Name -->
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Page Name <span class="text-danger">*</span></label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        value="{{ old('name', $page->name ?? '') }}"
                                        placeholder="Enter page name" required>
                                </div>

                                <!-- Slug -->
                                <div class="col-md-6">
                                    <label for="slug" class="form-label">Slug (auto/manual)</label>
                                    <input type="text" id="slug" name="slug" class="form-control"
                                        value="{{ old('slug', $page->slug ?? '') }}"
                                        placeholder="e.g. privacy-policy">
                                </div>


                                <!-- Image -->
                                <div class="col-md-6">
                                    <label for="image" class="form-label">Page Image</label>
                                    <input type="file" id="image" name="image" class="form-control">

                                    @if(isset($page) && $page->image)
                                        <div class="mt-2">
                                            <img src="{{ static_asset($page->image) }}" alt="{{ $page->alt }}" width="120" class="img-thumbnail">
                                        </div>
                                    @endif
                                </div>

                                <!-- ALT Text -->
                                <div class="col-md-6">
                                    <label class="form-label">Image ALT Text</label>
                                    <input type="text" name="alt" class="form-control"
                                        value="{{ old('alt', $page->alt ?? '') }}">
                                </div>

                                <!-- Content -->
                                <div class="col-12">
                                    <label class="form-label">Content <span class="text-danger">*</span></label>
                                    <textarea id="summernote" name="content" class="form-control" rows="8">
                                        {{ old('content', $page->content ?? '') }}
                                    </textarea>
                                </div>

                                <!-- Meta Title -->
                                <div class="col-md-6">
                                    <label class="form-label">Meta Title</label>
                                    <input type="text" name="meta_title" class="form-control"
                                        value="{{ old('meta_title', $page->meta_title ?? '') }}">
                                </div>

                                <!-- Canonical URL -->
                                <div class="col-md-6">
                                    <label class="form-label">Canonical URL</label>
                                    <input type="text" name="canonical_url" class="form-control"
                                        value="{{ old('canonical_url', $page->canonical_url ?? '') }}">
                                </div>

                                <!-- Meta Description -->
                                <div class="col-12">
                                    <label class="form-label">Meta Description</label>
                                    <textarea name="meta_description" class="form-control" rows="2">
                                        {{ old('meta_description', $page->meta_description ?? '') }}
                                    </textarea>
                                </div>

                                <!-- Meta Keywords -->
                                <div class="col-12">
                                    <label class="form-label">Meta Keywords</label>
                                    <input type="text" name="meta_keywords" class="form-control"
                                        value="{{ old('meta_keywords', $page->meta_keywords ?? '') }}"
                                        placeholder="keyword1, keyword2">
                                </div>

                                <!-- OG Title -->
                                <div class="col-md-6">
                                    <label class="form-label">OG Title</label>
                                    <input type="text" name="og_title" class="form-control"
                                        value="{{ old('og_title', $page->og_title ?? '') }}">
                                </div>

                                <!-- OG Description -->
                                <div class="col-md-6">
                                    <label class="form-label">OG Description</label>
                                    <input type="text" name="og_description" class="form-control"
                                        value="{{ old('og_description', $page->og_description ?? '') }}">
                                </div>

                                <!-- Visibility -->
                                <div class="col-md-4">
                                    <label class="form-label">Visibility</label>
                                    <select name="visibility" class="form-select">
                                        <option value="1" {{ (old('visibility', $page->visibility ?? 1) == 1) ? 'selected' : '' }}>Visible</option>
                                        <option value="0" {{ (old('visibility', $page->visibility ?? 1) == 0) ? 'selected' : '' }}>Hidden</option>
                                    </select>
                                </div>

                                <!-- Index Status -->
                                <div class="col-md-4">
                                    <label class="form-label">Index Status</label>
                                    <select name="index_status" class="form-select">
                                        <option value="1" {{ (old('index_status', $page->index_status ?? 1) == 1) ? 'selected' : '' }}>Index</option>
                                        <option value="0" {{ (old('index_status', $page->index_status ?? 1) == 0) ? 'selected' : '' }}>No Index</option>
                                    </select>
                                </div>

                                <!-- Follow Status -->
                                <div class="col-md-4">
                                    <label class="form-label">Follow Status</label>
                                    <select name="follow_status" class="form-select">
                                        <option value="1" {{ (old('follow_status', $page->follow_status ?? 1) == 1) ? 'selected' : '' }}>Follow</option>
                                        <option value="0" {{ (old('follow_status', $page->follow_status ?? 1) == 0) ? 'selected' : '' }}>No Follow</option>
                                    </select>
                                </div>

                                <!-- Status -->
                                <div class="col-md-6">
                                    <label class="form-label">Status</label>
                                    <div class="form-check">
                                        <input type="radio" name="status" value="1"
                                            class="form-check-input"
                                            {{ old('status', $page->status ?? 1) == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label">Active</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="status" value="0"
                                            class="form-check-input"
                                            {{ old('status', $page->status ?? 1) == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label">Inactive</label>
                                    </div>
                                </div>
                            </div>

                            <div class="text-end mt-4">
                                <button type="submit" class="btn" style="background-color:#1276B7;; color:#fff;">
                                    {{ isset($page) ? 'Update Page' : 'Create Page' }}
                                </button>
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
    function generateSlug(text) {
        return text
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')   // remove special chars
            .replace(/\s+/g, '-')           // replace spaces with dash
            .replace(/-+/g, '-');           // remove multiple dashes
    }

    const nameInput = document.getElementById("name");
    const slugInput = document.getElementById("slug");

    // Auto-generate slug when typing name
    nameInput.addEventListener("keyup", function () {
        let nameValue = this.value.trim();

        if (nameValue.length > 0) {
            slugInput.value = generateSlug(nameValue);
        } else {
            slugInput.value = ""; // Clear slug if name is cleared
        }
    });
</script>

</x-app-layout>
