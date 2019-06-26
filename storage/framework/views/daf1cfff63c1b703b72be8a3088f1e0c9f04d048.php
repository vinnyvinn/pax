<div class="modal" style="" id='<?php echo e("update_status_modal_id_".$pickup->id); ?>' role="dialog" aria-labelledby='dsdsd' aria-hidden="true">
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
              <div class="form-group">
                 <label for="status">Status:</label>
                 <select name="status" id="status" class="form-control" required>
                    <option value="<?php echo e(\PAX\Models\Pickup::STATUS_done); ?>" selected>Done</option>
                    <option value="<?php echo e(\PAX\Models\Pickup::STATUS_cancelled); ?>">Cancel</option>
                 </select>
              </div><br><br>
              <div class="form-group">
                <label for="comment">Comment</label>
                <textarea name="comment" id="comment" class="form-control" required></textarea>
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
  