@extends('layouts.admin')
@section('title', isset($admin) ? 'Edit Admin User' : 'Add Admin User')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-700 mb-0">{{ isset($admin) ? 'Edit Admin User' : 'Add New Admin User' }}</h5>
    <a href="{{ route('admin.admin-users.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Back
    </a>
</div>

<form method="POST"
      action="{{ isset($admin) ? route('admin.admin-users.update', $admin) : route('admin.admin-users.store') }}"
      enctype="multipart/form-data">
    @csrf
    @isset($admin) @method('PUT') @endisset

    <div class="row g-4">

        <div class="col-xl-8">
            <div class="form-card mb-4">
                <h6 class="fw-700 mb-3 pb-2 border-bottom">Account Details</h6>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $admin->name ?? '') }}">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $admin->email ?? '') }}">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $admin->phone ?? '') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Avatar</label>
                        <input type="file" name="avatar" accept="image/*" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Password {{ isset($admin) ? '' : '*' }}</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        @if(isset($admin))
                            <div class="form-text">Leave blank to keep the current password.</div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="form-card mb-4">
                <h6 class="fw-700 mb-3 pb-2 border-bottom">Role & Access</h6>

                <div class="mb-3">
                    <label class="form-label">Assigned Role</label>
                    <select name="role_id" class="form-select">
                        <option value="">— No role (no admin access) —</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id', $admin->role_id ?? '') == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="form-text">Controls exactly which admin sections this user can open.</div>
                </div>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="isActive" name="is_active" value="1"
                           {{ old('is_active', $admin->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="isActive">Active account</label>
                </div>
            </div>

            <button type="submit" class="btn btn-admin-primary text-white w-100 py-2">
                <i class="bi bi-check2-circle me-2"></i>
                {{ isset($admin) ? 'Update Admin User' : 'Create Admin User' }}
            </button>
        </div>

    </div>

</form>

@endsection
