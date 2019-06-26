<?php $__env->startSection('content'); ?>

    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                Add Courier
            </div>
            <form action="<?php echo e(route('courier.store')); ?>" method="post">
                <?php echo e(csrf_field()); ?>

                
                <div class="panel-body">
                
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" value="<?php echo e(old('name')); ?>" name="name" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="national_id">National/Passport NO:</label>
                                <input type="text" id="national_id" value="<?php echo e(old('national_id')); ?>" name="national_id" required class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="fedex_id">FedEx ID</label>
                                <input type="text" id="fedex_id" value="<?php echo e(old('fedex_id')); ?>" name="fedex_id" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone NO:</label>
                                <input type="text" id="phone" value="<?php echo e(old('phone')); ?>" name="phone" required class="form-control">
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