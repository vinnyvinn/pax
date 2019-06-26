<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
              <li><a href="/">Home</a></li>
              <li><a href="<?php echo e(route('setting-dashboard')); ?>">Setting Dashboard</a></li>
              <li><a href="<?php echo e(route('domestic-rates.index')); ?>">Domestic rates</a></li>
              <li class="active">Edit domestic rates</li>
            </ol>
            <hr>
        </div>
    </div>
    <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <form action="<?php echo e(route('domestic-rates.update', $rate->id)); ?>" method="post">
                    <?php echo e(csrf_field()); ?>

                    <?php echo e(method_field('PUT')); ?>


                    <h4>Location A</h4>
                    <p><?php echo e($rate->from->name); ?></p>

                    <h4>Location B</h4>
                    <p><?php echo e($rate->to->name); ?></p>


                    <div class="form-group<?php echo e($errors->has('amount') ? ' has-error' : ''); ?>">
                        <label for="amount">Rate</label>
                        <input type="number" min="0" name="amount" id="amount" class="form-control" required value="<?php echo e($rate->amount); ?>">

                        <?php if($errors->has('amount')): ?>
                            <span class="help-block"><?php echo e($errors->first('amount')); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="<?php echo e(route('domestic-rates.index')); ?>" class="btn btn-danger">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>