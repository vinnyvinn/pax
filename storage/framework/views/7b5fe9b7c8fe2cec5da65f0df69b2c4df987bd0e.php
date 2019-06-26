<?php $__env->startSection('content'); ?>
<div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
              <li><a href="/">Home</a></li>
            <li><a href="<?php echo e(route('inbound-dashboard')); ?>">Inbound dashboard</a></li>
              <li class="active">Clearance</li>
            </ol>
            <hr>
        </div>
        <?php if(hasShipments('Inbound')): ?>
        <div class="col-sm-6 col-md-3">
          <div class="thumbnail text-center bg-deltahs">
            <i class="fa fa-gift fa-4x font-white"></i>
            <div class="caption text-center">
              <p>
                <a href="<?php echo e(route('manifest.index', ['page' => 'clearance'])); ?>" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Shipments</a>
              </p>
            </div>
          </div>
        </div>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('import-scan-71')): ?>
        <div class="col-sm-6 col-md-3">
          <div class="thumbnail text-center bg-deltahs">
            <i class="fa fa-file fa-4x font-white"></i>
            <div class="caption text-center">
              <p>
                <a href="<?php echo e(route('manifest.scan', 'dutiable')); ?>" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Import 71</a>
              </p>
            </div>
          </div>
        </div>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('import-scan-72')): ?>
          <div class="col-sm-6 col-md-3">
            <div class="thumbnail text-center bg-deltahs">
              <i class="fa fa-file fa-4x font-white"></i>
              <div class="caption text-center">
                <p>
                  <a href="<?php echo e(route('manifest.scan', 'non-dutiable')); ?>" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Import 72</a>
                </p>
              </div>
            </div>
          </div>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('import-scan-65')): ?>
        <div class="col-sm-6 col-md-3">
          <div class="thumbnail text-center bg-deltahs">
            <i class="fa fa-file fa-4x font-white"></i>
            <div class="caption text-center">
              <p>
                <a href="<?php echo e(route('manifest.scan', 'released')); ?>" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Import 65</a>
              </p>
            </div>
          </div>
        </div>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('generate-release-orders')): ?>
        <div class="col-sm-6 col-md-3">
          <div class="thumbnail text-center bg-deltahs">
            <i class="fa fa-file fa-4x font-white"></i>
            <div class="caption text-center">
              <p>
                <a href="<?php echo e(route('clearance.index')); ?>" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Generate Release Orders</a>
              </p>
            </div>
          </div>
        </div>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update-clearing-agent')): ?>
        <div class="col-sm-6 col-md-3">
          <div class="thumbnail text-center bg-deltahs">
            <i class="fa fa-check fa-4x font-white"></i>
            <div class="caption text-center">
              <p>
                <a href="<?php echo e(route('clearing-agents')); ?>" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Update Clearing Agent</a>
              </p>
            </div>
          </div>
        </div>
        <?php endif; ?>
        <?php if(canAny(['Create Clearance Invoice', 'View Clearance Invoice', 'Edit Clearance Invoice', 'Delete Clearance Invoice', 'Finalize Clearance Invoice'])): ?>
        <div class="col-sm-6 col-md-3">
          <div class="thumbnail text-center bg-deltahs">
            <i class="fa fa-money fa-4x font-white"></i>
            <div class="caption text-center">
              <p>
                <a href="<?php echo e(route('invoice.index')); ?>" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Clearance Billing</a>
              </p>
            </div>
          </div>
        </div>
        <?php endif; ?>
        <?php if(canAny(['Create Clearance Invoice', 'View Clearance Invoice', 'Edit Clearance Invoice', 'Delete Clearance Invoice', 'Finalize Clearance Invoice'])): ?>
        <div class="col-sm-6 col-md-3">
          <div class="thumbnail text-center bg-deltahs">
            <i class="fa fa-bookmark fa-4x font-white"></i>
            <div class="caption text-center">
              <p>
                <a href="<?php echo e(route('invoice.index')); ?>" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Clearance Invoices</a>
              </p>
            </div>
          </div>
        </div>
        <?php endif; ?>
        <?php if(canAny(['Create Agent Clearance Invoice', 'View Agent Clearance Invoice', 'Edit Agent Clearance Invoice', 'Delete Agent Clearance Invoice', 'Finalize Agent Clearance Invoice',])): ?>
        <div class="col-sm-6 col-md-3">
          <div class="thumbnail text-center bg-deltahs">
            <i class="fa fa-check fa-4x font-white"></i>
            <div class="caption text-center">
              <p>
                <a href="<?php echo e(route('invoice.index')); ?>" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Agent Clearance</a>
              </p>
            </div>
          </div>
        </div>
        <?php endif; ?>
      </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="/css/style.css">
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>