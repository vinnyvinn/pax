<?php $__env->startSection('content'); ?>
    <div class="col-sm-10 col-sm-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                CBVS
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create-cbv')): ?>
                    <a href="<?php echo e(route('cbv.create')); ?>" class="btn btn-primary btn-xs pull-right">New CBV</a>
                <?php endif; ?>
            </div>
            <div class="panel-body">
                <table class="table table-responsive table-striped">
                    <thead>
                    <tr>
                        <th>CBV Number</th>
                        <th>Date Issued</th>
                        <th>Date Used</th>
                        <th class="text-right">Rate</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $cbvs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cbv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($cbv->number); ?></td>
                            <td><?php echo e(Carbon\Carbon::parse($cbv->date_issued)->format('d F Y')); ?></td>
                            <td><?php echo e($cbv->used_on ? Carbon\Carbon::parse($cbv->used_on)->format('d F Y') : ''); ?></td>
                            <td class="text-right">$<?php echo e($cbv->rate); ?> Per KG</td>
                            <td><?php echo e($cbv->used ? 'Used' : 'Unused'); ?></td>
                            <td class="text-center">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit-cbv')): ?>
                                    <a href="<?php echo e(route('cbv.edit', $cbv->id)); ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-cbv')): ?>
                                    <button type="button" class="btn btn-danger btn-xs btn-destroy" data-token="<?php echo e(csrf_token()); ?>" data-url="<?php echo e(route('cbv.destroy', $cbv->id)); ?>"><i class="fa fa-trash"></i></button>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>CBV Number</th>
                            <th>Date Issued</th>
                            <th>Date Used</th>
                            <th>Rate</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>