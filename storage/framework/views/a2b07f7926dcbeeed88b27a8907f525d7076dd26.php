<link href="https://fonts.googleapis.com/css?family=Lato:300,400,600" rel="stylesheet">
<style>
    * {
        background: #fff !important;
        color: #000 !important;
    }
    body {
        font-family: Lato,sans-serif;
    }
    .text-center {
        text-align: center;
    }
    .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
        font-family: inherit;
        font-weight: 500;
        line-height: 1.1;
        color: inherit;
    }
    h1, h2, h3 {
        margin-top: 22px;
        margin-bottom: 11px;
    }
    .h1, h1 {
        font-size: 36px;
        margin: .67em 0;
    }
    .h4, h4 {
        font-size: 18px;
    }
    .h5, h5 {
        font-size: 14px;
    }
    .h4, .h5, .h6, h4, h5, h6 {
        margin-top: 11px;
        margin-bottom: 11px;
    }
    .h6, h6 {
        font-size: 12px;
    }
    strong {
        font-weight: 700;
    }
    @media (min-width: 768px) {
        .container {
            width: 750px;
        }
    }
    @media (min-width: 992px) {
        .container {
            width: 970px;
        }
    }
    @media (min-width: 1200px) {
        .container {
            width: 1170px;
        }
    }
    .container, .container-fluid {
        padding-left: 15px;
        padding-right: 15px;
    }
    .container, .container-fluid {
        margin-right: auto;
        margin-left: auto;
    }
    .row {
        margin-left: -15px;
        margin-right: -15px;
    }
    .col-xs-6 {
        width: 50%;
    }
    .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
        float: left;
    }
    .col-xs-offset-2 {
        margin-left: 16.66666667%;
    }
    .col-xs-4 {
        width: 33.33333333%;
    }
    .col-xs-12 {
        width: 100%;
    }
    .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
        border: 1px solid #ddd;
    }
    .table {
        width: 100%;
        max-width: 100%;
        margin-bottom: 22px;
    }
    table {
        border-collapse: collapse;
        border-spacing: 0;
    }
    .table>caption+thead>tr:first-child>td, .table>caption+thead>tr:first-child>th, .table>colgroup+thead>tr:first-child>td, .table>colgroup+thead>tr:first-child>th, .table>thead:first-child>tr:first-child>td, .table>thead:first-child>tr:first-child>th {
        border-top: 0;
    }
    .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
        border-bottom-width: 2px;
    }
    .table>thead>tr>th {
        vertical-align: bottom;
    }
    .table-striped>tbody>tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }
    .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
        border: 1px solid #ddd;
    }
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
        padding: 8px;
        line-height: 1.6;
        vertical-align: top;
        border-top: 1px solid #ddd;
    }
    .text-right {
        text-align: right;
    }
    .col-xs-8 {
        width: 66.66666667%;
    }
</style>

