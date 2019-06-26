@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Invoices
                    </div>
                    <div class="panel-body table-responsive">
                        <table class="table dataTable nowrap">
                            <thead>
                            <tr>
                                <th class="printable">#</th>
                                <th class="printable">Quote</th>
                                <th class="printable">Client</th>
                                <th class="text-right printable">Proforma Amount</th>
                                <th class="text-right printable">Actual Amount</th>
                                <th class="text-right printable">Variance Amount</th>
                                <th class="printable">Date Created</th>
                                <th width="100px">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>
                                        <a target="_blank" href="{{ route('non-invoice.show', $invoice->id) }}">INV-{{ str_pad($invoice->id, 5, '0', STR_PAD_LEFT) }}</a>
                                    </td>
                                    <td>
                                        <a target="_blank" href="{{ route('quote.show', $invoice->quote->id) }}">QT{{ str_pad($invoice->quote->id, 5, '0', STR_PAD_LEFT) }}</a>
                                    </td>
                                    <td>{{ $invoice->client->Name }} ({{ $invoice->client->Account }})</td>
                                    <td class="text-right">{{ $currency }} {{ number_format($invoice->proforma_total, 2) }}</td>
                                    <td class="text-right">{{ $currency }} {{ number_format($invoice->invoice_total, 2) }}</td>
                                    <td class="text-right">{{ $currency }} {{ number_format($invoice->variance, 2) }}</td>
                                    <td>{{ Carbon\Carbon::parse($invoice->created_at)->format('d F Y') }}</td>

                                    <td>
                                        @if(($invoice->type != PAX\Models\Invoice::ACTUAL_FREIGHT) && ((int) $invoice->nonWaybill->current_status <= 63))
                                            <a href="{{route('non-invoice.edit', $invoice->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Quote</th>
                                <th>Client</th>
                                <th class="text-right">Proforma Amount</th>
                                <th class="text-right">Actual Amount</th>
                                <th class="text-right">Variance Amount</th>
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
@endsection
