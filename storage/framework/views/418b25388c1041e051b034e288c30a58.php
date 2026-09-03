<?php
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
?>

  <!-- ============ TOP UTILITY BAR ============ -->
  <div class="tm-topbar">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <!-- Left: Clinic Direct Channels -->
        <div class="d-flex align-items-center gap-2 gap-md-3">
          <a href="tel:<?php echo e($sitePhoneRaw ?? site_phone_raw()); ?>" class="tm-topbar-pill tm-topbar-pill-phone" title="Call Clinic Helpline">
            <span class="tm-topbar-pill-icon"><i class="bi bi-telephone-fill"></i></span>
            <span class="tm-topbar-pill-label d-none d-lg-inline"></span>
            <span class="tm-topbar-pill-val"><?php echo e($sitePhone ?? site_phone()); ?></span>
          </a>
          <a href="mailto:<?php echo e($siteEmail ?? site_email()); ?>" class="tm-topbar-pill tm-topbar-pill-mail d-none d-md-inline-flex" title="Email Clinic Team">
            <span class="tm-topbar-pill-icon"><i class="bi bi-envelope-fill"></i></span>
            <span class="tm-topbar-pill-val"><?php echo e($siteEmail ?? site_email()); ?></span>
          </a>
        </div>

        <!-- Right: Clinic Live Status & Branded Social Circles -->
        <div class="d-flex align-items-center gap-2 gap-md-3">
          <div class="tm-topbar-timing d-none d-sm-inline-flex align-items-center">
            <span class="tm-live-indicator"><span class="tm-live-pulse"></span></span>
            <span><?php echo e(SITE_HOURS_SHORT); ?></span>
          </div>
          <span class="tm-topbar-sep d-none d-sm-inline-block"></span>
          <div class="d-flex align-items-center gap-2">
            <?php $__currentLoopData = $tmSocial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e($s['url']); ?>" target="_blank" rel="noopener" class="tm-ref-social-btn <?php echo e($s['class']); ?>" title="<?php echo e($s['title']); ?>" aria-label="<?php echo e($s['title']); ?>"><i class="bi <?php echo e($s['icon']); ?>"></i></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ============ STICKY NAVBAR ============ -->
  <header class="tm-header">
    <div class="container">
      <nav class="navbar navbar-expand-lg py-2">
        <a class="navbar-brand d-flex align-items-center" href="<?php echo e(route('home')); ?>">
          <img src="<?php echo e(asset(SITE_LOGO)); ?>" alt="<?php echo e(SITE_NAME); ?>" class="tm-brand-logo">
        </a>

        <!-- Mobile Header Quick Actions (Cart & Toggle) -->
        <div class="d-flex d-lg-none align-items-center gap-2 ms-auto">
          <button type="button" class="tm-icon-btn position-relative" data-bs-toggle="offcanvas" data-bs-target="#tmCartDrawer" title="Cart" aria-label="Shopping Cart">
            <i class="bi bi-bag"></i>
            <span class="tm-badge-count tm-cart-badge-count" style="<?php echo e(($cartCount ?? 0) > 0 ? '' : 'display:none;'); ?>"><?php echo e($cartCount ?? 0); ?></span>
          </button>

          <button class="navbar-toggler border-0 shadow-none p-0 d-flex align-items-center justify-content-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#tmMobileNav" aria-label="Toggle navigation">
            <i class="bi bi-list fs-2 text-navy"></i>
          </button>
        </div>

        <div class="collapse navbar-collapse justify-content-center d-none d-lg-flex">
          <ul class="navbar-nav align-items-center gap-1">
            <?php $__currentLoopData = $tmNav; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if(empty($item['children'])): ?>
                <li class="nav-item">
                  <a class="nav-link tm-nav-link <?php echo e($activeNav === $item['key'] ? 'active' : ''); ?>" href="<?php echo e($item['url']); ?>"><?php echo e($item['label']); ?></a>
                </li>
              <?php else: ?>
                <li class="nav-item dropdown">
                  <a class="nav-link tm-nav-link dropdown-toggle <?php echo e($activeNav === $item['key'] ? 'active' : ''); ?>" href="<?php echo e($item['url']); ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo e($item['label']); ?>

                  </a>
                  <ul class="dropdown-menu tm-dropdown-menu">
                    <?php $__currentLoopData = $item['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if(!empty($child['divider'])): ?>
                        <li><hr class="dropdown-divider border-white-10 my-1"></li>
                      <?php else: ?>
                        <li>
                          <a class="dropdown-item tm-dropdown-item <?php echo e(!empty($child['highlight']) ? 'text-orange fw-bold' : ''); ?>" href="<?php echo e($child['url']); ?>">
                            <?php if(!empty($child['icon'])): ?><i class="bi <?php echo e($child['icon']); ?> <?php echo e(empty($child['highlight']) ? 'text-warning' : ''); ?> me-1"></i><?php endif; ?><?php echo e($child['label']); ?>

                          </a>
                        </li>
                      <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                </li>
              <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>

        <div class="d-none d-lg-flex align-items-center gap-2">
          <a href="<?php echo e(route('wishlist.index')); ?>" class="tm-icon-btn" title="Wishlist"><i class="bi bi-heart"></i><span class="tm-badge-count tm-wishlist-badge-count" style="display:none;">0</span></a>
          <button type="button" class="tm-icon-btn position-relative" data-bs-toggle="offcanvas" data-bs-target="#tmCartDrawer" title="Cart"><i class="bi bi-bag"></i><span class="tm-badge-count tm-cart-badge-count" style="<?php echo e(($cartCount ?? 0) > 0 ? '' : 'display:none;'); ?>"><?php echo e($cartCount ?? 0); ?></span></button>
          <?php if(auth()->guard()->check()): ?>
            <a href="<?php echo e(route('account.dashboard')); ?>" class="tm-icon-btn" title="Patient Portal"><i class="bi bi-person-check"></i></a>
          <?php else: ?>
            <a href="<?php echo e(route('login')); ?>" class="tm-icon-btn" title="Patient Portal"><i class="bi bi-person"></i></a>
          <?php endif; ?>
          <a href="<?php echo e(route('appointments.create')); ?>" class="tm-btn-appointment ms-1" title="Book Doctor Appointment">
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
      <img src="<?php echo e(asset(SITE_LOGO)); ?>" alt="<?php echo e(SITE_SHORT); ?>" style="height: 52px; width: auto; object-fit: contain;">
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <ul class="navbar-nav mb-4">
        <?php $__currentLoopData = $tmNav; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if(empty($item['children'])): ?>
            <li class="nav-item"><a class="nav-link fw-bold text-navy py-2" href="<?php echo e($item['url']); ?>"><?php echo e($item['label']); ?></a></li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link fw-bold text-navy py-2 d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#tmMobileSub<?php echo e($i); ?>" role="button" aria-expanded="false">
                <?php echo e($item['label']); ?> <i class="bi bi-chevron-down small"></i>
              </a>
              <div class="collapse ps-3" id="tmMobileSub<?php echo e($i); ?>">
                <ul class="list-unstyled small py-1">
                  <?php $__currentLoopData = $item['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(empty($child['divider'])): ?>
                      <li>
                        <a class="nav-link py-1 <?php echo e(!empty($child['highlight']) ? 'text-orange fw-bold' : 'text-secondary'); ?>" href="<?php echo e($child['url']); ?>">
                          <?php echo e(empty($child['highlight']) ? '• ' : ''); ?><?php echo e($child['label']); ?><?php echo e(!empty($child['highlight']) ? ' →' : ''); ?>

                        </a>
                      </li>
                    <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div>
            </li>
          <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <li class="nav-item"><a class="nav-link fw-bold text-navy py-2" href="<?php echo e(route('wishlist.index')); ?>">Wishlist</a></li>
        <?php if(auth()->guard()->check()): ?>
          <li class="nav-item"><a class="nav-link fw-bold text-navy py-2" href="<?php echo e(route('account.dashboard')); ?>"><i class="bi bi-person-check me-1"></i> My Account</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link fw-bold text-navy py-2" href="<?php echo e(route('login')); ?>"><i class="bi bi-person me-1"></i> Login</a></li>
        <?php endif; ?>
      </ul>
      <div class="d-grid gap-2">
        <a href="<?php echo e(route('appointments.create')); ?>" class="tm-btn-appointment w-100 justify-content-center py-2 fs-6">
          <i class="bi bi-calendar2-check"></i>
          <span>Appointment</span>
        </a>
        <a href="<?php echo e(route('cart.index')); ?>" class="tm-btn tm-btn-outline-navy w-100">View Cart</a>
      </div>
      <div class="d-flex gap-2 mt-3 pt-3 border-top">
        <?php $__currentLoopData = $tmSocial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e($s['url']); ?>" target="_blank" rel="noopener" class="tm-ref-social-btn <?php echo e($s['class']); ?>" title="<?php echo e($s['title']); ?>" aria-label="<?php echo e($s['title']); ?>"><i class="bi <?php echo e($s['icon']); ?>"></i></a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </div>
<?php /**PATH E:\xampp\htdocs\laravel\turtlemaarks\resources\views/site/partials/header.blade.php ENDPATH**/ ?>