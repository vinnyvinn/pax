<?php $__env->startSection('content'); ?>
<div class="container-fluid">
      <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li class="active">Settings</li>
                </ol>
                <hr>
            </div>
      </div>
      <div class="row">
        <?php if(canAny(['Create Area Codes', 'View Area Codes', 'Edit Area Codes', 'Delete Area Codes'])): ?>
        <div class="col-sm-6 col-md-2">
          <div class="thumbnail text-center bg-deltahs">
            <i class="fa fa-car fa-4x font-white"></i>
            <div class="caption text-center">
              <p>
                <a href="<?php echo e(route('area-code.index')); ?>" class="btn btn-sm btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Area-Codes</a>
              </p>
            </div>
          </div>
        </div>
        <?php endif; ?>
        <?php if(canAny(['Create CBV', 'View CBV', 'Edit CBV', 'Delete CBV'])): ?>
        <div class="col-sm-6 col-md-2">
            <div class="thumbnail text-center bg-deltahs">
              <i class="fa fa-file fa-4x font-white"></i>
              <div class="caption text-center">
                <p>
                  <a href="<?php echo e(route('cbv.index')); ?>" class="btn btn-sm btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> CBVs</a>
                </p>
              </div>
            </div>
          </div>
          <?php endif; ?>
          <?php if(canAny(['Create Cities', 'View Cities', 'Edit Cities', 'Delete Cities'])): ?>
          <div class="col-sm-6 col-md-2">
            <div class="thumbnail text-center bg-deltahs">
              <i class="fa fa-building fa-4x font-white"></i>
              <div class="caption text-center">
                <p>
                  <a href="<?php echo e(route('city.index')); ?>" class="btn btn-sm btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Cities</a>
                </p>
              </div>
            </div>
          </div>
          <?php endif; ?>
          <?php if(canAny(['Create Couriers', 'View Couriers', 'Edit Couriers', 'Delete Couriers'])): ?>
          <div class="col-sm-6 col-md-2">
              <div class="thumbnail text-center bg-deltahs">
                <i class="fa fa-motorcycle fa-4x font-white"></i>
                <div class="caption text-center">
                  <p>
                    <a href="<?php echo e(route('courier.index')); ?>" class="btn btn-sm btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Couriers</a>
                  </p>
                </div>
              </div>
            </div>
            <?php endif; ?>
            <?php if(canAny(['Create Domestic Locations', 'View Domestic Locations', 'Edit Domestic Locations', 'Delete Domestic Locations'])): ?>
            <div class="col-sm-6 col-md-2">
              <div class="thumbnail text-center bg-deltahs">
                <i class="fa fa-map-marker fa-4x font-white"></i>
                <div class="caption text-center">
                  <p>
                    <a href="<?php echo e(route('domestic-locations.index')); ?>" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Domestic Locations</a>
                  </p>
                </div>
              </div>
            </div>
            <?php endif; ?>
            <?php if(canAny(['Edit Domestic Rates'])): ?>
            <div class="col-sm-6 col-md-2">
              <div class="thumbnail text-center bg-deltahs">
                <i class="fa fa-calendar fa-4x font-white"></i>
                <div class="caption text-center">
                  <p>
                    <a href="<?php echo e(route('domestic-rates.index')); ?>" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Domestic Rates</a>
                  </p>
                </div>
              </div>
            </div>
            <?php endif; ?>
            <?php if(canAny(['Create Routes', 'View Routes', 'Edit Routes', 'Delete Routes'])): ?>
            <div class="col-sm-6 col-md-2">
              <div class="thumbnail text-center bg-deltahs">
                <i class="fa fa-map-marker fa-4x font-white"></i>
                <div class="caption text-center">
                  <p>
                    <a href="<?php echo e(route('route.index')); ?>" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Routes</a>
                  </p>
                </div>
              </div>
            </div>
            <?php endif; ?>
            <?php if(canAny(['Edit Outbound Zones', 'View Outbound Zones'])): ?>
            <div class="col-sm-6 col-md-2">
              <div class="thumbnail text-center bg-deltahs">
                <i class="fa fa-map-marker fa-4x font-white"></i>
                <div class="caption text-center">
                  <p>
                    <a href="<?php echo e(route('outbound-zones.index')); ?>" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Outbound Zones</a>
                  </p>
                </div>
              </div>
            </div>
            <?php endif; ?>
            <?php if(canAny(['Edit Outbound Rate Card', 'View Outbound Rate Card'])): ?>
            <div class="col-sm-6 col-md-2">
              <div class="thumbnail text-center bg-deltahs">
                <i class="fa fa-calendar fa-4x font-white"></i>
                <div class="caption text-center">
                  <p>
                    <a href="<?php echo e(route('sales-rate-card.index')); ?>" class="btn btn-danger" style="width:100%" role="button">
                      <i class="fa fa-caret-right"></i> Outbound Sales Rate Card
                    </a>
                  </p>
                </div>
              </div>
            </div>
            <?php endif; ?>
            <?php if(canAny(['Edit Outbound Rate Card', 'View Outbound Rate Card'])): ?>
            <div class="col-sm-6 col-md-2">
              <div class="thumbnail text-center bg-deltahs">
                <i class="fa fa-calendar fa-4x font-white"></i>
                <div class="caption text-center">
                  <p>
                    <a href="<?php echo e(route('discount-rate-card.index')); ?>" class="btn btn-danger" style="width:100%" role="button">
                      <i class="fa fa-caret-right"></i> Discount Sales Rate Card
                    </a>
                  </p>
                </div>
              </div>
            </div>
            <?php endif; ?>
            <?php if(canAny(['Edit Outbound Rate Card', 'View Outbound Rate Card'])): ?>
            <div class="col-sm-6 col-md-2">
              <div class="thumbnail text-center bg-deltahs">
                <i class="fa fa-calendar fa-4x font-white"></i>
                <div class="caption text-center">
                  <p>
                    <a href="<?php echo e(route('gdr.index')); ?>" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> GDR rates</a>
                  </p>
                </div>
              </div>
            </div>
            <?php endif; ?>
            <?php if(canAny(['Create Users', 'View Users', 'Edit Users', 'Delete Users'])): ?>
            <div class="col-sm-6 col-md-2">
              <div class="thumbnail text-center bg-deltahs">
                <i class="fa fa-users fa-4x font-white"></i>
                <div class="caption text-center">
                  <p>
                    <a href="<?php echo e(route('user.index')); ?>" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Users</a>
                  </p>
                </div>
              </div>
            </div>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-settings')): ?>
            <div class="col-sm-6 col-md-2">
              <div class="thumbnail text-center bg-deltahs">
                <i class="fa fa-cog fa-4x font-white"></i>
                <div class="caption text-center">
                  <p>
                    <a href="<?php echo e(route('settings.index')); ?>" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Settings</a>
                  </p>
                </div>
              </div>
            </div>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-settings')): ?>
            <div class="col-sm-6 col-md-2">
              <div class="thumbnail text-center bg-deltahs">
                <i class="fa fa-dollar fa-4x font-white"></i>
                <div class="caption text-center">
                  <p>
                    <a href="<?php echo e(route('other-charges.index')); ?>" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Other charges</a>
                  </p>
                </div>
              </div>
            </div>
            <?php endif; ?>
            <div class="col-sm-6 col-md-2">
              <div class="thumbnail text-center bg-deltahs">
                <i class="fa fa-user fa-4x font-white"></i>
                <div class="caption text-center">
                  <p>
                    <a href="<?php echo e(route('clients.index')); ?>" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Clients</a>
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