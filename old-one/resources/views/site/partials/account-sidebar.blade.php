@php
    /** @var string $active_tab  dashboard|profile|orders|appointments */
    $active_tab   = $active_tab ?? 'dashboard';
    $tmUser       = auth()->user();
    $tmOrderCount = $sidebarOrderCount ?? ($tmUser?->orders()->count() ?? 0);
    $tmApptCount  = $sidebarApptCount ?? \App\Models\Appointment::where('user_id', $tmUser?->id)->upcoming()->count();
@endphp
<div class="col-lg-3">
  <div class="card rounded-4 border p-3 bg-white shadow-xs sticky-top" style="top: 90px; z-index: 10;">

    <!-- Patient Profile Header -->
    <div class="text-center pb-3 border-bottom mb-3 position-relative">
      <div class="position-relative d-inline-block">
        <div class="bg-primary-subtle text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 68px; height: 68px; font-size: 1.85rem;">
          <i class="bi bi-person-fill text-orange"></i>
        </div>
        <span class="position-absolute bottom-0 end-0 bg-success border border-white rounded-circle p-1" title="Verified Active Patient"></span>
      </div>
      <h6 class="fw-bold text-navy mb-0 font-heading">{{ $tmUser?->name ?? 'Patient' }}</h6>
      <div class="small text-muted mb-1">Patient ID: <span class="fw-semibold text-navy">TM-PAT-{{ str_pad((string) ($tmUser?->id ?? 0), 4, '0', STR_PAD_LEFT) }}</span></div>
      <span class="badge bg-success-subtle text-success extra-small"><i class="bi bi-patch-check-fill me-1"></i> Verified Patient Record</span>
    </div>

    <!-- Navigation Links -->
    <div class="d-flex flex-column gap-1 tm-account-nav-wrap">
      <a href="{{ route('account.dashboard') }}" class="tm-account-nav-link {{ $active_tab === 'dashboard' ? 'active' : '' }}">
        <span><i class="bi bi-speedometer2 me-2"></i> Dashboard</span>
        <i class="bi bi-chevron-right small opacity-50"></i>
      </a>

      <a href="{{ route('account.profile') }}" class="tm-account-nav-link {{ $active_tab === 'profile' ? 'active' : '' }}">
        <span><i class="bi bi-person-badge me-2"></i> Profile</span>
        <i class="bi bi-chevron-right small opacity-50"></i>
      </a>

      <a href="{{ route('account.orders') }}" class="tm-account-nav-link {{ $active_tab === 'orders' ? 'active' : '' }}">
        <span><i class="bi bi-bag-check me-2"></i> Orders</span>
        @if ($tmOrderCount)
          <span class="badge bg-orange text-white rounded-pill px-2" style="font-size: 0.7rem;">{{ $tmOrderCount }}</span>
        @else
          <i class="bi bi-chevron-right small opacity-50"></i>
        @endif
      </a>

      <a href="{{ route('account.appointments') }}" class="tm-account-nav-link {{ $active_tab === 'appointments' ? 'active' : '' }}">
        <span><i class="bi bi-calendar2-check me-2"></i> Appointments</span>
        @if ($tmApptCount)
          <span class="badge bg-primary text-white rounded-pill px-2" style="font-size: 0.7rem;">{{ $tmApptCount }}</span>
        @else
          <i class="bi bi-chevron-right small opacity-50"></i>
        @endif
      </a>

      <a href="{{ route('account.addresses') }}" class="tm-account-nav-link {{ $active_tab === 'addresses' ? 'active' : '' }}">
        <span><i class="bi bi-geo-alt me-2"></i> Addresses</span>
        <i class="bi bi-chevron-right small opacity-50"></i>
      </a>

      <div class="border-top my-2 pt-2">
        <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Are you sure you want to sign out of your patient portal?');">
          @csrf
          <button type="submit" class="tm-account-nav-link text-danger w-100 bg-transparent border-0 text-start">
            <span><i class="bi bi-box-arrow-right me-2 text-danger"></i> Logout</span>
            <i class="bi bi-box-arrow-up-right small opacity-50"></i>
          </button>
        </form>
      </div>
    </div>

    <!-- Need Help Box -->
    <div class="mt-3 p-3 bg-light rounded-3 text-center border">
      <div class="extra-small text-muted mb-1" style="font-size: 0.75rem;">Need Audiologist Support?</div>
      <a href="tel:{{ $sitePhoneRaw ?? site_phone_raw() }}" class="fw-bold text-navy text-decoration-none small d-block">
        <i class="bi bi-telephone-fill text-orange me-1"></i> {{ $sitePhone ?? site_phone() }}
      </a>
    </div>

  </div>
</div>
