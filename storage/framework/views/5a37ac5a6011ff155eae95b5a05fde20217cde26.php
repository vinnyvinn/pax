<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php $__env->startComponent('dispatch.pickups.partials.form', ['pickup' => $pickup, 'clients' => $clients]); ?>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>