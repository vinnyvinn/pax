<?php $__env->startSection('content'); ?>
    <div class="col-sm-8 col-sm-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                View Waybill
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h3>From</h3>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="shipper_name">Shipper's Name</label>
                            <div><?php echo e($domestic->shipper_name); ?></div>
                        </div>
                        <div class="form-group">
                            <label for="shipper_phone">Phone</label>
                            <div><?php echo e($domestic->shipper_phone); ?></div>
                        </div>
                        <div class="form-group">
                            <label for="shipper_company">Company</label>
                            <div><?php echo e($domestic->shipper_company); ?></div>
                        </div>
                        <div class="form-group">
                            <label for="shipper_country">Country</label>
                            <div><?php echo e($domestic->shipper_country); ?></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="shipper_address">Address</label>
                            <div><?php echo e($domestic->shipper_address); ?></div>
                        </div>
                        <div class="form-group">
                            <label for="shipper_address_alternate">Alternative Address</label>
                            <div><?php echo e($domestic->shipper_address_alternate); ?></div>
                        </div>
                        <div class="form-group">
                            <label for="shipper_city">City</label>
                            <div><?php echo e($domestic->shipper_city); ?></div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-sm-12">
                        <h3>To</h3>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="con_name">Consignee's Name</label>
                            <div><?php echo e($domestic->con_name); ?></div>
                        </div>
                        <div class="form-group">
                            <label for="con_phone">Phone</label>
                            <div><?php echo e($domestic->con_phone); ?></div>
                        </div>
                        <div class="form-group">
                            <label for="con_company">Company</label>
                            <div><?php echo e($domestic->con_company); ?></div>
                        </div>
                        <div class="form-group">
                            <label for="con_country">Country</label>
                            <div><?php echo e($domestic->con_country); ?></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="con_address">Address</label>
                            <div><?php echo e($domestic->con_address); ?></div>
                        </div>
                        <div class="form-group">
                            <label for="con_address_alternate">Alternative Address</label>
                            <div><?php echo e($domestic->con_address_alternate); ?></div>
                        </div>
                        <div class="form-group">
                            <label for="con_city">City</label>
                            <div><?php echo e($domestic->con_city); ?></div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-sm-12">
                        <h3>Shipment Information</h3>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="total_package">Total Packages</label>
                            <div><?php echo e($domestic->total_package); ?></div>
                        </div>
                        <div class="form-group">
                            <label for="shipment_description">Description</label>
                            <div><?php echo e($domestic->shipment_description); ?></div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="weight">Total Weight(kgs)</label>
                            <div><?php echo e($domestic->weight); ?></div>
                        </div>
                        <div class="form-group">
                            <label for="shipment_value">Value</label>
                            <div><?php echo e($domestic->shipment_value); ?></div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <h3>Packaging</h3>
                        <div class="form-group">
                            <label for="packaging">Packaging</label>
                            <div><?php echo e($domestic->packaging); ?></div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <a href="<?php echo e(route('domestic.edit', $domestic->id)); ?>" class="btn btn-success">Edit</a>
                            <a href="<?php echo e(route('domestic.index')); ?>" class="btn btn-danger">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>