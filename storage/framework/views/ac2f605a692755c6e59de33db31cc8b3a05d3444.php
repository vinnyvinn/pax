<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="panel">
          <div class="panel-body">
            <p>Welcome <strong><?php echo e(ucwords(Auth::user()->name)); ?></strong></p>
          </div>
        
        </div>
      </div>
      <div class="row">
        <?php if(hasInbound()): ?>
        <div class="col-sm-6 col-md-2">
          <div class="thumbnail text-center bg-deltahs">
            <i class="fa fa-car fa-4x font-white"></i>
            <div class="caption text-center">
              <p>
                <a href="<?php echo e(route('inbound-dashboard')); ?>" class="btn btn-sm btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Inbound</a>
              </p>
            </div>
          </div>
        </div>
        <?php endif; ?>
        <?php if(hasOutbound()): ?>
          <div class="col-sm-6 col-md-2">
            <div class="thumbnail text-center bg-deltahs">
              <i class="fa fa-plane fa-4x font-white"></i>
              <div class="caption text-center">
                <p>
                  <a href="<?php echo e(route('outbound-dashboard')); ?>" class="btn btn-sm btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Outbound</a>
                </p>
              </div>
            </div>
          </div>
        <?php endif; ?>
          <div class="col-sm-6 col-md-2">
            <div class="thumbnail text-center bg-deltahs">
              <i class="fa fa-truck fa-4x font-white"></i>
              <div class="caption text-center">
                <p>
                  <a href="#" class="btn btn-sm btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Domestic</a>
                </p>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-2">
            <div class="thumbnail text-center bg-deltahs">
              <i class="fa fa-anchor fa-4x font-white"></i>
              <div class="caption text-center">
                <p>
                  <a href="#" class="btn btn-sm btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> NonFedex</a>
                </p>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-2">
            <div class="thumbnail text-center bg-deltahs">
              <i class="fa fa-motorcycle fa-4x font-white"></i>
              <div class="caption text-center">
                <p>
                <a href="<?php echo e(route('dispatch-dashboard')); ?>" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Dispatch</a>
                </p>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-2">
            <div class="thumbnail text-center bg-deltahs">
              <i class="fa fa-cog fa-4x font-white"></i>
              <div class="caption text-center">
                <p>
                <a href="<?php echo e(route('setting-dashboard')); ?>" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Masters</a>
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