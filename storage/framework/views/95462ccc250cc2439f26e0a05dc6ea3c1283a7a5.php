<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Tabulations
                    </div>
                    <div class="panel-body">
                        <form action="<?php echo e(route('tabulations.store')); ?>" method="post" role="form">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group<?php echo e($errors->has('freight') ? ' has-error' : ''); ?>">
                                <label for="freight">Freight*</label>
                                <input type="text" class="form-control text-uppercase" name="freight"
                                       id="freight" value="<?php echo e(old('freight')); ?>" required>
                                <?php if($errors->has('freight')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('freight')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group<?php echo e($errors->has('exchange_rate') ? ' has-error' : ''); ?>">
                            <label for="exchange_rate">Exchange Rate*</label>
                            <input type="text" class="form-control text-uppercase" name="exchange_rate"
                                   id="exchange_rate" value="<?php echo e(old('exchange_rate')); ?>" required>
                            <?php if($errors->has('exchange_rate')): ?>
                                <span class="help-block">
                                        <strong><?php echo e($errors->first('exchange_rate')); ?></strong>
                                    </span>
                        <?php endif; ?>
                                </div>

                            <div class="form-group<?php echo e($errors->has('import_duty_rate') ? ' has-error' : ''); ?>">
                            <label for="import_duty_rate">Import Duty Rate*</label>
                            <input type="text" class="form-control text-uppercase" name="import_duty_rate" id="import_duty_rate"
                                   value="<?php echo e(old('import_duty_rate')); ?>" required>
                            <?php if($errors->has('import_duty_rate')): ?>
                                <span class="help-block">
                                        <strong><?php echo e($errors->first('import_duty_rate')); ?></strong>
                                    </span>
                        <?php endif; ?>
                                </div>
                            <div class="form-group<?php echo e($errors->has('vat_rate') ? ' has-error' : ''); ?>">
                                <label for="vat_rate">VAT RATE*</label>
                                <input type="text" class="form-control text-uppercase" name="vat_rate" id="vat_rate"
                                       value="<?php echo e(old('vat_rate')); ?>" required>
                                <?php if($errors->has('vat_rate')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('vat_rate')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group<?php echo e($errors->has('kebs_amount') ? ' has-error' : ''); ?>">
                                <label for="kebs_amount">KEBS AMOUNT</label>
                                <input type="text" class="form-control text-uppercase" name="kebs_amount" id="kebs_amount"
                                       value="<?php echo e(old('kebs_amount')); ?>" required>
                                <?php if($errors->has('kebs_amount')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('kebs_amount')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group<?php echo e($errors->has('other_charges') ? ' has-error' : ''); ?>">
                                <label for="other_charges">Other charges</label>
                                <input type="text" class="form-control text-uppercase" name="other_charges" id="other_charges"
                                       value="<?php echo e(old('other_charges')); ?>" required>
                                <?php if($errors->has('other_charges')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('other_charges')); ?></strong>
                             </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Submit</button>
                                <a href="<?php echo e(route('tabulations.index')); ?>" class="btn btn-danger">Back</a>
                            </div>
                        </form>
                    </div>

                </div>
            </div>


        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>