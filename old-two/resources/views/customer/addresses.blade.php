@extends('site.layouts.layout')
@section('title', 'My Addresses')
@section('content')
<div class="account-area">
<div class="container">
    <div class="row g-4">
        <div class="col-lg-3">
            @include('customer.partials.sidebar')
        </div>
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-700 mb-0" style="color:var(--tm-navy);">Saved Addresses</h5>
                <button class="account-btn-primary" data-toggle="modal" data-target="#addAddressModal">+ Add New</button>
            </div>
            <div class="row g-3">
                @forelse($addresses as $addr)
                <div class="col-md-6">
                    <div class="account-panel p-4 h-100">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="account-badge">{{ ucfirst($addr->type) }}</span>
                            @if($addr->is_default)<span class="badge bg-success" style="font-size:.7rem;">Default</span>@endif
                        </div>
                        <div class="fw-600">{{ $addr->name }}</div>
                        <div style="font-size:.84rem;color:var(--tm-muted);line-height:1.8;margin-top:4px;">
                            {{ $addr->address_line1 }}<br>
                            @if($addr->address_line2){{ $addr->address_line2 }}<br>@endif
                            {{ $addr->city }}, {{ $addr->state }} {{ $addr->pincode }}<br>
                            &#128222; {{ $addr->phone }}
                        </div>
                        <form method="POST" action="{{ route('account.addresses.destroy', $addr) }}" onsubmit="return confirm('Delete?')" class="mt-3">
                            @csrf @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm" style="border-radius:8px;font-size:.78rem;">Delete</button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="account-empty">
                        <i class="bi bi-geo-alt"></i>
                        No addresses saved yet.
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
</div>

{{-- Add Address Modal --}}
<div class="modal fade" id="addAddressModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header border-0"><h5 class="modal-title fw-700" style="color:var(--tm-navy);">Add New Address</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
            <div class="modal-body">
                <form method="POST" action="{{ route('account.addresses.store') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-600" style="font-size:.85rem;">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Full name" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-600" style="font-size:.85rem;">Phone</label>
                            <input type="tel" name="phone" class="form-control" placeholder="Phone number" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-600" style="font-size:.85rem;">Address Line 1</label>
                            <input type="text" name="address_line1" class="form-control" placeholder="House no., street" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-600" style="font-size:.85rem;">Address Line 2</label>
                            <input type="text" name="address_line2" class="form-control" placeholder="Landmark, area (optional)">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-600" style="font-size:.85rem;">City</label>
                            <input type="text" name="city" class="form-control" placeholder="City" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-600" style="font-size:.85rem;">State</label>
                            <input type="text" name="state" class="form-control" placeholder="State" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-600" style="font-size:.85rem;">Pincode</label>
                            <input type="text" name="pincode" class="form-control" placeholder="Pincode" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-600" style="font-size:.85rem;">Type</label>
                            <select name="type" class="form-select">
                                <option value="home">Home</option>
                                <option value="work">Work</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-6 d-flex align-items-end">
                            <div class="form-check"><input class="form-check-input" type="checkbox" name="is_default" id="is_default" value="1"><label class="form-check-label" for="is_default" style="font-size:.84rem;">Set as Default</label></div>
                        </div>
                    </div>
                    <button type="submit" class="account-btn-primary w-100 mt-4">Save Address</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
