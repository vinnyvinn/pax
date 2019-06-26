<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li><a href="<?php echo e(route('outbound-dashboard')); ?>">Outbound dashboard</a></li>
                  <li class="active">Outbound Manifests</li>
                </ol>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Outbound Manifests
                        <a href="<?php echo e(route('outbound.create')); ?>" class="btn btn-primary btn-xs pull-right">
                            <i class="fa fa-plus"></i> New
                        </a>
                    </div>
                    <div class="panel-body">
                        <table class="table dataTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Flight Date</th>
                                <th>Flight Number</th>
                                <th>Departure Time</th>
                                <th>CBV Number</th>
                                <th class="text-right">CBV Rate</th>
                                <th class="text-right">Consignment Weight</th>
                                <th width="100px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $manifests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manifest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><a href="<?php echo e(route('outbound.show', $manifest->id)); ?>">MAN-<?php echo e(str_pad($manifest->id, 5, '0', STR_PAD_LEFT)); ?></a></td>
                                    <td><?php echo e(Carbon\Carbon::parse($manifest->flight_date)->format('d F Y')); ?></td>
                                    <td><?php echo e($manifest->flight_number); ?></td>
                                    <td><?php echo e(Carbon\Carbon::parse($manifest->arrival_time)->toTimeString()); ?></td>
                                    <td><?php echo e($manifest->cbv_number); ?></td>
                                    <td class="text-right">$<?php echo e($manifest->cbv_rate); ?>/KG</td>
                                    <td class="text-right"><?php echo e($manifest->consignment_weight); ?> KGs</td>
                                    <td>
                                        <a href="<?php echo e(route('outbound.edit', $manifest->id)); ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                                        <button type="button" class="btn btn-danger btn-sm btn-destroy" data-token="<?php echo e(csrf_token()); ?>" data-url="<?php echo e(route('outbound.destroy', $manifest->id)); ?>"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Flight Date</th>
                                <th>Flight Number</th>
                                <th>Departure Time</th>
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