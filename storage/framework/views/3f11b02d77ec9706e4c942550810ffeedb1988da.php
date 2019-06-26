<div class="modal" id='<?php echo e("set_recurrent_modal_id_".$pickup->id); ?>' role="dialog" aria-labelledby='dsdsd' aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id='dsdsd'>Set recurrent dates for <?php echo e($pickup->pickup_no); ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <recurrent-dates-set :pickup="<?php echo e($pickup); ?>"></recurrent-dates-set>
        </div>
      </div>
    </div>
  </div>
    