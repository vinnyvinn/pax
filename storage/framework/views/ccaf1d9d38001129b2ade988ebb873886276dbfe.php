<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Waybill <?php echo e($waybill->waybill_number); ?> Details
                    </div>

                    <div class="panel-body">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#details" aria-controls="details" role="tab" data-toggle="tab">Flight Details</a></li>
                            <li role="presentation"><a href="#waybills" aria-controls="waybills" role="tab" data-toggle="tab">Waybill Details</a></li>
                            <li role="presentation"><a href="#dutiable-waybills" aria-controls="dutiable-waybills" role="tab" data-toggle="tab">Consignee Details</a></li>
                            <li role="presentation"><a href="#non-dutiable-waybills" aria-controls="non-dutiable-waybills" role="tab" data-toggle="tab">Shipper Details</a></li>
                            <?php if($waybill->type == 71): ?>
                                <li role="presentation"><a href="#clearance" aria-controls="non-dutiable-waybills" role="tab" data-toggle="tab">Clearance Details</a></li>
                            <?php endif; ?>
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
                                        <h5><strong>Waybill Number</strong></h5>
                                        <p><?php echo e($waybill->waybill_number); ?></p>

                                        <h5><strong>CRN Number</strong></h5>
                                        <p><?php echo e($waybill->crn_number); ?></p>

                                        <h5><strong>Shipped Date</strong></h5>
                                        <p><?php echo e(Carbon\Carbon::parse($waybill->shipped_date)->format('d F Y')); ?></p>

                                        <h5><strong>Weight</strong></h5>
                                        <p><?php echo e($waybill->weight); ?></p>

                                    </div>

                                    <div class="col-sm-4">

                                        <h5><strong>Origin</strong></h5>
                                        <p><?php echo e($waybill->origin); ?></p>

                                        <h5><strong>Destination</strong></h5>
                                        <p><?php echo e($waybill->destination); ?></p>

                                        <h5><strong>Export City</strong></h5>
                                        <p><?php echo e($waybill->export_city); ?></p>

                                        <h5><strong>Value</strong></h5>
                                        <p><?php echo e($waybill->currency); ?> <?php echo e(number_format($waybill->value, 2)); ?></p>

                                    </div>

                                    <div class="col-sm-4">

                                        <h5><strong>Bill To</strong></h5>
                                        <p><?php echo e($waybill->bill_to); ?></p>

                                        <h5><strong>Bill Duty</strong></h5>
                                        <p><?php echo e($waybill->bill_duty); ?></p>

                                        <h5><strong>Total</strong></h5>
                                        <p><?php echo e($waybill->total); ?></p>

                                        <h5><strong>Description</strong></h5>
                                        <p><?php echo e($waybill->description); ?></p>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="dutiable-waybills">

                                <br>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h5><strong>Name</strong></h5>
                                        <p><?php echo e($waybill->con_name); ?></p>

                                        <h5><strong>Company</strong></h5>
                                        <p><?php echo e($waybill->con_company ?: '-'); ?></p>

                                        <h5><strong>Phone</strong></h5>
                                        <p><?php echo e($waybill->con_phone); ?></p>
                                    </div>

                                    <div class="col-sm-4">

                                        <h5><strong>Address</strong></h5>
                                        <p><?php echo e($waybill->con_address); ?></p>

                                        <h5><strong>Alternate Address</strong></h5>
                                        <p><?php echo e($waybill->con_address_alternate); ?></p>

                                        <h5><strong>City</strong></h5>
                                        <p><?php echo e($waybill->con_city); ?></p>
                                    </div>
                                    <div class="col-sm-4">
                                        <h5><strong>State</strong></h5>
                                        <p><?php echo e($waybill->con_state); ?></p>

                                        <h5><strong>Country</strong></h5>
                                        <p><?php echo e($waybill->con_country); ?></p>

                                        <h5><strong>Postal</strong></h5>
                                        <p><?php echo e($waybill->con_postal); ?></p>
                                    </div>
                                </div>










                            </div>

                            <div role="tabpanel" class="tab-pane" id="non-dutiable-waybills">

                                <br>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <h5><strong>Name</strong></h5>
                                        <p><?php echo e($waybill->shipper_name); ?></p>

                                        <h5><strong>Company</strong></h5>
                                        <p><?php echo e($waybill->shipper_company ?: '-'); ?></p>

                                        <h5><strong>Phone</strong></h5>
                                        <p><?php echo e($waybill->shipper_phone); ?></p>
                                    </div>

                                    <div class="col-sm-4">

                                        <h5><strong>Address</strong></h5>
                                        <p><?php echo e($waybill->shipper_address); ?></p>

                                        <h5><strong>Alternate Address</strong></h5>
                                        <p><?php echo e($waybill->shipper_address_alternate); ?></p>

                                        <h5><strong>City</strong></h5>
                                        <p><?php echo e($waybill->shipper_city); ?></p>
                                    </div>
                                    <div class="col-sm-4">
                                        <h5><strong>State</strong></h5>
                                        <p><?php echo e($waybill->shipper_state); ?></p>

                                        <h5><strong>Country</strong></h5>
                                        <p><?php echo e($waybill->shipper_country); ?></p>

                                        <h5><strong>Postal</strong></h5>
                                        <p><?php echo e($waybill->shipper_postal); ?></p>
                                    </div>
                                </div>

                            </div>

                            <div role="tabpanel" class="tab-pane" id="clearance">
                                <br>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h5><strong>Time Since Initial Scan</strong></h5>
                                        <p><?php echo e(Carbon\Carbon::parse($waybill->initial_billing_time)->diffForHumans(null, true)); ?></p>

                                        <h5><strong>Storage Fee</strong></h5>
                                        <?php
                                            $difference = Carbon\Carbon::parse($waybill->initial_billing_time)->diffInMinutes(Carbon\Carbon::now());
                                        ?>
                                        <?php if($difference > (48 * 60)): ?>
                                            <p>$<?php echo e(number_format(((1.5 * $difference) / 60), 2)); ?></p>
                                        <?php else: ?>
                                            <p>$<?php echo e(number_format(0, 2)); ?></p>
                                        <?php endif; ?>
                                    </div>

                                    <div class="col-sm-4">

                                        <h5><strong>Clearing Agent</strong></h5>
                                        <p><?php echo e($waybill->clearing_agent); ?></p>

                                        <h5><strong>Clearing Agent Name</strong></h5>
                                        <p><?php echo e($waybill->clearing_agent_name); ?></p>

                                    </div>
                                    <div class="col-sm-4">

                                        <h5><strong>Clearing Completed?</strong></h5>
                                        <p><?php echo e($waybill->clearance_billed ? 'Yes' : 'No'); ?></p>

                                        <?php if(! $waybill->clearance_billed): ?>
                                            <h5><strong>Change Agent</strong></h5>
                                            <p><a href="<?php echo e(route('clearance.change', $waybill->id)); ?>" class="btn btn-primary btn-xs">CHANGE</a></p>

                                            <h5><strong>Release Order</strong></h5>
                                            <p><a target="_blank" href="<?php echo e(route('clearance.release', $waybill->id)); ?>" class="btn btn-primary btn-xs">GET</a></p>
                                        <?php endif; ?>

                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="panel-footer">
                        <a href="<?php echo e(URL::previous()); ?>" class="btn btn-danger">Back</a>
                        <?php if($waybill->manifest->type !== PAX\Models\Manifest::INBOUND && ! $waybill->invoices()->exists()): ?>
                            <a href="<?php echo e(route('waybill.edit', $waybill->id)); ?>" class="btn btn-primary">Edit</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>