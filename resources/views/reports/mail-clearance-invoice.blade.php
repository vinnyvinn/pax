<link href="https://fonts.googleapis.com/css?family=Lato:300,400,600" rel="stylesheet">
<link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">

<div class="container" style="font-size: 12px;">

    <h1 class="text-center">FEDEX</h1>
    <h4 class="text-center">Pan African Express Transport Ltd</h4>
    <h5 class="text-center">Licensee of Federal Express Corporation</h5>

    @if(($invoice->type == PAX\Models\Invoice::PROFORMA) || ($invoice->type == PAX\Models\Invoice::PROFORMA_FREIGHT))
        <h4 class="text-center"><strong>PROFORMA INVOICE</strong></h4>
    @else
        <h4 class="text-center"><strong>INVOICE</strong></h4>
    @endif

    <br>
    <br>

    <div class="row">
        <div class="col-xs-6">
            <h4><strong class="text-uppercase">{{ $invoice->waybill->con_name ?: $invoice->waybill->con_company }}</strong></h4>
            <h5><strong class="text-uppercase">{{ $invoice->waybill->con_city }}</strong></h5>
            <h5><strong class="text-uppercase">{{ $invoice->waybill->con_country }}</strong></h5>
        </div>
        <div class="col-xs-4 col-xs-offset-2">
            <h5>
                <strong class="text-uppercase">
                    NUMBER: INV-{{ str_pad($invoice->id, 5, '0', STR_PAD_LEFT) }}
                </strong>
            </h5>
            <h5>
                <strong class="text-uppercase">
                    DATE: {{ Carbon\Carbon::now()->format('d F Y') }}
                </strong>
            </h5>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6">
            <h4><strong class="text-uppercase">{{ $invoice->waybill->waybill_number }}</strong></h4>
        </div>
        <div class="col-xs-4 col-xs-offset-2">
            <h4><strong class="text-uppercase">PIN NO: {{ PAX\Models\Setting::value(PAX\Models\Setting::PIN_NUMBER) }}</strong></h4>
            <h5><strong class="text-uppercase">VAT NO: {{ PAX\Models\Setting::value(PAX\Models\Setting::PIN_NUMBER) }}</strong></h5>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12">
            @if($invoice->category == PAX\Models\Invoice::CATEGORY_AGENT_CLEARANCE)
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
                        <td>BREAK BULK FEE</td>
                        <td class="text-right">0.00</td>
                        <td class="text-right">{{ number_format($invoice->break_bulk_fee, 2) }}</td>
                    </tr>
                    <tr>
                        <td>STORAGE FEE</td>
                        <td class="text-right">0.00</td>
                        <td class="text-right">{{ number_format($invoice->storage_fee, 2) }}</td>
                    </tr>
                    </tbody>
                </table>
            @else
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
                        <td class="text-right">{{ number_format($invoice->duty_amount, 2) }}</td>
                    </tr>
                    <tr>
                        <td>IDF</td>
                        <td class="text-right">0.00</td>
                        <td class="text-right">{{ number_format($invoice->idf, 2) }}</td>
                    </tr>
                    <tr>
                        <td>VAT IMPORT</td>
                        <td class="text-right">0.00</td>
                        <td class="text-right">{{ number_format($invoice->vat_amount, 2) }}</td>
                    </tr>
                    <tr>
                        <td>RDL (RAILWAY DEVELOPMENT LEVY)</td>
                        <td class="text-right">0.00</td>
                        <td class="text-right">{{ number_format($invoice->rdl, 2) }}</td>
                    </tr>
                    <tr>
                        <td>GOK</td>
                        <td class="text-right">0.00</td>
                        <td class="text-right">{{ number_format($invoice->gok, 2) }}</td>
                    </tr>
                    <tr>
                        <td>KAA</td>
                        <td class="text-right">0.00</td>
                        <td class="text-right">{{ number_format($invoice->kaa, 2) }}</td>
                    </tr>
                    <tr>
                        <td>KEBS FEE</td>
                        <td class="text-right">0.00</td>
                        <td class="text-right">{{ number_format($invoice->kebs, 2) }}</td>
                    </tr>
                    <tr>
                        <td>AGENCY FEE</td>
                        <td class="text-right">{{ number_format($invoice->agentVat, 2) }}</td>
                        <td class="text-right">{{ number_format($invoice->agency_fees, 2) }}</td>
                    </tr>
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            Please make cheques and remittances payable to:
        </div>
    </div>

    <div class="row">
        <div class="col-xs-8">
            <h6><strong>PAN AFRICA EXPRESS TRANSPORT LIMITED</strong></h6>
            <h6>CFC BANK</h6>
            <h6>KSH ‑ 0100002143059</h6>
            <h6>USD ‑ 0100002143067</h6>
            <h6>SWIFT CODE: SBICKENX</h6>
            <h6>BANK CODE:  31</h6>
            <h6>SORT CODE:  005</h6>
        </div>
        <div class="col-xs-4 brd">
            {{--<div class="row">--}}
                {{--<div class="col-xs-12">--}}
                    {{--<h6 class="text-right"><strong>Amount (USD)</strong></h6>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="row">--}}
                {{--<div class="col-xs-8">--}}
                    {{--<h6 class="text-right"><strong>Base Total Amount</strong></h6>--}}
                {{--</div>--}}
                {{--<div class="col-xs-4">--}}
                    {{--<h6 class="text-right">{{ number_format($invoice->actualTotal - $invoice->agentVat, 2) }}</h6>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="row">--}}
                {{--<div class="col-xs-8">--}}
                    {{--<h6 class="text-right"><strong>VAT Total Amount</strong></h6>--}}
                {{--</div>--}}
                {{--<div class="col-xs-4">--}}
                    {{--<h6 class="text-right">{{ number_format($invoice->agentVat, 2) }}</h6>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="row">--}}
                {{--<div class="col-xs-8">--}}
                    {{--<h6 class="text-right"><strong>Amount Due</strong></h6>--}}
                {{--</div>--}}
                {{--<div class="col-xs-4">--}}
                    {{--<h6 class="text-right">{{ number_format($invoice->actualTotal, 2) }}</h6>--}}
                {{--</div>--}}
            {{--</div>--}}

            <table class="tb">
                <tr>
                    <th colspan="2" class="text-right">Amount{{ $invoice->category == PAX\Models\Invoice::CATEGORY_AGENT_CLEARANCE ? " (USD)" : '' }}</th>
                </tr>
                <tr>
                    <th>Base Total Amount</th>
                    <td class="text-right">{{ number_format($invoice->actualTotal - $invoice->agentVat, 2) }}</td>
                </tr>
                <tr>
                    <th>VAT Total Amount</th>
                    <td class="text-right">{{ number_format($invoice->agentVat, 2) }}</td>
                </tr>
                <tr>
                    <th>Amount Due</th>
                    <td class="text-right"><strong>{{ number_format($invoice->actualTotal, 2) }}</strong></td>
                </tr>
            </table>
        </div>
    </div>


</div>
