<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li><a href="<?php echo e(route('setting-dashboard')); ?>">Setting Dashboard</a></li>
                  <li class="active">Routes</li>
                </ol>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <div class="col-md-6">
                                Routes
                        </div>
                        <div class="col-md-6">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create-routes')): ?>
                            <form action="<?php echo e(route('routes.import')); ?>" enctype="multipart/form-data" method="POST">
                                <?php echo e(csrf_field()); ?>

                                <div class="form-group">
                                    <div class="input-group pull-right">
                                        <input type="file" name="routes" id="routes" class="form-control input-sm">
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
                                    <th>Area Code</th>
                                    <th width="100px">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($route->name); ?></td>
                                        <td><?php echo e($route->areaCode->name); ?></td>
                                        <td>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit-routes')): ?>
                                                <a href="<?php echo e(route('route.edit', $route->id)); ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-routes')): ?>
                                                <button type="button" class="btn btn-danger btn-xs btn-destroy" data-token="<?php echo e(csrf_token()); ?>" data-url="<?php echo e(route('route.destroy', $route->id)); ?>"><i class="fa fa-trash"></i></button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Code</th>
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