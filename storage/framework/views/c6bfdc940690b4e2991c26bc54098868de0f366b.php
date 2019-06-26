<?php $__env->startSection('content'); ?>
    <tabulations :id="<?php echo e($id); ?>"></tabulations>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>