<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Dashboard Login | Godson Law Associate') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Your Vite Assets if needed -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f8f9fa;
            /* light gray background like bg-gray-100 */
            color: #212529;
            /* dark text */
        }
    </style>
</head>

<body>
    <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center pt-4">
        <div>
            <a href="/">
                <x-application-logo class="d-block" style="width: 5rem; height: 5rem; color: #6c757d;" />
            </a>
        </div>

        <div class="w-100" style="max-width: 24rem;">
            <div class="mt-4 p-4 bg-white shadow rounded">
                {{ $slot }}
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
