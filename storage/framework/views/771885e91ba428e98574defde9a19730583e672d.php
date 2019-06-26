<?php $__env->startSection('content'); ?>
    <?php if(isset($id)): ?>
        <non-tabulations :id="<?php echo e($id); ?>"></non-tabulations>
    <?php else: ?>
        <non-tabulations></non-tabulations>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>