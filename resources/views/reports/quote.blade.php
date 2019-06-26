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

    <div class="row">
        <div class="col-xs-4">
            <img src="{{ asset('images/fedex.png') }}" alt="FedEx" class="img-responsive" style="width: 130px !important;">
            <h4>Pan African Express Transport Ltd</h4>
            <h4>Licensee of Federal Express Corporation</h4>
        </div>
        <div class="col-xs-4">
            <h4 class="text-center">Afrique Center,</h4>
            <h4 class="text-center">Masai Road, Off Mombasa Road,</h4>
            <h4 class="text-center">P.O. Box 47802-00100,</h4>
            <h4 class="text-center">Mombasa Road, Nairobi, Kenya</h4>
        </div>
        <div class="col-xs-4">
            <h4>&nbsp;</h4>
            <h4 class="text-right">Tel: +254 20 3907000</h4>
            <h4 class="text-right">Fax: +254 20 3907222</h4>
            <h4 class="text-right">info@paxtransport.com</h4>
        </div>
    </div>

    <h1 class="text-center"><strong>QUOTE</strong></h1>

    <br>
    <br>

    <div class="row">
        <div class="col-xs-6">
            <h4><strong class="text-uppercase">{{ $quote->con_name ?: $quote->con_company }}</strong></h4>
            <h4><strong class="text-uppercase">{{ $quote->con_phone ?: $quote->con_address }}</strong></h4>
        </div>
        <div class="col-xs-4 col-xs-offset-2">
            <h5><strong class="text-uppercase">NUMBER: <span class="pull-right">QT{{ str_pad($quote->id, 5, '0', STR_PAD_LEFT) }}</span></strong></h5>
            <h5><strong class="text-uppercase">DATE <span class="pull-right">{{ Carbon\Carbon::now()->format('d F Y') }}</span></strong></h5>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-3">
            <h4><strong>Shipment Origin:</strong></h4>
            <h4><strong>Shipment Destination:</strong></h4>
            <h4><strong>Shipment Weight:</strong></h4>
            <h4><strong>Shipment Currency:</strong></h4>
        </div>
        <div class="col-xs-9">
            <h4>{{ $quote->shipper_city }}, {{ getCountry($quote->shipper_country) }}</h4>
            <h4>{{ $quote->con_city }}, {{ getCountry($quote->con_country) }}</h4>
            <h4>{{ $quote->weight }}</h4>
            <h4>{{ $quote->currency }}</h4>
        </div>
    </div>

    <br>
    <br>

    <div class="row">
        <div class="col-xs-12">
            <table class="table plain-table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Description</th>
                    <th class="text-right">Net Amount</th>
                    <th class="text-right">Vat Amount</th>
                    <th class="text-right">Total Amount</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $quote->description }}</td>
                    @if($quote->category == PAX\Models\Quote::CATEGORY_INBOUND)
                        <td class="text-right">{{ number_format($quote->subFuel + $quote->insurance + $quote->invoiceData->cck_levy, 2) }}</td>
                    @else
                        <td class="text-right">{{ number_format($quote->subFuel + $quote->insurance, 2) }}</td>
                    @endif
                    <td class="text-right">{{ number_format($quote->vat_amount, 2) }}</td>
                    <td class="text-right">{{ number_format($quote->actualTotal, 2) }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <h3>Terms</h3>
            <ol type="1">
                <li>Charges are only valid for parameters shown herein.</li>
                <li>The terms in this quotation are only valid for 14 days, i.e. {{ Carbon\Carbon::now()->addDays(7)->format('d/m/Y') }}.</li>
                <li>The price indicated herein is only provisional, subject to change (plus or minus) depending on the final billable weight between the actual weight and the dimensional weight as weighed by us prior to shipping.</li>
                <li>This price is exclusive of any duties and taxes to be imposed upon arrival after customs verification and assessment.</li>
            </ol>
        </div>

        <br>
        <br>
        <div class="col-xs-12">
            <p><strong>Incase of any queries do not hesitate to get in touch with us through the contacts shown above</strong></p>
        </div>
    </div>



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