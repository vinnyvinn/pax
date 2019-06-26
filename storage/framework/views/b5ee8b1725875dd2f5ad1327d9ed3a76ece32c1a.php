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
                            <li role="presentation"><a href="#waybills" aria-controls="waybills" role="tab" data-toggle="tab">Shipped Waybills</a></li>
                            <li role="presentation"><a href="#bill_s" aria-controls="bill_s" role="tab" data-toggle="tab">Bill Shipper Waybills</a></li>
                            <li role="presentation"><a href="#bill_c" aria-controls="bill_c" role="tab" data-toggle="tab">Bill Consignee Waybills</a></li>
                            <li role="presentation"><a href="#bill_o" aria-controls="bill_o" role="tab" data-toggle="tab">Bill Other Waybills</a></li>
                            
                            
                            
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
                                        <h5><?php echo e(Carbon\Carbon::parse($manifest->arrival_time)->toTimeString()); ?></h5>

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
                                            <th class="printable">Waybill #</th>
                                            <th class="printable">CRN #</th>
                                            <th class="printable">Shipped Date</th>
                                            <th class="printable text-right">Weight</th>
                                            <th class="printable text-right">Value</th>

                                            <th class="printable">Origin</th>
                                            <th class="printable">Destination</th>
                                            <th class="printable">Export City</th>
                                            <th class="printable">Con. Name</th>
                                            <th class="printable">Con. Company</th>

                                            <th class="printable">Con. Phone</th>
                                            <th class="printable">Con. Country</th>
                                            <th class="printable">Con. State</th>
                                            <th class="printable">Con. City</th>
                                            <th class="printable">Con. Address</th>

                                            <th class="printable">Con. Address 2</th>
                                            <th class="printable">Con. Postal</th>
                                            <th class="printable">Shipper Name</th>
                                            <th class="printable">Shipper Company</th>
                                            <th class="printable">Shipper Phone</th>

                                            <th class="printable">Shipper Country</th>
                                            <th class="printable">Shipper State</th>
                                            <th class="printable">Shipper City</th>
                                            <th class="printable">Shipper Address</th>
                                            <th class="printable">Shipper Address 2</th>

                                            <th class="printable">Shipper Postal</th>
                                            <th class="printable">Bill To</th>
                                            <th class="printable">Bill Duty</th>
                                            <th class="printable">Total</th>
                                            <th class="printable">Description</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $manifest->waybills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $waybill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><strong><a href="<?php echo e(route('waybill.show', $waybill->id)); ?>"><?php echo e($waybill->waybill_number); ?></a></strong></td>
                                                <td><strong><?php echo e($waybill->crn_number); ?></strong></td>
                                                <td><strong><?php echo e(Carbon\Carbon::parse($waybill->shipped_date)->format('d F Y')); ?></strong></td>
                                                <td class="text-right"><strong><?php echo e($waybill->weight); ?></strong></td>
                                                <td class="text-right"><strong><?php echo e($waybill->currency); ?> <?php echo e($waybill->value ? $waybill->value : 0); ?></strong></td>


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

                            <div role="tabpanel" class="tab-pane" id="bill_s">

                                <br>

                                <div class="table-responsive">
                                    <table class="table table-striped nowrap">
                                        <thead>

                                        <tr>
                                            <th class="printable">Waybill #</th>
                                            <th class="printable">CRN #</th>
                                            <th class="printable">Shipped Date</th>
                                            <th class="text-right printable">Weight</th>
                                            <th class="text-right printable">Value</th>

                                            <th class="printable">Origin</th>
                                            <th class="printable">Destination</th>
                                            <th class="printable">Export City</th>
                                            <th class="printable">Con. Name</th>
                                            <th class="printable">Con. Company</th>

                                            <th class="printable">Con. Phone</th>
                                            <th class="printable">Con. Country</th>
                                            <th class="printable">Con. State</th>
                                            <th class="printable">Con. City</th>
                                            <th class="printable">Con. Address</th>

                                            <th class="printable">Con. Address 2</th>
                                            <th class="printable">Con. Postal</th>
                                            <th class="printable">Shipper Name</th>
                                            <th class="printable">Shipper Company</th>
                                            <th class="printable">Shipper Phone</th>

                                            <th class="printable">Shipper Country</th>
                                            <th class="printable">Shipper State</th>
                                            <th class="printable">Shipper City</th>
                                            <th class="printable">Shipper Address</th>
                                            <th class="printable">Shipper Address 2</th>

                                            <th class="printable">Shipper Postal</th>
                                            <th class="printable">Bill To</th>
                                            <th class="printable">Bill Duty</th>
                                            <th class="printable">Total</th>
                                            <th class="printable">Description</th>

                                        </tr>

                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $manifest->waybills->where('bill_to', 'S'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $waybill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><strong><a href="<?php echo e(route('waybill.show', $waybill->id)); ?>"><?php echo e($waybill->waybill_number); ?></a></strong></td>
                                                <td><strong><?php echo e($waybill->crn_number); ?></strong></td>
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

                            <div role="tabpanel" class="tab-pane" id="bill_c">

                                <br>

                                <div class="table-responsive">
                                    <table class="table table-striped nowrap">
                                        <thead>

                                        <tr>
                                            <th class="printable">Waybill #</th>
                                            <th class="printable">CRN #</th>
                                            <th class="printable">Shipped Date</th>
                                            <th class="text-right printable">Weight</th>
                                            <th class="text-right printable">Value</th>

                                            <th class="printable">Origin</th>
                                            <th class="printable">Destination</th>
                                            <th class="printable">Export City</th>
                                            <th class="printable">Con. Name</th>
                                            <th class="printable">Con. Company</th>

                                            <th class="printable">Con. Phone</th>
                                            <th class="printable">Con. Country</th>
                                            <th class="printable">Con. State</th>
                                            <th class="printable">Con. City</th>
                                            <th class="printable">Con. Address</th>

                                            <th class="printable">Con. Address 2</th>
                                            <th class="printable">Con. Postal</th>
                                            <th class="printable">Shipper Name</th>
                                            <th class="printable">Shipper Company</th>
                                            <th class="printable">Shipper Phone</th>

                                            <th class="printable">Shipper Country</th>
                                            <th class="printable">Shipper State</th>
                                            <th class="printable">Shipper City</th>
                                            <th class="printable">Shipper Address</th>
                                            <th class="printable">Shipper Address 2</th>

                                            <th class="printable">Shipper Postal</th>
                                            <th class="printable">Bill To</th>
                                            <th class="printable">Bill Duty</th>
                                            <th class="printable">Total</th>
                                            <th class="printable">Description</th>

                                        </tr>

                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $manifest->waybills->where('bill_to', 'C'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $waybill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><strong><a href="<?php echo e(route('waybill.show', $waybill->id)); ?>"><?php echo e($waybill->waybill_number); ?></a></strong></td>
                                                <td><strong><?php echo e($waybill->crn_number); ?></strong></td>
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

                            <div role="tabpanel" class="tab-pane" id="bill_o">

                                <br>

                                <div class="table-responsive">
                                    <table class="table table-striped nowrap">
                                        <thead>

                                        <tr>
                                            <th class="printable">Waybill #</th>
                                            <th class="printable">CRN #</th>
                                            <th class="printable">Shipped Date</th>
                                            <th class="text-right printable">Weight</th>
                                            <th class="text-right printable">Value</th>

                                            <th class="printable">Origin</th>
                                            <th class="printable">Destination</th>
                                            <th class="printable">Export City</th>
                                            <th class="printable">Con. Name</th>
                                            <th class="printable">Con. Company</th>

                                            <th class="printable">Con. Phone</th>
                                            <th class="printable">Con. Country</th>
                                            <th class="printable">Con. State</th>
                                            <th class="printable">Con. City</th>
                                            <th class="printable">Con. Address</th>

                                            <th class="printable">Con. Address 2</th>
                                            <th class="printable">Con. Postal</th>
                                            <th class="printable">Shipper Name</th>
                                            <th class="printable">Shipper Company</th>
                                            <th class="printable">Shipper Phone</th>

                                            <th class="printable">Shipper Country</th>
                                            <th class="printable">Shipper State</th>
                                            <th class="printable">Shipper City</th>
                                            <th class="printable">Shipper Address</th>
                                            <th class="printable">Shipper Address 2</th>

                                            <th class="printable">Shipper Postal</th>
                                            <th class="printable">Bill To</th>
                                            <th class="printable">Bill Duty</th>
                                            <th class="printable">Total</th>
                                            <th class="printable">Description</th>

                                        </tr>

                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $manifest->waybills->where('bill_to', 'O'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $waybill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><strong><a href="<?php echo e(route('waybill.show', $waybill->id)); ?>"><?php echo e($waybill->waybill_number); ?></a></strong></td>
                                                <td><strong><?php echo e($waybill->crn_number); ?></strong></td>
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
                        <a href="<?php echo e(route('outbound.index')); ?>" class="btn btn-danger">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>