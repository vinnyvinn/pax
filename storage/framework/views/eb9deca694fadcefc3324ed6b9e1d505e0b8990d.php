<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Area Codes
                    </div>
                    <div class="panel-body">
                        <form action="<?php echo e(route('area-code.store')); ?>" method="post" role="form">
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


                            <div class="form-group<?php echo e($errors->has('code') ? ' has-error' : ''); ?>)">
                                <label for="code">Code</label>
                                <input type="text" name="code" id="code" value="<?php echo e(old('code')); ?>" class="form-control" required>
                                <span>
                                    <?php if($errors->has('code')): ?>
                                        <strong class="help-block"><?php echo e($errors->first('code')); ?> </strong>
                                    <?php endif; ?>
                                </span>
                            </div>

                            <div class="form-group<?php echo e($errors->has('inbound_freight') ? ' has-error' : ''); ?>)">
                                <label for="inbound_freight">Inbound Freight Account</label>
                                <select name="inbound_freight" id="inbound_freight" class="form-control" required>
                                    <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($account->AccountLink); ?>"><?php echo e($account->Account); ?> - <?php echo e($account->Description); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <span>
                                    <?php if($errors->has('inbound_freight')): ?>
                                        <strong class="help-block"><?php echo e($errors->first('inbound_freight')); ?> </strong>
                                    <?php endif; ?>
                                </span>
                            </div>

                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Save</button>
                                <a href="<?php echo e(route('area-code.index')); ?>" class="btn btn-danger">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>