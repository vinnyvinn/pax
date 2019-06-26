<?php $__env->startSection('content'); ?>

    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                Couriers
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create-couriers')): ?>
                    <a href="<?php echo e(route('courier.create')); ?>" class="btn btn-primary btn-xs pull-right">Add Courier</a>
                <?php endif; ?>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>NO:</th>
                            <th>Name</th>
                            <th>FedEx ID</th>
                            <th>National/Passport NO:</th>
                            <th>Phone</th>
                            <th >Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $couriers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $courier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e(ucwords($courier->name)); ?></td>
                                <td><?php echo e($courier->fedex_id); ?></td>
                                <td><?php echo e($courier->national_id); ?></td>
                                <td><?php echo e($courier->phone); ?></td>
                                <td>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit-couriers')): ?>
                                        <a href="<?php echo e(route('courier.edit', $courier->id)); ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-couriers')): ?>
                                        <button type="button" class="btn btn-danger btn-xs btn-destroy" data-token="<?php echo e(csrf_token()); ?>"
                                            data-url="<?php echo e(route('courier.destroy', $courier->id)); ?>"><i class="fa fa-trash"></i></button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>