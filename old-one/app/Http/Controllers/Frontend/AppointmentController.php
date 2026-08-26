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

        // Pre-fill from the quick-booking widget on marketing pages, or a
        // "book this service" link from a service detail page.
        $selectedServiceId = $request->integer('service') ?: null;
        $prefill = [
            'name'    => $request->get('name'),
            'phone'   => $request->get('phone'),
            'service' => $selectedServiceId,
        ];

        return view('site.appointments.create', compact('services', 'prefill'));
    }

    /** AJAX: return available slots for a given date + service (duration aware). */
    public function slots(Request $request)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
        ]);

        $slots = $this->appointmentService->availableSlots($request->date);

        return response()->json(['slots' => $slots->values()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'service_id'        => 'required|exists:services,id',
            'name'              => 'required|string|max:100',
            'email'             => 'nullable|email|max:150',
            'phone'             => 'required|string|max:15',
            'appointment_date'  => 'required|date|after_or_equal:today',
            'appointment_time'  => 'required',
            'notes'             => 'nullable|string|max:500',
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
        return view('site.appointments.confirmation', compact('appointment'));
    }
}
