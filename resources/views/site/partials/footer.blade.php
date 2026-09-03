  <!-- ============ FOOTER ============ -->
  <footer class="tm-footer">

    <!-- MAIN 5-COLUMN FOOTER -->
    <div class="tm-footer-ref-main">
      <div class="container">
        <div class="row g-4 g-lg-0 tm-ref-row">

          <!-- Column 1: Brand, Tagline & Social -->
          <div class="col-lg-3 col-md-6 tm-ref-col tm-ref-col-brand">
            <a href="{{ route('home') }}" class="d-inline-block mb-3">
              <img src="{{ asset(SITE_LOGO) }}" alt="{{ SITE_SHORT }}" class="tm-ref-logo">
            </a>
            <p class="tm-ref-brand-desc">
              {{ SITE_NAME }} &mdash; Premier audiology clinic in Greater Noida West dedicated to digital hearing restoration, sound-booth diagnostics, and speech therapy.
            </p>
            <div class="tm-ref-red-line"></div>
            <div class="tm-ref-follow-label">FOLLOW US</div>
            <div class="d-flex align-items-center gap-2 tm-ref-social-row">
              <a href="https://www.facebook.com/turtlemaarks/" target="_blank" rel="noopener" class="tm-ref-social-btn tm-ref-soc-fb" title="Facebook" aria-label="Facebook">
                <i class="bi bi-facebook"></i>
              </a>
              <a href="https://www.instagram.com/turtlemaarks_hearinghealth/" target="_blank" rel="noopener" class="tm-ref-social-btn tm-ref-soc-ig" title="Instagram" aria-label="Instagram">
                <i class="bi bi-instagram"></i>
              </a>
              <a href="https://in.linkedin.com/company/turtle-maarks-hearing-health" target="_blank" rel="noopener" class="tm-ref-social-btn tm-ref-soc-li" title="LinkedIn" aria-label="LinkedIn">
                <i class="bi bi-linkedin"></i>
              </a>
              <a href="https://wa.me/{{ SITE_WHATSAPP }}" target="_blank" rel="noopener" class="tm-ref-social-btn tm-ref-soc-wa" title="WhatsApp" aria-label="WhatsApp">
                <i class="bi bi-whatsapp"></i>
              </a>
              <a href="https://www.youtube.com/@TurtleMaarksHearingHealth" target="_blank" rel="noopener" class="tm-ref-social-btn tm-ref-soc-yt" title="YouTube" aria-label="YouTube">
                <i class="bi bi-youtube"></i>
              </a>
            </div>

            <div class="tm-ref-trust-tag mt-3">
              <span class="badge rounded-pill bg-light text-navy border py-2 px-3 fw-semibold">
                <i class="bi bi-shield-check text-orange me-1"></i> RCI Certified Audiologists
              </span>
            </div>
          </div>

          <!-- Column 2: Company -->
          <div class="col-lg-2 col-md-6 col-6 tm-ref-col">
            <div class="tm-ref-heading-wrap">
              <h6 class="tm-ref-heading">Company</h6>
              <div class="tm-ref-heading-line"></div>
            </div>
            <ul class="tm-ref-chevron-list">
              <li><a href="{{ route('home') }}"><span class="tm-ref-chevron">&gt;</span> Home</a></li>
              <li><a href="{{ route('about-us') }}"><span class="tm-ref-chevron">&gt;</span> About Us</a></li>
              <li><a href="{{ route('gallery') }}"><span class="tm-ref-chevron">&gt;</span> Clinic Tour</a></li>
              <li><a href="{{ route('blog.index') }}"><span class="tm-ref-chevron">&gt;</span> Health Blogs</a></li>
              <li><a href="{{ route('order.tracking') }}"><span class="tm-ref-chevron">&gt;</span> Order Tracking</a></li>
              <li><a href="{{ route('appointments.create') }}"><span class="tm-ref-chevron">&gt;</span> Book Appointment</a></li>
              <li><a href="{{ route('repair') }}"><span class="tm-ref-chevron">&gt;</span> Repair &amp; Servicing</a></li>
              <li><a href="{{ route('contact-us') }}"><span class="tm-ref-chevron">&gt;</span> Contact Us</a></li>
            </ul>
          </div>

          <!-- Column 3: Categories -->
          <div class="col-lg-2 col-md-6 col-6 tm-ref-col">
            <div class="tm-ref-heading-wrap">
              <h6 class="tm-ref-heading">Categories</h6>
              <div class="tm-ref-heading-line"></div>
            </div>
            <ul class="tm-ref-chevron-list">
              @php
                $dispCategories = $footerCategories ?? \App\Models\Category::active()->orderByDesc('is_featured')->orderBy('sort_order')->take(6)->get();
              @endphp
              @forelse($dispCategories as $cat)
                <li>
                  <a href="{{ route('products', ['category' => $cat->slug]) }}" title="{{ $cat->name }}">
                    <span class="tm-ref-chevron">&gt;</span> {{ $cat->name }}
                  </a>
                </li>
              @empty
                <li><a href="{{ route('products') }}"><span class="tm-ref-chevron">&gt;</span> All Hearing Aids</a></li>
              @endforelse
            </ul>
          </div>

          <!-- Column 4: Products -->
          <div class="col-lg-2 col-md-6 col-6 tm-ref-col">
            <div class="tm-ref-heading-wrap">
              <h6 class="tm-ref-heading">Products</h6>
              <div class="tm-ref-heading-line"></div>
            </div>
            <ul class="tm-ref-chevron-list">
              <li><a href="{{ route('products', ['style' => 'RIC']) }}"><span class="tm-ref-chevron">&gt;</span> Receiver-in-Canal (RIC)</a></li>
              <li><a href="{{ route('products', ['style' => 'CIC']) }}"><span class="tm-ref-chevron">&gt;</span> Invisible In-Canal (CIC)</a></li>
              <li><a href="{{ route('products', ['style' => 'BTE']) }}"><span class="tm-ref-chevron">&gt;</span> Behind-The-Ear (BTE)</a></li>
              <li><a href="{{ route('products', ['style' => 'ITE']) }}"><span class="tm-ref-chevron">&gt;</span> In-The-Ear (ITE) Aids</a></li>
              <li><a href="{{ route('product-category') }}"><span class="tm-ref-chevron">&gt;</span> Rechargeable Models</a></li>
              <li><a href="{{ route('products') }}"><span class="tm-ref-chevron">&gt;</span> Bluetooth &amp; AI Aids</a></li>
            </ul>
          </div>

          <!-- Column 5: Contact Us -->
          <div class="col-lg-3 col-md-6 tm-ref-col tm-ref-col-contact">
            <div class="tm-ref-heading-wrap">
              <h6 class="tm-ref-heading">Contact Us</h6>
              <div class="tm-ref-heading-line"></div>
            </div>

            <div class="tm-ref-contact-blocks">
              <!-- Clinic Address -->
              <div class="tm-ref-contact-item">
                <div class="tm-ref-contact-icon">
                  <i class="bi bi-geo-alt-fill"></i>
                </div>
                <div class="tm-ref-contact-body">
                  <div class="tm-ref-contact-title">Visit Our Clinic</div>
                  <div class="tm-ref-contact-detail">{{ $siteAddress ?? site_address() }}</div>
                </div>
              </div>

              <!-- Call Us -->
              <div class="tm-ref-contact-item">
                <div class="tm-ref-contact-icon">
                  <i class="bi bi-telephone-fill"></i>
                </div>
                <div class="tm-ref-contact-body">
                  <div class="tm-ref-contact-title">Call Helpline</div>
                  <a href="tel:{{ $sitePhoneRaw ?? site_phone_raw() }}" class="tm-ref-contact-link">{{ $sitePhone ?? site_phone() }}</a>
                  <div class="tm-ref-contact-sub"><i class="bi bi-clock-fill text-success"></i> {{ SITE_HOURS_SHORT }}</div>
                </div>
              </div>

              <!-- Email Us -->
              <div class="tm-ref-contact-item">
                <div class="tm-ref-contact-icon">
                  <i class="bi bi-envelope-fill"></i>
                </div>
                <div class="tm-ref-contact-body">
                  <div class="tm-ref-contact-title">Email Us</div>
                  <a href="mailto:{{ $siteEmail ?? site_email() }}" class="tm-ref-contact-link">{{ $siteEmail ?? site_email() }}</a>
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>

    <!-- BLACK BOTTOM BAR -->
    <div class="tm-ref-bottom-bar">
      <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">

          <div class="tm-ref-bottom-copy text-center text-md-start">
            &copy; {{ date('Y') }} <strong>{{ SITE_NAME }}</strong>. All Rights Reserved.
          </div>

          @php
            $footerPages = \App\Models\Page::where('status', 'published')
              ->whereIn('slug', ['privacy-policy', 'terms-conditions', 'refund-cancellation', 'warranty-service'])
              ->orderBy('id')
              ->get();

            if ($footerPages->isEmpty()) {
              $footerPages = \App\Models\Page::where('status', 'published')->orderBy('id')->take(6)->get();
            }
          @endphp

          <div class="tm-ref-bottom-links d-flex flex-wrap align-items-center justify-content-center gap-2">
            @forelse($footerPages as $idx => $fp)
              @if($idx > 0)
                <span class="tm-ref-pipe">|</span>
              @endif
              <a href="{{ route('page.show', $fp->slug) }}">{{ $fp->title }}</a>
            @empty
              <a href="{{ url('/privacy-policy') }}">Privacy Policy</a>
              <span class="tm-ref-pipe">|</span>
              <a href="{{ url('/terms-conditions') }}">Terms &amp; Conditions</a>
              <span class="tm-ref-pipe">|</span>
              <a href="{{ url('/refund-cancellation') }}">Refund &amp; Cancellation</a>
              <span class="tm-ref-pipe">|</span>
              <a href="{{ url('/warranty-service') }}">Warranty &amp; Service</a>
            @endforelse
          </div>

        </div>
      </div>
    </div>

  </footer>

  <!-- ============ FLOATING ACTION BUTTONS ============ -->
  <div class="tm-floating-left-wrap" aria-label="WhatsApp Contact">
    <a href="https://wa.me/{{ $siteWhatsApp ?? site_whatsapp() }}" target="_blank" rel="noopener" class="tm-floating-btn tm-floating-btn-wa" title="Chat on WhatsApp">
      <span class="tm-floating-icon-wrap">
        <i class="bi bi-whatsapp"></i>
        <span class="tm-floating-pulse"></span>
      </span>
      <span class="tm-floating-text">
        <span class="tm-floating-sub">Chat Online</span>
        <span class="tm-floating-title">WhatsApp</span>
      </span>
    </a>
  </div>

  <div class="tm-floating-right-wrap" aria-label="Phone Helpline">
    <a href="tel:{{ $sitePhoneRaw ?? site_phone_raw() }}" class="tm-floating-btn tm-floating-btn-call" title="Call Doctor Helpline">
      <span class="tm-floating-icon-wrap">
        <i class="bi bi-telephone-fill"></i>
      </span>
      <span class="tm-floating-text">
        <span class="tm-floating-sub">Helpline</span>
        <span class="tm-floating-title">Call Doctor</span>
      </span>
    </a>
  </div>

  <!-- ============ CART DRAWER (live, server-backed) ============ -->
  <div class="offcanvas offcanvas-end tm-cart-drawer" tabindex="-1" id="tmCartDrawer">
    <div class="offcanvas-header border-bottom">
      <div class="d-flex align-items-center gap-2">
        <i class="bi bi-bag-check fs-5 text-orange"></i>
        <h6 class="fw-bold text-navy mb-0">Shopping Cart (<span id="tmCartDrawerCount">0</span>)</h6>
      </div>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column">
      <div id="tmCartDrawerItems" class="flex-grow-1 overflow-auto"></div>
      <div class="border-top pt-3 mt-auto">
        <div class="d-flex justify-content-between mb-3 fs-5">
          <span class="fw-bold text-navy">Total:</span>
          <span class="fw-bold text-orange" id="tmCartDrawerGrandTotal">₹0</span>
        </div>
        <div class="d-grid gap-2">
          <a href="{{ route('checkout.index') }}" class="tm-btn tm-btn-primary">Checkout</a>
          <a href="{{ route('cart.index') }}" class="tm-btn tm-btn-outline-navy">View Full Cart</a>
        </div>
      </div>
    </div>
  </div>
