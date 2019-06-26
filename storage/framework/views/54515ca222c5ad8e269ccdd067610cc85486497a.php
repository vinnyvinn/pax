<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Inbound CBVs
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create-inbound-shipments')): ?>
                            <a href="<?php echo e(route('inbound-cbv.create')); ?>" class="btn btn-primary btn-xs pull-right">
                                <i class="fa fa-plus"></i> New
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="panel-body">
                        <table class="table dataTable table-striped">
                            <thead>
                            <tr>
                                <th class="printable">#</th>
                                <th class="printable">Manifest</th>
                                <th class="printable">Rate</th>
                                <th class="printable">Con Weight</th>
                                <th class="printable">Handlers</th>
                                <th width="100px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $cbvs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cbv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <?php if(Auth::user()->can('view-inbound-shipments')): ?>
                                        <td><a href="<?php echo e(route('inbound-cbv.show', $cbv->id)); ?>"><?php echo e($cbv->cbv_number); ?></a></td>
                                        <td><a href="<?php echo e(route('manifest.show', $cbv->manifest_id)); ?>">MAN-<?php echo e(str_pad($cbv->manifest_id, 5, '0', STR_PAD_LEFT)); ?></a></td>
                                    <?php else: ?>
                                        <td><?php echo e($cbv->cbv_number); ?></td>
                                        <td>MAN-<?php echo e(str_pad($cbv->manifest_id, 5, '0', STR_PAD_LEFT)); ?></td>
                                    <?php endif; ?>
                                    <td><?php echo e($cbv->cbv_rate); ?>/KG</td>
                                    <td><?php echo e($cbv->consignment_weight); ?> KGs</td>
                                    <td><?php echo e($cbv->handlers); ?></td>
                                    <td>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit-inbound-shipments')): ?>
                                            <a href="<?php echo e(route('inbound-cbv.edit', $cbv->id)); ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-inbound-shipments')): ?>
                                            <button type="button" class="btn btn-danger btn-xs btn-destroy" data-token="<?php echo e(csrf_token()); ?>" data-url="<?php echo e(route('inbound-cbv.destroy', $cbv->id)); ?>"><i class="fa fa-trash"></i></button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th class="printable">#</th>
                                <th class="printable">Manifest</th>
                                <th class="printable">Rate</th>
                                <th class="printable">Con Weight</th>
                                <th class="printable">Handlers</th>
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