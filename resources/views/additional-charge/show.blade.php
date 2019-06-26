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

<h5 class="text-center"><strong>{{ $invoice->status ? '' : 'PROFORMA'}}INVOICE</strong></h5>

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
                        <td>{{ $invoice->waybill->waybill_number }}</td>
                        <td class="text-right">{{ Carbon\Carbon::parse($invoice->waybill->shipped_date)->format('d/m/Y') }}</td>
                        <td class="text-right">{{ $invoice->waybill->con_name }} - {{ $invoice->waybill->export_city }}</td>
                        <td class="text-right">{{ $invoice->waybill->package() }}</td>
                        <td class="text-right">{{ number_format($invoice->waybill->actual_weight, 2) }}</td>
                        <td class="text-right">{{ number_format($invoice->freight, 2) }}</td>
                    </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3"><small>From: {{ $invoice->waybill->export_city }}</small></th>
                            <th colspan="3"><small>To: {{ "{$invoice->waybill->con_city} - {$invoice->waybill->con_country}" }}</small></th>
                        </tr>
                    </tfoot>
                </table>
                <h4 class="text-center">Additional charges</h4>
                <table class="table plain-table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Charge</th>
                            <th>description</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($invoice->invoice_data as $key => $item)
                         <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->charge->code }}</td>
                            <td>{{ $item->charge->description }}</td>
                            <td>{{ number_format($item->value, 2) }}</td>
                        </tr>   
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-right"></th>
                            <th colspan="2" class="text-right"> Total</th>
                            <th colspan="2" class="text-right">
                                    {{ is_array($invoice->invoice_data) ? number_format(array_sum(array_map(function($charge){ return $charge->value; }, $invoice->invoice_data)), 2) : 0 }}
                            </th>
                        </tr>
                    </tfoot>
                </table>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-12">
            Please make cheques and remittances payable to:
        </div>
    
        <div class="col-xs-12">
            <h6><strong>PAN AFRICA EXPRESS TRANSPORT LIMITED</strong></h6>
            <h6>CFC BANK</h6>
            <h6>KSH ‑ 0100002143059</h6>
            <h6>USD ‑ 0100002143067</h6>
            <h6>SWIFT CODE: SBICKENX</h6>
            <h6>BANK CODE:  31</h6>
            <h6>SORT CODE:  005</h6>
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