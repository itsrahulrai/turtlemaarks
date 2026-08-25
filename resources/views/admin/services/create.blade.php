@extends('layouts.admin')

@section('title', isset($service) ? 'Edit Service' : 'Add Service')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1 fw-semibold">{{ isset($service) ? 'Edit Service' : 'Add Service' }}</h4>
            <p class="text-muted small mb-0">Manage service details, pricing and duration</p>
        </div>
        <a href="{{ route('admin.services.index') }}" class="btn btn-light border rounded-3 px-3">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST"
          action="{{ isset($service) ? route('admin.services.update', $service->id) : route('admin.services.store') }}"
          enctype="multipart/form-data">
        @csrf
        @isset($service) @method('PUT') @endisset

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <h6 class="fw-semibold mb-4">Basic Information</h6>

                        <div class="mb-3">
                            <label class="form-label small fw-medium">Service Name</label>
                            <input type="text" name="name" id="service-name" class="form-control rounded-3"
                                   value="{{ old('name', $service->name ?? '') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-medium">Slug</label>
                            <input type="text" name="slug" id="service-slug" class="form-control rounded-3"
                                   value="{{ old('slug', $service->slug ?? '') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-medium">Short Description</label>
                            <input type="text" name="short_description" class="form-control rounded-3"
                                   value="{{ old('short_description', $service->short_description ?? '') }}" maxlength="500">
                        </div>

                        <div>
                            <label class="form-label small fw-medium">Full Description</label>
                            <textarea name="description" rows="6" class="form-control rounded-3">{{ old('description', $service->description ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 mt-4">
                    <div class="card-body p-4">
                        <h6 class="fw-semibold mb-4">SEO Settings</h6>

                        <div class="mb-3">
                            <label class="form-label small fw-medium">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control rounded-3"
                                   value="{{ old('meta_title', $service->meta_title ?? '') }}">
                        </div>

                        <div>
                            <label class="form-label small fw-medium">Meta Description</label>
                            <textarea name="meta_description" rows="3" class="form-control rounded-3">{{ old('meta_description', $service->meta_description ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <h6 class="fw-semibold mb-4">Image</h6>
                        <input type="file" name="image" class="form-control rounded-3">
                        @if(isset($service) && $service->image)
                            <img src="{{ $service->image_url }}" class="img-fluid rounded-3 border mt-3">
                        @endif
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <h6 class="fw-semibold mb-4">Pricing &amp; Duration</h6>

                        <div class="mb-3">
                            <label class="form-label small fw-medium">Price (₹)</label>
                            <input type="number" step="0.01" name="price" class="form-control rounded-3"
                                   value="{{ old('price', $service->price ?? 0) }}" required>
                        </div>

                        <div>
                            <label class="form-label small fw-medium">Duration (minutes)</label>
                            <input type="number" name="duration_minutes" class="form-control rounded-3"
                                   value="{{ old('duration_minutes', $service->duration_minutes ?? 30) }}" required>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <h6 class="fw-semibold mb-4">Settings</h6>

                        <div class="mb-3">
                            <label class="form-label small fw-medium">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control rounded-3"
                                   value="{{ old('sort_order', $service->sort_order ?? 0) }}">
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                                   {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label small" for="is_active">Active</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-dark w-100 rounded-3 py-2">
                    {{ isset($service) ? 'Update Service' : 'Create Service' }}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('service-name').addEventListener('keyup', function () {
    let slug = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
    document.getElementById('service-slug').value = slug;
});
</script>
@endpush
