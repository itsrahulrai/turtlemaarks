<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login | Nexa Health Consult - Your Smart Healthcare Consultants</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <link rel="icon" href="{{ static_asset('front-assets/assets/img/home1/favicon.png') }}" type="image/png" sizes="20x20">

    <style>
        body {
            background: #6cbbf0;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background: #fff;
            border-radius: 16px;
            padding: 2.5rem;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
            text-align: center;
        }


        .logo-wrapper {
            text-align: center;
            /* Center everything */
            margin-bottom: 1rem;
            /* Spacing below logo */
        }

        .login-logo {
            width: 180px;
            height: auto;
            border-radius: 12px;
            display: block;
            margin: 0 auto 16px;
            object-fit: contain;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .login-logo:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
        }



        .logo-text {
            font-size: 1.2rem;
            font-weight: 600;
            color: #314E52;
            /* Brand color */
            margin: 0;
            letter-spacing: 0.5px;
        }


        .login-card h2 {
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            color: #314E52;
        }

        .login-card p.subtitle {
            font-size: 0.9rem;
            color: #777;
            margin-bottom: 1.8rem;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ccc;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #B5895E;
            box-shadow: 0 0 0 4px rgba(181, 137, 94, 0.25);
        }

        .login-btn {
            background: #1276B7;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            text-transform: uppercase;
            padding: 0.75rem;
            color: #fff;
            transition: all 0.3s ease;
        }

        .login-btn:hover {
            background: #1276B7;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(181, 137, 94, 0.4);
        }

        .form-text {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #666;
        }

        .form-text a {
            color: #B5895E;
            text-decoration: none;
            font-weight: 500;
        }

        .form-text a:hover {
            text-decoration: underline;
        }

        .section-subtitle {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    font-size: 22px;
    font-weight: 600;
    letter-spacing: 1.5px;
    color: #d4a017; /* Gold color */
    text-transform: uppercase;
    margin-bottom: 15px;
}

.section-subtitle .start-shape,
.section-subtitle .end-shape {
    width: 40px;
    height: 2px;
    background: linear-gradient(to right, transparent, #d4a017);
}

.section-subtitle .end-shape {
    background: linear-gradient(to left, transparent, #d4a017);
}

.section-subtitle .text {
    font-family: 'Poppins', sans-serif;
    color: #d4a017;
}

    </style>
</head>

<body>
    <div class="login-card">
        <!-- Logo -->
        <div class="logo-wrapper">
            <img src="{{static_asset('assets/images/logo.svg')}}" alt="Logo" style="width: 250px; height: auto;" class="login-logo">
                

        </div>
        <p class="subtitle">Enter your credentials to login</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email / Phone -->
            <div class="mb-3">
                <input type="text" id="email" name="email" value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror" placeholder="Email or Phone" required>
                @error('email')
                <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <input type="password" id="password" name="password"
                    class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
                @error('password')
                <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit -->
            <div class="d-grid">
                <button type="submit" class="btn btn-lg login-btn">Login</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
