@php
    /** Primary navigation — single source for desktop navbar + mobile offcanvas. */
    $tmNav = [
        ['key' => 'home',     'label' => 'Home',       'url' => route('home')],
        ['key' => 'about',    'label' => 'About Us',   'url' => route('about-us')],
        [
            'key'      => 'services',
            'label'    => 'Services',
            'url'      => route('services.index'),
            'children' => [
                ['label' => 'PTA (Pure Tone Audiometry)',              'url' => route('pta-pure-tone-audiometry')],
                ['label' => 'Tymp (Tympanometry)',                     'url' => route('tymp-tympanometry')],
                ['label' => 'BERA (Brain Evoked Response Audiometry)', 'url' => route('bera-brain-evoked-response-audiometry')],
                ['label' => 'OAE (Oto Acoustic Emission)',             'url' => route('oae-oto-acoustic-emission')],
                ['divider' => true],
                ['label' => 'All Clinical Services',      'url' => route('services.index'),      'icon' => 'bi-grid'],
                ['label' => 'View All Diagnostic Tests',  'url' => route('diagnostic-services'), 'icon' => 'bi-arrow-right-circle', 'highlight' => true],
            ],
        ],
        ['key' => 'products', 'label' => 'Products',   'url' => route('products')],
        ['key' => 'gallery',  'label' => 'Gallery',    'url' => route('gallery')],
        ['key' => 'blogs',    'label' => 'Blogs',      'url' => route('blog.index')],
        ['key' => 'contact',  'label' => 'Contact Us', 'url' => route('contact-us')],
    ];

    $tmSocial = [
        ['icon' => 'bi-facebook',  'url' => 'https://www.facebook.com/turtlemaarks/',                   'title' => 'Facebook',  'class' => 'tm-ref-soc-fb'],
        ['icon' => 'bi-instagram', 'url' => 'https://www.instagram.com/turtlemaarks_hearinghealth/',    'title' => 'Instagram', 'class' => 'tm-ref-soc-ig'],
        ['icon' => 'bi-linkedin',  'url' => 'https://in.linkedin.com/company/turtle-maarks-hearing-health', 'title' => 'LinkedIn', 'class' => 'tm-ref-soc-li'],
        ['icon' => 'bi-whatsapp',  'url' => 'https://wa.me/' . ($siteWhatsApp ?? site_whatsapp()),      'title' => 'WhatsApp',  'class' => 'tm-ref-soc-wa'],
        ['icon' => 'bi-youtube',   'url' => 'https://www.youtube.com/@TurtleMaarksHearingHealth',       'title' => 'YouTube',   'class' => 'tm-ref-soc-yt'],
    ];

    $activeNav = trim($__env->yieldContent('active_nav'));
