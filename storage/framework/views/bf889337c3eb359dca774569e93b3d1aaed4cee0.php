<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Manifest Details
                    </div>

                    <div class="panel-body">

                        <form action="<?php echo e(route('inbound-cbv.update', $cbv->id)); ?>" method="post" role="form" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>

                            <?php echo e(method_field('PUT')); ?>

                            <input type="hidden" name="ref" value="<?php echo e(URL::previous()); ?>">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group<?php echo e($errors->has('cbv_number') ? ' has-error' : ''); ?>">
                                        <label for="cbv_number">CBV Number*</label>
                                        <input required class="form-control" name="cbv_number" id="cbv_number" value="<?php echo e(isset($cbv->cbv_number) ? $cbv->cbv_number : old('cbv_number')); ?>">

                                        <?php if($errors->has('cbv_number')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('cbv_number')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="form-group<?php echo e($errors->has('cbv_date') ? ' has-error' : ''); ?>">
                                        <label for="cbv_date">CBV Date*</label>
                                        <input class="form-control datepicker" name="cbv_date" id="cbv_date" value="<?php echo e(isset($cbv->cbv_date) ? $cbv->cbv_date : old('cbv_date')); ?>" required>

                                        <?php if($errors->has('cbv_date')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('cbv_date')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="form-group<?php echo e($errors->has('handlers') ? ' has-error' : ''); ?>">
                                        <label for="handlers">Handlers</label>
                                        <input class="form-control" name="handlers" id="handlers" value="<?php echo e(isset($cbv->handlers) ? $cbv->handlers : old('handlers')); ?>" required>

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
                                            <input required step="0.01" aria-label="Rate per KG in decimal format" title="Rate per KG in decimal format" type="number" class="form-control" name="cbv_rate" id="cbv_rate" value="<?php echo e(isset($cbv->cbv_rate) ? $cbv->cbv_rate : old('cbv_rate')); ?>">
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
                                            <input required step="0.01" aria-label="Total consignment weight in decimal format" title="Total consignment weight in decimal format" type="number" class="form-control" name="consignment_weight" id="consignment_weight" value="<?php echo e(isset($cbv->consignment_weight) ? $cbv->consignment_weight : old('consignment_weight')); ?>">
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
                                        <a href="<?php echo e(URL::previous('/manifest')); ?>" class="btn btn-danger pull-right">Back</a>
                                        <input type="submit" class="btn btn-success pull-right" value="Save CBV Details">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>