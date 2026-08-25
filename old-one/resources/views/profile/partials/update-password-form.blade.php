<div class="container my-5 border">
<section class="mb-5 mt-4">
    <header>
        <h2 class="h5" style="color:#314E52;">
            {{ __('Update Password') }}
        </h2>
        <p class="small mt-1" style="color:#6c757d;">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="POST" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="update_password_current_password" class="form-label fw-semibold" style="color:#314E52;">
                {{ __('Current Password') }}
            </label>
            <input type="password" class="form-control border-0 shadow-sm" id="update_password_current_password"
                name="current_password" autocomplete="current-password" style="background-color:#f8f9fa;">
            @if ($errors->updatePassword->has('current_password'))
                <div class="text-danger mt-1 small">
                    {{ $errors->updatePassword->first('current_password') }}
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="update_password_password" class="form-label fw-semibold" style="color:#314E52;">
                {{ __('New Password') }}
            </label>
            <input type="password" class="form-control border-0 shadow-sm" id="update_password_password"
                name="password" autocomplete="new-password" style="background-color:#f8f9fa;">
            @if ($errors->updatePassword->has('password'))
                <div class="text-danger mt-1 small">
                    {{ $errors->updatePassword->first('password') }}
                </div>
            @endif
        </div>

        <div class="mb-4">
            <label for="update_password_password_confirmation" class="form-label fw-semibold" style="color:#314E52;">
                {{ __('Confirm Password') }}
            </label>
            <input type="password" class="form-control border-0 shadow-sm"
                id="update_password_password_confirmation" name="password_confirmation"
                autocomplete="new-password" style="background-color:#f8f9fa;">
            @if ($errors->updatePassword->has('password_confirmation'))
                <div class="text-danger mt-1 small">
                    {{ $errors->updatePassword->first('password_confirmation') }}
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn" style="background-color:#1276B7; color:#fff;">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'password-updated')
                <p class="text-success small mb-0" x-data="{ show: true }" x-show="show" x-transition
                    x-init="setTimeout(() => show = false, 2000)">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
</div>
