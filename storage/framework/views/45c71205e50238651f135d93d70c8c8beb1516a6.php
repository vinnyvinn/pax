<?php $__env->startSection('content'); ?>

    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                HS Codes
                <a href="<?php echo e(route('hscode.create')); ?>" class="btn btn-primary btn-xs pull-right">Add HS Code</a>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>NO:</th>
                            <th>Code</th>
                            <th>Description</th>
                            <th>Unit of QTY</th>
                            <th>Rate</th>
                            <th >Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $hscodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hscode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e(ucwords($hscode->code)); ?></td>
                                <td><?php echo e($hscode->description); ?></td>
                                <td><?php echo e($hscode->unit_of_qty); ?></td>
                                <td><?php echo e($hscode->rate); ?></td>
                                <td>
                                    <a href="<?php echo e(route('hscode.edit', $hscode->id)); ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                    <button type="button" class="btn btn-danger btn-xs btn-destroy" data-token="<?php echo e(csrf_token()); ?>"
                                            data-url="<?php echo e(route('hscode.destroy', $hscode->id)); ?>"><i class="fa fa-trash"></i></button>
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