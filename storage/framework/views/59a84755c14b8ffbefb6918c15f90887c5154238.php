<?php $__env->startSection('content'); ?>

    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Add HS Code</h4>
            </div>
            <form action="<?php echo e(route('hscode.store')); ?>" method="post">
                <div class="panel-body">
                    <?php echo e(csrf_field()); ?>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group<?php echo e($errors->has('code') ? ' has-error' : ''); ?>">
                                <label for="code">Code</label>
                                <input type="text" class="form-control" name="code" id="code" value="<?php echo e(old('code')); ?>">

                                <?php if($errors->has('code')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('code')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>


                            <div class="form-group<?php echo e($errors->has('description') ? ' has-error' : ''); ?>">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" name="description" id="description" value="<?php echo e(old('description')); ?>">

                                <?php if($errors->has('description')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('description')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="form-group<?php echo e($errors->has('unit_of_qty') ? ' has-error' : ''); ?>">
                                <label for="unit_of_qty">Unit of Quantity</label>
                                <input type="text" class="form-control" name="unit_of_qty" id="unit_of_qty" value="<?php echo e(old('unit_of_qty')); ?>">

                                <?php if($errors->has('unit_of_qty')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('unit_of_qty')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="form-group<?php echo e($errors->has('rate') ? ' has-error' : ''); ?>">
                                <label for="rate">Rate per Unit</label>
                                <input type="text" class="form-control" name="rate" id="rate" value="<?php echo e(old('rate')); ?>">

                                <?php if($errors->has('rate')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('rate')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="<?php echo e(route('hscode.index')); ?>" class="btn btn-danger">Back</a>
                    </div>

                </div>
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>