<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo e(asset(mix('css/app.css'))); ?>" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>;
    </script>

</head>
<body style="background: #fff !important; font-size: 20px; color: #000 !important;">
<div class="container">

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
            <h5><strong class="text-uppercase">NUMBER: <span class="pull-right">INV-<?php echo e(str_pad($invoice->id, 5, '0', STR_PAD_LEFT)); ?></span></strong></h5>
            <h5><strong class="text-uppercase">DATE <span class="pull-right"><?php echo e(Carbon\Carbon::now()->format('d F Y')); ?></span></strong></h5>
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
    <?php if(($invoice->type == PAX\Models\Invoice::PROFORMA) || $invoice->type == PAX\Models\Invoice::ACTUAL): ?>
        <?php echo $__env->make('reports.partials.clearing', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php else: ?>
        <?php echo $__env->make('reports.partials.freight', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>

</div>
    <script src="<?php echo e(asset(mix('js/app.js'))); ?>"></script>
    <script>
        setTimeout(function () {
            window.print();
        }, 500);
        setTimeout(function () {
            window.close();
        }, 600);
    </script>
</body>
</html>