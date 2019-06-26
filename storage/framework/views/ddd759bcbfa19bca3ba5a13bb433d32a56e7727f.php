<?php $__env->startSection('content'); ?>

    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                Edit Courier
            </div>
            <form action="<?php echo e(route('courier.update', $courier->id)); ?>" method="post">
                <?php echo e(csrf_field()); ?>

                <?php echo e(method_field('PUT')); ?>


                <div class="panel-body">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                                <label for="name">Name</label>
                                <input type="text" id="name" value="<?php echo e(isset($courier->name) ? $courier->name : old('name')); ?>" name="name" required class="form-control">
                                <?php if($errors->has('name')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group<?php echo e($errors->has('national_id') ? ' has-error' : ''); ?>">
                                <label for="national_id">National/Passport NO:</label>
                                <input type="text" id="national_id" value="<?php echo e(isset($courier->national_id) ? $courier->national_id : old('national_id')); ?>" name="national_id" required class="form-control">
                                <?php if($errors->has('national_id')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('national_id')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group<?php echo e($errors->has('fedex_id') ? ' has-error' : ''); ?>">
                                <label for="fedex_id">FedEx ID</label>
                                <input type="text" id="fedex_id" value="<?php echo e(isset($courier->fedex_id) ? $courier->fedex_id : old('fedex_id')); ?>" name="fedex_id" required class="form-control">
                                <?php if($errors->has('fedex_id')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('fedex_id')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group<?php echo e($errors->has('phone') ? ' has-error' : ''); ?>">
                                <label for="phone">Phone NO:</label>
                                <input type="text" id="phone" value="<?php echo e(isset($courier->phone) ? $courier->phone : old('phone')); ?>" name="phone" required class="form-control">
                                <?php if($errors->has('phone')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('phone')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="<?php echo e(route('courier.index')); ?>" class="btn btn-danger">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>