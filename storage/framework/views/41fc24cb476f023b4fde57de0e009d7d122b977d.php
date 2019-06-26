<?php $__env->startSection('content'); ?>
<div class="row">
        <div class="col-md-3">
            <div class="card bg-primary p-20">
                <div class="media widget-ten">
                    <div class="media-left meida media-middle">
                        <span><i class="fa fa-plus f-s-40"></i></span>
                    </div>
                    <div class="media-body media-text-right">
                        <h2 class="color-white">Add pickup</h2>
                        <p class="m-b-0">
                        <a href="<?php echo e(route('pickups.create')); ?>" class="btn btn-sm btn-warning">Add <i class="fa fa-plus"></i></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-pink p-20">
                <div class="media widget-ten">
                    <div class="media-left meida media-middle">
                        <span><i class="fa fa-briefcase f-s-40"></i></span>
                    </div>
                    <div class="media-body media-text-right">
                        <h2 class="color-white">Pickup management</h2>
                        <p class="m-b-0">
                        <a href="<?php echo e(route('pickups.index')); ?>" class="btn btn-flat btn-primary">View <i class="fa fa-caret-right"></i></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success p-20">
                <div class="media widget-ten">
                    <div class="media-left meida media-middle">
                        <span><i class="fa fa-list f-s-40"></i></span>
                    </div>
                    <div class="media-body media-text-right">
                        <h2 class="color-white">Posted</h2>
                        <p class="m-b-0">
                            <a href="" class="btn btn-sm btn-info">View <i class="fa fa-caret-right"></i></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-primary p-20">
                <div class="media widget-ten">
                    <div class="media-left meida media-middle">
                        <span><i class="ti-location-pin f-s-40"></i></span>
                    </div>
                    <div class="media-body media-text-right">
                        <h2 class="color-white">Collected</h2>
                        <p class="m-b-0">
                            <a href="" class="btn btn-sm btn-primary">View <i class="fa fa-caret-right"></i></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger p-20">
                <div class="media widget-ten">
                    <div class="media-left meida media-middle">
                        <span><i class="ti-location-pin f-s-40"></i></span>
                    </div>
                    <div class="media-body media-text-right">
                        <h2 class="color-white">Postponed</h2>
                        <p class="m-b-0">
                            <a href="" class="btn btn-sm btn-primary">View <i class="fa fa-caret-right"></i></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning p-20">
                <div class="media widget-ten">
                    <div class="media-left meida media-middle">
                        <span><i class="ti-location-pin f-s-40"></i></span>
                    </div>
                    <div class="media-body media-text-right">
                        <h2 class="color-white">Rescheduled</h2>
                        <p class="m-b-0">
                            <a href="" class="btn btn-sm btn-primary">View <i class="fa fa-caret-right"></i></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dispatch.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>