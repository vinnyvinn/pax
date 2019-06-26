<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <form action="<?php echo e(isset($route) ? $route : route('waybill.store')); ?>" method="post" role="form">
                    <?php echo e(csrf_field()); ?>

                    <?php if(isset($manifest)): ?>
                        <input type="hidden" name="manifest_id" value="<?php echo e($manifest); ?>">
                    <?php endif; ?>

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Waybill Details
                        </div>

                        <div class="panel-body">

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#details" aria-controls="details" role="tab" data-toggle="tab">Flight Details</a></li>
                                <li role="presentation"><a href="#waybills" aria-controls="waybills" role="tab" data-toggle="tab">Waybill Details</a></li>
                                <li role="presentation"><a href="#dutiable-waybills" aria-controls="dutiable-waybills" role="tab" data-toggle="tab">Consignee Details</a></li>
                                <li role="presentation"><a href="#non-dutiable-waybills" aria-controls="non-dutiable-waybills" role="tab" data-toggle="tab">Shipper Details</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="details">
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h5><strong>Flight Number</strong></h5>
                                            <p><?php echo e($waybill->manifest->flight_number); ?></p>

                                            <h5><strong>Flight Date</strong></h5>
                                            <p><?php echo e(Carbon\Carbon::parse($waybill->manifest->flight_date)->format('l dS F Y')); ?></p>

                                            <h5><strong>Flight Arrival Time</strong></h5>
                                            <p><?php echo e($waybill->manifest->arrival_time); ?></p>

                                        </div>
                                        <div class="col-sm-6">
                                            <h5><strong>CBV Number</strong></h5>
                                            <p><?php echo e($waybill->manifest->cbv_number); ?></p>

                                            <h5><strong>CBV Rate</strong></h5>
                                            <p>$<?php echo e(number_format($waybill->manifest->cbv_rate, 0)); ?></p>

                                            <h5><strong>Total Consignment Weight</strong></h5>
                                            <p><?php echo e(number_format($waybill->manifest->consignment_weight, 0)); ?> KGs</p>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="waybills">
                                    <br>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="waybill_number"><strong>Waybill Number</strong></label>
                                            <input type="text" class="form-control" id="waybill_number" name="waybill_number" value="<?php echo e($waybill->waybill_number); ?>" required>

                                            <label for="crn_number"><strong>CRN Number</strong></label>
                                            <input type="text" class="form-control" id="crn_number" name="crn_number" value="<?php echo e($waybill->crn_number); ?>">

                                            <label for="shipped_date"><strong>Shipped Date</strong></label>
                                            <input type="text" class="form-control datepicker" id="shipped_date" name="shipped_date" value="<?php echo e($waybill->shipped_date); ?>" required>

                                            <label for="weight"><strong>Weight e.g. 10K or 10L</strong></label>
                                            <input type="text" class="form-control" id="weight" name="weight" value="<?php echo e($waybill->weight); ?>" required>

                                        </div>

                                        <div class="col-sm-4">

                                            <label for="origin"><strong>Origin (<?php echo e($waybill->origin); ?>)</strong></label>
                                            <input type="text" class="form-control" id="origin" name="origin" value="<?php echo e($waybill->origin); ?>" required>


                                            <label for="destination"><strong>Destination (<?php echo e($waybill->destination); ?>)</strong></label>
                                            <input type="text" class="form-control" id="destination" name="destination" value="<?php echo e($waybill->destination); ?>" required>

                                            <label for="export_city"><strong>Export Country (<?php echo e($waybill->export_city); ?>)</strong></label>
                                            <select name="export_city" id="export_city" class="form-control">
                                                <?php $__currentLoopData = countries(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($value); ?>"<?php echo e($waybill->export_city == $value ? ' selected' : ''); ?>><?php echo e($key); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>

                                            <label for="value"><strong>Value (<?php echo e($waybill->currency); ?> <?php echo e(number_format($waybill->value, 2)); ?>)</strong></label>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <select name="currency" id="currency" class="form-control">
                                                        <?php $__currentLoopData = currencies(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($value); ?>"<?php echo e($waybill->currency == $value ? ' selected' : ''); ?>><?php echo e($value); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" id="value" name="value" value="<?php echo e($waybill->value); ?>" required>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-sm-4">

                                            <label for="bill_to"><strong>Bill To (<?php echo e($waybill->bill_to); ?>)</strong></label>
                                            <select name="bill_to" id="bill_to" class="form-control">
                                                <option value="O"<?php echo e($waybill->bill_to == 'O' ? ' selected' : ''); ?>>O</option>
                                                <option value="S"<?php echo e($waybill->bill_to == 'S' ? ' selected' : ''); ?>>S</option>
                                                <option value="C"<?php echo e($waybill->bill_to == 'C' ? ' selected' : ''); ?>>C</option>
                                            </select>

                                            <label for="bill_duty"><strong>Bill Duty (<?php echo e($waybill->bill_duty); ?>)</strong></label>
                                            <select name="bill_duty" id="bill_duty" class="form-control">
                                                <option value="O"<?php echo e($waybill->bill_duty == 'O' ? ' selected' : ''); ?>>O</option>
                                                <option value="S"<?php echo e($waybill->bill_duty == 'S' ? ' selected' : ''); ?>>S</option>
                                                <option value="C"<?php echo e($waybill->bill_duty == 'C' ? ' selected' : ''); ?>>C</option>
                                            </select>

                                            <label for="total"><strong>Total Items (<?php echo e($waybill->total); ?>)</strong></label>
                                            <input type="number" class="form-control" id="total" name="total" value="<?php echo e($waybill->total); ?>" required>

                                            <label for="description"><strong>Description (<?php echo e($waybill->description); ?>)</strong></label>
                                            <textarea class="form-control" id="description" name="description" required><?php echo e($waybill->description); ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane" id="dutiable-waybills">

                                    <br>
                                    <div class="row">
                                        <div class="col-sm-4">

                                            <label for="con_name"><strong>Name (<?php echo e($waybill->con_name); ?>)</strong></label>
                                            <input type="text" class="form-control" id="con_name" name="con_name" value="<?php echo e($waybill->con_name); ?>" required>

                                            <label for="con_company"><strong>Company (<?php echo e($waybill->con_company ?: '-'); ?>)</strong></label>
                                            <input type="text" class="form-control" id="con_company" name="con_company" value="<?php echo e($waybill->con_company); ?>">

                                            <label for="con_phone"><strong>Phone (<?php echo e($waybill->con_phone); ?>)</strong></label>
                                            <input type="text" class="form-control" id="con_phone" name="con_phone" value="<?php echo e($waybill->con_phone); ?>" required>
                                        </div>

                                        <div class="col-sm-4">

                                            <label for="con_address"><strong>Address (<?php echo e($waybill->con_address ?: '-'); ?>)</strong></label>
                                            <input type="text" class="form-control" id="con_address" name="con_address" value="<?php echo e($waybill->con_address); ?>" required>

                                            <label for="con_address_alternate"><strong>Alternate Address (<?php echo e($waybill->con_address_alternate ?: '-'); ?>)</strong></label>
                                            <input type="text" class="form-control" id="con_address_alternate" name="con_address_alternate" value="<?php echo e($waybill->con_address_alternate); ?>">

                                            <label for="con_city"><strong>City (<?php echo e($waybill->con_city ?: '-'); ?>)</strong></label>
                                            <input type="text" class="form-control" id="con_city" name="con_city" value="<?php echo e($waybill->con_city); ?>" required>

                                        </div>
                                        <div class="col-sm-4">

                                            <label for="con_state"><strong>State (<?php echo e($waybill->con_state ?: '-'); ?>)</strong></label>
                                            <input type="text" class="form-control" id="con_state" name="con_state" value="<?php echo e($waybill->con_state); ?>">

                                            <label for="con_country"><strong>Country (<?php echo e($waybill->con_country ?: '-'); ?>)</strong></label>
                                            <select name="con_country" id="con_country" class="form-control">
                                                <?php $__currentLoopData = countries(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($value); ?>"<?php echo e($waybill->con_country == $value ? ' selected' : ''); ?>><?php echo e($key); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>

                                            <label for="con_postal"><strong>Postal (<?php echo e($waybill->con_postal ?: '-'); ?>)</strong></label>
                                            <input type="text" class="form-control" id="con_postal" name="con_postal" value="<?php echo e($waybill->con_postal); ?>">

                                        </div>
                                    </div>
                                    
                                </div>

                                <div role="tabpanel" class="tab-pane" id="non-dutiable-waybills">

                                    <br>

                                    <div class="row">
                                        <div class="col-sm-4">

                                            <label for="shipper_name"><strong>Name (<?php echo e($waybill->shipper_name); ?>)</strong></label>
                                            <input type="text" class="form-control" id="shipper_name" name="shipper_name" value="<?php echo e($waybill->shipper_name); ?>" required>

                                            <label for="shipper_company"><strong>Company (<?php echo e($waybill->shipper_company ?: '-'); ?>)</strong></label>
                                            <input type="text" class="form-control" id="shipper_company" name="shipper_company" value="<?php echo e($waybill->shipper_company); ?>" required>

                                            <label for="shipper_phone"><strong>Phone (<?php echo e($waybill->shipper_phone); ?>)</strong></label>
                                            <input type="text" class="form-control" id="shipper_phone" name="shipper_phone" value="<?php echo e($waybill->shipper_phone); ?>" required>
                                        </div>

                                        <div class="col-sm-4">

                                            <label for="shipper_address"><strong>Address (<?php echo e($waybill->shipper_address ?: '-'); ?>)</strong></label>
                                            <input type="text" class="form-control" id="shipper_address" name="shipper_address" value="<?php echo e($waybill->shipper_address); ?>" required>

                                            <label for="shipper_address_alternate"><strong>Alternate Address (<?php echo e($waybill->shipper_address_alternate ?: '-'); ?>)</strong></label>
                                            <input type="text" class="form-control" id="shipper_address_alternate" name="shipper_address_alternate" value="<?php echo e($waybill->shipper_address_alternate); ?>">

                                            <label for="shipper_city"><strong>City (<?php echo e($waybill->shipper_company ?: '-'); ?>)</strong></label>
                                            <input type="text" class="form-control" id="shipper_city" name="shipper_city" value="<?php echo e($waybill->shipper_city); ?>" required>

                                        </div>
                                        <div class="col-sm-4">

                                            <label for="shipper_state"><strong>State (<?php echo e($waybill->shipper_state ?: '-'); ?>)</strong></label>
                                            <input type="text" class="form-control" id="shipper_state" name="shipper_state" value="<?php echo e($waybill->shipper_state); ?>">

                                            <label for="shipper_country"><strong>Country (<?php echo e($waybill->shipper_state ?: '-'); ?>)</strong></label>
                                            <select name="shipper_country" id="shipper_country" class="form-control">
                                                <?php $__currentLoopData = countries(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($value); ?>"<?php echo e($waybill->shipper_country == $value ? ' selected' : ''); ?>><?php echo e($key); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>

                                            <label for="shipper_postal"><strong>Postal (<?php echo e($waybill->shipper_state ?: '-'); ?>)</strong></label>
                                            <input type="text" class="form-control" id="shipper_postal" name="shipper_postal" value="<?php echo e($waybill->shipper_postal); ?>">

                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="panel-footer">
                            <a href="<?php echo e(URL::previous()); ?>" class="btn btn-danger">Back</a>
                            <input type="submit" class="btn btn-success" value="Save Changes">
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>