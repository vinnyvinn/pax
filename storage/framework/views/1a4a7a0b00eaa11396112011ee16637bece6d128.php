<?php $__env->startSection('content'); ?>
    <div class="col-sm-10 col-sm-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                Outbound Rates
            </div>
            <div class="panel-body">
                <table class="table table-responsive table-striped">
                    <thead>
                    <tr>
                        <th>Packaging</th>
                        <th class="text-right">Weight</th>
                        <th class="text-right">Zone A</th>
                        <th class="text-right">Zone B</th>
                        <th class="text-right">Zone C</th>
                        <th class="text-right">Zone D</th>
                        <th class="text-right">Zone E</th>
                        <th class="text-right">Zone F</th>
                        <th class="text-right">Zone G</th>
                        <th class="text-right">Zone H</th>
                        <th class="text-right">Zone I</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $rates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($rate->getPackaging()); ?></td>
                        <td class="text-right"><?php echo e(number_format($rate->weight, 2)); ?></td>
                        <td class="text-right"><?php echo e(number_format($rate->zone_a, 2)); ?></td>
                        <td class="text-right"><?php echo e(number_format($rate->zone_b, 2)); ?></td>
                        <td class="text-right"><?php echo e(number_format($rate->zone_c, 2)); ?></td>
                        <td class="text-right"><?php echo e(number_format($rate->zone_d, 2)); ?></td>
                        <td class="text-right"><?php echo e(number_format($rate->zone_e, 2)); ?></td>
                        <td class="text-right"><?php echo e(number_format($rate->zone_f, 2)); ?></td>
                        <td class="text-right"><?php echo e(number_format($rate->zone_g, 2)); ?></td>
                        <td class="text-right"><?php echo e(number_format($rate->zone_h, 2)); ?></td>
                        <td class="text-right"><?php echo e(number_format($rate->zone_i, 2)); ?></td>
                        <td class="text-center">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit-outbound-rate-card')): ?>
                                <a href="<?php echo e(route('rate-card.edit', $rate->id)); ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Packaging</th>
                            <th>Weight</th>
                            <th class="text-right">Zone A</th>
                            <th class="text-right">Zone B</th>
                            <th class="text-right">Zone C</th>
                            <th class="text-right">Zone D</th>
                            <th class="text-right">Zone E</th>
                            <th class="text-right">Zone F</th>
                            <th class="text-right">Zone G</th>
                            <th class="text-right">Zone H</th>
                            <th class="text-right">Zone I</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>