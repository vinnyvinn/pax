<?php $__env->startSection('content'); ?>
    <outbound-quote :id="<?php echo e($id); ?>" :canf="<?php echo e(Auth::user()->can('finalize-outbound-freight-invoice')); ?> == 1"></outbound-quote>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>