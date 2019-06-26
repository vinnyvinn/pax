<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Customer Quotes
                    </div>
                    <div class="panel-body">
                        <table class="table dataTable">
                            <thead>
                            <tr>
                                <th class="printable">#</th>
                                <th class="printable">Client</th>
                                <th class="text-right printable">Proforma Amount</th>
                                <th class="text-right printable">Actual Amount</th>
                                <th class="text-right printable">Variance Amount</th>
                                <th class="printable">Date Created</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><a target="_blank" href="<?php echo e(route('quote.show', $invoice->id)); ?>">QT<?php echo e(str_pad($invoice->id, 5, '0', STR_PAD_LEFT)); ?></a></td>
                                    <td><?php echo e($invoice->client->Name); ?> (<?php echo e($invoice->client->Account); ?>)</td>
                                    <td class="text-right"><?php echo e($currency); ?> <?php echo e(number_format($invoice->proforma_total, 2)); ?></td>
                                    <td class="text-right"><?php echo e($currency); ?> <?php echo e(number_format($invoice->invoice_total, 2)); ?></td>
                                    <td class="text-right"><?php echo e($currency); ?> <?php echo e(number_format($invoice->variance, 2)); ?></td>
                                    <td><?php echo e(Carbon\Carbon::parse($invoice->created_at)->format('d F Y')); ?></td>

                                    <td class="text-center">
                                        <?php if($invoice->invoice_count == 0 && $invoice->waybill_count == 0): ?>
                                            <a href="<?php echo e(route('quote.edit', $invoice->id)); ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                            <button type="button" class="btn btn-danger btn-xs btn-destroy" data-token="<?php echo e(csrf_token()); ?>" data-url="<?php echo e(route('quote.destroy', $invoice->id)); ?>"><i class="fa fa-trash"></i></button>
                                        <?php endif; ?>

                                        <?php if($invoice->waybill && $invoice->category != PAX\Models\Quote::CATEGORY_OUTBOUND): ?>
                                            <?php if($invoice->waybill->status == '0'): ?>
                                                <a href="<?php echo e(route('non-receive', $invoice->waybill->id)); ?>" class="btn btn-primary btn-xs">RECEIVE</a>
                                            <?php endif; ?>
                                            <?php if($invoice->waybill->status == '71' || $invoice->waybill->status == '72'): ?>
                                                <?php if($invoice->waybill->type == '71'): ?>
                                                    <a target="_blank" href="<?php echo e(route('non-release-order', $invoice->waybill->id)); ?>" class="btn btn-primary btn-xs">RO</a>
                                                <?php endif; ?>
                                                <a href="<?php echo e(route('non-dispatch', $invoice->waybill->id)); ?>" class="btn btn-primary btn-xs">DISPATCH</a>
                                            <?php endif; ?>
                                            <?php if($invoice->waybill->status == '65'): ?>
                                                <a href="<?php echo e(route('non-load', $invoice->waybill->id)); ?>" class="btn btn-primary btn-xs">LOAD</a>
                                            <?php endif; ?>
                                            <?php if($invoice->waybill->status == '63' || $invoice->waybill->status == '61'): ?>
                                                <a href="<?php echo e(route('non-pod', $invoice->waybill->id)); ?>" class="btn btn-success btn-xs">POD</a>
                                                <a href="<?php echo e(route('non-dex', $invoice->waybill->id)); ?>" class="btn btn-danger btn-xs">DEX</a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Client</th>
                                <th class="text-right">Proforma Amount</th>
                                <th class="text-right">Actual Amount</th>
                                <th class="text-right">Variance Amount</th>
                                <th>Date Created</th>
                                <th>Action</th>
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