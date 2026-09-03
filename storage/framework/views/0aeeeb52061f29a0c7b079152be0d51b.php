<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#0b2545">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <title><?php echo $__env->yieldContent('title', SITE_NAME . ' — ' . SITE_TAGLINE); ?></title>
  <meta name="description" content="<?php echo $__env->yieldContent('meta_description', 'Authorized clinic for Phonak, Oticon, ReSound, Signia, Starkey, Widex digital hearing aids & sound-booth diagnostic hearing tests in Greater Noida West & Noida.'); ?>">
  <meta name="keywords" content="<?php echo $__env->yieldContent('meta_keywords', ''); ?>">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="<?php echo e(url()->current()); ?>">
  <link rel="icon" type="image/png" href="<?php echo e(asset(SITE_FAVICON)); ?>">

  
  <meta property="og:title" content="<?php echo $__env->yieldContent('title', SITE_NAME); ?>">
  <meta property="og:description" content="<?php echo $__env->yieldContent('meta_description', SITE_TAGLINE); ?>">
  <meta property="og:url" content="<?php echo e(url()->current()); ?>">
  <meta property="og:type" content="website">
  <meta property="og:image" content="<?php echo $__env->yieldContent('og_image', asset(SITE_LOGO)); ?>">

  <!-- Google Fonts (Raleway — Modern, Elegant & Sophisticated) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

  <!-- Bootstrap 5.3 CSS & Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- Design tokens & custom styles -->
  <link rel="stylesheet" href="<?php echo e(tm_asset('css/variables.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(tm_asset('css/custom.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(tm_asset('css/responsive.css')); ?>">
  <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body <?php if (! empty(trim($__env->yieldContent('body_class')))): ?> class="<?php echo $__env->yieldContent('body_class'); ?>" <?php endif; ?>>

  <?php echo $__env->make('site.partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <main id="tmMainContent">
    <?php echo $__env->make('site.partials.flash', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->yieldContent('content'); ?>
  </main>

  <?php echo $__env->make('site.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <!-- ============ SCRIPTS ============ -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    /* Server-driven configuration consumed by assets/js/*.js */
    window.TM = {
      csrf: '<?php echo e(csrf_token()); ?>',
      auth: <?php echo json_encode(auth()->check(), 15, 512) ?>,
      routes: {
        home:        '<?php echo e(route('home')); ?>',
        products:    '<?php echo e(route('products')); ?>',
        contact:     '<?php echo e(route('contact-us')); ?>',
        search:      '<?php echo e(route('search')); ?>',
        cart:        '<?php echo e(route('cart.index')); ?>',
        cartAdd:     '<?php echo e(route('cart.add')); ?>',
        cartData:    '<?php echo e(route('cart.data')); ?>',
        cartUpdate:  '<?php echo e(url('cart')); ?>',
        cartCoupon:  '<?php echo e(route('cart.coupon.apply')); ?>',
        cartCouponRemove: '<?php echo e(route('cart.coupon.remove')); ?>',
        checkout:    '<?php echo e(route('checkout.index')); ?>',
        wishlist:    '<?php echo e(route('wishlist.index')); ?>',
        wishlistToggle: '<?php echo e(route('wishlist.toggle')); ?>',
        login:       '<?php echo e(route('login')); ?>',
        diagnostics: '<?php echo e(route('diagnostic-services')); ?>',
        repair:      '<?php echo e(route('repair')); ?>',
        appointment: '<?php echo e(route('appointments.create')); ?>',
        appointmentStore: '<?php echo e(route('appointments.store')); ?>',
        appointmentSlots: '<?php echo e(route('appointments.slots')); ?>'
      },
      placeholder: '<?php echo e(tm_asset('images/hearing-aid/ric.webp')); ?>',
      wishlistIds: <?php echo json_encode($tmWishlistIds ?? [], 15, 512) ?>
    };
    window.TURTLE_PRODUCTS = <?php echo json_encode($tmCatalogue ?? [], 15, 512) ?>;
  </script>
  <script src="<?php echo e(tm_asset('js/main.js')); ?>"></script>
  <script src="<?php echo e(tm_asset('js/products.js')); ?>"></script>
  <script src="<?php echo e(tm_asset('js/cart.js')); ?>"></script>
  <script src="<?php echo e(tm_asset('js/wishlist.js')); ?>"></script>
  <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH E:\xampp\htdocs\laravel\turtlemaarks\resources\views/site/layouts/app.blade.php ENDPATH**/ ?>