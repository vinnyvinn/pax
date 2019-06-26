<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Cities
                    </div>
                    <div class="panel-body">
                        <form action="<?php echo e(route('city.update', $city->id)); ?>" method="post">
                            <?php echo e(csrf_field()); ?>

                            <?php echo e(method_field('PUT')); ?>

                            <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>)">
                                <label for="name">Name</label>
                                <input name="name" id="name" value="<?php echo e(isset($city->name) ? $city->name : old('name')); ?>" class="form-control" required>
                                <span>
                                    <?php if($errors->has('name')): ?>
                                        <strong class="help-block"><?php echo e($errors->first('name')); ?> </strong>
                                    <?php endif; ?>
                                </span>
                            </div>


                            <div class="form-group<?php echo e($errors->has('import_duty') ? ' has-error' : ''); ?>)">
                                <label for="import_duty">Import Duty Account</label>
                                <select name="import_duty" id="import_duty" class="form-control" required>
                                    <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($account->AccountLink); ?>"<?php echo e($city->import_duty == $account->AccountLink ? ' selected' : ''); ?>><?php echo e($account->Account); ?> - <?php echo e($account->Description); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <span>
                                    <?php if($errors->has('import_duty')): ?>
                                        <strong class="help-block"><?php echo e($errors->first('import_duty')); ?> </strong>
                                    <?php endif; ?>
                                </span>
                            </div>

                            <div class="form-group<?php echo e($errors->has('agency_fee') ? ' has-error' : ''); ?>)">
                                <label for="agency_fee">Agency Fee Account</label>
                                <select name="agency_fee" id="agency_fee" class="form-control" required>
                                    <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($account->AccountLink); ?>"<?php echo e($city->agency_fee == $account->AccountLink ? ' selected' : ''); ?>><?php echo e($account->Account); ?> - <?php echo e($account->Description); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <span>
                                    <?php if($errors->has('agency_fee')): ?>
                                        <strong class="help-block"><?php echo e($errors->first('agency_fee')); ?> </strong>
                                    <?php endif; ?>
                                </span>
                            </div>

                            <div class="form-group<?php echo e($errors->has('outbound_freight') ? ' has-error' : ''); ?>)">
                                <label for="outbound_freight">Outbound Freight Account</label>
                                <select name="outbound_freight" id="outbound_freight" class="form-control" required>
                                    <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($account->AccountLink); ?>"<?php echo e($city->outbound_freight == $account->AccountLink ? ' selected' : ''); ?>><?php echo e($account->Account); ?> - <?php echo e($account->Description); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <span>
                                    <?php if($errors->has('outbound_freight')): ?>
                                        <strong class="help-block"><?php echo e($errors->first('outbound_freight')); ?> </strong>
                                    <?php endif; ?>
                                </span>
                            </div>

                            <div class="form-group<?php echo e($errors->has('break_bulk') ? ' has-error' : ''); ?>)">
                                <label for="break_bulk">Clearance Break Bulk Fee Account</label>
                                <select name="break_bulk" id="break_bulk" class="form-control" required>
                                    <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($account->AccountLink); ?>"<?php echo e($city->break_bulk == $account->AccountLink ? ' selected' : ''); ?>><?php echo e($account->Account); ?> - <?php echo e($account->Description); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <span>
                                    <?php if($errors->has('break_bulk')): ?>
                                        <strong class="help-block"><?php echo e($errors->first('break_bulk')); ?> </strong>
                                    <?php endif; ?>
                                </span>
                            </div>

                            <div class="form-group<?php echo e($errors->has('storage_fee') ? ' has-error' : ''); ?>)">
                                <label for="storage_fee">Clearance Storage Fee Account</label>
                                <select name="storage_fee" id="storage_fee" class="form-control" required>
                                    <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($account->AccountLink); ?>"<?php echo e($city->storage_fee == $account->AccountLink ? ' selected' : ''); ?>><?php echo e($account->Account); ?> - <?php echo e($account->Description); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <span>
                                    <?php if($errors->has('storage_fee')): ?>
                                        <strong class="help-block"><?php echo e($errors->first('storage_fee')); ?> </strong>
                                    <?php endif; ?>
                                </span>
                            </div>

                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group">
                                <button class="btn btn-success">Save</button>
                                <a href="<?php echo e(route('city.index')); ?>" class="btn btn-danger">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>