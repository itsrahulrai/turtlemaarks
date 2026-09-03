@extends('layouts.admin')

@section('title', isset($brand) ? 'Edit Brand' : 'Add Brand')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1 fw-semibold">{{ isset($brand) ? 'Edit Brand' : 'Add Brand' }}</h4>
            <p class="text-muted small mb-0">Manage brand details</p>
        </div>
        <a href="{{ route('admin.brands.index') }}" class="btn btn-light border rounded-3 px-3">
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
          action="{{ isset($brand) ? route('admin.brands.update', $brand->id) : route('admin.brands.store') }}"
          enctype="multipart/form-data">
        @csrf
        @isset($brand) @method('PUT') @endisset

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <h6 class="fw-semibold mb-4">Basic Information</h6>

                        <div class="mb-3">
                            <label class="form-label small fw-medium">Brand Name</label>
                            <input type="text" name="name" id="brand-name" class="form-control rounded-3"
                                   value="{{ old('name', $brand->name ?? '') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-medium">Slug</label>
                            <input type="text" name="slug" id="brand-slug" class="form-control rounded-3"
                                   value="{{ old('slug', $brand->slug ?? '') }}">
                        </div>

                        <div>
                            <label class="form-label small fw-medium">Description</label>
                            <textarea name="description" rows="4" class="form-control rounded-3">{{ old('description', $brand->description ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <h6 class="fw-semibold mb-4">Logo</h6>
                        <input type="file" name="logo" class="form-control rounded-3">
                        @if(isset($brand) && $brand->logo)
                            <img src="{{ $brand->logo_url }}" class="img-fluid rounded-3 border mt-3">
                        @endif
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <h6 class="fw-semibold mb-4">Settings</h6>

                        <div class="mb-3">
                            <label class="form-label small fw-medium">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control rounded-3"
                                   value="{{ old('sort_order', $brand->sort_order ?? 0) }}">
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                                   {{ old('is_active', $brand->is_active ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label small" for="is_active">Active</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-dark w-100 rounded-3 py-2">
                    {{ isset($brand) ? 'Update Brand' : 'Create Brand' }}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('brand-name').addEventListener('keyup', function () {
    let slug = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
    document.getElementById('brand-slug').value = slug;
});
</script>
@endpush
