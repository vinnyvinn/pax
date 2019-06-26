<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <div class="col-md-6">
                                Setting
                        </div>
                        <div class="col-md-6">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create-routes')): ?>
                            <form action="<?php echo e(route('settings.store')); ?>" enctype="multipart/form-data" method="POST">
                                <?php echo e(csrf_field()); ?>

                                <div class="form-group">
                                    <div class="input-group pull-right">
                                        <input type="file" name="uploaded_file" id="uploaded_file" class="form-control input-sm">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm btn-info">Import</button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table dataTable">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Value</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($setting->key); ?></td>
                                        <td><?php echo e($setting->current_value); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Value</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>