<?php $__env->startSection('content'); ?>
    <div class="col-sm-10 col-sm-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                Edit Waybill
            </div>
            <div class="panel-body">
                <form action="<?php echo e(route('domestic.update', $domestic->id)); ?>" method="post">
                    <?php echo e(csrf_field()); ?>

                    <?php echo e(method_field('PUT')); ?>

                    <div class="form-group">
                        <label for="client_id">Client Name</label>
                        <select name="client_id" id="client_id" class="form-control">
                            <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($client->DCLink); ?>"><?php echo e($client->Name); ?> <?php echo e($client->Account); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-sm-12">
                        <h3>To</h3>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="con_name">Sender Name</label>
                            <input type="text" name="con_name" id="con_name" class="form-control" required
                                   value="<?php echo e($domestic->con_name); ?>">
                        </div>
                        <div class="form-group">
                            <label for="con_phone">Phone</label>
                            <input type="number" name="con_phone" id="con_phone" class="form-control" required
                                   value="<?php echo e($domestic->con_phone); ?>">
                        </div>
                        <div class="form-group">
                            <label for="con_company">Company</label>
                            <input type="text" name="con_company" id="con_company" class="form-control" required
                                   value="<?php echo e($domestic->con_company); ?>">
                        </div>
                        <div class="form-group">
                            <label for="con_country">Country</label>
                            <input type="text" name="con_country" id="con_country" class="form-control" required
                                   value="<?php echo e($domestic->con_country); ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="con_address">Address</label>
                            <input type="text" name="con_address" id="con_address" class="form-control" required
                                   value="<?php echo e($domestic->con_address); ?>">
                        </div>
                        <div class="form-group">
                            <label for="con_address_alternate">Alternative Address</label>
                            <input type="text" name="con_address_alternate" id="con_address_alternate"
                                   class="form-control" required value="<?php echo e($domestic->con_address_alternate); ?>">
                        </div>
                        <div class="form-group">
                            <label for="con_city">City</label>
                            <input type="text" name="con_city" id="con_city" class="form-control" required
                                   value="<?php echo e($domestic->con_city); ?>">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <h3>Shipment Information</h3>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="total_package">Total Packages</label>
                            <input type="number" name="total_package" id="total_package" class="form-control"
                                   value="<?php echo e($domestic->total_package); ?>">
                        </div>
                        <div class="form-group">
                            <label for="shipment_description">Description</label>
                            <input type="text" name="shipment_description" id="shipment_description"
                                   class="form-control" value="<?php echo e($domestic->shipment_description); ?>">
                        </div>
                    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>