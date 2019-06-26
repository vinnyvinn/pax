<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Manifests
                        <a href="<?php echo e(route('manifest.create')); ?>" class="btn btn-primary btn-xs pull-right">
                            <i class="fa fa-plus"></i> New
                        </a>
                    </div>
                    <div class="panel-body">
                        <table class="table dataTable table-striped">
                            <thead>
                            <tr>
                                <th class="printable">#</th>
                                <th class="printable">Flight Date</th>
                                <th class="printable">Flight Number</th>
                                <th class="printable">Arrival Time</th>
                                <th class="printable">CBV Number</th>
                                <th class="text-right printable">CBV Rate</th>
                                <th class="text-right printable">Consignment Weight</th>
                                <th width="100px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $manifests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manifest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><a href="<?php echo e(route('manifest.show', $manifest->id)); ?>">MAN-<?php echo e(str_pad($manifest->id, 5, '0', STR_PAD_LEFT)); ?></a></td>
                                    <td><?php echo e(Carbon\Carbon::parse($manifest->flight_date)->format('d F Y')); ?></td>
                                    <td><?php echo e($manifest->flight_number); ?></td>
                                    <td><?php echo e(Carbon\Carbon::parse($manifest->arrival_time)->toTimeString()); ?></td>
                                    <td><?php echo e($manifest->cbv_number); ?></td>
                                    <td class="text-right">$<?php echo e(number_format($manifest->cbv_rate, 0)); ?>/KG</td>
                                    <td class="text-right"><?php echo e(number_format($manifest->consignment_weight, 0)); ?> KGs</td>
                                    <td>
                                        <a href="<?php echo e(route('manifest.edit', $manifest->id)); ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                        <button type="button" class="btn btn-danger btn-xs btn-destroy" data-token="<?php echo e(csrf_token()); ?>" data-url="<?php echo e(route('manifest.destroy', $manifest->id)); ?>"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Flight Date</th>
                                <th>Flight Number</th>
                                <th>Arrival Time</th>
                                <th>CBV Number</th>
                                <th>CBV Rate</th>
                                <th>Consignment Weight</th>
                                <th width="100px">Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>