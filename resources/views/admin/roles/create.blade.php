@extends('layouts.admin')
@section('title', isset($role) ? 'Edit Role' : 'Add Role')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-700 mb-0">{{ isset($role) ? 'Edit Role' : 'Add New Role' }}</h5>
    <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Back
    </a>
</div>

<form method="POST" action="{{ isset($role) ? route('admin.roles.update', $role) : route('admin.roles.store') }}">
    @csrf
    @isset($role) @method('PUT') @endisset

    <div class="row g-4">

        <div class="col-xl-4">
            <div class="form-card mb-4">
                <h6 class="fw-700 mb-3 pb-2 border-bottom">Role Details</h6>

                <div class="mb-3">
                    <label class="form-label">Role Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $role->name ?? '') }}" placeholder="e.g. Store Manager">
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="3" class="form-control" placeholder="What this role is for">{{ old('description', $role->description ?? '') }}</textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-admin-primary text-white w-100 py-2">
                <i class="bi bi-check2-circle me-2"></i>
                {{ isset($role) ? 'Update Role' : 'Create Role' }}
            </button>
        </div>

        <div class="col-xl-8">
            <div class="form-card mb-4">
                <h6 class="fw-700 mb-3 pb-2 border-bottom">Module Permissions</h6>
                <p class="text-muted small">Tick every admin panel section this role should be able to access and manage.</p>

                @php $assignedIds = $assignedIds ?? []; @endphp

                @foreach($permissions as $module => $modulePermissions)
                    <div class="mb-3">
                        <div class="fw-semibold small text-uppercase text-secondary mb-2">{{ $module }}</div>
                        <div class="row g-2">
                            @foreach($modulePermissions as $permission)
                                @if($permission->slug === 'testimonials') @continue @endif
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]"
                                               value="{{ $permission->id }}" id="perm{{ $permission->id }}"
                                               {{ in_array($permission->id, old('permissions', $assignedIds)) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="perm{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

</form>

@endsection
