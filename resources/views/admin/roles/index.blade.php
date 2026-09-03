@extends('layouts.admin')

@section('title', 'Roles & Permissions')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Roles & Permissions</h4>
            <p class="text-muted mb-0">Define what each staff role is allowed to do in the admin panel.</p>
        </div>

        <a href="{{ route('admin.roles.create') }}" class="btn btn-admin-primary text-white">
            <i class="bi bi-plus-circle me-2"></i>Add Role
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
                            <th>Role</th>
                            <th>Description</th>
                            <th>Permissions</th>
                            <th>Admins Assigned</th>
                            <th width="150">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($roles as $role)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $role->name }}</td>
                            <td class="text-muted small">{{ $role->description ?: '—' }}</td>
                            <td><span class="badge bg-light text-dark border fw-semibold" style="color: #111 !important;">{{ $role->permissions_count }} modules</span></td>
                            <td>{{ $role->admins_count }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-sm btn-warning">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('admin.roles.destroy', $role) }}" method="POST"
                                          onsubmit="return confirm('Delete this role?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <h6>No roles yet</h6>
                                <p class="text-muted mb-0">Create a role to start assigning permissions to staff accounts.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $roles->links() }}

        </div>
    </div>

</div>

@endsection
