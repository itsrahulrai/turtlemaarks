<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Turtle Maarks Hearing Health</title>

    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --kkt-primary: #0C3C64;
            --kkt-secondary: #D6C6A5;
            --kkt-accent: #FF9501;

            --kkt-light: #F8FAFC;
            --kkt-dark: #1E293B;

            --kkt-bg: #FFFFFF;
            --kkt-card: #FFFFFF;

            --kkt-text: #475569;
            --kkt-muted: #94A3B8;

            --kkt-border: #E2E8F0;

            --kkt-shadow: 0 15px 40px rgba(15, 23, 42, .12);

            --kkt-radius: 20px;
            --kkt-radius-sm: 12px;

            --kkt-gradient: linear-gradient(135deg, #0C3C64, #14507F);

            --kkt-gold-gradient: linear-gradient(135deg, #FF9501, #FFB74D);
        }

        * {
            font-family: 'Rubik', sans-serif;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background:
                radial-gradient(circle at top right,
                    rgba(255, 149, 1, .08),
                    transparent 25%),
                linear-gradient(135deg, #EEF4FB 0%, #DCE8F6 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 15px;
            overflow-x: hidden;
        }

        .login-card {
            width: 100%;
            max-width: 430px;
            background: #fff;
            border-radius: var(--kkt-radius);
            padding: 42px;
            border: 1px solid rgba(255, 255, 255, .1);
            box-shadow: var(--kkt-shadow);
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: -80px;
            right: -80px;
            width: 180px;
            height: 180px;
            background: rgba(255, 149, 1, .10);
            border-radius: 50%;
        }

        .login-logo {
            text-align: center;
            margin-bottom: 16px;
        }

        .login-logo img {
            width: 280px;
            /* Increase width */
            height: 120px;
            /* Increase height */
            max-width: 100%;
            object-fit: contain;
            margin-bottom: 20px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .logo-box {
            display: none;
        }

        .form-label {
            font-size: .88rem;
            font-weight: 600;
            color: var(--kkt-dark);
            margin-bottom: 8px;
        }

        .input-group {
            border-radius: var(--kkt-radius-sm);
            overflow: hidden;
            border: 1px solid #e5e7eb;
            transition: .3s;
            background: #fff;
        }

        .input-group:focus-within {
            border-color: var(--kkt-primary);
            box-shadow: 0 0 0 .20rem rgba(12, 60, 100, .08);
        }

        .input-group-text {
            background: #fff;
            border: none;
            color: var(--kkt-primary);
            padding-left: 16px;
            padding-right: 4px;
            font-size: 1rem;
        }

        .form-control {
            border: none;
            height: 52px;
            font-size: .94rem;
            color: var(--kkt-text);
            box-shadow: none !important;
        }

        .form-control::placeholder {
            color: #9ca3af;
        }

        .remember-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 4px;
            margin-bottom: 26px;
        }

        .form-check-label {
            font-size: .86rem;
            color: var(--kkt-muted);
        }

        .form-check-input:checked {
            background-color: var(--kkt-primary);
            border-color: var(--kkt-primary);
        }

        .btn-login {
            width: 100%;
            height: 54px;
            border: none;
            border-radius: 14px;
            background: linear-gradient(135deg, #0C3C64, #14507F);
            color: #fff;
            font-weight: 700;
            font-size: .96rem;
            letter-spacing: .3px;
            transition: all .3s ease;
            box-shadow: 0 12px 25px rgba(0, 0, 0, .18);
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #092f50, #0C3C64);
            transform: translateY(-2px);
            color: #fff;
        }

        .alert-danger {
            border: none;
            background: rgba(220, 53, 69, .08);
            color: #b42318;
            border-radius: 12px;
            font-size: .86rem;
        }

        @media (max-width: 576px) {
            .login-card {
                padding: 30px 22px;
                border-radius: 18px;
            }

            .login-logo {
                margin-bottom: 16px;
                /* Reduce space below logo */
            }

            .login-logo img {
                width: 220px;
                max-width: 100%;
                height: auto;
                /* Remove fixed height */
                display: block;
                margin: 0 auto;
                /* Remove bottom margin */
                object-fit: contain;
            }
        }
        }
    </style>
</head>

<body>

    <div class="login-card">
        <div class="login-logo">

            @if (setting('site_logo'))
                <img src="{{ asset('/storage/' . setting('site_logo')) }}" alt="{{ config('app.name') }}">
            @else
                <img src="{{ asset('frontend-assets/images/logo.png') }}" alt="{{ config('app.name') }}">
            @endif



        </div>

        @if ($errors->any())
            <div class="alert alert-danger py-2 px-3 mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">
                    Email Address
                </label>

                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-envelope"></i>
                    </span>

                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                        placeholder="admin@example.com" required autofocus>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">
                    Password
                </label>

                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-lock"></i>
                    </span>

                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
            </div>

            <div class="remember-box">

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">

                    <label class="form-check-label" for="remember">
                        Remember me
                    </label>
                </div>

            </div>

            <button type="submit" class="btn btn-login">
                <i class="bi bi-shield-lock me-2"></i>
                Sign In
            </button>

        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
