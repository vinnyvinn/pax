<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li><a href="<?php echo e(route('outbound-dashboard')); ?>">Outbound dashboard</a></li>
                  <li class="active">Freight Invoices</li>
                </ol>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Freight Invoices
                        <a href="<?php echo e(route('outbound.freight.create')); ?>" class="btn btn-primary btn-xs pull-right">
                            <i class="fa fa-plus"></i> New Proforma Invoice
                        </a>
                    </div>
                    <div class="panel-body">
                        <table class="table dataTable">
                            <thead>
                            <tr>
                                <th class="printable">#</th>
                                <th class="printable">Client</th>
                                <th class="printable">Type</th>
                                <th class="printable text-right">Proforma Amount (USD)</th>
                                <th class="printable text-right">Actual Amount (USD)</th>
                                <th class="printable text-right">Variance Amount (USD)</th>
                                <th class="printable">Date Created</th>
                                <th width="100px">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="printable"><a target="_blank" href="<?php echo e(route('outbound.freight.show', $invoice->id)); ?>">INV<?php echo e($invoice->id); ?></a></td>
                                    <td class="printable"><?php echo e("{$invoice->client->Account} ({$invoice->client->FedexId})"); ?></td>
                                    <td class="printable"><?php echo e($invoice->type); ?></td>
                                    <td class="printable text-right"><?php echo e(number_format($invoice->proforma_total, 2)); ?></td>
                                    <td class="printable text-right"><?php echo e(number_format($invoice->invoice_total, 2)); ?></td>
                                    <td class="printable text-right"><?php echo e(number_format($invoice->variance, 2)); ?></td>
                                    <td class="printable"><?php echo e(Carbon\Carbon::parse($invoice->created_at)->format('d F Y')); ?></td>


                                    <td>
                                        <?php if($invoice->type != PAX\Models\Invoice::ACTUAL_FREIGHT): ?>
                                            <a href="<?php echo e(route('outbound.freight.edit', $invoice->id)); ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                                            <button type="button" class="btn btn-danger btn-sm btn-destroy" data-token="<?php echo e(csrf_token()); ?>" data-url="<?php echo e(route('freight.destroy', $invoice->id)); ?>"><i class="fa fa-trash"></i></button>
                                        <?php endif; ?>
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