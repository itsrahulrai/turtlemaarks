  <title>Categories -Nexa Health Consult - Your Smart Healthcare Consultants</title>
  <x-app-layout>
      <div class="py-0" style="background-color:#f8f9fa;">
          <div class="container-fluid">
              <div class="row min-vh-100">

                  <!-- Sidebar -->
                  @include('admin-sidebar')

                  <!-- Main content -->
                  <main class="col-12 col-md-9 col-lg-10 p-4">

                      <!-- Breadcrumb -->
                      <div class="card border-0 rounded shadow-sm mb-3">
                          <div class="card-body">
                              <h5 class="card-title fw-bold text-dark">Categories</h5>
                              <nav aria-label="breadcrumb" class="mb-0">
                                  <ol class="breadcrumb mb-0">
                                      <li class="breadcrumb-item">
                                          <a href="{{ route('dashboard') }}" class="text-primary fw-semibold">Dashboard</a>
                                      </li>
                                      <li class="breadcrumb-item active" aria-current="page">
                                          <span class="fw-semibold" style="color:#000;">All Categories</span>
                                      </li>
                                  </ol>
                              </nav>
                          </div>
                      </div>

                      <!-- Categories Card -->
                      <div class="card rounded shadow-sm border-0">
                          <div class="card-header d-flex justify-content-between align-items-center" style="background-color:#1276B7;; color:#fff;">
                              <h5 class="mb-0">All Categories</h5>
                              <a href="{{ route('categories.create') }}" class="btn btn-sm" style="background-color:#000; color:#fff;">+ Add New</a>
                          </div>
                          <div class="card-body p-0">
                              <div class="table-responsive">
                                  <table class="table table-hover mb-0">
                                      <thead style="background-color:#314E52; color:#fff;">
                                          <tr>
                                              <th>#</th>
                                              <th>Name</th>
                                              <th>Slug</th>
                                              <th>Status</th>
                                              <th>Action</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @forelse($categories as $key => $category)
                                          <tr>
                                              <td>{{ $key + 1 }}</td>
                                              <td>{{ $category->name }}</td>
                                              <td>{{ $category->slug }}</td>
                                              <td>
                                                  @if ($category->status == 1)
                                                  <span class="badge" style="background-color:#28a745; color:#fff;">Active</span>
                                                  @else
                                                  <span class="badge bg-danger">Inactive</span>
                                                  @endif
                                              </td>

                                              <td>
                                                  <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm" style="background-color:#000; color:#fff;">Edit</a>
                                                  <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                                                      @csrf
                                                      @method('DELETE')
                                                      <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                                                  </form>
                                              </td>
                                          </tr>
                                          @empty
                                          <tr>
                                              <td colspan="5" class="text-center text-muted py-4">No categories found</td>
                                          </tr>
                                          @endforelse
                                      </tbody>
                                  </table>
                              </div>

                              <!-- Pagination -->
                              <div class="d-flex justify-content-end mt-3">
                                  {{ $categories->links('pagination.custom') }}
                              </div>


                          </div>
                      </div>

                  </main>
              </div>
          </div>
      </div>
  </x-app-layout>

  <!-- Styles -->
  <style>
      body {
          font-family: 'Rubik', sans-serif;
      }

      table thead th {
          text-transform: uppercase;
          letter-spacing: 0.5px;
      }

      table tbody tr:hover {
          background-color: #f1f1f1;
          transition: background-color 0.3s;
      }

      .badge {
          padding: 0.35em 0.65em;
          font-size: 0.85rem;
          border-radius: 0.35rem;
          font-weight: 600;
      }

      .btn-sm {
          transition: all 0.3s ease;
          border-radius: 5px;
      }

      .btn-sm:hover {
          opacity: 0.85;
      }
  </style>