<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

  <title>@yield('title', config('app.name', 'Frontline Logistics'))</title>



<!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="icon" href="{{ static_asset('front-assets/assets/img/home1/favicon.png') }}" type="image/gif"
        sizes="20x20" />

    <link rel="stylesheet" href="{{ static_asset('backend/css/style.css') }}">


    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.css" rel="stylesheet">

    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    <!-- Bootstrap Icons CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">


</head>

<body style="font-family: 'Figtree', sans-serif;">
    <div class="min-vh-100 bg-light"> {{-- Bootstrap light background for main container --}}
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow-sm py-3 mb-4">
                <div class="container">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="container-fluid p-0">
            {{ $slot }}
        </main>
    </div>



    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap 5 JS Bundle with Popper (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <!-- jQuery (Required for Toastr) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 250, // height of editor
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['fontsize', 'color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>


    <!-- Show Toastr Message -->
    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif
    </script>

    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000"
        };
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toastEl = document.getElementById('successToast');
            if (toastEl) {
                const toast = new bootstrap.Toast(toastEl);
                toast.show();
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
                    let nameInput = document.getElementById('name');
                    let slugInput = document.getElementById('slug');

                    nameInput.addEventListener('keyup', function() {

                            if (!slugInput.dataset.edited) {
                                slugInput.value = this.value
                                    .toLowerCase()
                                    .replace(/[^a-z0-9\s-]/g, '')
                                    .trim()
                                    .replace(/\s+/g, '-');
                            }); slugInput.addEventListener('input', function() {
                            this.dataset.edited = true;
                        });
                    });
    </script>





</body>

</html>
