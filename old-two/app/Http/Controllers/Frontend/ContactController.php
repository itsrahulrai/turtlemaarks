<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:150',
            'phone'   => 'required|string|max:15',
            'message' => 'nullable|string|max:2000',
        ]);

        // Log the enquiry so nothing is lost even if mail isn't configured yet.
        Log::info('Contact form submission', $data);

        $adminEmail = Admin::where('is_active', true)->whereNotNull('email')->value('email')
            ?? config('services.admin_notifications.email');

        if ($adminEmail) {
            try {
                Mail::raw(
                    "New contact form enquiry:\n\nName: {$data['name']}\nEmail: {$data['email']}\nPhone: {$data['phone']}\nMessage: " . ($data['message'] ?? '-'),
                    function ($mail) use ($adminEmail, $data) {
                        $mail->to($adminEmail)
                            ->subject('New Contact Enquiry from ' . $data['name']);
                    }
                );
            } catch (\Throwable $e) {
                Log::error('Contact form mail failed: ' . $e->getMessage());
            }
        }

        return redirect()->route('thank-you');
    }
}
