<div class="modal" style="" id='<?php echo e("reschedule_modal_id_".$pickup->id); ?>' role="dialog" aria-labelledby='dsdsd' aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id='dsdsd'>Update status - <?php echo e($pickup->pickup_no); ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?php echo e(route('pickups.update-status', $pickup->id)); ?>" method="post">
          <?php echo e(csrf_field()); ?> <?php echo e(method_field('PUT')); ?>

          <div class="modal-body">
           <div class="row">
               <div class="col-md-12">
                <div class="form-group">
                  <label for="status">Status:</label>
                  <select name="status" id="status" class="form-control" required>
                    <option value="<?php echo e(\PAX\Models\Pickup::STATUS_rescheduled); ?>" selected>Reschedule</option>
                  </select>
                </div>
               </div>
               <div class="form-group col-md-12">
                  <label class="control-label">Pick up date</label>
                  <input type="date" name="pickup_date"  value="<?php echo e(isset($pickup->pickup_date) ? $pickup->pickup_date : old('pickup_date')); ?>" placeholder="pick up date" class="form-control" required>
                  <?php if($errors->has('pickup_date')): ?>
                  <small class="form-control-feedback text-danger"><?php echo e($errors->first('pickup_date')); ?></small>
                  <?php endif; ?>
                </div>
                <div class="form-group col-md-12">
                    <label for="ready_time" class="control-label">Ready time</label>
                    <input type="time" name="ready_time" id="ready_time" value="<?php echo e(isset($pickup->ready_time) ? $pickup->ready_time : old('ready_time')); ?>" class="form-control">
                    <?php if($errors->has('ready_time')): ?>
                      <small class="form-control-feedback text-danger"><?php echo e($errors->first('ready_time')); ?></small>
                    <?php endif; ?>
                </div>              
            </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
    </div>
    </div>
</div>
  