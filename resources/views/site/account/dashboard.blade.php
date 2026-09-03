@extends('site.layouts.app')

@section('title', 'Patient Dashboard — ' . SITE_NAME)
@section('meta_description', 'Turtle Maarks patient dashboard: active appointments, orders, and hearing records.')

@section('content')

  <!-- HERO BANNER -->
  <section class="tm-page-hero text-center position-relative">
    <div class="container">
      <nav aria-label="breadcrumb" class="d-inline-flex mb-2">
        <div class="tm-breadcrumb-pill">
          <a href="{{ route('home') }}"><i class="bi bi-house-door"></i> Home</a>
          <span class="tm-breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
          <span class="tm-breadcrumb-current" aria-current="page">Patient Account</span>
        </div>
      </nav>
      <h1 class="display-6 fw-bold text-white mb-1 font-heading">Patient Dashboard</h1>
      <p class="text-white-50 mx-auto small mb-0" style="max-width: 580px;">Manage your appointments, hearing device orders, and audiogram records.</p>
    </div>
  </section>

  <section class="py-5 bg-light">
    <div class="container">
      <div class="row g-4">

        @include('site.partials.account-sidebar', ['active_tab' => 'dashboard'])

        <!-- Main Dashboard View -->
        <div class="col-lg-9">

          <!-- Patient Welcome Banner -->
          <div class="card rounded-4 border-0 p-4 text-white mb-4 shadow-sm position-relative overflow-hidden" style="background: linear-gradient(135deg, #071324 0%, #0B1E36 50%, #0E2442 100%); border: 1px solid rgba(255, 255, 255, 0.08) !important;">
            <div class="position-relative z-1">
              <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div>
                  <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                    <span class="badge bg-success-subtle text-success rounded-pill px-3 py-1 extra-small fw-semibold">
                      <i class="bi bi-patch-check-fill me-1"></i> Verified Patient
                    </span>
                    <span class="badge bg-white bg-opacity-10 text-white-50 rounded-pill px-3 py-1 extra-small">
                      <i class="bi bi-person-badge me-1"></i> TM-PAT-{{ str_pad((string) $user->id, 4, '0', STR_PAD_LEFT) }}
                    </span>
                  </div>

                  <h3 class="fw-bold text-white mb-1 font-heading">Welcome Back, {{ $user->name }}</h3>
                  <p class="text-white-50 small mb-0" style="max-width: 560px;">
                    Track your clinical appointments, hearing device orders, and warranty records in one place.
                  </p>
                </div>

                <div class="d-flex flex-wrap gap-2">
                  <a href="{{ route('appointments.create') }}" class="tm-btn tm-btn-primary tm-btn-sm shadow-sm">
                    <i class="bi bi-calendar-plus me-1"></i> Book Visit
                  </a>
                  <a href="{{ route('account.appointments') }}" class="tm-btn tm-btn-outline tm-btn-sm text-white border-white-50">
                    <i class="bi bi-ticket-perforated me-1"></i> My Appointments
                  </a>
                </div>
              </div>
            </div>
          </div>

          <!-- 4 Core Stat Cards -->
          <div class="row g-3 mb-4">
            <div class="col-sm-6 col-xl-3">
              <div class="tm-account-stat-card">
                <div class="d-flex align-items-center justify-content-between mb-2">
                  <span class="small text-muted fw-medium">Total Orders</span>
                  <div class="tm-account-stat-icon bg-orange-subtle text-orange"><i class="bi bi-bag-check"></i></div>
                </div>
                <h6 class="fw-bold text-navy mb-0 font-heading">{{ $totalOrders }} {{ Str::plural('Order', $totalOrders) }}</h6>
                <div class="d-flex align-items-center gap-1 mt-1">
                  <span class="badge bg-light text-navy border extra-small">Lifetime {{ inr($totalSpent) }}</span>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-xl-3">
              <div class="tm-account-stat-card">
                <div class="d-flex align-items-center justify-content-between mb-2">
                  <span class="small text-muted fw-medium">Next Visit</span>
                  <div class="tm-account-stat-icon bg-primary-subtle text-primary"><i class="bi bi-calendar2-check"></i></div>
                </div>
                <h6 class="fw-bold text-navy mb-0 font-heading">
                  {{ $nextAppointment ? $nextAppointment->appointment_date->format('D, d M') : 'Not booked' }}
                </h6>
                <div class="d-flex align-items-center gap-1 mt-1">
                  <span class="badge bg-primary-subtle text-primary extra-small">
                    {{ $nextAppointment ? \Carbon\Carbon::parse($nextAppointment->appointment_time)->format('h:i A') : 'Book a slot' }}
                  </span>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-xl-3">
              <div class="tm-account-stat-card">
                <div class="d-flex align-items-center justify-content-between mb-2">
                  <span class="small text-muted fw-medium">Appointments</span>
                  <div class="tm-account-stat-icon bg-success-subtle text-success"><i class="bi bi-clipboard2-pulse"></i></div>
                </div>
                <h6 class="fw-bold text-navy mb-0 font-heading">{{ $totalAppointments }} Booked</h6>
                <div class="d-flex align-items-center gap-1 mt-1">
                  <span class="badge bg-light text-navy border extra-small">{{ $upcomingAppointments }} upcoming</span>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-xl-3">
              <div class="tm-account-stat-card">
                <div class="d-flex align-items-center justify-content-between mb-2">
                  <span class="small text-muted fw-medium">Wishlist</span>
                  <div class="tm-account-stat-icon bg-danger-subtle text-danger"><i class="bi bi-heart"></i></div>
                </div>
                <h6 class="fw-bold text-navy mb-0 font-heading">{{ $wishlistCount }} Saved</h6>
                <div class="d-flex align-items-center gap-1 mt-1">
                  <a href="{{ route('wishlist.index') }}" class="badge bg-light text-navy border extra-small text-decoration-none">View wishlist</a>
                </div>
              </div>
            </div>
          </div>

          <!-- Upcoming Appointment Spotlight -->
          @if ($nextAppointment)
          <div class="card rounded-4 border p-4 bg-white shadow-xs mb-4">
            <div class="d-flex flex-wrap justify-content-between align-items-center border-bottom pb-3 mb-3">
              <div>
                <span class="badge bg-primary-subtle text-primary fw-bold px-2 py-1 small mb-1">
                  <i class="bi bi-clock-history me-1"></i> Upcoming Appointment
                </span>
                <h5 class="fw-bold text-navy mb-0 font-heading">{{ $nextAppointment->service?->name ?? 'Clinical Consultation' }}</h5>
              </div>
              <div class="text-end">{!! $nextAppointment->status_badge !!}</div>
            </div>

            <div class="row g-3 align-items-center">
              <div class="col-md-7">
                <div class="d-flex flex-column gap-2 small">
                  <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-calendar-event text-orange fs-5"></i>
                    <div>
                      <strong class="text-navy">{{ $nextAppointment->appointment_date->format('l, F j, Y') }}</strong>
                      <span class="text-muted ms-1">({{ \Carbon\Carbon::parse($nextAppointment->appointment_time)->format('h:i A') }} IST)</span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-hash text-primary fs-5"></i>
                    <div><strong class="text-navy">{{ $nextAppointment->appointment_number }}</strong></div>
                  </div>
                  <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-geo-alt-fill text-danger fs-5"></i>
                    <span class="text-secondary">{{ SITE_ADDRESS }}</span>
                  </div>
                </div>
              </div>
              <div class="col-md-5 text-md-end">
                <div class="d-flex flex-column flex-sm-row justify-content-md-end gap-2">
                  <a href="{{ route('appointments.confirmation', $nextAppointment->appointment_number) }}" class="tm-btn tm-btn-primary tm-btn-sm">
                    <i class="bi bi-ticket-perforated me-1"></i> View Slip
                  </a>
                  <a href="https://maps.google.com/?q=Gaur+City+Mall+Greater+Noida" target="_blank" rel="noopener" class="tm-btn tm-btn-outline tm-btn-sm">
                    <i class="bi bi-map me-1"></i> Directions
                  </a>
                </div>
              </div>
            </div>
          </div>
          @else
          <div class="card rounded-4 border p-4 bg-white shadow-xs mb-4 text-center">
            <i class="bi bi-calendar2-plus text-muted fs-1 mb-2"></i>
            <h6 class="fw-bold text-navy mb-1">No upcoming appointment</h6>
            <p class="small text-secondary mb-3">Book a sound-booth hearing evaluation or a free senior citizen home visit.</p>
            <div><a href="{{ route('appointments.create') }}" class="tm-btn tm-btn-primary tm-btn-sm">Book an Appointment</a></div>
          </div>
          @endif

          <!-- Recent Orders -->
          <div class="card rounded-4 border p-4 bg-white shadow-xs mb-4">
            <div class="d-flex flex-wrap justify-content-between align-items-center border-bottom pb-3 mb-3">
              <h6 class="fw-bold text-navy mb-0 font-heading">Recent Orders</h6>
              <a href="{{ route('account.orders') }}" class="small text-orange fw-bold text-decoration-none">
                View All Orders <i class="bi bi-arrow-right"></i>
              </a>
            </div>

            <div class="table-responsive">
              <table class="table align-middle small mb-0">
                <thead class="table-light">
                  <tr>
                    <th>Order</th>
                    <th>Date</th>
                    <th>Items</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th class="text-end">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($recentOrders as $order)
                  <tr>
                    <td class="fw-bold text-navy">{{ $order->order_number }}</td>
                    <td class="text-muted">{{ $order->created_at->format('d M Y') }}</td>
                    <td class="text-muted">{{ $order->items->count() }}</td>
                    <td class="fw-bold text-orange">{{ inr($order->total) }}</td>
                    <td>{!! $order->status_badge !!}</td>
                    <td class="text-end">
                      <a href="{{ route('account.orders.show', $order->id) }}" class="btn btn-sm btn-outline-secondary py-1 px-2">View</a>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                      No orders yet — <a href="{{ route('products') }}" class="text-orange fw-bold text-decoration-none">browse hearing aids</a>.
                    </td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>

        </div>

      </div>
    </div>
  </section>
@endsection
