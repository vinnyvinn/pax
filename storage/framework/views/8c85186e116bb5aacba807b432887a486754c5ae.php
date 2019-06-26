<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <div class="col-md-6">
                            Other charges
                        </div>
                        
                    </div>
                    <div class="panel-body">
                        <form action="<?php echo e($data->id ? route('other-charges.update', $data->id) : route('other-charges.store')); ?>" method="post" role="form">
                            <?php echo e(csrf_field()); ?>

                            <?php echo e($data->id ? method_field('PUT') : ''); ?>

                            <div class="form-group<?php echo e($errors->has('code') ? ' has-error' : ''); ?>)">
                                <label for="name">Code</label>
                                <input type="text" name="code" id="code" value="<?php echo e($data->id ? $data->code : old('code')); ?>" class="form-control" required>
                                <span>
                                    <?php if($errors->has('code')): ?>
                                        <strong class="help-block"><?php echo e($errors->first('code')); ?> </strong>
                                    <?php endif; ?>
                                </span>
                            </div>

                            <div class="form-group<?php echo e($errors->has('description') ? ' has-error' : ''); ?>)">
                                <label for="description">Description</label>
                                <input type="text" name="description" id="description" value="<?php echo e($data->id ? $data->description : old('description')); ?>" class="form-control" required>
                                <span>
                                    <?php if($errors->has('description')): ?>
                                        <strong class="help-block"><?php echo e($errors->first('description')); ?> </strong>
                                    <?php endif; ?>
                                </span>
                            </div>

                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Save</button>
                                <a href="<?php echo e(route('route.index')); ?>" class="btn btn-danger">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>