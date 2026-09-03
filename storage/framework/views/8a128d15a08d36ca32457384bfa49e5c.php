<?php if(session('success') || session('error') || session('status') || $errors->any()): ?>
<div class="container pt-3">
  <?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show small py-2 px-3 mb-2" role="alert">
      <i class="bi bi-check-circle-fill me-1"></i> <?php echo e(session('success')); ?>

      <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <?php if(session('status')): ?>
    <div class="alert alert-info alert-dismissible fade show small py-2 px-3 mb-2" role="alert">
      <i class="bi bi-info-circle-fill me-1"></i> <?php echo e(session('status')); ?>

      <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <?php if(session('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show small py-2 px-3 mb-2" role="alert">
      <i class="bi bi-exclamation-triangle-fill me-1"></i> <?php echo e(session('error')); ?>

      <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <?php if($errors->any()): ?>
    <div class="alert alert-danger alert-dismissible fade show small py-2 px-3 mb-2" role="alert">
      <strong><i class="bi bi-exclamation-circle-fill me-1"></i> Please fix the following:</strong>
      <ul class="mb-0 mt-1 ps-3">
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
      <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>
</div>
<?php endif; ?>
<?php /**PATH E:\xampp\htdocs\laravel\turtlemaarks\resources\views/site/partials/flash.blade.php ENDPATH**/ ?>