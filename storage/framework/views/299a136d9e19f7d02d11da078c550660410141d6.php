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
        window.print();
    </script>

</head>
<body style="background: #fff !important; font-size: 20px; color: #000 !important;">
<div class="container">

    <?php $__currentLoopData = $waybills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $waybill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <h1 class="text-center">FEDEX</h1>
        <h4 class="text-center">Pan African Express Transport Ltd</h4>
        <h5 class="text-center">Licensee of Federal Express Corporation</h5>

        <h4 class="text-center"><strong>RELEASE ORDER</strong></h4>

        <br>
        <br>

        <div class="row">
            <div class="col-xs-6">
                <h4><strong>CONSIGNEE</strong></h4>
                <h2><strong class="text-uppercase"><?php echo e($waybill->con_name); ?></strong></h2>
            </div>
            <div class="col-xs-6">
                <div class="text-right">
                    <h5><strong>TRANSGLOBAL CARGO CENTRE</strong></h5>
                    <h5><strong>JKIA - NAIROBI</strong></h5>
                    <h5>P.O. BOX 47802 – 00100</h5>
                    <h5>TEL: 254-20-8045280/1/2</h5>
                    <h5>FAX: 254-20-3907222</h5>
                    <h5>PIN NO: P051304647Z</h5>
                    <h5>Email address: clearingke@paxtransport.com</h5>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 text-right">
                <h4><strong>Release Order Number: <?php echo e($waybill->id); ?></strong></h4>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <table class="table table-stripped table-bordered plain-table">
                    <thead>
                    <tr>
                        <th>Airway Bill Number</th>
                        <th>No. of Pieces</th>
                        <th>Weight (KGS)</th>
                        <th colspan="2">Gateway</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?php echo e($waybill->waybill_number); ?></td>
                        <td><?php echo e($waybill->total); ?></td>
                        <td><?php echo e(number_format($waybill->actual_weight, 2)); ?> KGs</td>
                        <td>JKIA</td>
                        <td>PAN AFRICA TRANSPORT LTD</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-xs-8">
                <h5><strong>Flight Number Shipment</strong></h5>
                <h5><?php echo e($manifest->flight_number); ?></h5>

                <h5><strong>Description</strong></h5>
                <h5><?php echo e($waybill->description); ?></h5>
            </div>
            <div class="col-xs-4">
                <h5><strong>Value</strong></h5>
                <h5><?php echo e($waybill->currency); ?> <?php echo e(number_format($waybill->value, 0)); ?></h5>

                <h5><strong>Arrive Date</strong></h5>
                <h5><?php echo e(Carbon\Carbon::parse($manifest->flight_date)->format('d/m/Y')); ?></h5>
            </div>
        </div>

        <hr>

        <h5>Dear Customer,</h5>

        <p>
            FedEx has received your shipment at JKIA. Kenya and it has been held by Kenya Revenue
            Authority for Customs processing.
        </p>
        <p>
            All shipments arriving in Kenya are subject to customs clearance before they can be released
            to you. You are allowed 48 hours free storage from the date of this advice in which to effect
            clearance. After this time storage charge of USD 0.15 per kilo per day with a minimum charge of
            USD 50.00 will be levied.
        </p>
        <p>
            Please note according to KRA regulations shipments that are not cleared within 21 days will
            be transferred to the Customs warehouse at
            Forodha House — JKIA. For the duration of their stay at this warehouse, warehouse rent will
            be levied at a rate determined by Customs.
            We will be pleased to respond to any inquiry on our Customer Call Center on Tel. No. 3907000
        </p>


        <div class="row">
            <div class="col-xs-12">
                <table class="table table-bordered plain-table">
                    <thead>
                    <tr>
                        <th class="text-center">STOP</th>
                        <th class="text-center">RELEASED</th>
                        <th class="text-center">FEDEX CASHIER RELEASE</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td rowspan="2"></td>
                        <td rowspan="2"></td>
                        <td rowspan="2"></td>
                        <td><h6><strong>SIGNATURE</strong></h6><br></td>
                    </tr>
                    <tr>
                        <td><h6><strong>DATE</strong></h6><br></td>
                    </tr>
                    <tr>
                        <td colspan="4"><strong>CUSTOMS VALUE:</strong></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="page-break"></div>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<script src="<?php echo e(asset(mix('js/app.js'))); ?>"></script>
<script>
    setTimeout(function () {
        window.close();
    }, 200);
</script>
</body>
</html>