<?php $__env->startSection('content'); ?>
    <div class="col-sm-10 col-sm-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                Create new Waybill
            </div>
            <div class="panel-body">
                <form action="<?php echo e(route('domestic.store')); ?>" method="post">
                    <?php echo e(csrf_field()); ?>


                    <div class="row">
                        <div class="col-sm-12">
                            <h3>From</h3>

                            <div class="form-group">
                                <label for="client_id">From Client</label>
                                <select name="client_id" id="client_id" class="form-control">
                                    <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($client->DCLink); ?>"><?php echo e($client->Name); ?> <?php echo e($client->Account); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">

                            <div class="form-group">
                                <label for="shipper_name">Shipper's Name</label>
                                <input type="text" name="shipper_name" id="shipper_name" class="form-control" required value="<?php echo e(old('shipper_name')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="shipper_phone">Phone</label>
                                <input type="number" name="shipper_phone" id="shipper_phone" class="form-control" required value="<?php echo e(old('shipper_phone')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="shipper_company">Company</label>
                                <input type="text" name="shipper_company" id="shipper_company" class="form-control" value="<?php echo e(old('shipper_company')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="shipper_country">Country</label>
                                <input type="text" name="shipper_country" id="shipper_country" class="form-control" required value="<?php echo e(old('shipper_country')); ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="shipper_address">Address</label>
                                <input type="text" name="shipper_address" id="shipper_address" class="form-control" required value="<?php echo e(old('shipper_address')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="shipper_address_alternate">Alternative Address</label>
                                <input type="text" name="shipper_address_alternate" id="shipper_address_alternate" class="form-control" value="<?php echo e(old('shipper_address_alternate')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="shipper_city">City</label>
                                <select name="shipper_city" id="shipper_city" class="form-control">
                                    <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($location->id); ?>"><?php echo e($location->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <h3>To</h3>
                        </div>
                        <div class="col-sm-6">

                            <div class="form-group">
                                <label for="con_name">Recipient's Name</label>
                                <input type="text" name="con_name" id="con_name" class="form-control" required value="<?php echo e(old('con_name')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="con_phone">Phone</label>
                                <input type="number" name="con_phone" id="con_phone" class="form-control" required value="<?php echo e(old('con_phone')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="con_company">Company</label>
                                <input type="text" name="con_company" id="con_company" class="form-control" value="<?php echo e(old('con_company')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="con_country">Country</label>
                                <input type="text" name="con_country" id="con_country" class="form-control" required value="<?php echo e(old('con_country')); ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="con_address">Address</label>
                                <input type="text" name="con_address" id="con_address" class="form-control" required value="<?php echo e(old('con_address')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="con_address_alternate">Alternative Address</label>
                                <input type="text" name="con_address_alternate" id="con_address_alternate" class="form-control" value="<?php echo e(old('con_address_alternate')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="con_city">City</label>
                                <select name="con_city" id="con_city" class="form-control">
                                    <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($location->id); ?>"><?php echo e($location->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
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
                                <input type="number" name="total_package" id="total_package" class="form-control" value="<?php echo e(old('total_package')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="shipment_description">Description</label>
                                <textarea name="shipment_description" required id="shipment_description" rows="5" class="form-control"><?php echo e(old('shipment_description')); ?></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="weight">Total Weight (KGs)</label>
                                <input type="number" name="weight" id="weight" class="form-control"  value="<?php echo e(old('weight')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="shipment_value">Value</label>
                                <input type="text" name="shipment_value" id="shipment_value" class="form-control" value="<?php echo e(old('shipment_value')); ?>">
                            </div>

                            <h5><strong>DIM (L/W/H CM)</strong></h5>
                            <div class="row">
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" name="length" placeholder="Length" required>
                                </div>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" name="width" placeholder="width" required>
                                </div>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" name="height" placeholder="height" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <h3>Packaging</h3>
                            <div class="form-group">
                                <label for="packaging">Packaging</label>
                                <select name="packaging" id="packaging" class="form-control">
                                    <option value="1"<?php echo e(old('packaging') == '1' ? ' selected' : ''); ?>>CUSTOMER PACKAGING</option>
                                    <option value="2"<?php echo e(old('packaging') == '2' ? ' selected' : ''); ?>>FEDEX PAK</option>
                                    <option value="3"<?php echo e(old('packaging') == '3' ? ' selected' : ''); ?>>FEDEX BOX</option>
                                    <option value="4"<?php echo e(old('packaging') == '4' ? ' selected' : ''); ?>>FEDEX TUBE</option>
                                    <option value="6"<?php echo e(old('packaging') == '6' ? ' selected' : ''); ?>>FEDEX LETTER</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="special_handling"><strong>Special Handling</strong></label>
                            <select name="special_handling" id="special_handling" class="form-control">
                                <option value="None">None</option>
                                <option value="HOLD at PAX Location">HOLD at PAX Location</option>
                                <option value="SATURDAY Delivery">SATURDAY Delivery</option>
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="internal_billing_reference">Internal Billing Reference</label>
                                <input type="number" name="internal_billing_reference" id="internal_billing_reference" class="form-control"  value="<?php echo e(old('internal_billing_reference')); ?>">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="bill_to"><strong>Bill To</strong></label>
                            <select name="bill_to" id="bill_to" class="form-control">
                                <option value="O">Other</option>
                                <option value="S">Shipper</option>
                                <option value="C">Consignee</option>
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <label for="bill_duty"><strong>Bill Duty</strong></label>
                            <select name="bill_duty" id="bill_duty" class="form-control">
                                <option value="O">Other</option>
                                <option value="S">Shipper</option>
                                <option value="C">Consignee</option>
                            </select>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="submit" class="btn btn-success" value="Save">
                                <a href="<?php echo e(route('domestic.index')); ?>" class="btn btn-danger">Back</a>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>