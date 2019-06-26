<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">3rd Party Clearance Invoice</div>

                    <div class="panel-body">

                        <form action="<?php echo e(route('agent-clearance.update', $invoice->id)); ?>" method="post" role="form">
                            <?php echo e(csrf_field()); ?>

                            <?php echo e(method_field('PUT')); ?>


                            <div class="row">
                                <div class="col-sm-12">

                                    <div class="form-group">
                                        <label for="client_id">Client</label>
                                        <select required class="form-control selectpicker" name="client_id" id="client_id">
                                            <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($client->DCLink); ?>"<?php echo e($invoice->client_id == $client->DCLink ? ' selected' : ''); ?>><?php echo e($client->Name); ?>(<?php echo e($client->Account); ?>)</option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="waybill_id">Waybill</label>

                                        <select required class="form-control selectpicker" name="waybill_id" id="waybill_id">
                                            <?php $__currentLoopData = $waybills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $waybill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($waybill->id); ?>"<?php echo e($invoice->waybill_id == $waybill->id ? ' selected' : ''); ?>><?php echo e($waybill->waybill_number); ?> (Duty <?php echo e($waybill->bill_duty); ?>, Bill To <?php echo e($waybill->bill_to); ?>)</option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="clearing_agent_name">Clearing Agent Name.</label>
                                        <input value="<?php echo e($invoice->waybill->clearing_agent_name); ?>" type="text" required class="form-control" name="clearing_agent_name" id="clearing_agent_name">
                                    </div>

                                    <div class="form-group">
                                        <label for="break_bulk_fee">Break Bulk Fee.</label>
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1">$</span>
                                            <input value="<?php echo e($invoice->break_bulk_fee); ?>"  aria-describedby="basic-addon1" pattern="[0-9\.]+$" title="Decimal values only" type="text" required class="form-control" name="break_bulk_fee" id="break_bulk_fee">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <input type="hidden" id="finalize" name="finalize" value="false">

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Process</button>
                                <button class="btn btn-success" type="submit" onclick="$('#finalize').val('true');">Finalize Invoice</button>
                                <a href="<?php echo e(route('agent-clearance.index')); ?>" class="btn btn-danger">Back</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>