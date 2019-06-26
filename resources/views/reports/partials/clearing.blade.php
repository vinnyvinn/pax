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
                <td>EXCISE DUTY</td>
                <td class="text-right">0.00</td>
                <td class="text-right">{{ number_format(($invoice->local_amount * ($invoice->excise_duty/100)), 2) }}</td>
            </tr>
            <tr>
                <td>IDF</td>
                <td class="text-right">0.00</td>
                <td class="text-right">{{ number_format(($invoice->local_amount * ($invoice->idf/100)), 2) }}</td>
            </tr>
            <tr>
                <td>VAT IMPORT</td>
                <td class="text-right">0.00</td>
                <td class="text-right">{{ number_format($invoice->vat_amount, 2) }}</td>
            </tr>
            <tr>
                <td>RDL ‑ RAILWAY DEVELOPMENT LEVY</td>
                <td class="text-right">0.00</td>
                <td class="text-right">{{ number_format(($invoice->local_amount * ($invoice->rdl/100)), 2) }}</td>
            </tr>
            <tr>
                <td>GOK</td>
                <td class="text-right">0.00</td>
                <td class="text-right">{{ number_format(($invoice->local_amount * ($invoice->gok/100)), 2) }}</td>
            </tr>
            <tr>
                <td>KAA</td>
                <td class="text-right">0.00</td>
                <td class="text-right">{{ number_format(($invoice->local_amount * ($invoice->kaa/100)), 2) }}</td>
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
                <th colspan="2" class="text-right">Amount{{ $invoice->category == PAX\Models\Invoice::CATEGORY_AGENT_CLEARANCE ? " (USD)" : '' }}</th>
            </tr>
            </thead>
            <tbody>
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
            </tbody>
        </table>
    </div>
</div>
