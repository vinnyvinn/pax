@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li><a href="{{ route('outbound-dashboard') }}">Outbound dashboard</a></li>
                  <li class="active">Freight Invoices</li>
                </ol>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Freight Invoices
                        <a href="{{ route('outbound.freight.create') }}" class="btn btn-primary btn-xs pull-right">
                            <i class="fa fa-plus"></i> New Proforma Invoice
                        </a>
                    </div>
                    <div class="panel-body">
                        <table class="table dataTable">
                            <thead>
                            <tr>
                                <th class="printable">#</th>
                                <th class="printable">Client</th>
                                <th class="printable">Type</th>
                                <th class="printable text-right">Proforma Amount (USD)</th>
                                <th class="printable text-right">Actual Amount (USD)</th>
                                <th class="printable text-right">Variance Amount (USD)</th>
                                <th class="printable">Date Created</th>
                                <th width="100px">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($invoices as $invoice)
                                <tr>
                                    <td class="printable"><a target="_blank" href="{{ route('outbound.freight.show', $invoice->id) }}">INV{{ $invoice->id }}</a></td>
                                    <td class="printable">{{ "{$invoice->client->Account} ({$invoice->client->FedexId})" }}</td>
                                    <td class="printable">{{ $invoice->type }}</td>
                                    <td class="printable text-right">{{ number_format($invoice->proforma_total, 2) }}</td>
                                    <td class="printable text-right">{{ number_format($invoice->invoice_total, 2) }}</td>
                                    <td class="printable text-right">{{ number_format($invoice->variance, 2) }}</td>
                                    <td class="printable">{{ Carbon\Carbon::parse($invoice->created_at)->format('d F Y') }}</td>


                                    <td>
                                        @if($invoice->type != PAX\Models\Invoice::ACTUAL_FREIGHT)
                                            <a href="{{route('outbound.freight.edit', $invoice->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                                            <button type="button" class="btn btn-danger btn-sm btn-destroy" data-token="{{ csrf_token() }}" data-url="{{ route('freight.destroy', $invoice->id) }}"><i class="fa fa-trash"></i></button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Client</th>
                                <th>Type</th>
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
