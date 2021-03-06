<?php $__env->startSection('content'); ?>
    <div class="col-sm-10 col-sm-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                Domestic Waybill
                <a href= "<?php echo e(route('domestic.create')); ?>" class="btn btn-primary btn-xs pull-right">
                    New Waybill
                </a>
            </div>
            <div class="panel-body">
                <table class="table table-responsive table-hover">
                    <thead>
                    <tr>
                        <th>Waybill #</th>
                        <th>Shipper Name</th>
                        <th>Shipper Phone</th>
                        <th>Shipper Address</th>
                        <th>Consignee Name</th>
                        <th>Consignee Phone</th>
                        <th>Consignee Address</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $domestics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $domestic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><a target="_blank" href="<?php echo e(route('domestic.show', $domestic->id)); ?>"><?php echo e(chunk_split(str_pad($domestic->id, 12, '0', STR_PAD_LEFT), 3, ' ')); ?></a></td>
                        <td><?php echo e($domestic->con_name); ?></td>
                        <td><?php echo e($domestic->con_phone); ?></td>
                        <td><?php echo e($domestic->con_address); ?></td>
                        <td><?php echo e($domestic->shipper_name); ?></td>
                        <td><?php echo e($domestic->shipper_phone); ?></td>
                        <td><?php echo e($domestic->shipper_address); ?></td>
                        <td>
                            <?php if($domestic->status == PAX\Models\DomesticWaybill::STATUS_RAW): ?>
                                <a href="<?php echo e(route('domestic.edit', $domestic->id)); ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Waybill #</th>
                        <th>Shipper Name</th>
                        <th>Shipper Phone</th>
                        <th>Shipper Address</th>
                        <th>Consignee Name</th>
                        <th>Consignee Phone</th>
                        <th>Consignee Address</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>