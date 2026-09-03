@if (session('success') || session('error') || session('status') || $errors->any())
<div class="container pt-3">
  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show small py-2 px-3 mb-2" role="alert">
      <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
      <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  @if (session('status'))
    <div class="alert alert-info alert-dismissible fade show small py-2 px-3 mb-2" role="alert">
      <i class="bi bi-info-circle-fill me-1"></i> {{ session('status') }}
      <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show small py-2 px-3 mb-2" role="alert">
      <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ session('error') }}
      <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show small py-2 px-3 mb-2" role="alert">
      <strong><i class="bi bi-exclamation-circle-fill me-1"></i> Please fix the following:</strong>
      <ul class="mb-0 mt-1 ps-3">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
      <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
</div>
@endif
