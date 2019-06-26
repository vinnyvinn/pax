<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Customer List</div>
                <div class="card-body">
                        <div class="table-responsive m-t-40">
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Contact Name</th>
                                        <th>Contact phone</th>
                                        <th>Company</th>
                                        <th>Bill ac</th>
                                        <th>Bill Company</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Contact Name</th>
                                        <th>Contact phone</th>
                                        <th>Company</th>
                                        <th>Bill ac</th>
                                        <th>Bill Company</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <tr>
                                        <td><?php echo e($key+1); ?></td>
                                        <td><?php echo e(ucwords($customer->contact_name)); ?></td>
                                        <td><?php echo e($customer->contact_phone); ?></td>
                                        <td><?php echo e(ucwords($customer->company_name)); ?></td>
                                        <td><?php echo e($customer->bill_account); ?></td>
                                        <td><?php echo e($customer->bill_co); ?></td>
                                        <td><?php echo e($customer->address); ?></td>
                                        <td>
                                        <a href="<?php echo e(route('customers.edit', $customer->id)); ?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="/dismod/js/lib/datatables/datatables.min.js"></script>
    <script src="/dismod/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="/dismod/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="/dismod/js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="/dismod/js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="/dismod/js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="/dismod/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="/dismod/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="/dismod/js/lib/datatables/datatables-init.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dispatch.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>