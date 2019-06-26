<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Invoices
                        <a href="<?php echo e(route(isset($freight) ? 'freight.create' : 'invoice.create')); ?>" class="btn btn-primary btn-xs pull-right">
                            <i class="fa fa-plus"></i> New Proforma Invoice
                        </a>
                    </div>
                    <div class="panel-body">
                        <table class="table dataTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Client</th>
                                <th>Type</th>
                                <th class="text-right">Proforma Amount</th>
                                <th class="text-right">Actual Amount</th>
                                <th class="text-right">Variance Amount</th>
                                <th>Date Created</th>
                                <th width="100px">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><a href="<?php echo e(route('invoice.show', $invoice->id)); ?>">INV<?php echo e($invoice->id); ?></a></td>
                                    <td><?php echo e($invoice->client_id); ?></td>
                                    <td><?php echo e($invoice->type); ?></td>
                                    <td class="text-right"><?php echo e($currency); ?> <?php echo e(number_format($invoice->proforma_total, 2)); ?></td>
                                    <td class="text-right"><?php echo e($currency); ?> <?php echo e(number_format($invoice->invoice_total, 2)); ?></td>
                                    <td class="text-right"><?php echo e($currency); ?> <?php echo e(number_format($invoice->variance, 2)); ?></td>
                                    <td><?php echo e(Carbon\Carbon::parse($invoice->created_at)->format('d F Y')); ?></td>


                                    <td>
                                        <a href="<?php echo e(route('invoice.edit', $invoice->id)); ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                        <button type="button" class="btn btn-danger btn-xs btn-destroy" data-token="<?php echo e(csrf_token()); ?>" data-url="<?php echo e(route('invoice.destroy', $invoice->id)); ?>"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Client</th>
                                <th>Type</th>
                                <th class="text-right">Proforma Amount</th>
                                <th class="text-right">Actual Amount</th>
                                <th class="text-right">Variance Amount</th>
                                <th>Date Created</th>
                                <th width="100px">Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>