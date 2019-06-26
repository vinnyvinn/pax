<?php $__env->startSection('content'); ?>
    <div class="col-sm-8 col-sm-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                Outbound Zones
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create-domestic-locations')): ?>
                <a href="<?php echo e(route('outbound-zones.create')); ?>" class="btn btn-primary btn-xs pull-right">Add New</a>
                <?php endif; ?>
            </div>
            <div class="panel-body">
                <table class="table table-responsive table-striped">
                    <thead>
                    <tr>
                        <th>Zone</th>
                        <th>Location</th>
                        <th>Country Code</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $zones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($zone->zone); ?></td>
                        <td><?php echo e($zone->name); ?></td>
                        <td><?php echo e($zone->code); ?></td>
                        <td class="text-center">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit-outbound-zones')): ?>
                                <a href="<?php echo e(route('outbound-zones.edit', $zone->id)); ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-outbound-zones')): ?>
                                <button type="button" class="btn btn-danger btn-xs btn-destroy" data-token="<?php echo e(csrf_token()); ?>" data-url="<?php echo e(route('outbound-zones.destroy', $zone->id)); ?>"><i class="fa fa-trash"></i></button>
                            <?php endif; ?>
                        </td>
                    </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Zone</th>
                            <th>Location</th>
                            <th>Country Code</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>