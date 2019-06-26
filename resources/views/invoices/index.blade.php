@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Invoices
                        <a href="{{ route(isset($freight) ? 'freight.create' : 'invoice.create') }}" class="btn btn-primary btn-xs pull-right">
                            <i class="fa fa-plus"></i> New Proforma Invoice
                        </a>
                    </div>
                    <div class="panel-body">
                        <table class="table dataTable">
                            <thead>
                            <tr>
                                <th class="printable">#</th>
                                <th class="printable">Client</th>
                                <th class="printable">AWB</th>
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
                                    <td><a target="_blank" href="{{ route('invoice.show', $invoice->id) }}">INV-{{ str_pad($invoice->id, 5, '0', STR_PAD_LEFT) }}</a></td>
                                    <td>{{ $invoice->client->Name }} ({{ $invoice->client->Account }})</td>
                                    <td>{{ $invoice->waybill->waybill_number }}</td>
                                    <td class="text-right">{{ $currency }} {{ number_format($invoice->proforma_total, 2) }}</td>
                                    <td class="text-right">{{ $currency }} {{ number_format($invoice->invoice_total, 2) }}</td>
                                    <td class="text-right">{{ $currency }} {{ number_format($invoice->variance, 2) }}</td>
                                    <td>{{ Carbon\Carbon::parse($invoice->created_at)->format('d F Y') }}</td>

                                    <td>
                                        @if($invoice->type != PAX\Models\Invoice::ACTUAL)
                                            <a href="{{route('invoice.edit', $invoice->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                            <button type="button" class="btn btn-danger btn-xs btn-destroy" data-token="{{ csrf_token() }}" data-url="{{ route('invoice.destroy', $invoice->id) }}"><i class="fa fa-trash"></i></button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="printable">#</th>
                                    <th class="printable">Client</th>
                                    <th class="printable">AWB</th>
                                    <th class="text-right printable">Proforma Amount</th>
                                    <th class="text-right printable">Actual Amount</th>
                                    <th class="text-right printable">Variance Amount</th>
                                    <th class="printable">Date Created</th>
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
