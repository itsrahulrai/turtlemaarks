@extends('layouts.admin')

@section('title', 'Admin Users')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Admin Users</h4>
            <p class="text-muted mb-0">Create staff accounts and assign them a role.</p>
        </div>

        <a href="{{ route('admin.admin-users.create') }}" class="btn btn-admin-primary text-white">
            <i class="bi bi-plus-circle me-2"></i>Add Admin User
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table align-middle table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th width="150">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($admins as $adminUser)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="d-flex align-items-center gap-2">
                                <img src="{{ $adminUser->avatar_url }}" width="34" height="34" class="rounded-circle border" style="object-fit:cover;">
                                {{ $adminUser->name }}
                            </td>
                            <td>{{ $adminUser->email }}</td>
                            <td>
                                @if($adminUser->isSuperAdmin())
                                    <span class="badge bg-dark text-white">Super Admin</span>
                                @elseif($adminUser->assignedRole)
                                    <span class="badge bg-light text-dark border fw-semibold" style="color: #111 !important;">{{ $adminUser->assignedRole->name }}</span>
                                @elseif(is_string($adminUser->role) && !in_array($adminUser->role, ['staff', ''], true))
                                    <span class="badge bg-light text-dark border fw-semibold" style="color: #111 !important;">{{ ucfirst($adminUser->role) }}</span>
                                @else
                                    <span class="text-muted small">No role assigned</span>
                                @endif
                            </td>
                            <td>
                                @if($adminUser->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Disabled</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.admin-users.edit', $adminUser) }}" class="btn btn-sm btn-warning">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    @if($adminUser->id !== auth('admin')->id())
                                    <form action="{{ route('admin.admin-users.destroy', $adminUser) }}" method="POST"
                                          onsubmit="return confirm('Remove this admin user?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <h6>No admin users found</h6>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $admins->links() }}

        </div>
    </div>

</div>

@endsection
