<?php $__env->startSection('content'); ?>
<div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
              <li><a href="/">Home</a></li>
              <li class="active">Outbound</li>
            </ol>
            <hr>
        </div>
        <?php if(hasOutbound()): ?>
        <?php if(hasShipments('Outbound')): ?>
        <div class="col-md-1"></div>
        <div class="col-sm-6 col-md-2">
            <div class="thumbnail text-center bg-deltahs">
              <i class="fa fa-gift fa-4x font-white"></i>
              <div class="caption text-center">
                <p>
                  <a href="<?php echo e(route('outbound.index')); ?>" class="btn btn-sm btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Shipments</a>
                </p>
              </div>
            </div>
          </div>
          <?php endif; ?>
          <?php if(canAny(['Create Outbound Freight Invoice', 'View Outbound Freight Invoice', 'Edit Outbound Freight Invoice', 'Delete Outbound Freight Invoice', 'Finalize Outbound Freight Invoice'])): ?>
          <div class="col-sm-6 col-md-2">
            <div class="thumbnail text-center bg-deltahs">
              <i class="fa fa-money fa-4x font-white"></i>
              <div class="caption text-center">
                <p>
                  <a href="<?php echo e(route('outbound.freight.index')); ?>" class="btn btn-sm btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Billing</a>
                </p>
              </div>
            </div>
          </div>
          <?php endif; ?>
          <?php if(canAny(['Create Outbound Freight Invoice', 'View Outbound Freight Invoice', 'Edit Outbound Freight Invoice', 'Delete Outbound Freight Invoice', 'Finalize Outbound Freight Invoice'])): ?>
          <div class="col-sm-6 col-md-2">
              <div class="thumbnail text-center bg-deltahs">
                <i class="fa fa-money fa-4x font-white"></i>
                <div class="caption text-center">
                  <p>
                    <a href="<?php echo e(route('outbound.freight.invoice')); ?>" class="btn btn-sm btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Invoices</a>
                  </p>
                </div>
              </div>
            </div>
            <?php endif; ?>
            <?php if(canAny(['Create Outbound Freight Invoice', 'View Outbound Freight Invoice', 'Edit Outbound Freight Invoice', 'Delete Outbound Freight Invoice', 'Finalize Outbound Freight Invoice'])): ?>
            <div class="col-sm-6 col-md-2">
              <div class="thumbnail text-center bg-deltahs">
                <i class="fa fa-dollar fa-4x font-white"></i>
                <div class="caption text-center">
                  <p>
                    <a href="<?php echo e(route('additional-charges-outbound.index')); ?>" class="btn btn-sm btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Additional charges</a>
                  </p>
                </div>
              </div>
            </div>
            <?php endif; ?>
            <?php if(canAny(['Create Outbound Freight Invoice', 'View Outbound Freight Invoice', 'Edit Outbound Freight Invoice', 'Delete Outbound Freight Invoice', 'Finalize Outbound Freight Invoice'])): ?>
            <div class="col-sm-6 col-md-2">
              <div class="thumbnail text-center bg-deltahs">
                <i class="fa fa-dollar fa-4x font-white"></i>
                <div class="caption text-center">
                  <p>
                    <a href="<?php echo e(route('additional-charges-outbound.invoices')); ?>" class="btn btn-sm btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Additional charges Invoices</a>
                  </p>
                </div>
              </div>
            </div>
            <?php endif; ?>
        <?php endif; ?>
        <div class="col-md-1"></div>
      </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="/css/style.css">
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>