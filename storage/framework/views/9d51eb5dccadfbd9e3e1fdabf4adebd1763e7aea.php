<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Manifest Details
                    </div>

                    <div class="panel-body">

                        <form action="<?php echo e(route('manifest.update', $manifest->id)); ?>" method="post" role="form">

                            <?php echo e(csrf_field()); ?>

                            <?php echo e(method_field('PUT')); ?>


                            <div class="form-group<?php echo e($errors->has('flight_number') ? ' has-error' : ''); ?>">
                                <label for="flight_number">Flight Number*</label>
                                <input type="text" class="form-control text-uppercase" name="flight_number" id="flight_number" value="<?php echo e(isset($manifest->flight_number) ? $manifest->flight_number : old('flight_number')); ?>" required>

                                <?php if($errors->has('flight_number')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('flight_number')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="form-group<?php echo e($errors->has('flight_date') ? ' has-error' : ''); ?>">
                                <label for="flight_date">Flight Date*</label>
                                <input type="text" class="form-control datepicker" name="flight_date" id="flight_date" value="<?php echo e($manifest->flight_date->format('Y-m-d')); ?>" required>

                                <?php if($errors->has('flight_date')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('flight_date')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="form-group<?php echo e($errors->has('arrival_time') ? ' has-error' : ''); ?>">
                                <label for="arrival_time">Arrival Hour</label>
                                <select class="form-control" name="arrival_time" id="arrival_time">
                                    <?php for($i = 0; $i <= 23; $i++): ?>
                                        <option value="<?php echo e($i); ?>:00"><?php echo e($i); ?>:00 HRS</option>
                                    <?php endfor; ?>
                                </select>

                                <?php if($errors->has('arrival_time')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('arrival_time')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Save</button>
                                <a href="<?php echo e(route('manifest.index')); ?>" class="btn btn-danger">Back</a>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>