@endphp

  <!-- ============ TOP UTILITY BAR ============ -->
  <div class="tm-topbar">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <!-- Left: Clinic Direct Channels -->
        <div class="d-flex align-items-center gap-2 gap-md-3">
          <a href="tel:{{ $sitePhoneRaw ?? site_phone_raw() }}" class="tm-topbar-pill tm-topbar-pill-phone" title="Call Clinic Helpline">
            <span class="tm-topbar-pill-icon"><i class="bi bi-telephone-fill"></i></span>
            <span class="tm-topbar-pill-label d-none d-lg-inline"></span>
            <span class="tm-topbar-pill-val">{{ $sitePhone ?? site_phone() }}</span>
          </a>
          <a href="mailto:{{ $siteEmail ?? site_email() }}" class="tm-topbar-pill tm-topbar-pill-mail d-none d-md-inline-flex" title="Email Clinic Team">
            <span class="tm-topbar-pill-icon"><i class="bi bi-envelope-fill"></i></span>
            <span class="tm-topbar-pill-val">{{ $siteEmail ?? site_email() }}</span>
          </a>
        </div>

        <!-- Right: Clinic Live Status & Branded Social Circles -->
        <div class="d-flex align-items-center gap-2 gap-md-3">
          <div class="tm-topbar-timing d-none d-sm-inline-flex align-items-center">
            <span class="tm-live-indicator"><span class="tm-live-pulse"></span></span>
            <span>{{ SITE_HOURS_SHORT }}</span>
          </div>
          <span class="tm-topbar-sep d-none d-sm-inline-block"></span>
          <div class="d-flex align-items-center gap-2">
            @foreach ($tmSocial as $s)
            <a href="{{ $s['url'] }}" target="_blank" rel="noopener" class="tm-ref-social-btn {{ $s['class'] }}" title="{{ $s['title'] }}" aria-label="{{ $s['title'] }}"><i class="bi {{ $s['icon'] }}"></i></a>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ============ STICKY NAVBAR ============ -->
  <header class="tm-header">
    <div class="container">
      <nav class="navbar navbar-expand-lg py-2">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
          <img src="{{ asset(SITE_LOGO) }}" alt="{{ SITE_NAME }}" class="tm-brand-logo">
        </a>

        <!-- Mobile Header Quick Actions (Cart & Toggle) -->
        <div class="d-flex d-lg-none align-items-center gap-2 ms-auto">
          <button type="button" class="tm-icon-btn position-relative" data-bs-toggle="offcanvas" data-bs-target="#tmCartDrawer" title="Cart" aria-label="Shopping Cart">
            <i class="bi bi-bag"></i>
            <span class="tm-badge-count tm-cart-badge-count" style="{{ ($cartCount ?? 0) > 0 ? '' : 'display:none;' }}">{{ $cartCount ?? 0 }}</span>
          </button>

          <button class="navbar-toggler border-0 shadow-none p-0 d-flex align-items-center justify-content-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#tmMobileNav" aria-label="Toggle navigation">
            <i class="bi bi-list fs-2 text-navy"></i>
          </button>
        </div>

        <div class="collapse navbar-collapse justify-content-center d-none d-lg-flex">
          <ul class="navbar-nav align-items-center gap-1">
            @foreach ($tmNav as $item)
              @if (empty($item['children']))
                <li class="nav-item">
                  <a class="nav-link tm-nav-link {{ $activeNav === $item['key'] ? 'active' : '' }}" href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                </li>
              @else
                <li class="nav-item dropdown">
                  <a class="nav-link tm-nav-link dropdown-toggle {{ $activeNav === $item['key'] ? 'active' : '' }}" href="{{ $item['url'] }}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ $item['label'] }}
                  </a>
                  <ul class="dropdown-menu tm-dropdown-menu">
                    @foreach ($item['children'] as $child)
                      @if (!empty($child['divider']))
                        <li><hr class="dropdown-divider border-white-10 my-1"></li>
                      @else
                        <li>
                          <a class="dropdown-item tm-dropdown-item {{ !empty($child['highlight']) ? 'text-orange fw-bold' : '' }}" href="{{ $child['url'] }}">
                            @if (!empty($child['icon']))<i class="bi {{ $child['icon'] }} {{ empty($child['highlight']) ? 'text-warning' : '' }} me-1"></i>@endif{{ $child['label'] }}
                          </a>
                        </li>
                      @endif
                    @endforeach
                  </ul>
                </li>
              @endif
            @endforeach
          </ul>
        </div>

        <div class="d-none d-lg-flex align-items-center gap-2">
          <a href="{{ route('wishlist.index') }}" class="tm-icon-btn" title="Wishlist"><i class="bi bi-heart"></i><span class="tm-badge-count tm-wishlist-badge-count" style="display:none;">0</span></a>
          <button type="button" class="tm-icon-btn position-relative" data-bs-toggle="offcanvas" data-bs-target="#tmCartDrawer" title="Cart"><i class="bi bi-bag"></i><span class="tm-badge-count tm-cart-badge-count" style="{{ ($cartCount ?? 0) > 0 ? '' : 'display:none;' }}">{{ $cartCount ?? 0 }}</span></button>
          @auth
            <a href="{{ route('account.dashboard') }}" class="tm-icon-btn" title="Patient Portal"><i class="bi bi-person-check"></i></a>
          @else
            <a href="{{ route('login') }}" class="tm-icon-btn" title="Patient Portal"><i class="bi bi-person"></i></a>
          @endauth
          <a href="{{ route('appointments.create') }}" class="tm-btn-appointment ms-1" title="Book Doctor Appointment">
            <i class="bi bi-calendar2-check"></i>
            <span>Appointment</span>
          </a>
        </div>
      </nav>
    </div>
  </header>

  <!-- ============ MOBILE OFFCANVAS NAV ============ -->
  <div class="offcanvas offcanvas-start" tabindex="-1" id="tmMobileNav">
    <div class="offcanvas-header border-bottom">
      <img src="{{ asset(SITE_LOGO) }}" alt="{{ SITE_SHORT }}" style="height: 52px; width: auto; object-fit: contain;">
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <ul class="navbar-nav mb-4">
        @foreach ($tmNav as $i => $item)
          @if (empty($item['children']))
            <li class="nav-item"><a class="nav-link fw-bold text-navy py-2" href="{{ $item['url'] }}">{{ $item['label'] }}</a></li>
          @else
            <li class="nav-item">
              <a class="nav-link fw-bold text-navy py-2 d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#tmMobileSub{{ $i }}" role="button" aria-expanded="false">
                {{ $item['label'] }} <i class="bi bi-chevron-down small"></i>
              </a>
              <div class="collapse ps-3" id="tmMobileSub{{ $i }}">
                <ul class="list-unstyled small py-1">
                  @foreach ($item['children'] as $child)
                    @if (empty($child['divider']))
                      <li>
                        <a class="nav-link py-1 {{ !empty($child['highlight']) ? 'text-orange fw-bold' : 'text-secondary' }}" href="{{ $child['url'] }}">
                          {{ empty($child['highlight']) ? '• ' : '' }}{{ $child['label'] }}{{ !empty($child['highlight']) ? ' →' : '' }}
                        </a>
                      </li>
                    @endif
                  @endforeach
                </ul>
              </div>
            </li>
          @endif
        @endforeach
        <li class="nav-item"><a class="nav-link fw-bold text-navy py-2" href="{{ route('wishlist.index') }}">Wishlist</a></li>
        @auth
          <li class="nav-item"><a class="nav-link fw-bold text-navy py-2" href="{{ route('account.dashboard') }}"><i class="bi bi-person-check me-1"></i> My Account</a></li>
        @else
          <li class="nav-item"><a class="nav-link fw-bold text-navy py-2" href="{{ route('login') }}"><i class="bi bi-person me-1"></i> Login</a></li>
        @endauth
      </ul>
      <div class="d-grid gap-2">
        <a href="{{ route('appointments.create') }}" class="tm-btn-appointment w-100 justify-content-center py-2 fs-6">
          <i class="bi bi-calendar2-check"></i>
          <span>Appointment</span>
        </a>
        <a href="{{ route('cart.index') }}" class="tm-btn tm-btn-outline-navy w-100">View Cart</a>
      </div>
      <div class="d-flex gap-2 mt-3 pt-3 border-top">
        @foreach ($tmSocial as $s)
        <a href="{{ $s['url'] }}" target="_blank" rel="noopener" class="tm-ref-social-btn {{ $s['class'] }}" title="{{ $s['title'] }}" aria-label="{{ $s['title'] }}"><i class="bi {{ $s['icon'] }}"></i></a>
        @endforeach
      </div>
    </div>
  </div>
