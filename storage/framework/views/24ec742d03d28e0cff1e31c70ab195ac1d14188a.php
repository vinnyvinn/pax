<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
      <div class="col-md-12">
          <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li><a href="<?php echo e(route('dispatch-dashboard')); ?>">Dispatch dashboard</a></li>
            <li><a href="<?php echo e(route('pickups.index')); ?>">Pickup management</a></li>
            <li class="active">Create/Edit piickup</li>
          </ol>
          <hr>
      </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?php $__env->startComponent('dispatch.pickups.partials.form', ['pickup' => $pickup, 'clients' => $clients]); ?>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>