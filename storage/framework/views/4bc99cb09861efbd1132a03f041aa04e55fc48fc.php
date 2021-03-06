<?php $__env->startSection('content'); ?>
    <div class="container">
        
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li><a href="<?php echo e(route('finance-dashboard')); ?>">Finance dashboard</a></li>
                  <li><a href="<?php echo e(route('manifest.index', ['page' => 'finance'])); ?>">Shipments</a></li>
                  <li class="active">Manifest details</li>
                </ol>
                <hr>
            </div>
            <div class="col-sm-12">
                <div class="panel panel-primary">

                    <div class="panel-body">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#details" aria-controls="details" role="tab" data-toggle="tab">Manifest Details</a></li>
                            <li role="presentation"><a href="#bill_f_s" aria-controls="bill_f_s" role="tab" data-toggle="tab">Freight BS</a></li>
                            <li role="presentation"><a href="#bill_f_c" aria-controls="bill_f_c" role="tab" data-toggle="tab">Freight BC</a></li>
                            <li role="presentation"><a href="#bill_f_o" aria-controls="bill_f_o" role="tab" data-toggle="tab">Freight BO</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="details">
                                <br>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h5>City</h5>
                                        <h5><?php echo e($manifest->city->name); ?></h5>

                                        <hr>
                                        <h5>Flight Number</h5>
                                        <h5><?php echo e($manifest->flight_number); ?></h5>

                                    </div>
                                    <div class="col-sm-6">

                                        <h5>Flight Date</h5>
                                        <h5><?php echo e(Carbon\Carbon::parse($manifest->flight_date)->format('l dS F Y')); ?></h5>

                                        <hr>

                                        <h5>Flight Arrival Time</h5>
                                        <h5><?php echo e(Carbon\Carbon::parse($manifest->arrival_time)->toTimeString()); ?></h5>

                                    </div>
                                </div>
                                <hr>
                                <h4>CBV Details</h4>
                                <?php if('create-inbound-shipments'): ?>
                                <br>
                                <form action="<?php echo e(route('inbound-cbv.store')); ?>" method="post" role="form" enctype="multipart/form-data">
                                    <h5><strong>Add New CBV</strong></h5>
                                    <?php echo e(csrf_field()); ?>

                                    <input type="hidden" name="manifest_id" value="<?php echo e($manifest->id); ?>">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group<?php echo e($errors->has('cbv_number') ? ' has-error' : ''); ?>">
                                                <label for="cbv_number">CBV Number*</label>
                                                <input required class="form-control" name="cbv_number" id="cbv_number" value="<?php echo e(old('cbv_number')); ?>">

                                                <?php if($errors->has('cbv_number')): ?>
                                                    <span class="help-block">
                                                        <strong><?php echo e($errors->first('cbv_number')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>

                                            <div class="form-group<?php echo e($errors->has('cbv_date') ? ' has-error' : ''); ?>">
                                                <label for="cbv_date">CBV Date*</label>
                                                <input class="form-control datepicker" name="cbv_date" id="cbv_date" value="<?php echo e(old('cbv_date')); ?>" required>

                                                <?php if($errors->has('cbv_date')): ?>
                                                    <span class="help-block">
                                                        <strong><?php echo e($errors->first('cbv_date')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>

                                            <div class="form-group<?php echo e($errors->has('handlers') ? ' has-error' : ''); ?>">
                                                <label for="handlers">Handlers</label>
                                                <input class="form-control" name="handlers" id="handlers" value="<?php echo e(old('handlers')); ?>" required>

                                                <?php if($errors->has('handlers')): ?>
                                                    <span class="help-block">
                                                        <strong><?php echo e($errors->first('handlers')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group<?php echo e($errors->has('cbv_rate') ? ' has-error' : ''); ?>">
                                                <label for="cbv_rate">Rate per KG*</label>

                                                <div class="input-group">
                                                    <span class="input-group-addon">$</span>
                                                    <input required step="0.01" aria-label="Rate per KG in decimal format" title="Rate per KG in decimal format" type="number" class="form-control" name="cbv_rate" id="cbv_rate" value="<?php echo e(old('cbv_rate')); ?>">
                                                    <span class="input-group-addon">Per KG</span>
                                                </div>
                                                <?php if($errors->has('cbv_rate')): ?>
                                                    <span class="help-block">
                                                        <strong><?php echo e($errors->first('cbv_rate')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>

                                            <div class="form-group<?php echo e($errors->has('consignment_weight') ? ' has-error' : ''); ?>">
                                                <label for="consignment_weight">Total Consignment Weight*</label>

                                                <div class="input-group">
                                                    <input required step="0.01" aria-label="Total consignment weight in decimal format" title="Total consignment weight in decimal format" type="number" class="form-control" name="consignment_weight" id="consignment_weight" value="<?php echo e(old('consignment_weight')); ?>">
                                                    <span class="input-group-addon">KGs</span>
                                                </div>
                                                <?php if($errors->has('consignment_weight')): ?>
                                                    <span class="help-block">
                                                        <strong><?php echo e($errors->first('consignment_weight')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>

                                            <div class="form-group<?php echo e($errors->has('invoices') ? ' has-error' : ''); ?>">
                                                <label for="invoices">Scanned Invoice*</label>

                                                <input required type="file" class="form-control" name="invoices" id="invoices">
                                                <?php if($errors->has('invoices')): ?>
                                                    <span class="help-block">
                                                        <strong><?php echo e($errors->first('invoices')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>

                                            <div class="form-group">
                                                <br>
                                                <input type="submit" class="btn btn-success pull-right" value="Save CBV Details">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <?php endif; ?>
                                <hr>
                                <table class="table dataTable table-striped">
                                    <thead>
                                    <tr>
                                        <th class="printable">#</th>
                                        <th class="printable">Date</th>
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
                                            <?php else: ?>
                                                <td><?php echo e($cbv->cbv_number); ?></td>
                                            <?php endif; ?>
                                            <td><?php echo e($cbv->cbv_date); ?></td>
                                            <td>$<?php echo e($cbv->cbv_rate); ?>/KG</td>
                                            <td><?php echo e($cbv->consignment_weight); ?> KGs</td>
                                            <td><?php echo e($cbv->handlers); ?></td>
                                            <td>
                                                <?php if($cbv->invoices): ?>
                                                <a href="<?php echo e(url($cbv->invoices)); ?>" class="btn btn-xs btn-warning" target="_blank">INVOICE</a>
                                                <?php endif; ?>
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
                            <div role="tabpanel" class="tab-pane" id="bill_f_s">

                                <br>

                                <div class="table-responsive">
                                    <table class="table table-striped nowrap">
                                        <thead>

                                        <tr>
                                            <th class="printable">Waybill #</th>
                                            <th class="printable">CRN #</th>
                                            <th class="printable">Status</th>
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
                                                <?php if(Auth::user()->can('view-inbound-waybills')): ?>
                                                <td><strong><a href="<?php echo e(route('waybill.show', $waybill->id)); ?>"><?php echo e($waybill->waybill_number); ?></a></strong></td>
                                                <?php else: ?>
                                                <td><?php echo e($waybill->waybill_number); ?></td>
                                                <?php endif; ?>
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

                            <div role="tabpanel" class="tab-pane" id="bill_f_c">

                                <br>

                                <div class="table-responsive">
                                    <table class="table table-striped nowrap">
                                        <thead>

                                        <tr>
                                            <th class="printable">Waybill #</th>
                                            <th class="printable">CRN #</th>
                                            <th class="printable">Status</th>
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
                                                <?php if(Auth::user()->can('view-inbound-waybills')): ?>
                                                    <td><strong><a href="<?php echo e(route('waybill.show', $waybill->id)); ?>"><?php echo e($waybill->waybill_number); ?></a></strong></td>
                                                <?php else: ?>
                                                    <td><?php echo e($waybill->waybill_number); ?></td>
                                                <?php endif; ?>
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
                        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-danger">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>