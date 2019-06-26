<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li><a href="<?php echo e(route('outbound-dashboard')); ?>">Outbound dashboard</a></li>
                  <li class="active">Airwaybill additional charges</li>
                </ol>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Additional charges
                        <a href="<?php echo e(route('additional-charges-outbound.create')); ?>" class="btn btn-primary btn-xs pull-right">
                            <i class="fa fa-plus"></i> Additional charge
                        </a>
                    </div>
                    <div class="panel-body">
                        <table class="table dataTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Client</th>
                                <th>Type</th>
                                <th>Waybill</th>
                                <th>Amount (USD)</th>
                                <th>Date Created</th>
                                <th width="100px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><a target="_blank" href="<?php echo e(route('additional-charges-outbound.show', $invoice->id)); ?>"><?php echo e('INV-AC-' . str_pad($invoice->id, 5, '0', STR_PAD_LEFT)); ?></a></td>
                                    <td><?php echo e("{$invoice->client->Account} {$invoice->client->Name}"); ?></td>
                                    <td><?php echo e($invoice->status ? 'Invoice' : 'Proforma'); ?></td>
                                    <td><?php echo e($invoice->waybill->waybill_number); ?></td>
                                    <td><?php echo e(is_array($invoice->invoice_data) ? number_format(array_sum(array_map(function($charge){ return $charge->value; }, $invoice->invoice_data)), 2) : 0); ?></td>
                                    <td><?php echo e(Carbon\Carbon::parse($invoice->created_at)->format('Y-M-d')); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('additional-charges-outbound.edit', $invoice->id)); ?>" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Client</th>
                                <th>Type</th>
                                <th>Waybill</th>
                                <th>Amount (USD)</th>
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