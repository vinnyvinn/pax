<?php $__env->startSection('content'); ?>
    <div class="col-sm-10 col-sm-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                CBVS
                <a href="<?php echo e(route('cbv.create')); ?>" class="btn btn-primary btn-xs pull-right">New CBV</a>
            </div>
            <div class="panel-body">
                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th>CBV Number</th>
                        <th>Rate</th>
                        <th>Date Issued</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $cbvs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cbv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($cbv->number); ?></td>
                        <td><?php echo e($cbv->rate); ?></td>
                        <td><?php echo e(Carbon\Carbon::parse($cbv->date_issued)->format('d F Y')); ?></td>
                        <td><a href="<?php echo e(route('cbv.edit', $cbv->id)); ?>" class="btn btn-primary btn-xs">Edit</a></td>
                    </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>CBV Number</th>
                            <th>Rate</th>
                            <th>Date Issued</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>