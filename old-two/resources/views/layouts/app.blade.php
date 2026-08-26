<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name')) - {{ setting('site_tagline', 'Premium Shopping') }}</title>
    <meta name="description" content="@yield('meta_description', setting('meta_description', ''))">
    <meta name="keywords" content="@yield('meta_keywords', setting('meta_keywords', ''))">

    {{-- Open Graph --}}
    <meta property="og:title" content="@yield('og_title', config('app.name'))">
    <meta property="og:description" content="@yield('og_description', '')">
    <meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    {{-- Favicon --}}
    <link rel="icon"
        href="{{ setting('site_favicon') ? asset('storage/' . setting('site_favicon')) : asset('images/favicon.png') }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css">

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ base_public_url('assets/css/style.css') }}">
    @stack('styles')
    <style>
        .dropdown-submenu {
    position: relative;
}

.dropdown-submenu > .dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -1px;
    display: none;
}

.dropdown-submenu:hover > .dropdown-menu {
    display: block;
}

.dropdown-submenu > .dropdown-toggle::after {
    float: right;
    margin-top: 8px;
    transform: rotate(-90deg);
}
    </style>
</head>

<body>

    {{-- Top Bar --}}
    <div class="premium-topbar">
        <div class="topbar-left">
            @if(setting('site_email'))
            <a href="mailto:{{ setting('site_email') }}">
                <i class="bi bi-envelope"></i>
              {{ setting('site_email') }}
            </a>
            @endif
             @if(setting('site_phone'))
            <a href="tel:{{ setting('site_phone') }}">
                <i class="bi bi-telephone"></i>
              {{ setting('site_phone') }}
            </a>
            @endif

        </div>

        <div class="topbar-right">
            <span class="follow-label">
                Follow Us
            </span>
            <a href="https://www.facebook.com/CenterForPilesandFistula">
                <i class="bi bi-facebook"></i>
            </a>
            <a href="https://www.instagram.com/cpf_centreforpiles">
                <i class="bi bi-instagram"></i>
            </a>
            <a href="#">
                <i class="bi bi-twitter-x"></i>
            </a>
            <a href="#">
                <i class="bi bi-linkedin"></i>
            </a>
        </div>

    </div>

    <nav class="navbar navbar-expand-lg navbar-kkt py-0">

        <div class="container">

            {{-- LOGO --}}
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                @if (setting('site_logo'))
                    <img src="{{ asset('public/storage/' . setting('site_logo')) }}" alt="{{ config('app.name') }}">
                @else
                   <p>Logo</p>
                @endif

            </a>

            {{-- MOBILE RIGHT --}}
            <div class="mobile-header-actions d-lg-none">

                {{-- Mobile Cart --}}
                <a href="{{ route('cart.index') }}" class="btn btn-light cart-icon mobile-cart-btn" title="Cart">

                    <i class="bi bi-bag"></i>

                    <span class="cart-badge" id="mobile-cart-count">
                        {{ app(\App\Services\CartService::class)->count() }}
                    </span>

                </a>


                {{-- TOGGLER --}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">

                    <span class="navbar-toggler-icon"></span>

                </button>

            </div>



            {{-- NAVBAR COLLAPSE --}}
            <div class="collapse navbar-collapse" id="navMain">

                {{-- MENU --}}
                <ul class="navbar-nav">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">
                            About
                        </a>
                    </li>

                   @php
                        $categories = \App\Models\Category::with('subcategories')
                            ->orderBy('name')
                            ->get();
                    @endphp
                   <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="{{ route('shop') }}" role="button"
        data-bs-toggle="dropdown">
        Products
    </a>

    <ul class="dropdown-menu category-dropdown">

        @foreach ($categories as $cat)
            @if($cat->subcategories->count())
                <li class="dropdown-submenu">
                    <a class="dropdown-item dropdown-toggle"
                        href="{{ route('shop.category', $cat->slug) }}">
                        {{ $cat->name }}
                    </a>

                    <ul class="dropdown-menu">
                        @foreach($cat->subcategories as $sub)
                            <li>
                              <a class="dropdown-item"
                                    href="{{ route('shop.subcategory', [
                                        'categorySlug' => $cat->slug,
                                        'subcategorySlug' => $sub->slug,
                                    ]) }}">
                                    {{ $sub->name }}
                                </a>
                                                            </li>
                        @endforeach
                    </ul>
                </li>
            @else
                <li>
                    <a class="dropdown-item"
                        href="{{ route('shop.category', $cat->slug) }}">
                        {{ $cat->name }}
                    </a>
                </li>
            @endif
        @endforeach

    </ul>
