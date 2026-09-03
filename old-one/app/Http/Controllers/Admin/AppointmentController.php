<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\AppointmentBlock;
use App\Models\AppointmentSetting;
use App\Models\Service;
use App\Services\AppointmentService;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function __construct(private AppointmentService $appointmentService) {}

    public function index(Request $request)
    {
        $query = Appointment::with('service')->latest('appointment_date');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('date')) {
            $query->whereDate('appointment_date', $request->date);
        }
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('phone', 'like', '%' . $request->search . '%')
                  ->orWhere('appointment_number', 'like', '%' . $request->search . '%');
            });
        }

        $appointments = $query->paginate(20)->withQueryString();

        return view('admin.appointments.index', compact('appointments'));
    }

    public function show(Appointment $appointment)
    {
        $appointment->load('service', 'user', 'order');
        return view('admin.appointments.show', compact('appointment'));
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $data = $request->validate([
            'status'      => 'required|in:pending,confirmed,rejected,rescheduled,cancelled,completed',
            'admin_notes' => 'nullable|string|max:500',
        ]);

        // Rescheduling moves the date/time too
        if ($data['status'] === 'rescheduled') {
            $request->validate([
                'appointment_date' => 'required|date|after_or_equal:today',
                'appointment_time' => 'required',
            ]);

            if (!$this->appointmentService->isSlotAvailable($request->appointment_date, $request->appointment_time)) {
                return back()->with('error', 'The chosen slot is not available.');
            }

            $appointment->update([
                'appointment_date' => $request->appointment_date,
                'appointment_time' => $request->appointment_time,
            ]);
        }

        $this->appointmentService->updateStatus($appointment, $data['status'], $data['admin_notes'] ?? null);

        return back()->with('success', 'Appointment updated.');
    }

    // ------------------------------------------------------------------
    // Working hours + blocked dates
    // ------------------------------------------------------------------

    public function settings()
    {
        $settings = collect(range(0, 6))->map(function ($day) {
            return AppointmentSetting::firstOrCreate(
                ['day_of_week' => $day],
                ['is_working_day' => $day !== 0, 'start_time' => '10:00', 'end_time' => '19:00', 'slot_duration_minutes' => 30]
            );
        })->sortBy('day_of_week');

        $blocks = AppointmentBlock::orderBy('date', 'desc')->paginate(20, ['*'], 'blocks_page');

        return view('admin.appointments.settings', compact('settings', 'blocks'));
    }

    public function updateSettings(Request $request)
    {
        $data = $request->validate([
            'days'                          => 'required|array',
            'days.*.is_working_day'         => 'nullable|boolean',
            'days.*.start_time'             => 'required',
            'days.*.end_time'               => 'required|after:days.*.start_time',
            'days.*.slot_duration_minutes'  => 'required|integer|min:5|max:240',
        ]);

        foreach ($request->input('days') as $day => $values) {
            AppointmentSetting::updateOrCreate(
                ['day_of_week' => $day],
                [
                    'is_working_day'        => isset($values['is_working_day']),
                    'start_time'            => $values['start_time'],
                    'end_time'              => $values['end_time'],
                    'slot_duration_minutes' => $values['slot_duration_minutes'],
                ]
            );
        }

        return back()->with('success', 'Working hours updated.');
    }

    public function storeBlock(Request $request)
    {
        $data = $request->validate([
            'date'       => 'required|date',
            'full_day'   => 'nullable|boolean',
            'start_time' => 'nullable|required_if:full_day,null|date_format:H:i',
            'end_time'   => 'nullable|required_if:full_day,null|date_format:H:i|after:start_time',
            'reason'     => 'nullable|string|max:150',
        ]);

        $data['full_day'] = $request->has('full_day');

        AppointmentBlock::create($data);

        return back()->with('success', 'Date/slot blocked.');
    }

    public function destroyBlock(AppointmentBlock $block)
    {
        $block->delete();
        return back()->with('success', 'Block removed.');
    }
}
