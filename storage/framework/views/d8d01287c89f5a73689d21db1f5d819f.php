<?php
    $col = $col ?? 'col-xl-3 col-lg-4 col-md-6';
    $products = $products ?? [];
    $isWishlistPage = $isWishlistPage ?? false;
?>
<?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
  <?php echo $__env->make('site.partials.product-card', ['p' => $p, 'col' => $col, 'isWishlistPage' => $isWishlistPage], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
  <div class="col-12 d-flex justify-content-center w-100">
    <div class="tm-empty-state-card">
      <div class="tm-empty-state-icon">
        <i class="bi bi-search"></i>
      </div>
      <h4 class="tm-empty-state-title">No Products Available</h4>
      <p class="tm-empty-state-text">
        Try selecting another brand or explore all hearing aids.
      </p>
      <div class="tm-empty-state-actions">
        <a href="<?php echo e(route('contact-us')); ?>" class="tm-btn tm-btn-primary btn-sm px-4">
          <i class="bi bi-headset me-1"></i> Contact Us
        </a>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php /**PATH E:\xampp\htdocs\laravel\turtlemaarks\resources\views/site/partials/product-grid.blade.php ENDPATH**/ ?>