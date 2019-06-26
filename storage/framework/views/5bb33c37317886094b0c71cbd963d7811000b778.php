<?php $__env->startSection('content'); ?>
<div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
              <li><a href="/">Home</a></li>
              <li><a href="<?php echo e(route('inbound-dashboard')); ?>">Inbound</a></li>
              <li class="active">Operations</li>
            </ol>
            <hr>
        </div>
        <?php if(hasShipments('Inbound')): ?>
        <div class="col-sm-6 col-md-3">
          <div class="thumbnail text-center bg-deltahs">
            <i class="fa fa-gift fa-4x font-white"></i>
            <div class="caption text-center">
              <p>
                <a href="<?php echo e(route('manifest.index', ['page' => 'operations'])); ?>" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Shipments</a>
              </p>
            </div>
          </div>
        </div>
        <?php endif; ?>
        <div class="col-sm-6 col-md-3">
          <div class="thumbnail text-center bg-deltahs">
            <i class="fa fa-file fa-4x font-white"></i>
            <div class="caption text-center">
              <p>
                <a href="<?php echo e(route('manifest.scan', 'oda')); ?>" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i>ODA scan</a>
              </p>
            </div>
          </div>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('import-van-scan')): ?>
        <div class="col-sm-6 col-md-3">
          <div class="thumbnail text-center bg-deltahs">
            <i class="fa fa-file fa-4x font-white"></i>
            <div class="caption text-center">
              <p>
                <a href="<?php echo e(route('manifest.scan', 'van')); ?>" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i>Van Scan</a>
              </p>
            </div>
          </div>
        </div>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('import-dex-scan')): ?>
        <div class="col-sm-6 col-md-3">
          <div class="thumbnail text-center bg-deltahs">
            <i class="fa fa-file fa-4x font-white"></i>
            <div class="caption text-center">
              <p>
                <a href="<?php echo e(route('manifest.scan', 'dex')); ?>" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> DEX Scan</a>
              </p>
            </div>
          </div>
        </div>
        <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="/css/style.css">
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>