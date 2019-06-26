<?php $__env->startSection('content'); ?>
    <div class="col-sm-10 col-sm-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                Create new Waybill
            </div>
            <div class="panel-body">
                <form action="<?php echo e(route('domestic.store')); ?>" method="post">
                    <?php echo e(csrf_field()); ?>

                    <domestic-waybill-create></domestic-waybill-create>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>