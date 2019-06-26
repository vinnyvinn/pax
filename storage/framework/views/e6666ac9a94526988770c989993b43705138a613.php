<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li><a href="<?php echo e(route('setting-dashboard')); ?>">Setting Dashboard</a></li>
                  <li class="active">GDR rate cards</li>
                </ol>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="text-left">GDR rate cards</h4>
                            </div>
                            <div class="col-md-6">
                                <a href="<?php echo e(route('gdr.create')); ?>" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus"></i> Rate card</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                           <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Effective from</th>
                                        <th>Effective to</th>
                                        <th>Status</th>
                                        <th>Created at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $rateCard): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key+1); ?></td>
                                        <td><?php echo e(pax_date_format($rateCard->effective_from)); ?></td>
                                        <td><?php echo e(pax_date_format($rateCard->effective_to)); ?></td>
                                        <td><?php echo e($rateCard->status ? 'Active' : 'Inactive'); ?></td>
                                        <td><?php echo e(pax_date_format($rateCard->created_at)); ?></td>
                                        <td>
                                        <a href="<?php echo e(route('gdr.edit', $rateCard->id)); ?>" class="btn btn-sm btn-info" title="Edit">
                                            <i class="fa fa-edit"></i></a>
                                            <a href="<?php echo e(route('gdr.show', $rateCard->id)); ?>" class="btn btn-sm btn-info" title="Show">
                                                <i class="fa fa-eye"></i></a>
                                            <button type="button" class="btn btn-danger btn-sm btn-destroy" data-token="<?php echo e(csrf_token()); ?>" data-url="<?php echo e(route('gdr.destroy', $rateCard->id)); ?>">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>   
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table> 
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>