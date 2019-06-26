<?php $__env->startSection('content'); ?>
<div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
              <li><a href="/">Home</a></li>
              <li class="active">Dispatch</li>
            </ol>
            <hr>
        </div>
      </div>
      <div class="row">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-pickups')): ?>
        <div class="col-md-1"></div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create-pickup')): ?>
        <div class="col-sm-6 col-md-2">
          <div class="thumbnail text-center bg-deltahs">
            <i class="fa fa-car fa-4x font-white"></i>
            <div class="caption text-center">
              <p>
                <a href="<?php echo e(route('pickups.import', ['type' => \PAX\Models\Pickup::TYPE_tnt])); ?>" class="btn btn-sm btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Import TNT</a>
              </p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-2">
            <div class="thumbnail text-center bg-deltahs">
              <i class="fa fa-motorcycle fa-4x font-white"></i>
              <div class="caption text-center">
                <p>
                  <a href="<?php echo e(route('pickups.import', ['type' => \PAX\Models\Pickup::TYPE_fedex])); ?>" class="btn btn-sm btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Import FEDEX</a>
                </p>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-2">
            <div class="thumbnail text-center bg-deltahs">
              <i class="fa fa-motorcycle fa-4x font-white"></i>
              <div class="caption text-center">
                <p>
                  <a href="<?php echo e(route('pickups.import', ['type' => \PAX\Models\Pickup::TYPE_recurrent])); ?>" class="btn btn-sm btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Import Recurrent</a>
                </p>
              </div>
            </div>
          </div>
          <?php endif; ?>
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-pickups')): ?>
          <div class="col-sm-6 col-md-2">
            <div class="thumbnail text-center bg-deltahs">
              <i class="fa fa-car fa-4x font-white"></i>
              <div class="caption text-center">
                <p>
                  <a href="<?php echo e(route('pickups.index')); ?>" class="btn btn-sm btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Pickups dashboard</a>
                </p>
              </div>
            </div>
          </div>
          <?php endif; ?>
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create-pickup')): ?>
          <div class="col-sm-6 col-md-2">
            <div class="thumbnail text-center bg-deltahs">
              <i class="fa fa-car fa-4x font-white"></i>
              <div class="caption text-center">
                <p>
                  <a href="<?php echo e(route('pickups.create')); ?>" class="btn btn-sm btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Add pickup</a>
                </p>
              </div>
            </div>
          </div>
          <?php endif; ?>
          <div class="col-md-1"></div>
        <?php endif; ?>
      </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="/css/style.css">
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>