<?php $__env->startSection('content'); ?>
    <div class="col-sm-10 col-sm-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                Domestic Rates
            </div>
            <div class="panel-body">
                <table class="table table-responsive table-striped">
                    <thead>
                    <tr>
                        <th>Location A</th>
                        <th>Location B</th>
                        <th class="text-right">Amount</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $rates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($rate->from->name); ?></td>
                        <td><?php echo e($rate->to->name); ?></td>
                        <td class="text-right"><?php echo e(number_format($rate->amount, 2)); ?></td>
                        <td class="text-center">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit-domestic-rates')): ?>
                                <a href="<?php echo e(route('domestic-rates.edit', $rate->id)); ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Location A</th>
                            <th>Location B</th>
                            <th class="text-right">Amount</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>