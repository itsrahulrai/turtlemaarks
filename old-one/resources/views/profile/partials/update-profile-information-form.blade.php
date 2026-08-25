
<div class="container my-5 border">
<section class="mb-5 mt-4">
    <header>
        <h2 class="h5" style="color:#314E52;">
            {{ __('Profile Information') }}
        </h2>
        <p class="small mt-1" style="color:#6c757d;">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <!-- Email Verification Form -->
    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- Profile Update Form -->
    <form method="POST" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label fw-semibold" style="color:#314E52;">{{ __('Name') }}</label>
            <input id="name" name="name" type="text" class="form-control border-0 shadow-sm"
                value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                style="background-color:#f8f9fa;">
            @if ($errors->has('name'))
                <div class="text-danger mt-1 small">
                    {{ $errors->first('name') }}
                </div>
            @endif
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label fw-semibold" style="color:#314E52;">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" class="form-control border-0 shadow-sm"
                value="{{ old('email', $user->email) }}" required autocomplete="username"
                style="background-color:#f8f9fa;">
            @if ($errors->has('email'))
                <div class="text-danger mt-1 small">
                    {{ $errors->first('email') }}
                </div>
            @endif

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="small text-muted mb-1">
                        {{ __('Your email address is unverified.') }}

                        <button type="submit" form="send-verification"
                            class="btn btn-link p-0 align-baseline small"
                            style="color:#BB996E; text-decoration:underline;">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="text-success small">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Submit -->
        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn" style="background-color:#1276B7; color:#fff;">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-success small mb-0">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
</div>

