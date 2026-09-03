<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Service;
use App\Services\AppointmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function __construct(private AppointmentService $appointmentService) {}

    public function create(Request $request)
    {
        $services = Service::active()->orderBy('sort_order')->get();

        // Pre-fill from the quick-booking widget, a "book this service" link,
        // or a "book a trial" link on a product page.
        $prefill = [
            'name'    => $request->get('name'),
            'phone'   => $request->get('phone'),
            'service' => $request->integer('service') ?: null,
            'model'   => $request->get('model'),
        ];

        return view('site.book-appointment', compact('services', 'prefill'));
    }

    /** AJAX: genuinely free slots for a date (clinic hours, breaks, blocks, bookings). */
    public function slots(Request $request)
    {
        $request->validate(['date' => 'required|date|after_or_equal:today']);

        return response()->json([
            'slots' => $this->appointmentService->availableSlots($request->date)->values(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'service_id'       => 'required|exists:services,id',
            'name'             => 'required|string|max:100',
            'email'            => 'nullable|email|max:150',
            'phone'            => 'required|string|max:15',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
            'notes'            => 'nullable|string|max:500',
        ]);

        if (!$this->appointmentService->isSlotAvailable($data['appointment_date'], $data['appointment_time'])) {
            return back()->withInput()->with('error', 'Sorry, that slot was just taken. Please pick another time.');
        }

        try {
            $appointment = $this->appointmentService->book(array_merge($data, [
                'user_id' => Auth::id(),
            ]));
        } catch (\RuntimeException $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }

        return redirect()->route('appointments.confirmation', $appointment->appointment_number)
            ->with('success', 'Your appointment request has been received.');
    }

    public function confirmation(Appointment $appointment)
    {
        $appointment->load('service');

        return view('site.appointment-confirmation', compact('appointment'));
    }
}
