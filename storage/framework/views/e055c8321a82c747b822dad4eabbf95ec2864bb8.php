<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="m-b-0 text-white">
                        Import pickups
                         <?php if($type == \PAX\Models\Pickup::TYPE_tnt): ?> (TNT)
                         <?php elseif($type == \PAX\Models\Pickup::TYPE_fedex): ?> (FEDEX)
                         <?php elseif($type == \PAX\Models\Pickup::TYPE_tnt): ?> (Recurrent)
                         <?php endif; ?>
                    </h4>
                </div>
                <form action="<?php echo e(route('pickups.imports')); ?>" class="form-bordered" method="POST"  enctype="multipart/form-data">
                  <div class="panel-body">
                    <?php echo e(csrf_field()); ?>

                   <input type="hidden" name="type" value="<?php echo e($type); ?>">
                    <div class="row">
                        <div class="form-group col-md-4 col-md-offset-4">
                            <input type="file" name="pickups" id="pickups" class="form-control" required>
                        </div>
                    </div>
                    <hr>
                  </div>
                <div class="panel-footer">
                    <div class="row">
                      <div class="col-12">
                        <div class="pull-right clearfix">
                           <button type="submit" class="btn btn-info btn-sm">
                             <i class="fa fa-save"></i> Import
                            </button>
                           <a href="<?php echo e(route('pickups.index')); ?>" class="btn btn-warning btn-sm"><i class="fa fa-caret-left"></i> Back</a>
                        </div>
                      </div>
                    </div>
                </div>
              </form>
            </div>
        </div>
    </div>
</div>
    
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="/dismod/date-picker/css/bootstrap-datepicker.standalone.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="/dismod/date-picker/js/bootstrap-datepicker.min.js"></script>
    <script>
      $(function() {
        $('#date-picker').datepicker({
            autoclose: true
        });
      });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>