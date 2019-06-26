<?php $__env->startSection('content'); ?>
    <outbound-freight :id="<?php echo e($id); ?>" :canf="<?php echo e(Auth::user()->can('finalize-outbound-freight-invoice')); ?> == 1"<?php echo isset($route) ? "route='$route'" : ''; ?>></outbound-freight>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>