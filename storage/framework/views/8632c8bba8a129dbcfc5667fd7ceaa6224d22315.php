<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
              <li><a href="/">Home</a></li>
              <li><a href="<?php echo e(route('outbound-dashboard')); ?>">Outbound dashboard</a></li>
              <li><a href="<?php echo e(route('additional-charges-outbound.index')); ?>">Airwaybill additional charges</a></li>
              <li class="active">Edit Additional charge</li>
            </ol>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
        <outbound-additional-charge :id="<?php echo e($id); ?>"></outbound-additional-charge>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>