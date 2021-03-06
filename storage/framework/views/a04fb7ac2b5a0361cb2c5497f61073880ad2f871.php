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
                                <th class="printable">#</th>
                                <th class="printable">Client</th>
                                <th class="printable">AWB</th>
                                <th class="text-right printable">Proforma Amount</th>
                                <th class="text-right printable">Actual Amount</th>
                                <th class="text-right printable">Variance Amount</th>
                                <th class="printable">Date Created</th>
                                <th width="100px">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><a target="_blank" href="<?php echo e(route('invoice.show', $invoice->id)); ?>">INV-<?php echo e(str_pad($invoice->id, 5, '0', STR_PAD_LEFT)); ?></a></td>
                                    <td><?php echo e($invoice->client->Name); ?> (<?php echo e($invoice->client->Account); ?>)</td>
                                    <td><?php echo e($invoice->waybill->waybill_number); ?></td>
                                    <td class="text-right"><?php echo e($currency); ?> <?php echo e(number_format($invoice->proforma_total, 2)); ?></td>
                                    <td class="text-right"><?php echo e($currency); ?> <?php echo e(number_format($invoice->invoice_total, 2)); ?></td>
                                    <td class="text-right"><?php echo e($currency); ?> <?php echo e(number_format($invoice->variance, 2)); ?></td>
                                    <td><?php echo e(Carbon\Carbon::parse($invoice->created_at)->format('d F Y')); ?></td>

                                    <td>
                                        <?php if($invoice->type != PAX\Models\Invoice::ACTUAL): ?>
                                            <a href="<?php echo e(route('invoice.edit', $invoice->id)); ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                            <button type="button" class="btn btn-danger btn-xs btn-destroy" data-token="<?php echo e(csrf_token()); ?>" data-url="<?php echo e(route('invoice.destroy', $invoice->id)); ?>"><i class="fa fa-trash"></i></button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="printable">#</th>
                                    <th class="printable">Client</th>
                                    <th class="printable">AWB</th>
                                    <th class="text-right printable">Proforma Amount</th>
                                    <th class="text-right printable">Actual Amount</th>
                                    <th class="text-right printable">Variance Amount</th>
                                    <th class="printable">Date Created</th>
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