<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-info">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">Edit Customer</h4>
                </div>
                <form action="<?php echo e(route('customers.update', $customer->id)); ?>" class="form-bordered" method="POST">
                <div class="card-body m-t-15">
                        <?php echo e(csrf_field()); ?>

                        <?php echo e(method_field('PUT')); ?>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label">Contact name</label>
                            <input type="text" name="contact_name" value="<?php echo e(isset($customer->contact_name) ? $customer->contact_name : old('contact_name')); ?>" placeholder="contact name" class="form-control" required>
                                  <?php if($errors->has('contact_name')): ?>
                                  <small class="form-control-feedback text-danger"><?php echo e($errors->first('contact_name')); ?></small>
                                  <?php endif; ?>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Contact Phone</label>
                                    <input type="number" name="contact_phone"value="<?php echo e(isset($customer->contact_phone) ? $customer->contact_phone : old('contact_phone')); ?>"  placeholder="contact phone" class="form-control" required>
                                    <?php if($errors->has('contact_phone')): ?>
                                      <small class="form-control-feedback text-danger"><?php echo e($errors->first('contact_phone')); ?></small>
                                    <?php endif; ?>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Company name</label>
                                    <input type="text" name="company_name" value="<?php echo e(isset($customer->company_name) ? $customer->company_name : old('company_name')); ?>"  placeholder="company name" class="form-control" required>
                                    <?php if($errors->has('company_name')): ?>
                                      <small class="form-control-feedback text-danger"><?php echo e($errors->first('company_name')); ?></small>
                                    <?php endif; ?>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Bill Account</label>
                                    <input type="text" name="bill_account" value="<?php echo e(isset($customer->bill_account) ? $customer->bill_account : old('bill_account')); ?>"  placeholder="bill account" class="form-control" required>
                                    <?php if($errors->has('bill_account')): ?>
                                      <small class="form-control-feedback text-danger"><?php echo e($errors->first('bill_account')); ?></small>
                                    <?php endif; ?>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Bill Company</label>
                                   <select class="form-control" name="bill_company" required>
                                      <option value="<?php echo e(\PAX\Models\Customer::BILL_FEDEX); ?>" <?php echo e($customer->bill_account == \PAX\Models\Customer::BILL_FEDEX ? 'selected' : ''); ?>>FEDEX</option>
                                      <option value="<?php echo e(\PAX\Models\Customer::BILL_PAX); ?>" <?php echo e($customer->bill_account == \PAX\Models\Customer::BILL_PAX ? 'selected' : ''); ?>>PAX</option>
                                    </select>
                                    <?php if($errors->has('bill_account')): ?>
                                      <small class="form-control-feedback text-danger"><?php echo e($errors->first('bill_company')); ?></small>
                                    <?php endif; ?>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Address</label>
                                    <textarea name="address" placeholder="address" class="form-control"><?php echo e(isset($customer->address) ? $customer->address : old('address')); ?></textarea>
                                    <?php if($errors->has('address')): ?>
                                      <small class="form-control-feedback text-danger"><?php echo e($errors->first('address')); ?></small>
                                    <?php endif; ?>
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-12">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-info btn-sm"> <i class="fa fa-check"></i> Update</button>
                            <a href="<?php echo e(route('customers.index')); ?>" class="btn btn-warning btn-sm"><i class="fa fa-caret-left"></i>Back</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dispatch.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>