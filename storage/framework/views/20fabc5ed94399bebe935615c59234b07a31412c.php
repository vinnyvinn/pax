<div class="row">
    <div class="col-xs-12">
        <table class="table plain-table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Airway bill</th>
                    <th>Ship Date</th>
                    <th>Origin/Description</th>
                    <th>Packaging</th>
                    <th class="text-right">Weight (KGs)</th>
                    <th class="text-right">Amount</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?php echo e($invoice->waybill->waybill_number); ?></td>
                    <td class="text-right"><?php echo e(Carbon\Carbon::parse($invoice->waybill->shipped_date)->format('d/m/Y')); ?></td>
                    <td class="text-right"><?php echo e($invoice->waybill->con_name); ?> - <?php echo e($invoice->waybill->export_city); ?></td>
                    <td class="text-right"><?php echo e($invoice->waybill->package()); ?></td>
                    <td class="text-right"><?php echo e(number_format($invoice->waybill->actual_weight, 2)); ?></td>
                    <td class="text-right"><?php echo e(number_format($invoice->freight, 2)); ?></td>
                </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">From: <?php echo e(@$invoice->waybill->from->name); ?></th>
                        <th colspan="3">To: <?php echo e(@$invoice->waybill->to->name); ?></th>
                    </tr>
                </tfoot>
            </table>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        Please make cheques and remittances payable to:
    </div>

    <div class="col-xs-6">
        <h4><strong>PAN AFRICA EXPRESS TRANSPORT LIMITED</strong></h4>
        <h4>CFC BANK</h4>
        <h4>KSH ‑ 0100002143059</h4>
        <h4>USD ‑ 0100002143067</h4>
        <h4>SWIFT CODE: SBICKENX</h4>
        <h4>BANK CODE:  31</h4>
        <h4>SORT CODE:  005</h4>
    </div>
    <div class="col-xs-6">
        <table class="table plain-table table-bordered">
            <thead>
            <tr>
                <th colspan="2" class="text-right">Amount<?php echo e($invoice->category == PAX\Models\Invoice::CATEGORY_AGENT_CLEARANCE ? " (USD)" : ''); ?></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th>Subtotal Before VAT</th>
                <td class="text-right"><?php echo e(number_format($invoice->freight, 2)); ?></td>
            </tr>
            <?php if(isset($invoice->discount)): ?>
                <tr>
                    <th>Discount</th>
                    <td class="text-right"><?php echo e(number_format($invoice->discount, 2)); ?></td>
                </tr>
            <?php endif; ?>
            <tr>
                <th>Fuel Levy</th>
                <td class="text-right"><?php echo e(number_format($invoice->fuel_levy, 2)); ?></td>
            </tr>
            <tr>
                <th>Subtotal After Fuel Levy</th>
                <td class="text-right"><strong><?php echo e(number_format($invoice->subFuel, 2)); ?></strong></td>
            </tr>
            <tr>
                <th>Insurance</th>
                <td class="text-right"><strong><?php echo e(number_format($invoice->insurance, 2)); ?></strong></td>
            </tr>
            <tr>
                <th>CCK Levy</th>
                <td class="text-right"><strong><?php echo e(number_format($invoice->invoiceData->cck_levy, 2)); ?></strong></td>
            </tr>
            <tr>
                <th>VAT</th>
                <td class="text-right"><strong><?php echo e(number_format($invoice->vat_amount, 2)); ?></strong></td>
            </tr>
            <tr>
                <th>Amount Due</th>
                <td class="text-right"><strong><?php echo e(number_format($invoice->actualTotal, 2)); ?></strong></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
