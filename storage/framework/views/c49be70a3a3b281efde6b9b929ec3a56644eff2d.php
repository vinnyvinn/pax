<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Import Manifest
                    </div>

                    <div class="panel-body">

                        <form action="<?php echo e(route('manifest.store')); ?>" method="post" role="form" enctype="multipart/form-data">

                            <?php echo e(csrf_field()); ?>


                            <div class="form-group<?php echo e($errors->has('city_id') ? ' has-error' : ''); ?>">
                                <label for="city_id">City*</label>
                                <select class="form-control" name="city_id" id="city_id" required>
                                    <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($city->id); ?>"><?php echo e($city->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>

                                <?php if($errors->has('city_id')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('city_id')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="form-group<?php echo e($errors->has('flight_number') ? ' has-error' : ''); ?>">
                                <label for="flight_number">Flight Number*</label>
                                <input class="form-control text-uppercase" name="flight_number" id="flight_number" value="<?php echo e(old('flight_number')); ?>" required>

                                <?php if($errors->has('flight_number')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('flight_number')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="form-group<?php echo e($errors->has('flight_date') ? ' has-error' : ''); ?>">
                                <label for="flight_date">Flight Date*</label>
                                <input class="form-control datepicker" name="flight_date" id="flight_date" value="<?php echo e(old('flight_date')); ?>" required>

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

                            <div class="form-group<?php echo e($errors->has('cbv_number') ? ' has-error' : ''); ?>">
                                <label for="cbv_number">CBV Number</label>
                                <input class="form-control" name="cbv_number" id="cbv_number" value="<?php echo e(old('cbv_number')); ?>">

                                <?php if($errors->has('cbv_number')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('cbv_number')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="form-group<?php echo e($errors->has('cbv_rate') ? ' has-error' : ''); ?>">
                                <label for="cbv_rate">Rate per KG</label>

                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input step="0.01" aria-label="Rate per KG in decimal format" title="Rate per KG in decimal format" type="number" class="form-control" name="cbv_rate" id="cbv_rate" value="<?php echo e(old('cbv_rate')); ?>">
                                    <span class="input-group-addon">Per KG</span>
                                </div>
                                <?php if($errors->has('cbv_rate')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('cbv_rate')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="form-group<?php echo e($errors->has('consignment_weight') ? ' has-error' : ''); ?>">
                                <label for="consignment_weight">Total Consignment Weight</label>

                                <div class="input-group">
                                    <input step="0.01" aria-label="Total consignment weight in decimal format" title="Total consignment weight in decimal format" type="number" class="form-control" name="consignment_weight" id="consignment_weight" value="<?php echo e(old('consignment_weight')); ?>">
                                    <span class="input-group-addon">KGs</span>
                                </div>
                                <?php if($errors->has('consignment_weight')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('consignment_weight')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="form-group<?php echo e($errors->has('uploaded_file') ? ' has-error' : ''); ?>">
                                <label for="uploaded_file">Manifest File*</label>
                                <input type="file" class="form-control" name="uploaded_file" id="uploaded_file" required>

                                <?php if($errors->has('uploaded_file')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('uploaded_file')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Import</button>
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