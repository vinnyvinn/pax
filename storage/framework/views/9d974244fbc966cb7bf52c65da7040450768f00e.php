<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="panel">
        <p>Welcome <strong><?php echo e(ucwords(Auth::user()->name)); ?></strong></p>
        </div>
      </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>