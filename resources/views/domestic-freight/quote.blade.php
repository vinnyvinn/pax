@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Domestic Freight Quotes
                        <a href="{{ route('domestic-freight.create') }}" class="btn btn-primary btn-xs pull-right">
                            <i class="fa fa-plus"></i> New Quote Invoice
                        </a>
                    </div>
                    <div class="panel-body">
                        <table class="table dataTable">
                            <thead>
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
                            </thead>
                            <tbody>

                            @foreach($invoices as $invoice)
                                <tr>
                                    <td><a target="_blank" href="{{ route('domestic-freight.show', $invoice->id) }}">QTE-{{ $invoice->id }}</a></td>
                                    <td>{{ $invoice->client->Name }} ({{ $invoice->client->Account }})</td>
                                    <td>{{ $invoice->type }}</td>
                                    <td class="text-right">KES {{ number_format($invoice->proforma_total, 2) }}</td>
                                    <td class="text-right">KES {{ number_format($invoice->invoice_total, 2) }}</td>
                                    <td class="text-right">KES {{ number_format($invoice->variance, 2) }}</td>
                                    <td>{{ Carbon\Carbon::parse($invoice->created_at)->format('d F Y') }}</td>

                                    <td>

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
