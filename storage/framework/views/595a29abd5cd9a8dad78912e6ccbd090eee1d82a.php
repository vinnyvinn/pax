<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Cities
                        <a href="<?php echo e(route('account.create')); ?>" class="btn btn-primary btn-xs pull-right">New</a>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table dataTable">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th width="100px">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($city->name); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('account.edit', $city->id)); ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                            <button type="button" class="btn btn-danger btn-xs btn-destroy" data-token="<?php echo e(csrf_token()); ?>"
                                                    data-url="<?php echo e(route('account.destroy', $city->id)); ?>"
                                            ><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th width="100px">Action</th>
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