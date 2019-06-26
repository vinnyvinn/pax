<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Domestic Freight Quotes
                        <a href="<?php echo e(route('domestic-freight.create')); ?>" class="btn btn-primary btn-xs pull-right">
                            <i class="fa fa-plus"></i> New Quote Invoice
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
                                    <td><a target="_blank" href="<?php echo e(route('domestic-freight.show', $invoice->id)); ?>">INV<?php echo e($invoice->id); ?></a></td>
                                    <td><?php echo e($invoice->client->Name); ?> (<?php echo e($invoice->client->Account); ?>)</td>
                                    <td><?php echo e($invoice->type); ?></td>
                                    <td class="text-right">KES <?php echo e(number_format($invoice->proforma_total, 2)); ?></td>
                                    <td class="text-right">KES <?php echo e(number_format($invoice->invoice_total, 2)); ?></td>
                                    <td class="text-right">KES <?php echo e(number_format($invoice->variance, 2)); ?></td>
                                    <td><?php echo e(Carbon\Carbon::parse($invoice->created_at)->format('d F Y')); ?></td>

                                    <td>
                                        
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