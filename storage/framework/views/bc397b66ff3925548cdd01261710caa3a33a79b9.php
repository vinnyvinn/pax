<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        MAN-<?php echo e(str_pad($manifest->id, 5, '0', STR_PAD_LEFT)); ?>

                    </div>

                    <div class="panel-body">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#details" aria-controls="details" role="tab" data-toggle="tab">Manifest Details</a></li>
                            <li role="presentation"><a href="#waybills" aria-controls="waybills" role="tab" data-toggle="tab">Waybills Awaiting Recovery</a></li>
                            <li role="presentation"><a href="#dutiable-waybills" aria-controls="dutiable-waybills" role="tab" data-toggle="tab">Waybills Undergoing Clearance</a></li>
                            <li role="presentation"><a href="#non-dutiable-waybills" aria-controls="non-dutiable-waybills" role="tab" data-toggle="tab">Non-Dutiable Waybills</a></li>
                            <li role="presentation"><a href="#released-waybills" aria-controls="waybills" role="tab" data-toggle="tab">Released Waybills</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="details">
                                <br>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h4>Flight Number</h4>
                                        <h5><?php echo e($manifest->flight_number); ?></h5>

                                        <hr>

                                        <h4>Flight Date</h4>
                                        <h5><?php echo e(Carbon\Carbon::parse($manifest->flight_date)->format('l dS F Y')); ?></h5>

                                        <hr>

                                        <h4>Flight Arrival Time</h4>
                                        <h5><?php echo e($manifest->arrival_time); ?></h5>

                                    </div>
                                    <div class="col-sm-6">
                                        <h4>CBV Number</h4>
                                        <h5><?php echo e($manifest->cbv_number); ?></h5>

                                        <hr>

                                        <h4>CBV Rate</h4>
                                        <h5>$<?php echo e(number_format($manifest->cbv_rate, 0)); ?></h5>

                                        <hr>

                                        <h4>Total Consignment Weight</h4>
                                        <h5><?php echo e(number_format($manifest->consignment_weight, 0)); ?> KGs</h5>


                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="waybills">

                                <br>

                                <div class="table-responsive">
                                    <table class="table nowrap">
                                        <thead>
                                        <tr>
                                            <th>Waybill #</th>
                                            <th>CRN #</th>
                                            <th>Status</th>
                                            <th>Shipped Date</th>
                                            <th class="text-right">Weight</th>
                                            <th class="text-right">Value</th>


                                            <th>Origin</th>
                                            <th>Destination</th>
                                            <th>Export City</th>
                                            <th>Con. Name</th>
                                            <th>Con. Company</th>


                                            <th>Con. Phone</th>
                                            <th>Con. Country</th>
                                            <th>Con. State</th>
                                            <th>Con. City</th>
                                            <th>Con. Address</th>


                                            <th>Con. Address 2</th>
                                            <th>Con. Postal</th>
                                            <th>Shipper Name</th>
                                            <th>Shipper Company</th>
                                            <th>Shipper Phone</th>


                                            <th>Shipper Country</th>
                                            <th>Shipper State</th>
                                            <th>Shipper City</th>
                                            <th>Shipper Address</th>
                                            <th>Shipper Address 2</th>


                                            <th>Shipper Postal</th>
                                            <th>Bill To</th>
                                            <th>Bill Duty</th>
                                            <th>Total</th>
                                            <th>Description</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $manifest->waybills->where('status', 'Awaiting Recovery'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $waybill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><strong><a href="<?php echo e(route('waybill.show', $waybill->id)); ?>"><?php echo e($waybill->waybill_number); ?></a></strong></td>
                                                <td><strong><?php echo e($waybill->crn_number); ?></strong></td>
                                                <td><strong><?php echo e($waybill->status); ?></strong></td>
                                                <td><strong><?php echo e(Carbon\Carbon::parse($waybill->shipped_date)->format('d F Y')); ?></strong></td>
                                                <td class="text-right"><strong><?php echo e($waybill->weight); ?></strong></td>
                                                <td class="text-right"><strong><?php echo e($waybill->currency); ?> <?php echo e($waybill->value); ?></strong></td>


                                                <td><?php echo e($waybill->origin); ?></td>
                                                <td><?php echo e($waybill->destination); ?></td>
                                                <td><?php echo e($waybill->export_city); ?></td>
                                                <td><?php echo e($waybill->con_name); ?></td>
                                                <td><?php echo e($waybill->con_company); ?></td>


                                                <td><?php echo e($waybill->con_phone); ?></td>
                                                <td><?php echo e($waybill->con_country); ?></td>
                                                <td><?php echo e($waybill->con_state); ?></td>
                                                <td><?php echo e($waybill->con_city); ?></td>
                                                <td><?php echo e($waybill->con_address); ?></td>


                                                <td><?php echo e($waybill->con_address_alternate); ?></td>
                                                <td><?php echo e($waybill->con_postal); ?></td>
                                                <td><?php echo e($waybill->shipper_name); ?></td>
                                                <td><?php echo e($waybill->shipper_company); ?></td>
                                                <td><?php echo e($waybill->shipper_phone); ?></td>


                                                <td><?php echo e($waybill->shipper_country); ?></td>
                                                <td><?php echo e($waybill->shipper_state); ?></td>
                                                <td><?php echo e($waybill->shipper_city); ?></td>
                                                <td><?php echo e($waybill->shipper_address); ?></td>
                                                <td><?php echo e($waybill->shipper_address_alternate); ?></td>


                                                <td><?php echo e($waybill->shipper_postal); ?></td>
                                                <td><?php echo e($waybill->bill_to); ?></td>
                                                <td><?php echo e($waybill->bill_duty); ?></td>
                                                <td><?php echo e($waybill->total); ?></td>
                                                <td><?php echo e($waybill->description); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div role="tabpanel" class="tab-pane" id="dutiable-waybills">

                                <br>

                                <div class="table-responsive">
                                    <table class="table nowrap">
                                        <thead>
                                        <tr>
                                            <th>Waybill #</th>
                                            <th>CRN #</th>
                                            <th>Status</th>
                                            <th>Shipped Date</th>
                                            <th class="text-right">Weight</th>
                                            <th class="text-right">Value</th>


                                            <th>Origin</th>
                                            <th>Destination</th>
                                            <th>Export City</th>
                                            <th>Con. Name</th>
                                            <th>Con. Company</th>


                                            <th>Con. Phone</th>
                                            <th>Con. Country</th>
                                            <th>Con. State</th>
                                            <th>Con. City</th>
                                            <th>Con. Address</th>


                                            <th>Con. Address 2</th>
                                            <th>Con. Postal</th>
                                            <th>Shipper Name</th>
                                            <th>Shipper Company</th>
                                            <th>Shipper Phone</th>


                                            <th>Shipper Country</th>
                                            <th>Shipper State</th>
                                            <th>Shipper City</th>
                                            <th>Shipper Address</th>
                                            <th>Shipper Address 2</th>


                                            <th>Shipper Postal</th>
                                            <th>Bill To</th>
                                            <th>Bill Duty</th>
                                            <th>Total</th>
                                            <th>Description</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $manifest->waybills->where('status', 'Undergoing Clearance'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $waybill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><strong><a href="<?php echo e(route('waybill.show', $waybill->id)); ?>"><?php echo e($waybill->waybill_number); ?></a></strong></td>
                                                <td><strong><?php echo e($waybill->crn_number); ?></strong></td>
                                                <td><strong><?php echo e($waybill->status); ?></strong></td>
                                                <td><strong><?php echo e(Carbon\Carbon::parse($waybill->shipped_date)->format('d F Y')); ?></strong></td>
                                                <td class="text-right"><strong><?php echo e($waybill->weight); ?></strong></td>
                                                <td class="text-right"><strong><?php echo e($waybill->currency); ?> <?php echo e($waybill->value); ?></strong></td>


                                                <td><?php echo e($waybill->origin); ?></td>
                                                <td><?php echo e($waybill->destination); ?></td>
                                                <td><?php echo e($waybill->export_city); ?></td>
                                                <td><?php echo e($waybill->con_name); ?></td>
                                                <td><?php echo e($waybill->con_company); ?></td>


                                                <td><?php echo e($waybill->con_phone); ?></td>
                                                <td><?php echo e($waybill->con_country); ?></td>
                                                <td><?php echo e($waybill->con_state); ?></td>
                                                <td><?php echo e($waybill->con_city); ?></td>
                                                <td><?php echo e($waybill->con_address); ?></td>


                                                <td><?php echo e($waybill->con_address_alternate); ?></td>
                                                <td><?php echo e($waybill->con_postal); ?></td>
                                                <td><?php echo e($waybill->shipper_name); ?></td>
                                                <td><?php echo e($waybill->shipper_company); ?></td>
                                                <td><?php echo e($waybill->shipper_phone); ?></td>


                                                <td><?php echo e($waybill->shipper_country); ?></td>
                                                <td><?php echo e($waybill->shipper_state); ?></td>
                                                <td><?php echo e($waybill->shipper_city); ?></td>
                                                <td><?php echo e($waybill->shipper_address); ?></td>
                                                <td><?php echo e($waybill->shipper_address_alternate); ?></td>


                                                <td><?php echo e($waybill->shipper_postal); ?></td>
                                                <td><?php echo e($waybill->bill_to); ?></td>
                                                <td><?php echo e($waybill->bill_duty); ?></td>
                                                <td><?php echo e($waybill->total); ?></td>
                                                <td><?php echo e($waybill->description); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div role="tabpanel" class="tab-pane" id="non-dutiable-waybills">

                                <br>

                                <div class="table-responsive">
                                    <table class="table nowrap">
                                        <thead>
                                        <tr>
                                            <th>Waybill #</th>
                                            <th>CRN #</th>
                                            <th>Status</th>
                                            <th>Shipped Date</th>
                                            <th class="text-right">Weight</th>
                                            <th class="text-right">Value</th>


                                            <th>Origin</th>
                                            <th>Destination</th>
                                            <th>Export City</th>
                                            <th>Con. Name</th>
                                            <th>Con. Company</th>


                                            <th>Con. Phone</th>
                                            <th>Con. Country</th>
                                            <th>Con. State</th>
                                            <th>Con. City</th>
                                            <th>Con. Address</th>


                                            <th>Con. Address 2</th>
                                            <th>Con. Postal</th>
                                            <th>Shipper Name</th>
                                            <th>Shipper Company</th>
                                            <th>Shipper Phone</th>


                                            <th>Shipper Country</th>
                                            <th>Shipper State</th>
                                            <th>Shipper City</th>
                                            <th>Shipper Address</th>
                                            <th>Shipper Address 2</th>


                                            <th>Shipper Postal</th>
                                            <th>Bill To</th>
                                            <th>Bill Duty</th>
                                            <th>Total</th>
                                            <th>Description</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $manifest->waybills->where('status', 'Non-Dutiable'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $waybill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><strong><a href="<?php echo e(route('waybill.show', $waybill->id)); ?>"><?php echo e($waybill->waybill_number); ?></a></strong></td>
                                                <td><strong><?php echo e($waybill->crn_number); ?></strong></td>
                                                <td><strong><?php echo e($waybill->status); ?></strong></td>
                                                <td><strong><?php echo e(Carbon\Carbon::parse($waybill->shipped_date)->format('d F Y')); ?></strong></td>
                                                <td class="text-right"><strong><?php echo e($waybill->weight); ?></strong></td>
                                                <td class="text-right"><strong><?php echo e($waybill->currency); ?> <?php echo e($waybill->value); ?></strong></td>


                                                <td><?php echo e($waybill->origin); ?></td>
                                                <td><?php echo e($waybill->destination); ?></td>
                                                <td><?php echo e($waybill->export_city); ?></td>
                                                <td><?php echo e($waybill->con_name); ?></td>
                                                <td><?php echo e($waybill->con_company); ?></td>


                                                <td><?php echo e($waybill->con_phone); ?></td>
                                                <td><?php echo e($waybill->con_country); ?></td>
                                                <td><?php echo e($waybill->con_state); ?></td>
                                                <td><?php echo e($waybill->con_city); ?></td>
                                                <td><?php echo e($waybill->con_address); ?></td>


                                                <td><?php echo e($waybill->con_address_alternate); ?></td>
                                                <td><?php echo e($waybill->con_postal); ?></td>
                                                <td><?php echo e($waybill->shipper_name); ?></td>
                                                <td><?php echo e($waybill->shipper_company); ?></td>
                                                <td><?php echo e($waybill->shipper_phone); ?></td>


                                                <td><?php echo e($waybill->shipper_country); ?></td>
                                                <td><?php echo e($waybill->shipper_state); ?></td>
                                                <td><?php echo e($waybill->shipper_city); ?></td>
                                                <td><?php echo e($waybill->shipper_address); ?></td>
                                                <td><?php echo e($waybill->shipper_address_alternate); ?></td>


                                                <td><?php echo e($waybill->shipper_postal); ?></td>
                                                <td><?php echo e($waybill->bill_to); ?></td>
                                                <td><?php echo e($waybill->bill_duty); ?></td>
                                                <td><?php echo e($waybill->total); ?></td>
                                                <td><?php echo e($waybill->description); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div role="tabpanel" class="tab-pane" id="released-waybills">

                                <br>

                                <div class="table-responsive">
                                    <table class="table nowrap">
                                        <thead>
                                        <tr>
                                            <th>Waybill #</th>
                                            <th>CRN #</th>
                                            <th>Status</th>
                                            <th>Shipped Date</th>
                                            <th class="text-right">Weight</th>
                                            <th class="text-right">Value</th>


                                            <th>Origin</th>
                                            <th>Destination</th>
                                            <th>Export City</th>
                                            <th>Con. Name</th>
                                            <th>Con. Company</th>


                                            <th>Con. Phone</th>
                                            <th>Con. Country</th>
                                            <th>Con. State</th>
                                            <th>Con. City</th>
                                            <th>Con. Address</th>


                                            <th>Con. Address 2</th>
                                            <th>Con. Postal</th>
                                            <th>Shipper Name</th>
                                            <th>Shipper Company</th>
                                            <th>Shipper Phone</th>


                                            <th>Shipper Country</th>
                                            <th>Shipper State</th>
                                            <th>Shipper City</th>
                                            <th>Shipper Address</th>
                                            <th>Shipper Address 2</th>


                                            <th>Shipper Postal</th>
                                            <th>Bill To</th>
                                            <th>Bill Duty</th>
                                            <th>Total</th>
                                            <th>Description</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $manifest->waybills->where('status', 'Released'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $waybill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><strong><a href="<?php echo e(route('waybill.show', $waybill->id)); ?>"><?php echo e($waybill->waybill_number); ?></a></strong></td>
                                                <td><strong><?php echo e($waybill->crn_number); ?></strong></td>
                                                <td><strong><?php echo e($waybill->status); ?></strong></td>
                                                <td><strong><?php echo e(Carbon\Carbon::parse($waybill->shipped_date)->format('d F Y')); ?></strong></td>
                                                <td class="text-right"><strong><?php echo e($waybill->weight); ?></strong></td>
                                                <td class="text-right"><strong><?php echo e($waybill->currency); ?> <?php echo e($waybill->value); ?></strong></td>


                                                <td><?php echo e($waybill->origin); ?></td>
                                                <td><?php echo e($waybill->destination); ?></td>
                                                <td><?php echo e($waybill->export_city); ?></td>
                                                <td><?php echo e($waybill->con_name); ?></td>
                                                <td><?php echo e($waybill->con_company); ?></td>


                                                <td><?php echo e($waybill->con_phone); ?></td>
                                                <td><?php echo e($waybill->con_country); ?></td>
                                                <td><?php echo e($waybill->con_state); ?></td>
                                                <td><?php echo e($waybill->con_city); ?></td>
                                                <td><?php echo e($waybill->con_address); ?></td>


                                                <td><?php echo e($waybill->con_address_alternate); ?></td>
                                                <td><?php echo e($waybill->con_postal); ?></td>
                                                <td><?php echo e($waybill->shipper_name); ?></td>
                                                <td><?php echo e($waybill->shipper_company); ?></td>
                                                <td><?php echo e($waybill->shipper_phone); ?></td>


                                                <td><?php echo e($waybill->shipper_country); ?></td>
                                                <td><?php echo e($waybill->shipper_state); ?></td>
                                                <td><?php echo e($waybill->shipper_city); ?></td>
                                                <td><?php echo e($waybill->shipper_address); ?></td>
                                                <td><?php echo e($waybill->shipper_address_alternate); ?></td>


                                                <td><?php echo e($waybill->shipper_postal); ?></td>
                                                <td><?php echo e($waybill->bill_to); ?></td>
                                                <td><?php echo e($waybill->bill_duty); ?></td>
                                                <td><?php echo e($waybill->total); ?></td>
                                                <td><?php echo e($waybill->description); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="panel-footer">
                        <a href="<?php echo e(route('manifest.index')); ?>" class="btn btn-danger">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>