<?php $__env->startSection('content'); ?>
    <inbound-quote :id="<?php echo e($id); ?>" :canf="<?php echo e(Auth::user()->can('finalize-inbound-freight-invoice')); ?> == 1"></inbound-quote>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>