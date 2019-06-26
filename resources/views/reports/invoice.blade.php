<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

</head>
<body style="background: #fff !important; font-size: 20px; color: #000 !important;">
<div class="container">

    <h3 class="text-center">DELTAHANDLING</h3>
    <h5 class="text-center">Pan African Express Transport Ltd</h5>
    <h6 class="text-center">Licensee of Federal Express Corporation</h6>

    @if(($invoice->type == PAX\Models\Invoice::PROFORMA) || ($invoice->type == PAX\Models\Invoice::PROFORMA_FREIGHT))
        <h5 class="text-center"><strong>PROFORMA INVOICE</strong></h5>
    @else
        <h5 class="text-center"><strong>INVOICE</strong></h5>
    @endif

    <br>

    <div class="row">
        <div class="col-xs-6">
            <h5><strong class="text-uppercase">{{ $invoice->waybill->con_name ?: $invoice->waybill->con_company }}</strong></h5>
            <h6><strong class="text-uppercase">{{ $invoice->waybill->con_city }}</strong></h6>
            <h6><strong class="text-uppercase">{{ $invoice->waybill->con_country }}</strong></h6>
        </div>
        <div class="col-xs-4 col-xs-offset-2">
            <h6><strong class="text-uppercase">NUMBER: <span class="pull-right">INV-{{ str_pad($invoice->id, 5, '0', STR_PAD_LEFT) }}</span></strong></h6>
            <h6><strong class="text-uppercase">DATE <span class="pull-right">{{ Carbon\Carbon::now()->format('d F Y') }}</span></strong></h6>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6">
            <h5><strong class="text-uppercase">{{ $invoice->waybill->waybill_number }}</strong></h5>
        </div>
        <div class="col-xs-4 col-xs-offset-2">
            <h6><strong class="text-uppercase">PIN NO: {{ PAX\Models\Setting::value(PAX\Models\Setting::PIN_NUMBER) }}</strong></h6>
            <h6><strong class="text-uppercase">VAT NO: {{ PAX\Models\Setting::value(PAX\Models\Setting::PIN_NUMBER) }}</strong></h6>
        </div>
    </div>
    @if(($invoice->type == PAX\Models\Invoice::PROFORMA) || $invoice->type == PAX\Models\Invoice::ACTUAL)
        @include('reports.partials.clearing')
    @else
        @include('reports.partials.freight')
    @endif

</div>
    <script src="{{ asset(mix('js/app.js')) }}"></script>
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