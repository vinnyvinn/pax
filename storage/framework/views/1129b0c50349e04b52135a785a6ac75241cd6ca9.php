<?php $__env->startSection('content'); ?>
    <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Outbound Zones</h4>
            </div>
            <div class="panel-body">
                <form action="<?php echo e(route('outbound-zones.store')); ?>" method="post">
                    <?php echo e(csrf_field()); ?>


                    <div class="form-group<?php echo e($errors->has('zone') ? ' has-error' : ''); ?>)">
                        <label for="zone">Zone</label>
                        <select name="zone" id="zone" class="form-control" required>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                            <option value="F">F</option>
                            <option value="G">G</option>
                            <option value="H">H</option>
                            <option value="I">I</option>
                        </select>
                        <span>
                        <?php if($errors->has('zone')): ?>
                            <strong class="help-block"><?php echo e($errors->first('zone')); ?> </strong>
                        <?php endif; ?>
                    </span>
                    </div>

                    <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                        <label for="name">Location Name</label>

                        <input type="text" name="name" id="name" class="form-control" value="<?php echo e(isset($zone->name) ? $zone->name : old('name')); ?>" required>
                        <?php if($errors->has('name')): ?>
                            <span class="help-block"><?php echo e($errors->first('name')); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group<?php echo e($errors->has('code') ? ' has-error' : ''); ?>)">
                        <label for="code">Country</label>
                        <select name="code" id="code" class="form-control" required>
                            <?php $__currentLoopData = countries(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($country); ?>"><?php echo e($name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <span>
                        <?php if($errors->has('code')): ?>
                            <strong class="help-block"><?php echo e($errors->first('code')); ?> </strong>
                        <?php endif; ?>
                        </span>
                    </div>

                    <br class="clearfix" />

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="<?php echo e(route('outbound-zones.index')); ?>" class="btn btn-danger">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>