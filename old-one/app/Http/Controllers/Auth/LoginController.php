<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\RateLimiter;

class LoginController extends Controller
{
    public function __construct(private CartService $cartService) {}

    public function showForm() { return view('site.auth.login'); }

    public function login(Request $request) {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $key = 'login.' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            return back()->withErrors(['email' => 'Too many login attempts. Try again in ' . RateLimiter::availableIn($key) . ' seconds.']);
        }

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            if (!Auth::user()->is_active) {
                Auth::logout();
                return back()->withErrors(['email' => 'Your account has been disabled.']);
            }
            RateLimiter::clear($key);
            $request->session()->regenerate();
            $this->cartService->mergeTo(Auth::id());
            return redirect()->intended(route('home'));
        }

        RateLimiter::hit($key);
        return back()->withErrors(['email' => 'Invalid credentials.'])->withInput($request->only('email'));
    }

    // Password reset
    public function showForgotForm() { return view('site.auth.forgot-password'); }

    public function sendResetLink(Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', 'A secure password reset link has been sent to your email.')
            : back()->withErrors(['email' => __($status)]);
    }

    public function showResetForm(Request $request, string $token) {
        return view('site.auth.reset-password', ['token' => $token, 'email' => $request->email]);
    }

    public function resetPassword(Request $request) {
        $request->validate([
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill(['password' => $request->password])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', 'Password updated. Please sign in.')
            : back()->withErrors(['email' => __($status)]);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login', ['logged_out' => 1]);
    }

    // OTP Login
    public function showOtpForm() { return view('site.auth.otp'); }

    public function sendOtp(Request $request) {
        $request->validate(['phone' => 'required|string|max:15']);
        $user = User::where('phone', $request->phone)->first();
        if (!$user) {
            return back()->withErrors(['phone' => 'Phone number not registered.']);
        }

        $otp = str_pad(random_int(100000, 999999), 6, '0', STR_PAD_LEFT);
        $user->update(['otp' => $otp, 'otp_expires_at' => now()->addMinutes(10)]);

        // TODO: Integrate SMS gateway (Twilio / MSG91)
        logger('OTP for ' . $user->phone . ': ' . $otp);

        return redirect()->route('login.otp.verify', ['phone' => $request->phone]);
    }

    public function verifyOtp(Request $request) {
        $request->validate(['phone' => 'required', 'otp' => 'required|string|size:6']);
        $user = User::where('phone', $request->phone)->first();

        if (!$user || !$user->isOtpValid() || $user->otp !== $request->otp) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
        }

        $user->update(['otp' => null, 'otp_expires_at' => null, 'phone_verified_at' => now()]);
        Auth::login($user);
        $this->cartService->mergeTo($user->id);
        return redirect()->route('home');
    }
}