<div class="container" style="font-size: 16px; clear: both; display: block;">

    <h1 class="text-center">FEDEX</h1>
    <h4 class="text-center">Pan African Express Transport Ltd</h4>
    <h5 class="text-center">Licensee of Federal Express Corporation</h5>

    <?php if(($invoice->type == PAX\Models\Invoice::PROFORMA) || ($invoice->type == PAX\Models\Invoice::PROFORMA_FREIGHT)): ?>
        <h4 class="text-center"><strong>PROFORMA INVOICE</strong></h4>
    <?php else: ?>
        <h4 class="text-center"><strong>INVOICE</strong></h4>
    <?php endif; ?>

    <br>
    <br>

    <div class="row">
        <div class="col-xs-6">
            <h4><strong class="text-uppercase"><?php echo e($invoice->waybill->con_name ?: $invoice->waybill->con_company); ?></strong></h4>
            <h5><strong class="text-uppercase"><?php echo e($invoice->waybill->con_city); ?></strong></h5>
            <h5><strong class="text-uppercase"><?php echo e($invoice->waybill->con_country); ?></strong></h5>
        </div>
        <div class="col-xs-4 col-xs-offset-2">
            <h5>
                <strong class="text-uppercase">
                    NUMBER: INV-<?php echo e(str_pad($invoice->id, 5, '0', STR_PAD_LEFT)); ?>

                </strong>
            </h5>
            <h5>
                <strong class="text-uppercase">
                    DATE: <?php echo e(Carbon\Carbon::now()->format('d F Y')); ?>

                </strong>
            </h5>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6">
            <h4><strong class="text-uppercase"><?php echo e($invoice->waybill->waybill_number); ?></strong></h4>
        </div>
        <div class="col-xs-4 col-xs-offset-2">
            <h4><strong class="text-uppercase">PIN NO: <?php echo e(PAX\Models\Setting::value(PAX\Models\Setting::PIN_NUMBER)); ?></strong></h4>
            <h5><strong class="text-uppercase">VAT NO: <?php echo e(PAX\Models\Setting::value(PAX\Models\Setting::PIN_NUMBER)); ?></strong></h5>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12">
            <table class="table plain-table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Description</th>
                        <th class="text-right">VAT AMOUNT</th>
                        <th class="text-right">AMOUNT</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>IMPORT DUTY</td>
                        <td class="text-right">0.00</td>
                        <td class="text-right"><?php echo e(number_format($invoice->duty_amount, 2)); ?></td>
                    </tr>
                    <tr>
                        <td>IDF</td>
                        <td class="text-right">0.00</td>
                        <td class="text-right"><?php echo e(number_format($invoice->idf, 2)); ?></td>
                    </tr>
                    <tr>
                        <td>VAT IMPORT</td>
                        <td class="text-right">0.00</td>
                        <td class="text-right"><?php echo e(number_format($invoice->vat_amount, 2)); ?></td>
                    </tr>
                    <tr>
                        <td>RDL (RAILWAY DEVELOPMENT LEVY)</td>
                        <td class="text-right">0.00</td>
                        <td class="text-right"><?php echo e(number_format($invoice->rdl, 2)); ?></td>
                    </tr>
                    <tr>
                        <td>GOK</td>
                        <td class="text-right">0.00</td>
                        <td class="text-right"><?php echo e(number_format($invoice->gok, 2)); ?></td>
                    </tr>
                    <tr>
                        <td>KAA</td>
                        <td class="text-right">0.00</td>
                        <td class="text-right"><?php echo e(number_format($invoice->kaa, 2)); ?></td>
                    </tr>
                    <tr>
                        <td>KEBS FEE</td>
                        <td class="text-right">0.00</td>
                        <td class="text-right"><?php echo e(number_format($invoice->kebs, 2)); ?></td>
                    </tr>
                    <tr>
                        <td>AGENCY FEE</td>
                        <td class="text-right"><?php echo e(number_format($invoice->agentVat, 2)); ?></td>
                        <td class="text-right"><?php echo e(number_format($invoice->agency_fees, 2)); ?></td>
                    </tr>
                    </tbody>
                </table>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            Please make cheques and remittances payable to:
        </div>
    </div>

    <div class="row">
        <div class="col-xs-8">
            <h4><strong>PAN AFRICA EXPRESS TRANSPORT LIMITED</strong></h4>
            <h4>CFC BANK</h4>
            <h4>KSH ‑ 0100002143059</h4>
            <h4>USD ‑ 0100002143067</h4>
            <h4>SWIFT CODE: SBICKENX</h4>
            <h4>BANK CODE:  31</h4>
            <h4>SORT CODE:  005</h4>
        </div>
        <div class="col-xs-4">

            <table class="table plain-table table-bordered">
                <tr>
                    <th colspan="2" class="text-right">Amount<?php echo e($invoice->category == PAX\Models\Invoice::CATEGORY_AGENT_CLEARANCE ? " (USD)" : ''); ?></th>
                </tr>
                <tr>
                    <th>Base Total Amount</th>
                    <td class="text-right"><?php echo e(number_format($invoice->actualTotal - $invoice->agentVat, 2)); ?> &nbps;</td>
                </tr>
                <tr>
                    <th>VAT Total Amount</th>
                    <td class="text-right"><?php echo e(number_format($invoice->agentVat, 2)); ?> &nbps;</td>
                </tr>
                <tr>
                    <th>Amount Due</th>
                    <td class="text-right"><strong><?php echo e(number_format($invoice->actualTotal, 2)); ?> &nbps;</strong></td>
                </tr>
            </table>
        </div>
    </div>


</div>

<br>
<br class="clearfix">