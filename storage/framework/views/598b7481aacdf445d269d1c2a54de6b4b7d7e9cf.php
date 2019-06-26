<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Receive Shipment
                    </div>

                    <div class="panel-body">
                        <form action="<?php echo e(route('non-receive', $waybill->id)); ?>" method="post" role="form">
                            <?php echo e(csrf_field()); ?>


                            <div class="row">
                                <div class="col-sm-6">
                                    <h4>Waybill Number</h4>
                                    <h5><?php echo e($waybill->waybill_number); ?></h5>

                                    <h4>Shipped From</h4>
                                    <h5><?php echo e(getCountry($waybill->export_city)); ?></h5>
                                </div>

                                <div class="col-sm-6">
                                    <h4>Consignee</h4>
                                    <h5><?php echo e($waybill->con_name); ?> <?php echo e($waybill->con_phone); ?></h5>

                                    <h4>Shipper</h4>
                                    <h5><?php echo e($waybill->shipper_name); ?> <?php echo e($waybill->shipper_phone); ?></h5>
                                </div>
                            </div>

                            <div class="form-group<?php echo e($errors->has('type') ? ' has-error' : ''); ?>">
                                <label for="type">Waybill Type*</label>
                                <select class="form-control" name="type" id="type" required>
                                    <option value="71">Dutiable</option>
                                    <option value="72">Non-Dutiable</option>
                                </select>

                                <?php if($errors->has('type')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('type')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Update</button>
                                <a href="<?php echo e(URL::previous()); ?>" class="btn btn-danger">Back</a>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>