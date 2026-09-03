
<?php
    $col   = $col   ?? 'col-xl-3 col-lg-4 col-md-6';
    $wrap  = $wrap  ?? true;
    $isWishlistPage = $isWishlistPage ?? false;

    $price   = (float) $p['price'];
    $mrp     = (float) ($p['mrp'] ?? $p['price']);
    $savePct = $mrp > $price ? (int) round((($mrp - $price) / $mrp) * 100) : 0;

    $badgeText = !empty($p['badge']) ? $p['badge'] : ($savePct > 0 ? $savePct . '% OFF' : 'Authorized');
    $image     = !empty($p['image']) ? $p['image'] : asset('frontend-assets/images/no-product/no-product.png');
    $detailUrl = $p['url'] ?? route('product.show', $p['slug'] ?? $p['id']);

    $jsItem = "{id:'" . js_str($p['id']) . "', name:'" . js_str($p['name'])
        . "', brand:'" . js_str($p['brand'] ?? SITE_SHORT)
        . "', price:" . (int) $price . ", mrp:" . (int) $mrp
        . ", image:'" . js_str($image) . "'}";
?>
<?php if($wrap): ?><div class="<?php echo e($col); ?>"><?php endif; ?>
  <div class="tm-product-card" data-product-id="<?php echo e($p['id']); ?>">

    <!-- Media, badge & floating actions -->
    <div class="tm-product-media">
      <span class="tm-product-save-badge"><?php echo e($badgeText); ?></span>

      <div class="tm-product-actions-group">
        <button type="button" class="tm-product-action-btn"
                data-wishlist-id="<?php echo e($p['id']); ?>"
                onclick="Wishlist.toggle(<?php echo $jsItem; ?>)"
                title="Add to Wishlist" aria-label="Wishlist">
          <i class="bi bi-heart"></i>
        </button>
      </div>

      <a href="<?php echo e($detailUrl); ?>" class="tm-product-img-wrap d-flex align-items-center justify-content-center">
        <img src="<?php echo e($image); ?>" onerror="this.onerror=null;this.src='<?php echo e(asset('frontend-assets/images/no-product/no-product.png')); ?>';" alt="<?php echo e($p['name']); ?>" class="tm-product-img" loading="lazy">
      </a>
    </div>

    <!-- Body -->
    <div class="tm-product-body">

      <div class="tm-product-brand-tag">
        <span class="tm-brand-name">
          <i class="bi bi-shield-check text-orange me-1"></i><?php echo e($p['brand']); ?>

          <span class="tm-origin-text">• <?php echo e($p['brandOrigin'] ?? 'Global'); ?></span>
        </span>
        <span class="tm-rating-chip">
          <i class="bi bi-star-fill text-warning"></i> <?php echo e(number_format((float) ($p['rating'] ?? 4.9), 1)); ?>

          <span class="text-muted tm-reviews-count">(<?php echo e((int) ($p['reviews'] ?? 0)); ?>)</span>
        </span>
      </div>

      <h6 class="tm-product-title">
        <a href="<?php echo e($detailUrl); ?>" title="<?php echo e($p['name']); ?>"><?php echo e($p['name']); ?></a>
      </h6>

      <div class="tm-product-specs-chips">
        <?php if(!empty($p['style'])): ?>
          <span class="tm-spec-chip tm-spec-style"><i class="bi bi-soundwave"></i> <?php echo e($p['style']); ?></span>
        <?php endif; ?>
        <?php if(!empty($p['rechargeable'])): ?>
          <span class="tm-spec-chip tm-spec-recharge"><i class="bi bi-battery-charging text-success"></i> Rechargeable</span>
        <?php endif; ?>
        <?php if(!empty($p['bluetooth'])): ?>
          <span class="tm-spec-chip tm-spec-bt"><i class="bi bi-bluetooth text-primary"></i> Bluetooth</span>
        <?php endif; ?>
        <?php if(!empty($p['channels'])): ?>
          <span class="tm-spec-chip tm-spec-channels"><i class="bi bi-cpu"></i> <?php echo e((int) $p['channels']); ?> Ch</span>
        <?php endif; ?>
        <?php if(!empty($p['featureHighlight'])): ?>
          <span class="tm-spec-chip tm-spec-feature"><?php echo e($p['featureHighlight']); ?></span>
        <?php endif; ?>
      </div>

      <div class="tm-product-price-row">
        <div>
          <div class="tm-product-sale-price"><?php echo e(inr($price)); ?></div>
          <?php if($mrp > $price): ?>
            <div class="tm-product-mrp">MRP: <?php echo e(inr($mrp)); ?></div>
          <?php endif; ?>
        </div>
        <button type="button" class="tm-product-btn-cart" onclick="Cart.addItem(<?php echo $jsItem; ?>)" title="Add to Cart">
          <i class="bi bi-cart-plus-fill"></i> Add to Cart
        </button>
      </div>

      <?php if($isWishlistPage): ?>
        <div class="tm-product-wishlist-actions mt-2 pt-2 border-top">
          <button type="button" class="tm-btn tm-btn-sm tm-btn-outline-danger w-100 d-flex align-items-center justify-content-center gap-1"
                  onclick="Wishlist.toggle(<?php echo $jsItem; ?>)" title="Remove product from Wishlist">
            <i class="bi bi-trash3"></i> Remove from Wishlist
          </button>
        </div>
      <?php endif; ?>

    </div>
  </div>
<?php if($wrap): ?></div><?php endif; ?>
<?php /**PATH E:\xampp\htdocs\laravel\turtlemaarks\resources\views/site/partials/product-card.blade.php ENDPATH**/ ?>