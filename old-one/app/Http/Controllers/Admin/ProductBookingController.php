<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductBooking;
use Illuminate\Http\Request;

class ProductBookingController extends Controller
{
    public function index()
    {
        $bookings = ProductBooking::latest()->get();
        return view('profile.products-booking', compact('bookings'));
    }
    public function destroy($id)
    {
        $booking = ProductBooking::findOrFail($id);
        $booking->delete();
        return back()->with('success', 'Booking deleted successfully!');
    }
}
