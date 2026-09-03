@extends('site.layouts.app')

@section('title', 'Patient Profile & Records — ' . SITE_NAME)
@section('meta_description', 'Manage your patient profile, contact details, saved addresses, and portal security settings.')

@section('content')

  <!-- HERO BANNER -->
  <section class="tm-page-hero text-center position-relative">
    <div class="container">
      <nav aria-label="breadcrumb" class="d-inline-flex mb-2">
        <div class="tm-breadcrumb-pill">
          <a href="{{ route('home') }}"><i class="bi bi-house-door"></i> Home</a>
          <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
          <a href="{{ route('account.dashboard') }}">Account</a>
          <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
          <span class="tm-breadcrumb-current" aria-current="page">Profile</span>
        </div>
      </nav>
      <h1 class="display-6 fw-bold text-white mb-1 font-heading">Patient Profile</h1>
      <p class="text-white-50 mx-auto small mb-0" style="max-width: 580px;">Update your demographics, delivery addresses, and portal security settings.</p>
    </div>
  </section>

  <section class="py-5 bg-light">
    <div class="container">
      <div class="row g-4">

        @include('site.partials.account-sidebar', ['active_tab' => 'profile'])

        <div class="col-lg-9">

          <!-- Profile Header Card -->
          <div class="card rounded-4 border p-4 bg-white shadow-xs mb-4">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
              <div>
                <h5 class="fw-bold text-navy mb-1 font-heading">Patient Profile &amp; Records</h5>
                <p class="text-secondary small mb-0">Update personal details, delivery addresses, and account security.</p>
              </div>
              <span class="badge bg-success-subtle text-success p-2 px-3 small">
                <i class="bi bi-shield-check me-1"></i> Patient Record ID: <strong>TM-PAT-{{ str_pad((string) $user->id, 4, '0', STR_PAD_LEFT) }}</strong>
              </span>
            </div>
          </div>

          <!-- SECTION 1: DEMOGRAPHICS -->
          <div class="card rounded-4 border p-4 bg-white shadow-xs mb-4">
            <h6 class="fw-bold text-navy mb-3 font-heading border-bottom pb-2">
              <i class="bi bi-person-lines-fill text-orange me-2"></i> 1. Personal Details &amp; Contact
            </h6>

            <form method="POST" action="{{ route('account.profile.update') }}" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label small fw-bold text-navy">Full Patient Name *</label>
                  <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="col-md-3">
                  <label class="form-label small fw-bold text-navy">Date of Birth</label>
                  <input type="date" name="dob" class="form-control" value="{{ old('dob', optional($user->dob)->format('Y-m-d')) }}">
                </div>

                <div class="col-md-3">
                  <label class="form-label small fw-bold text-navy">Gender</label>
                  <select name="gender" class="form-select">
                    <option value="">Prefer not to say</option>
                    <option value="male"   @selected(old('gender', $user->gender) === 'male')>Male</option>
                    <option value="female" @selected(old('gender', $user->gender) === 'female')>Female</option>
                    <option value="other"  @selected(old('gender', $user->gender) === 'other')>Other</option>
                  </select>
                </div>

                <div class="col-md-6">
                  <label class="form-label small fw-bold text-navy">WhatsApp / Mobile Phone</label>
                  <div class="input-group">
                    <span class="input-group-text bg-light text-muted small">+91</span>
                    <input type="tel" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                  </div>
                </div>

                <div class="col-md-6">
                  <label class="form-label small fw-bold text-navy">Email Address</label>
                  <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                  <div class="form-text extra-small text-muted">Contact the clinic to change your registered email.</div>
                </div>

                <div class="col-12">
                  <label class="form-label small fw-bold text-navy">Profile Photo</label>
                  <input type="file" name="avatar" class="form-control" accept="image/*">
                </div>

                <div class="col-12 text-end pt-2">
                  <button type="submit" class="tm-btn tm-btn-primary tm-btn-sm">
                    <i class="bi bi-check2-circle me-1"></i> Save Details
                  </button>
                </div>
              </div>
            </form>
          </div>

          <!-- SECTION 2: ADDRESSES -->
          <div class="card rounded-4 border p-4 bg-white shadow-xs mb-4">
            <h6 class="fw-bold text-navy mb-3 font-heading border-bottom pb-2">
              <i class="bi bi-geo-alt-fill text-primary me-2"></i> 2. Delivery &amp; Home-Visit Addresses
            </h6>

            <div class="d-flex flex-column gap-2 mb-4">
              @forelse ($user->addresses as $address)
              <div class="p-3 border rounded-3 bg-white d-flex flex-wrap justify-content-between align-items-center gap-2">
                <div class="small">
                  <strong class="text-navy d-block">
                    {{ $address->name }} &bull; {{ $address->phone }}
                    @if ($address->is_default)<span class="badge bg-orange-subtle text-orange ms-1">Default</span>@endif
                  </strong>
                  <span class="text-muted">
                    {{ $address->address_line1 }}@if ($address->address_line2), {{ $address->address_line2 }}@endif,
                    {{ $address->city }}, {{ $address->state }} — {{ $address->pincode }}
                  </span>
                </div>
                <form method="POST" action="{{ route('account.addresses.destroy', $address->id) }}">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-outline-danger py-1 px-2"><i class="bi bi-trash3"></i></button>
                </form>
              </div>
              @empty
              <div class="text-muted small">No addresses saved yet. Add one below so checkout and home visits are faster.</div>
              @endforelse
            </div>

            <form method="POST" action="{{ route('account.addresses.store') }}">
              @csrf
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label small fw-bold text-navy">Contact Name *</label>
                  <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label small fw-bold text-navy">Phone *</label>
                  <input type="tel" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" required>
                </div>
                <div class="col-12">
                  <label class="form-label small fw-bold text-navy">Address Line 1 *</label>
                  <input type="text" name="address_line1" class="form-control" required placeholder="Flat / House no., Building">
                </div>
                <div class="col-12">
                  <label class="form-label small fw-bold text-navy">Address Line 2</label>
                  <input type="text" name="address_line2" class="form-control" placeholder="Sector / Society / Landmark">
                </div>
                <div class="col-md-4">
                  <label class="form-label small fw-bold text-navy">City *</label>
                  <input type="text" name="city" class="form-control" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label small fw-bold text-navy">State *</label>
                  <input type="text" name="state" class="form-control" value="Uttar Pradesh" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label small fw-bold text-navy">PIN Code *</label>
                  <input type="text" name="pincode" class="form-control" maxlength="6" pattern="[0-9]{6}" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label small fw-bold text-navy">Address Type</label>
                  <select name="type" class="form-select">
                    <option value="home">Home</option>
                    <option value="work">Work</option>
                    <option value="other">Other</option>
                  </select>
                </div>
                <div class="col-md-6 d-flex align-items-end">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_default" value="1" id="addrDefault">
                    <label class="form-check-label small text-navy" for="addrDefault">Make this my default address</label>
                  </div>
                </div>
                <div class="col-12 text-end">
                  <button type="submit" class="tm-btn tm-btn-outline-navy tm-btn-sm">
                    <i class="bi bi-plus-circle me-1"></i> Add Address
                  </button>
                </div>
              </div>
            </form>
          </div>

          <!-- SECTION 3: SECURITY -->
          <div class="card rounded-4 border p-4 bg-white shadow-xs">
            <h6 class="fw-bold text-navy mb-3 font-heading border-bottom pb-2">
              <i class="bi bi-shield-lock-fill text-success me-2"></i> 3. Password &amp; Security
            </h6>

            <form method="POST" action="{{ route('account.password.update') }}">
              @csrf
              @method('PUT')
              <div class="row g-3 mb-3">
                <div class="col-md-4">
                  <label class="form-label small fw-bold text-navy">Current Password *</label>
                  <input type="password" name="current_password" class="form-control" required placeholder="••••••••">
                </div>
                <div class="col-md-4">
                  <label class="form-label small fw-bold text-navy">New Password *</label>
                  <input type="password" name="password" class="form-control" required placeholder="At least 8 characters">
                </div>
                <div class="col-md-4">
                  <label class="form-label small fw-bold text-navy">Confirm New Password *</label>
                  <input type="password" name="password_confirmation" class="form-control" required placeholder="••••••••">
                </div>
              </div>

              <div class="text-end">
                <button type="submit" class="tm-btn tm-btn-primary tm-btn-sm">
                  <i class="bi bi-save me-1"></i> Update Password
                </button>
              </div>
            </form>
          </div>

        </div>

      </div>
    </div>
  </section>
@endsection
