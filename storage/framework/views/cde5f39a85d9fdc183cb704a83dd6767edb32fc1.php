<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Pickup Management
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 clearfix">
                            <a href="<?php echo e(route('pickups.create')); ?>" class="btn btn-primary pull-right">Add pickup</a>
                            </div>
                        </div>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-pickups')): ?>
                              <li role="presentation" class="active"><a href="#all" aria-controls="all" role="tab" data-toggle="tab">All</a></li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-tnt-pickups')): ?>
                              <li role="presentation"><a href="#tnt" aria-controls="tnt" role="tab" data-toggle="tab">TNT</a></li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-fedex-pickups')): ?>
                              <li role="presentation"><a href="#fedex" aria-controls="fedex" role="tab" data-toggle="tab">FEDEX</a></li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-recurrent-pickups')): ?>
                              <li role="presentation"><a href="#recurrent" aria-controls="recurrent" role="tab" data-toggle="tab">Recurrent</a></li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-not-assigned-pickups')): ?>
                              <li role="presentation"><a href="#posted" aria-controls="posted" role="tab" data-toggle="tab">Not Assigned</a></li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-assigned-pickups')): ?>
                              <li role="presentation"><a href="#assigned" aria-controls="assigned" role="tab" data-toggle="tab">Assigned</a></li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-delayed-pickups')): ?>
                              <li role="presentation"><a href="#over_60_mins" aria-controls="over_60_mins" role="tab" data-toggle="tab">Over 60 Mins</a></li>
                              <li role="presentation"><a href="#missed" aria-controls="missed" role="tab" data-toggle="tab">Missed</a></li> 
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-done-pickups')): ?>
                              <li role="presentation"><a href="#done" aria-controls="done" role="tab" data-toggle="tab">Done</a></li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-cancelled-pickups')): ?>
                              <li role="presentation"><a href="#cancelled" aria-controls="cancelled" role="tab" data-toggle="tab">Cancelled</a></li> 
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-cancelled-pickups')): ?>
                              <li role="presentation"><a href="#rescheduled" aria-controls="rescheduled" role="tab" data-toggle="tab">Rescheduled</a></li> 
                            <?php endif; ?>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-pickups')): ?>
                              <div role="tabpanel" class="tab-pane active" id="all">
                              <form action="<?php echo e(route('pickups.report')); ?>" method="post">
                                  <div class="row">
                                      <?php echo e(csrf_field()); ?>

                                    <div class="form-group col-md-3">
                                      <label for="date_from" class="control-label">Date from:</label>
                                      <input type="date" name="date_from" id="date_from" class="form-control">
                                    </div>
                                    <div class="form-group col-md-3">
                                      <label for="date_to" class="control-label">Date to:</label>
                                      <input type="date" name="date_to" id="date_to" class="form-control">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="type" class="control-label">Type:</label>
                                        <select name="type" id="type" class="form-control">
                                          <option value="">Select pickup type</option>
                                          <option value="<?php echo e(\PAX\Models\Pickup::TYPE_tnt); ?>">TNT</option>
                                          <option value="<?php echo e(\PAX\Models\Pickup::TYPE_fedex); ?>">FEDEX</option>
                                          <option value="<?php echo e(\PAX\Models\Pickup::TYPE_recurrent); ?>">Recurrent</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                      <label for="status" class="control-label">Status:</label>
                                      <div class="input-group">
                                        <select name="status" id="status" class="form-control">
                                          <option value="">Select pickup status</option>
                                          <option value="<?php echo e(\PAX\Models\Pickup::STATUS_pending); ?>">Not assigned</option>
                                          <option value="<?php echo e(\PAX\Models\Pickup::STATUS_assigned); ?>">Assigned</option>
                                          <option value="<?php echo e(\PAX\Models\Pickup::STATUS_done); ?>">Done</option>
                                          <option value="<?php echo e(\PAX\Models\Pickup::STATUS_rescheduled); ?>">Rescheduled</option>
                                          <option value="<?php echo e(\PAX\Models\Pickup::STATUS_cancelled); ?>">Cancelled</option>
                                        </select>
                                        <span class="input-group-btn">
                                          <button class="btn btn-primary" type="submit"><i class="fa fa-download"></i></button>
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                                </form>
                                <br>
                                <?php $__env->startComponent('dispatch.pickups.partials.table', ['data' => $pickupsAll, 'table' => 'all']); ?>
                                <?php echo $__env->renderComponent(); ?>
                              </div>  
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-tnt-pickups')): ?>
                            <div role="tabpanel" class="tab-pane" id="tnt">
                                <br>
                                <?php $__env->startComponent('dispatch.pickups.partials.table', ['data' => $pickupTNT, 'table' => 'tnt']); ?>
                                <?php echo $__env->renderComponent(); ?>
                            </div>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-fedex-pickups')): ?>
                            <div role="tabpanel" class="tab-pane" id="fedex">
                                <br>
                                <?php $__env->startComponent('dispatch.pickups.partials.table', ['data' => $pickupFEDEX, 'table' => 'fedex']); ?>
                                <?php echo $__env->renderComponent(); ?>
                            </div>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-recurrent-pickups')): ?>
                            <div role="tabpanel" class="tab-pane" id="recurrent">
                                <br>
                                <?php $__env->startComponent('dispatch.pickups.partials.table', ['data' => $pickupsRecurrent, 'table' => 'recurrent']); ?>
                                <?php echo $__env->renderComponent(); ?>
                            </div>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-not-assigned-pickups')): ?>
                            <div role="tabpanel" class="tab-pane" id="posted">
                                <br>
                                <?php $__env->startComponent('dispatch.pickups.partials.table', ['data' => $pickupsPosted, 'table' => 'posted']); ?>
                                <?php echo $__env->renderComponent(); ?>
                            </div>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-assigned-pickups')): ?>
                            <div role="tabpanel" class="tab-pane" id="assigned">
                                <br>
                                <?php $__env->startComponent('dispatch.pickups.partials.table', ['data' => $pickupsAssigned, 'table' => 'assigned']); ?>
                                <?php echo $__env->renderComponent(); ?>
                            </div>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-delayed-pickups')): ?>
                            <div role="tabpanel" class="tab-pane" id="over_60_mins">
                                <br>
                                <?php $__env->startComponent('dispatch.pickups.partials.table', ['data' => $pickupOver60, 'table' => 'over60']); ?>
                                <?php echo $__env->renderComponent(); ?>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="missed">
                                <br>
                                <?php $__env->startComponent('dispatch.pickups.partials.table', ['data' => $pickupMissed, 'table' => 'missed']); ?>
                                <?php echo $__env->renderComponent(); ?>
                            </div>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-done-pickups')): ?>
                            <div role="tabpanel" class="tab-pane" id="done">
                                <br>
                                <?php $__env->startComponent('dispatch.pickups.partials.table', ['data' => $pickupDone, 'table' => 'done']); ?>
                                <?php echo $__env->renderComponent(); ?>
                            </div>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-cancelled-pickups')): ?>
                            <div role="tabpanel" class="tab-pane" id="cancelled">
                                <br>
                                <?php $__env->startComponent('dispatch.pickups.partials.table', ['data' => $pickupCancelled, 'table' => 'cancelled']); ?>
                                <?php echo $__env->renderComponent(); ?>
                            </div>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-cancelled-pickups')): ?>
                            <div role="tabpanel" class="tab-pane" id="rescheduled">
                                <br>
                                <?php $__env->startComponent('dispatch.pickups.partials.table', ['data' => $pickupRescheduled, 'table' => 'rescheduled']); ?>
                                <?php echo $__env->renderComponent(); ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<style>
  .table>tr>td {
    font-size: 10px;
  }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>