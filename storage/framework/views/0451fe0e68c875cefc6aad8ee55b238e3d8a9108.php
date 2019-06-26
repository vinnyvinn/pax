<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <div class="col-md-6">
                            Routes
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group pull-right">
                                <input type="file" name="routes" id="routes" class="form-control input-sm">
                                <span class="input-group-btn">
                                    <button class="btn btn-sm btn-info">Import</button>
                                </span>
                            </div>
                        </div>
                        </div>
                        
                    </div>
                    <div class="panel-body">
                        <form action="<?php echo e(route('route.store')); ?>" method="post" role="form">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>)">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" value="<?php echo e(old('name')); ?>" class="form-control" required>
                                <span>
                                    <?php if($errors->has('name')): ?>
                                        <strong class="help-block"><?php echo e($errors->first('name')); ?> </strong>
                                    <?php endif; ?>
                                </span>
                            </div>


                            <div class="form-group<?php echo e($errors->has('area_code_id') ? ' has-error' : ''); ?>)">
                                <label for="area_code_id">Area Code</label>
                                <select name="area_code_id" id="area_code_id" class="form-control">
                                    <?php $__currentLoopData = $codes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($code->id); ?>"><?php echo e($code->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <span>
                                    <?php if($errors->has('area_code_id')): ?>
                                        <strong class="help-block"><?php echo e($errors->first('area_code_id')); ?> </strong>
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