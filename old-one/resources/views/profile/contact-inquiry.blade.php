<x-app-layout>
    <div class="py-0">
        <div class="container-fluid">
            <div class="row min-vh-100">

                <!-- Sidebar -->
                @include('admin-sidebar')

                <!-- Main content -->
                <main class="col-12 col-md-9 col-lg-10 bg-white p-4">

                    <div class="card border rounded mb-3">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <h5 class="card-title fw-bold">Contact Form Submissions</h5>
                        </div>
                    </div>

                    <div class="card rounded">
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <table class="table table-bordered table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        <th>Accepted Terms</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($contacts as $key => $contact)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $contact->name }}</td>
                                            <td>{{ $contact->email }}</td>
                                            <td>{{ $contact->phone }}</td>
                                            <td>{{ $contact->subject ?? '-' }}</td>
                                            <td>{{ $contact->message }}</td>
                                            <td>
                                                @if($contact->accepted_terms)
                                                    <span class="badge bg-success">Yes</span>
                                                @else
                                                    <span class="badge bg-danger">No</span>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this submission?')" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-muted">No contact submissions found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                </main>
            </div>
        </div>
    </div>
</x-app-layout>
