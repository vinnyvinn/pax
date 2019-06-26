<div class="row">
    <div class="col-12">
        <div class="table-responsive m-t-40">
            <table class="table dataTable">
              <thead>
                  <tr>
                     <th class="printable">#</th>
                     <th class="printable">Pickup no</th>
                     <th class="printable">Bill Account</th>
                     <th class="printable">Bill Company</th>
                     <th class="printable">Pickup Date</th>
                     <th class="printable">Company Name</th>
                     <th class="printable">Assigned to</th>
                     <th class="printable">Status</th>
                     <th class="printable">Type</th>
                     <th class="printable">Close time</th>
                     <th>Action</th>
                  </tr>
              </thead>
              <tfoot>
                  <tr>
                    <th class="printable">#</th>
                    <th class="printable">Pickup no</th>
                    <th class="printable">Bill Account</th>
                    <th class="printable">Bill Company</th>
                    <th class="printable">Pickup Date</th>
                    <th class="printable">Company Name</th>
                    <th class="printable">Assigned to</th>
                    <th class="printable">Status</th>
                    <th class="printable">Type</th>
                    <th class="printable">Close time</th>
                    <th>Action</th>
                  </tr>
              </tfoot>
              <tbody>
                  <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pickup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td class="printable"><?php echo e($key+1); ?></td>
                      <td class="printable"><?php echo e($pickup->pickup_no); ?></td>
                      <td class="printable"><?php echo e($pickup->client ? $pickup->client->Name :'-'); ?></td>
                      <td class="printable"><?php echo e($pickup->bill_company_name); ?></td>
                      <td class="printable"><?php echo e($pickup->pickup_date); ?></td>
                      <td class="printable"><?php echo e($pickup->company_name); ?></td>
                      <td class="printable"><?php echo e($pickup->courier ? $pickup->courier->name : '-'); ?></td>
                      <td class="printable"><?php echo e($pickup->status_name); ?></td>
                      <td class="printable"><?php echo e($pickup->type_name); ?></td>
                      <td class="printable"><?php echo e($pickup->close_time); ?></td>
                      <td>
                        <?php if($table == 'posted'): ?>
                          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target='<?php echo e("#assignment_modal_id_".$pickup->id); ?>'>
                            <i class="fa fa-exchange"></i>
                          </button>
                          <?php echo $__env->make('dispatch.pickups.partials.assign-modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php endif; ?>
                        <?php if($table == 'recurrent'): ?>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target='<?php echo e("#set_recurrent_modal_id_".$pickup->id); ?>'>
                          <i class="fa fa-bell"></i>
                        </button>
                        <?php echo $__env->make('dispatch.pickups.partials.set-recurrent-modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update-status-pickups')): ?>
                          <?php if($table == 'assigned'): ?>
                          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target='<?php echo e("#update_status_modal_id_".$pickup->id); ?>'>
                            <i class="fa fa-exchange"></i>
                          </button>
                          <?php echo $__env->make('dispatch.pickups.partials.update-status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target='<?php echo e("#reschedule_modal_id_".$pickup->id); ?>'>
                              <i class="fa fa-bell"></i>
                            </button>
                            <?php echo $__env->make('dispatch.pickups.partials.reschedule', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                          <?php endif; ?>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update-pickup')): ?>
                          <a href="<?php echo e(route('pickups.edit', $pickup->id)); ?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                        <?php endif; ?>
                        <a href="<?php echo e(route('pickups.show', $pickup->id)); ?>" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update-pickup')): ?>
                          <button type="button" class="btn btn-danger btn-sm btn-destroy" data-token="<?php echo e(csrf_token()); ?>" data-url="<?php echo e(route('pickups.destroy', $pickup->id)); ?>"><i class="fa fa-trash"></i></button>
                        <?php endif; ?>
                      </td>
                    </tr> 
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
        </div>
    </div>
</div>
