<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#0b2545">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', SITE_NAME . ' — ' . SITE_TAGLINE)</title>
  <meta name="description" content="@yield('meta_description', 'Authorized clinic for Phonak, Oticon, ReSound, Signia, Starkey, Widex digital hearing aids & sound-booth diagnostic hearing tests in Greater Noida West & Noida.')">
  <meta name="keywords" content="@yield('meta_keywords', '')">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="{{ url()->current() }}">
  <link rel="icon" type="image/png" href="{{ asset(SITE_FAVICON) }}">

  {{-- Open Graph --}}
  <meta property="og:title" content="@yield('title', SITE_NAME)">
  <meta property="og:description" content="@yield('meta_description', SITE_TAGLINE)">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:type" content="website">
  <meta property="og:image" content="@yield('og_image', asset(SITE_LOGO))">

  <!-- Google Fonts (Raleway — Modern, Elegant & Sophisticated) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

  <!-- Bootstrap 5.3 CSS & Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- Design tokens & custom styles -->
  <link rel="stylesheet" href="{{ tm_asset('css/variables.css') }}">
  <link rel="stylesheet" href="{{ tm_asset('css/custom.css') }}">
  <link rel="stylesheet" href="{{ tm_asset('css/responsive.css') }}">
  @stack('styles')
</head>
<body @hasSection('body_class') class="@yield('body_class')" @endif>

  @include('site.partials.header')

  <main id="tmMainContent">
    @include('site.partials.flash')
    @yield('content')
  </main>

  @include('site.partials.footer')

  <!-- ============ SCRIPTS ============ -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    /* Server-driven configuration consumed by assets/js/*.js */
    window.TM = {
      csrf: '{{ csrf_token() }}',
      auth: @json(auth()->check()),
      routes: {
        home:        '{{ route('home') }}',
        products:    '{{ route('products') }}',
        contact:     '{{ route('contact-us') }}',
        search:      '{{ route('search') }}',
        cart:        '{{ route('cart.index') }}',
        cartAdd:     '{{ route('cart.add') }}',
        cartData:    '{{ route('cart.data') }}',
        cartUpdate:  '{{ url('cart') }}',
        cartCoupon:  '{{ route('cart.coupon.apply') }}',
        cartCouponRemove: '{{ route('cart.coupon.remove') }}',
        checkout:    '{{ route('checkout.index') }}',
        wishlist:    '{{ route('wishlist.index') }}',
        wishlistToggle: '{{ route('wishlist.toggle') }}',
        login:       '{{ route('login') }}',
        diagnostics: '{{ route('diagnostic-services') }}',
        repair:      '{{ route('repair') }}',
        appointment: '{{ route('appointments.create') }}',
        appointmentStore: '{{ route('appointments.store') }}',
        appointmentSlots: '{{ route('appointments.slots') }}'
      },
      placeholder: '{{ tm_asset('images/hearing-aid/ric.webp') }}',
      wishlistIds: @json($tmWishlistIds ?? [])
    };
    window.TURTLE_PRODUCTS = @json($tmCatalogue ?? []);
  </script>
  <script src="{{ tm_asset('js/main.js') }}"></script>
  <script src="{{ tm_asset('js/products.js') }}"></script>
  <script src="{{ tm_asset('js/cart.js') }}"></script>
  <script src="{{ tm_asset('js/wishlist.js') }}"></script>
  @stack('scripts')
</body>
</html>
