<?php $__env->startSection('content'); ?>
    <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <form action="<?php echo e(route('cbv.store')); ?>" method="post">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group<?php echo e($errors->has('number') ? ' has-error' : ''); ?>">
                        <label for="number">CBV Number</label>
                        <input type="text" name="number" id="number" class="form-control" value="<?php echo e(old('number')); ?>" required>
                        <?php if($errors->has('number')): ?>
                            <span class="help-block"><?php echo e($errors->first('number')); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group<?php echo e($errors->has('rate') ? ' has-error' : ''); ?>">
                        <label for="rate">Rate</label>
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input pattern="[0-9\.]+$" title="Decimals" type="text" name="rate" id="rate" class="form-control" value="<?php echo e(old('rate')); ?>" required>
                            <span class="input-group-addon">Per KG</span>
                        </div>

                        <?php if($errors->has('rate')): ?>
                            <span class="help-block"><?php echo e($errors->first('rate')); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group<?php echo e($errors->has('handling_rate') ? ' has-error' : ''); ?>">
                        <label for="handling_rate">Handling Rate</label>
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input pattern="[0-9\.]+$" title="Decimals" type="text" name="handling_rate" id="handling_rate" class="form-control" value="<?php echo e(old('handling_rate')); ?>" required>
                            <span class="input-group-addon">Per KG</span>
                        </div>

                        <?php if($errors->has('handling_rate')): ?>
                            <span class="help-block"><?php echo e($errors->first('handling_rate')); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group<?php echo e($errors->has('date_issued') ? ' has-error' : ''); ?>">
                        <label for="date_issued">Date Issued</label>
                        <input type="text" name="date_issued" id="date_issued" value="<?php echo e(old('date_issued')); ?>" class="form-control datepicker" required>
                        <?php if($errors->has('date_issued')): ?>
                            <span class="help-block"><?php echo e($errors->first('date_issued')); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="<?php echo e(route('cbv.index')); ?>" class="btn btn-danger">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>