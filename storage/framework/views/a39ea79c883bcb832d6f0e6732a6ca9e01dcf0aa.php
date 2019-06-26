<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li><a href="<?php echo e(route('setting-dashboard')); ?>">Setting Dashboard</a></li>
                  <li><a href="<?php echo e(route('user.index')); ?>">Users</a></li>
                  <li class="active">Add User</li>
                </ol>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        User
                    </div>
                    <div class="panel-body">
                        <form action="<?php echo e(route('user.store')); ?>" method="post">
                            <?php echo e(csrf_field()); ?>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>)">
                                        <label for="name">Name</label>
                                        <input name="name" id="name" value="<?php echo e(old('name')); ?>" class="form-control" required>
                                        <span>
                                    <?php if($errors->has('name')): ?>
                                                <strong class="help-block"><?php echo e($errors->first('name')); ?> </strong>
                                            <?php endif; ?>
                                </span>
                                    </div>

                                    <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>)">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" value="<?php echo e(old('email')); ?>" class="form-control" required>
                                        <span>
                                    <?php if($errors->has('email')): ?>
                                                <strong class="help-block"><?php echo e($errors->first('email')); ?> </strong>
                                            <?php endif; ?>
                                </span>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>)">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" value="<?php echo e(old('password')); ?>" class="form-control" required>
                                        <span>
                                    <?php if($errors->has('password')): ?>
                                                <strong class="help-block"><?php echo e($errors->first('password')); ?> </strong>
                                            <?php endif; ?>
                                </span>
                                    </div>

                                    <div class="form-group<?php echo e($errors->has('password_confirmation') ? ' has-error' : ''); ?>)">
                                        <label for="password_confirmation">Password Confirmation</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" value="<?php echo e(old('password_confirmation')); ?>" class="form-control" required>
                                        <span>
                                    <?php if($errors->has('password_confirmation')): ?>
                                                <strong class="help-block"><?php echo e($errors->first('password_confirmation')); ?> </strong>
                                            <?php endif; ?>
                                </span>
                                    </div>
                                </div>
                            </div>

                            <h4>Permissions</h4>
                            <div>
                                <button id="selectAll" class="btn btn-success">Select All</button>
                                <button id="selectNone" class="btn btn-danger">Select None</button>
                            </div>
                            <div class="row">
                                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="checkbox col-sm-4">
                                        <label>
                                            <input type="checkbox" name="permissions[<?php echo e($permission->slug); ?>]"> <?php echo e($permission->name); ?>

                                        </label>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group">
                                <button class="btn btn-success">Save</button>
                                <a href="<?php echo e(route('user.index')); ?>" class="btn btn-danger">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <script>
        $('#selectAll').on('click', function (e) {
            e.preventDefault();
            $('input[type=checkbox]').prop('checked', true);
        });
        $('#selectNone').on('click', function (e) {
            e.preventDefault();
            $('input[type=checkbox]').prop('checked', false);
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>