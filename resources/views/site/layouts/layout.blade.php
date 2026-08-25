<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', config('app.name'))</title>
    <!-- <meta name="meta-title" content="@yield('meta-title', config('app.name'))"> -->
        <meta name="google-site-verification" content="ahiVUWelvmK2tICsQppULgxTOop8f5EwM7-D3aJaDnQ" />
        <meta name="description" content="@yield('description', '')">
        <meta name="keywords" content="@yield('keywords', '')">
        <meta name="robots" content="index, follow">
    <!-- Canonical -->
    <link rel="canonical" href="{{ url()->current() }}">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('frontend-assets/images/favicon.png') }}">


    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('frontend-assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend-assets/css/font-awsome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend-assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend-assets/css/icofont.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend-assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend-assets/css/meanmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend-assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend-assets/css/style.css') }}">



</head>

<body>

    <div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">Book Your Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="row justify-content-center">
                    <div class="p-3" style="max-width:auto;">
                        <div class="modal-body">
                        <form action="{{ route('appointments.create') }}" method="GET">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="tel" name="phone" class="form-control" placeholder="Phone No" required>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <select name="service" class="form-control" required>
                                            <option value="">Select Service</option>
                                            @foreach($activeServices ?? [] as $svc)
                                                <option value="{{ $svc->id }}">{{ $svc->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-danger">Book Now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Header Area Start Here -->
    @include('site.includes.header')
    <!-- Header Area End Here -->
    <!-- Booking Modal -->



     @yield('content')


    <!-- Footer Area Start Here -->
    @include('site.includes.footer')
    <!-- Footer Area End Here -->
    
        <a href="https://wa.me/+918130495476" class="float" target="_blank">
    <i class="icofont-whatsapp my-float"></i>
    </a>
    


    <script>window.$zoho=window.$zoho || {};$zoho.salesiq=$zoho.salesiq||{ready:function(){}}</script>
    <script id="zsiqscript" src="https://salesiq.zohopublic.in/widget?wc=siq82a24f1418b7ee4def6296b6265421285e7ec1a8c75811c95c4672268dc854aa" defer></script>
   

    <!-- Javascript Files -->
    <script src="{{ asset('frontend-assets/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('frontend-assets/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend-assets/js/vendor/slick.min.js') }}"></script>
    <script src="{{ asset('frontend-assets/js/vendor/counterup.min.js') }}"></script>
    <script src="{{ asset('frontend-assets/js/vendor/jquery.meanmenu.min.js') }}"></script>
    <script src="{{ asset('frontend-assets/js/vendor/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend-assets/js/vendor/waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend-assets/js/vendor/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend-assets/js/vendor/easing.min.js') }}"></script>
    <script src="{{ asset('frontend-assets/js/vendor/wow.min.js') }}"></script>
    <script src="{{ asset('frontend-assets/js/main.js') }}"></script>
  @stack('scripts')
</body>

</html>