<?php $__env->startSection('content'); ?>
    <domestic-freight :id="<?php echo e($id); ?>" :canf="<?php echo e(Auth::user()->can('finalize-domestic-freight-invoice')); ?> == 1"></domestic-freight>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>