<?php $__env->startSection('content'); ?>
<div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
              <li><a href="/">Home</a></li>
              <li class="active">Inbound</li>
            </ol>
            <hr>
        </div>
        <div class="col-sm-6 col-md-4">
          <div class="thumbnail text-center bg-deltahs">
            <i class="fa fa-gift fa-4x font-white"></i>
            <div class="caption text-center">
              <p>
                <a href="<?php echo e(route('clearance-dashboard')); ?>" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Clearance</a>
              </p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-4">
          <div class="thumbnail text-center bg-deltahs">
            <i class="fa fa-cogs fa-4x font-white"></i>
            <div class="caption text-center">
              <p>
                <a href="<?php echo e(route('operations-dashboard')); ?>" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Operations</a>
              </p>
            </div>
          </div>
        </div>
          <div class="col-sm-6 col-md-4">
            <div class="thumbnail text-center bg-deltahs">
              <i class="fa fa-money fa-4x font-white"></i>
              <div class="caption text-center">
                <p>
                  <a href="<?php echo e(route('finance-dashboard')); ?>" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Finance</a>
                </p>
              </div>
            </div>
          </div>
      </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="/css/style.css">
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>