<div class="panel panel-info">
    <div class="panel-heading">
        <h4 class="m-b-0 text-white"><?php echo e($pickup->id ? 'Update' : 'Add'); ?> pickup</h4>
    </div>
    <form action="<?php echo e(!$pickup->id ? route('pickups.store') : route('pickups.update', $pickup->id)); ?>" class="form-bordered" method="POST">
      <div class="panel-body">
        <?php echo e(csrf_field()); ?>

        <?php if($pickup->id): ?>
          <?php echo e(method_field('PUT')); ?>

        <?php endif; ?>
        <div class="row">
            <div class="form-group col-md-4">
                <label class="control-label">Type</label>
                <select name="type" id="type" class="form-control">
                  <option value="<?php echo e(\PAX\Models\Pickup::TYPE_tnt); ?>" <?php echo e(isset($pickup->type) ? $pickup->type : old('type') == \PAX\Models\Pickup::TYPE_tnt ? 'selected' : ''); ?>>TNT</option>
                  <option value="<?php echo e(\PAX\Models\Pickup::TYPE_fedex); ?>" <?php echo e(isset($pickup->type) ? $pickup->type : old('type') == \PAX\Models\Pickup::TYPE_fedex ? 'selected' : ''); ?>>FEDEX</option>
                </select>
                <?php if($errors->has('type')): ?>
                <small class="form-control-feedback text-danger"><?php echo e($errors->first('type')); ?></small>
                <?php endif; ?>
            </div>
            <div class="form-group col-md-4">
              <label class="control-label">Pickup no</label>
              <input type="text" disabled name="pickup_no" value="<?php echo e(isset($pickup->pickup_no) ? $pickup->pickup_no : old('pickup_no')); ?>" placeholder="Pick number" class="form-control">
              <?php if($errors->has('pickup_no')): ?>
              <small class="form-control-feedback text-danger"><?php echo e($errors->first('pickup_no')); ?></small>
              <?php endif; ?>
            </div>
            <div class="form-group col-md-4">
              <label class="control-label">Pick up date</label>
              <input type="date" name="pickup_date"  value="<?php echo e(isset($pickup->pickup_date) ? $pickup->pickup_date : old('pickup_date')); ?>" placeholder="pick up date" class="form-control" required>
              <?php if($errors->has('pickup_date')): ?>
              <small class="form-control-feedback text-danger"><?php echo e($errors->first('pickup_date')); ?></small>
              <?php endif; ?>
            </div>
            <div class="form-group col-md-4">
                <label for="ready_time" class="control-label">Ready time</label>
                <input type="time" name="ready_time" id="ready_time" max="17:30" value="<?php echo e(isset($pickup->ready_time) ? $pickup->ready_time : old('ready_time')); ?>" class="form-control" required>
                <?php if($errors->has('ready_time')): ?>
                  <small class="form-control-feedback text-danger"><?php echo e($errors->first('ready_time')); ?></small>
                <?php endif; ?>
            </div>
            <div class="form-group col-md-4">
               <label for="close_time" class="control-label">Close time</label>
               <input type="time" name="close_time" id="close_time" max="17:30" value="<?php echo e(isset($pickup->close_time) ? $pickup->close_time : old('close_time')); ?>" class="form-control" required>
               <?php if($errors->has('close_time')): ?>
                  <small class="form-control-feedback text-danger"><?php echo e($errors->first('close_time')); ?></small>
                <?php endif; ?>
            </div>
        </div>
      <hr>
      <div class="row">
        <div class="form-group col-md-6">
          <label class="control-label">Contact name</label>
          <input type="text" name="contact_name" value="<?php echo e(isset($pickup->contact_name) ? $pickup->contact_name : old('contact_name')); ?>" placeholder="contact name" class="form-control" required>
            <?php if($errors->has('contact_name')): ?>
            <small class="form-control-feedback text-danger"><?php echo e($errors->first('contact_name')); ?></small>
            <?php endif; ?>
        </div>
        <div class="form-group col-md-4">
          <label class="control-label">Contact Phone</label>
          <input type="number" name="contact_phone" value="<?php echo e(isset($pickup->contact_phone) ? $pickup->contact_phone : old('contact_phone')); ?>" class="form-control" required>
          <?php if($errors->has('contact_phone')): ?>
            <small class="form-control-feedback text-danger"><?php echo e($errors->first('contact_phone')); ?></small>
          <?php endif; ?>
        </div>
        <div class="form-group col-md-4">
          <label class="control-label">Company name</label>
          <input type="text" name="company_name" value="<?php echo e(isset($pickup->company_name) ? $pickup->company_name : old('company_name')); ?>" class="form-control" required>
          <?php if($errors->has('company_name')): ?>
            <small class="form-control-feedback text-danger"><?php echo e($errors->first('company_name')); ?></small>
          <?php endif; ?>
        </div>
        <div class="form-group col-md-4">
          <label class="control-label" id="client_id">Bill Account</label>
          <select name="client_id" id="client_id" class="form-control">
            <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($client->DCLink); ?>" <?php echo e(isset($pickup->client_id) ? $pickup->client_id : old('client_id') == $client->DCLink ? 'selected' : ''); ?>><?php echo e($client->name); ?></option> 
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
          <?php if($errors->has('bill_account')): ?>
            <small class="form-control-feedback text-danger"><?php echo e($errors->first('bill_account')); ?></small>
          <?php endif; ?>
        </div>
        <div class="form-group col-md-4">
          <label class="control-label">Bill Company</label>
          <select class="form-control" name="bill_company" required>
             <option value="<?php echo e(\PAX\Models\Pickup::BILL_FEDEX); ?>" <?php echo e(isset($pickup->bill_company) ? $pickup->bill_company : old('bill_company') == \PAX\Models\Pickup::BILL_FEDEX ? 'selected' : ''); ?>>FEDEX</option>
             <option value="<?php echo e(\PAX\Models\Pickup::BILL_TNT); ?>" <?php echo e(isset($pickup->bill_company) ? $pickup->bill_company : old('bill_company') == \PAX\Models\Pickup::BILL_TNT ? 'selected' : ''); ?>>TNT</option>
             <option value="<?php echo e(\PAX\Models\Pickup::BILL_DOMESTIC); ?>" <?php echo e(isset($pickup->bill_company) ? $pickup->bill_company : old('bill_company') == \PAX\Models\Pickup::BILL_DOMESTIC ? 'selected' : ''); ?>>Domestic</option>
           </select>
           <?php if($errors->has('bill_account')): ?>
             <small class="form-control-feedback text-danger"><?php echo e($errors->first('bill_company')); ?></small>
           <?php endif; ?>
        </div>
    </div>
      <hr>
      <div class="row">
        <div class="form-group col-md-4">
          <label class="control-label">No packages</label>
          <input type="number" name="no_packages" value="<?php echo e(isset($pickup->no_packages) ? $pickup->no_packages : old('no_packages')); ?>" class="form-control text-right" required>
          <?php if($errors->has('no_packages')): ?>
          <small class="form-control-feedback text-danger"><?php echo e($errors->first('no_packages')); ?></small>
          <?php endif; ?>
        </div>
        <div class="form-group col-md-4">
           <label class="control-label">Expected weight(Kg)</label>
           <input type="number" name="expected_weight" value="<?php echo e(isset($pickup->expected_weight) ? $pickup->expected_weight : old('expected_weight')); ?>" class="form-control text-right" required>
           <?php if($errors->has('expected_weight')): ?>
           <small class="form-control-feedback text-danger"><?php echo e($errors->first('expected_weight')); ?></small>
           <?php endif; ?>
         </div>
      </div>
      <div class="form-group col-md-12">
          <label for="description" class="control-label">Brief description</label>
          <textarea name="description" id="description" class="form-control"><?php echo e(isset($pickup->description) ? $pickup->description : old('description')); ?></textarea>
      </div>
      <div class="form-group col-md-12">
          <label for="address" class="control-label">Pickup address</label>
          <textarea name="address" id="address" class="form-control"><?php echo e(isset($pickup->address) ? $pickup->address : old('address')); ?></textarea>
      </div>
      <div class="form-group col-md-12">
          <label for="instructions" class="control-label">Other instructions</label>
          <textarea name="instructions" id="instructions" class="form-control"><?php echo e(isset($pickup->instructions) ? $pickup->instructions : old('instructions')); ?></textarea>
      </div>
      <div class="form-group col-md-4">
          <label class="control-label">Cash Collect</label>
          <input type="number" name="cash_collect" value="<?php echo e(isset($pickup->cash_collect) ? $pickup->cash_collect : old('cash_collect')); ?>" class="form-control text-right">
            <?php if($errors->has('cash_collect')): ?>
            <small class="form-control-feedback text-danger"><?php echo e($errors->first('cash_collect')); ?></small>
            <?php endif; ?>
      </div>
      <div class="form-group col-md-4">
          <br>
          <div class="checkbox icheck-primary">
          <input type="checkbox" name="recurrent" id="recurrent" value="1" <?php echo e(isset($pickup->recurrent) ? $pickup->recurrent : old('recurrent') ? 'checked' : ''); ?>/>
             <label for="recurrent">Check recurrent</label>
          </div>
      </div>
      <hr>
    </div>
    <div class="panel-footer">
        <div class="row">
          <div class="col-12">
            <div class="pull-right clearfix">
               <button type="submit" class="btn btn-info btn-sm">
                 <i class="fa fa-save"></i> <?php echo e($pickup->id ? 'Update' : 'Save'); ?>

                </button>
               <a href="<?php echo e(route('pickups.index')); ?>" class="btn btn-warning btn-sm"><i class="fa fa-caret-left"></i> Back</a>
            </div>
          </div>
        </div>
    </div>
  </form>
</div>