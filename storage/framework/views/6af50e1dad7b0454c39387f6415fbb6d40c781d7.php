<?php $__env->startSection('content'); ?>
    <div class="col-sm-10 col-sm-offset-1">
        <div class="panel panel-default">
            <div class="panel-body">
                <form action="<?php echo e(route('domestic-locations.update', $location->id)); ?>" method="post">
                    <?php echo e(csrf_field()); ?>

                    <?php echo e(method_field('PUT')); ?>


                    <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                        <label for="name">City Name</label>

                        <input type="text" name="name" id="name" class="form-control" value="<?php echo e(isset($location->name) ? $location->name : old('name')); ?>" required>
                        <?php if($errors->has('name')): ?>
                            <span class="help-block"><?php echo e($errors->first('name')); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group<?php echo e($errors->has('freight_account') ? ' has-error' : ''); ?>)">
                        <label for="freight_account">Domestic Freight Account</label>
                        <select name="freight_account" id="freight_account" class="form-control" required>
                            <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($account->AccountLink); ?>"<?php echo e($account->AccountLink == $location->freight_account ? ' selected' : ''); ?>><?php echo e($account->Account); ?> - <?php echo e($account->Description); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <span>
                            <?php if($errors->has('freight_account')): ?>
                                <strong class="help-block"><?php echo e($errors->first('freight_account')); ?> </strong>
                            <?php endif; ?>
                        </span>
                    </div>

                    <br class="clearfix" />

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="<?php echo e(route('domestic-locations.index')); ?>" class="btn btn-danger">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>