</li>

                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('shop') }}">
                            Shop
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blog.index') }}">
                            Blogs
                        </a>
                    </li> --}}

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">
                            Contact
                        </a>
                    </li>

                </ul>



                {{-- RIGHT SIDE --}}
                <div class="mobile-auth-buttons">

                    {{-- Wishlist --}}
                    @auth
                        <a href="{{ route('wishlist.index') }}" class="btn btn-light cart-icon" title="Wishlist">

                            <i class="bi bi-heart"></i>

                        </a>
                    @endauth


                    {{-- DESKTOP CART --}}
                    <a href="{{ route('cart.index') }}" class="btn btn-light cart-icon desktop-cart" title="Cart">

                        <i class="bi bi-bag"></i>

                        <span class="cart-badge"  id="desktop-cart-count">
                            {{ app(\App\Services\CartService::class)->count() }}
                        </span>

                    </a>



                    {{-- USER --}}
                    @auth

                        <div class="dropdown">

                            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">

                                <i class="bi bi-person-circle me-1"></i>

                                {{ Str::words(Auth::user()->name, 1, '') }}

                            </button>

                            <ul class="dropdown-menu dropdown-menu-end">

                                <li>
                                    <a class="dropdown-item" href="{{ route('account.dashboard') }}">

                                        <i class="bi bi-speedometer2 me-2"></i>

                                        Dashboard
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="{{ route('account.orders') }}">

                                        <i class="bi bi-box me-2"></i>

                                        Orders
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="{{ route('account.profile') }}">

                                        <i class="bi bi-person me-2"></i>

                                        Profile
                                    </a>
                                </li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li>
                                    <form method="POST" action="{{ route('logout') }}">

                                        @csrf

                                        <button class="dropdown-item text-danger">

                                            <i class="bi bi-box-arrow-right me-2"></i>

                                            Logout

                                        </button>

                                    </form>
                                </li>

                            </ul>

                        </div>
                    @else
                        {{-- LOGIN --}}
                        <a href="{{ route('login') }}" class="btn btn-outline-pink">

                            Login

                        </a>


                        {{-- REGISTER --}}
                        <a href="{{ route('register') }}" class="btn btn-primary">

                            Join & Shop

                        </a>

                    @endauth

                </div>

            </div>

        </div>

    </nav>

    {{-- Flash Messages --}}
    @if (session('success') || session('error'))
        <div class="toast-container">
            <div class="toast show align-items-center text-white {{ session('success') ? 'bg-success' : 'bg-danger' }} border-0"
                role="alert">
                <div class="d-flex">
                    <div class="toast-body">{{ session('success') ?? session('error') }}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast"></button>
                </div>
            </div>
        </div>
    @endif

    {{-- Main Content --}}
    @yield('content')
    
  <footer class="gw-footer">

    {{-- Trust badges --}}
    <div class="gw-trust d-none d-md-flex">
        <div class="container">
            <div class="gw-trust-row">
                <div class="gw-trust-item"><i class="bi bi-patch-check-fill"></i><span>100% Genuine Medicines</span></div>
                <div class="gw-trust-item"><i class="bi bi-award-fill"></i><span>WHO-GMP Certified</span></div>
                <div class="gw-trust-item"><i class="bi bi-shield-lock-fill"></i><span>Secure SSL Payment</span></div>
                <div class="gw-trust-item"><i class="bi bi-shield-check"></i><span>Safe & Effective</span></div>
                <div class="gw-trust-item"><i class="bi bi-heart-pulse-fill"></i><span>Trusted Healthcare Brand</span></div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="gw-cols">

            {{-- About --}}
            <div class="gw-col gw-brand">
                <a href="{{ route('home') }}" class="gw-logo">
                    @if (setting('site_logo'))
                        <img src="{{ asset('public/storage/' . setting('site_logo')) }}" alt="{{ config('app.name') }}">
                    @else
                        <img src="{{ base_public_url('assets/img/kkt.png') }}" alt="{{ config('app.name') }}">
                    @endif
                </a>
                <p>{{ setting('site_tagline', 'Turtle Maarks Hearing Health is your trusted partner for hearing care, diagnostics, and speech therapy services.') }}</p>
            </div>

            {{-- Quick Links --}}
            <div class="gw-col">
                <h6>Quick Links</h6>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('shop') }}">Shop</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>

            {{-- Product Categories --}}
           <div class="gw-col">
                    <h6>Categories</h6>
                    @php
                        $categories = \App\Models\Category::orderBy('name')
                                        ->take(6)
                                        ->get();
                    @endphp

                    <ul>
                        @forelse($categories as $category)
                            <li>
                                <a href="{{ route('shop', ['category' => $category->slug]) }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @empty
                            <li>No categories found.</li>
                        @endforelse
                    </ul>
                </div>

            {{-- Customer Support --}}
            <div class="gw-col">
                <h6>Useful Links</h6>
                <ul>
                    @if($footerPages && $footerPages->count())
                        @foreach($footerPages as $page)
                            <li><a href="{{ route('page.show', $page->slug) }}">{{ $page->title }}</a></li>
                        @endforeach
                    @endif
                </ul>
            </div>

            {{-- Contact --}}
            <div class="gw-col">
                <h6>Contact Us</h6>
                <ul class="gw-contact">
                    <li><i class="bi bi-geo-alt-fill"></i> {{ setting('site_address', 'Address') }}</li>
                    @if(setting('site_phone'))
                    <li><i class="bi bi-telephone-fill"></i> <a href="tel:{{ setting('site_phone') }}">{{ setting('site_phone') }}</a></li>
                    @endif
                    @if(setting('site_email'))
                    <li><i class="bi bi-envelope-fill"></i> <a href="mailto:{{ setting('site_email') }}">{{ setting('site_email') }}</a></li>
                    @endif
                </ul>
            </div>

        </div>

    </div>

    {{-- Bottom --}}
    <div class="gw-bottom">
        <div class="container">
            <div class="gw-bottom-inner">
                <div class="gw-copy">© {{ date('Y') }} {{ setting('site_name', 'Turtle Maarks Hearing Health') }}. All Rights Reserved.</div>

                
        {{-- Social --}}
       
                <div class="gw-pay">
                    
            <div class="gw-social">
                <a href="https://www.facebook.com/CenterForPilesandFistula"><i class="bi bi-facebook"></i></a>
                <a href="https://www.instagram.com/cpf_centreforpiles"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-linkedin"></i></a>
                <a href="https://www.youtube.com/channel/UCohZYth9o6O_8UBeEagIhFA"><i class="bi bi-youtube"></i></a>
                <a href="#"><i class="bi bi-whatsapp"></i></a>
            </div>
        
                </div>
            </div>
        </div>
    </div>

</footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        // CSRF setup for AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Auto-dismiss toasts
        setTimeout(() => {
            document.querySelectorAll('.toast').forEach(t => new bootstrap.Toast(t, {
                autohide: true,
                delay: 3500
            }).hide());
        }, 3500);

        // AJAX Search
        let searchTimeout;
        $('#search-input').on('input', function() {
            const q = $(this).val().trim();
            clearTimeout(searchTimeout);
            if (q.length < 2) {
                $('#search-results-dropdown').addClass('d-none').empty();
                return;
            }
            searchTimeout = setTimeout(() => {
                $.get('{{ route('search.ajax') }}', {
                    q
                }, function(data) {
                    const $d = $('#search-results-dropdown');
                    if (!data.length) {
                        $d.addClass('d-none');
                        return;
                    }
                    let html = data.map(p => `
                <a href="${p.url}" class="search-item">
                    <img src="${p.image}" alt="${p.name}">
                    <div><div style="font-size:.88rem;font-weight:600;">${p.name}</div>
                    <div style="color:var(--kkt-primary);font-weight:700;">₹${parseFloat(p.price).toFixed(2)}</div></div>
                </a>`).join('');
                    $d.html(html).removeClass('d-none');
                });
            }, 300);
        });

        $(document).on('click', function(e) {
            if (!$(e.target).closest('form').length) $('#search-results-dropdown').addClass('d-none');
        });

        // Add to Cart AJAX
        $(document).on('click', '.btn-add-to-cart', function(e) {
            e.preventDefault();
            const btn = $(this);
            const productId = btn.data('product-id');
            const variantId = btn.data('variant-id') || null;
            const qty = parseInt($('#qty-input').val() || 1);

            $.post('{{ route('cart.add') }}', {
                    product_id: productId,
                    product_variant_id: variantId,
                    quantity: qty
                })
                 .done(res => {
                    if (res.success) {
                         $('#mobile-cart-count').text(res.count);
                            $('#desktop-cart-count').text(res.count);
                        showToast(res.message, 'success');
                    }
                });
        });

        // Wishlist toggle
        $(document).on('click', '.btn-wishlist', function(e) {
            e.preventDefault();
            @guest
            return;
        @endguest
        const btn = $(this); $.post('{{ route('wishlist.toggle') }}', {
            product_id: btn.data('product-id')
        })
        .done(res => {
            if (res.success) {
                btn.toggleClass('wishlisted', res.inWishlist);
                btn.find('i').toggleClass('bi-heart', !res.inWishlist).toggleClass('bi-heart-fill', res
                    .inWishlist);
                showToast(res.message, res.inWishlist ? 'success' : 'warning');
            }
        });
        });

        function showToast(msg, type = 'success') {
            const id = 'toast-' + Date.now();
            const bg = type === 'success' ? 'bg-success' : (type === 'danger' ? 'bg-danger' : 'bg-warning text-dark');
            const html =
                `<div id="${id}" class="toast show align-items-center text-white ${bg} border-0 mb-2" role="alert">
        <div class="d-flex"><div class="toast-body">${msg}</div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button></div></div>`;
            let container = document.querySelector('.toast-container');
            if (!container) {
                container = document.createElement('div');
                container.className = 'toast-container';
                document.body.appendChild(container);
            }
            container.insertAdjacentHTML('beforeend', html);
            setTimeout(() => document.getElementById(id)?.remove(), 3500);
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js"></script>
    <script>
        (function() {
            'use strict';
         const REELS = [
        {id:1, videoId:'uAmxdUDmJKw'},
        {id:2, videoId:'bIqAijsjH08'},
        {id:3, videoId:'Aw6QwM01kG8'},
        {id:4, videoId:'rIuwqzQO_xQ'},
        {id:5, videoId:'3P10tqraZsg'},
        { id: 6, videoId: 'lseFh9qG3g8'}
        ];

            /* ============================================================
               2. DOM REFS
            ============================================================ */
            const phoneScreen = document.querySelector('.rs-screen');
            const stripSlides = document.querySelectorAll('.rs-strip-slide');
            const stripCards = document.querySelectorAll('.rs-strip-card');

            /* Phone screen elements */
            const elMainVideo = document.getElementById('rsMainVideo');
            const elProdCat = document.querySelector('.rs-prod-cat');
            const elProdName = document.querySelector('.rs-prod-name');
            const elProdPrice = document.querySelector('.rs-prod-price');
            const elLikes = document.querySelectorAll('.rs-action-btn')[0]?.querySelector('p');
            const elComments = document.querySelectorAll('.rs-action-btn')[1]?.querySelector('p');

            /* ============================================================
               3. UPDATE PHONE with selected reel data
            ============================================================ */
            function updatePhone(index) {
                const reel = REELS[index];
                if (!reel) return;

                /* ---- Update placeholder / video ---- */
                if (elMainVideo) {
                    
                   const frame = document.getElementById('rsYoutubeFrame');
                        if(frame){

                           frame.src =
                            'https://www.youtube-nocookie.com/embed/' +
                            reel.videoId +
                            '?autoplay=1&mute=1&controls=0&playsinline=1';

                        }
                        
                }

                /* ---- Animate screen transition ---- */
                if (phoneScreen) {
                    phoneScreen.style.opacity = '0';
                    phoneScreen.style.transform = 'scale(0.97)';
                    setTimeout(function() {
                        phoneScreen.style.transition = 'opacity .35s ease, transform .35s ease';
                        phoneScreen.style.opacity = '1';
                        phoneScreen.style.transform = 'scale(1)';
                    }, 80);
                }
            }

            /* ============================================================
               4. SET ACTIVE CARD
            ============================================================ */
            function setActiveCard(index) {
                stripCards.forEach(function(card, i) {
                    if (i === index) {
                        card.classList.add('rs-active-card');
                    } else {
                        card.classList.remove('rs-active-card');
                    }
                });
                updatePhone(index);
            }

            /* ============================================================
               5. CLICK HANDLERS on strip cards
            ============================================================ */
            stripCards.forEach(function(card, i) {
                card.addEventListener('click', function() {
                    setActiveCard(i);
                    /* If swiper exists, slide to that index */
                    if (window._rsSwiper) {
                        window._rsSwiper.slideTo(i);
                    }
                });
            });

            /* ============================================================
               6. SWIPER — Vertical strip (auto-advances every 3s)
            ============================================================ */
            document.addEventListener('DOMContentLoaded', function() {

                /* Detect tablet/mobile for direction */
                const isMobile = window.innerWidth <= 900;

                window._rsSwiper = new Swiper('#rsStripSwiper', {
                    direction: isMobile ? 'horizontal' : 'vertical',
                    slidesPerView: isMobile ? 1.4 : 5,
                    spaceBetween: 16,
                    loop: !isMobile,
                    speed: isMobile ? 600 : 900,
                    grabCursor: true,
                    freeMode: isMobile,
                    centeredSlides: false,
                    autoplay: isMobile ? false : {
                        delay: 2000,
                        disableOnInteraction: false
                    },
                    mousewheel: false,
                    on: {
                        slideChange: function () {
                            const idx = this.realIndex % REELS.length;
                            setActiveCard(idx);
                        }
                    }

                });

                /* Initial state */
                setActiveCard(0);

                /* ---- Pause autoplay when user hovers the phone ---- */
                const phoneEl = document.getElementById('rsPhone');
                if (phoneEl && window._rsSwiper) {
                    phoneEl.addEventListener('mouseenter', function() {
                        window._rsSwiper.autoplay.stop();
                    });
                    phoneEl.addEventListener('mouseleave', function() {
                        window._rsSwiper.autoplay.start();
                    });
                }
            });

            /* ============================================================
               7. RESIZE HANDLER — re-init swiper direction on breakpoint
            ============================================================ */
            let _resizeTimer;
            window.addEventListener('resize', function() {
                clearTimeout(_resizeTimer);
                _resizeTimer = setTimeout(function() {
                    if (window._rsSwiper) {
                        window._rsSwiper.destroy(true, true);
                    }
                    const isMob = window.innerWidth <= 900;
                    window._rsSwiper = new Swiper('#rsStripSwiper', {
                        direction: isMob ? 'horizontal' : 'vertical',
                      slidesPerView: isMob ? 1.4 : 5,
                       slidesPerView: isMob ? 1.4 : 5,
                            spaceBetween: 16,
                            loop: !isMob,
                            freeMode: isMob,
                            speed: isMob ? 600 : 900,
                        autoplay: {
                            delay: 8000,
                            disableOnInteraction: false,
                            pauseOnMouseEnter: true,
                        },
                        on: {
                            slideChange: function() {
                                const idx = this.realIndex % REELS.length;
                                setActiveCard(idx);
                            }
                        }
                    });
                }, 250);
            });

        })();
    </script>

    @stack('scripts')
</body>

</html>
