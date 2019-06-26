<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li><a href="<?php echo e(route('finance-dashboard')); ?>">Finance dashboard</a></li>
                  <li class="active">Shipments</li>
                </ol>
                <hr>
            </div>
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Manifests
                    </div>
                    <div class="panel-body">
                        <table class="table dataTable table-striped">
                            <thead>
                            <tr>
                                <th class="printable">#</th>
                                <th class="printable">Flight Date</th>
                                <th class="printable">Flight Number</th>
                                <th class="printable">Is TNT</th>
                                <th class="printable">Type</th>
                                <th class="printable">Arrival Time</th>
                                <th width="100px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $manifests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manifest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <?php if(Auth::user()->can('view-inbound-shipments')): ?>
                                        <td><a href="<?php echo e(route('manifest.show',  [$manifest->id, 'page' => 'finance'])); ?>">MAN-<?php echo e(str_pad($manifest->id, 5, '0', STR_PAD_LEFT)); ?></a></td>
                                    <?php else: ?>
                                        <td>MAN-<?php echo e(str_pad($manifest->id, 5, '0', STR_PAD_LEFT)); ?></td>
                                    <?php endif; ?>
                                    <td><?php echo e(Carbon\Carbon::parse($manifest->flight_date)->format('d F Y')); ?></td>
                                    <td><?php echo e($manifest->flight_number); ?></td>
                                    <td><?php echo e($manifest->is_tnt ? 'TNT' : 'Normal'); ?></td>
                                    <td><?php echo e($manifest->manifest_type); ?></td>
                                    <td><?php echo e(Carbon\Carbon::parse($manifest->arrival_time)->toTimeString()); ?></td>
                                    <td>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit-inbound-shipments')): ?>
                                            <a href="<?php echo e(route('manifest.edit', $manifest->id)); ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-inbound-shipments')): ?>
                                            <button type="button" class="btn btn-danger btn-xs btn-destroy" data-token="<?php echo e(csrf_token()); ?>" data-url="<?php echo e(route('manifest.destroy', $manifest->id)); ?>"><i class="fa fa-trash"></i></button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th class="printable">#</th>
                                <th class="printable">Flight Date</th>
                                <th class="printable">Flight Number</th>
                                <th class="printable">Is TNT</th>
                                <th class="printable">Type</th>
                                <th class="printable">Arrival Time</th>
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