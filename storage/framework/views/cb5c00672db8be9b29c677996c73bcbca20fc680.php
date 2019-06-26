<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Update Scan <?php echo e($scan); ?>

                    </div>

                    <div class="panel-body">

                        <form action="<?php echo e(route('manifest.scan', $endpoint)); ?>" method="post" role="form" enctype="multipart/form-data">

                            <?php echo e(csrf_field()); ?>



                            <div class="form-group<?php echo e($errors->has('manifest_id') ? ' has-error' : ''); ?>">
                                <label for="manifest_id">Flight</label>
                                <select class="form-control selectpicker" name="manifest_id" id="manifest_id">
                                    <?php $__currentLoopData = $manifests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manifest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($manifest->id); ?>"><?php echo e($manifest->flight_date->format('d F Y')); ?> - <?php echo e($manifest->flight_number); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>

                                <?php if($errors->has('manifest_id')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('manifest_id')); ?></strong>
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
                                <button class="btn btn-success" type="submit">Update</button>
                                <a href="<?php echo e(url()->previous()); ?>" class="btn btn-danger">Back</a>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>