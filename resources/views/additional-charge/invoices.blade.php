@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li><a href="{{ route('outbound-dashboard') }}">Outbound dashboard</a></li>
                  <li class="active">Additional charges invoices</li>
                </ol>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Additional charges Invoices
                    </div>
                    <div class="panel-body">
                        <table class="table dataTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Client</th>
                                <th>Type</th>
                                <th>Waybill</th>
                                <th>Amount</th>
                                <th>Date Created</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $invoice)
                                <tr>
                                    <td><a target="_blank" href="{{ route('additional-charges-outbound.show', $invoice->id)}}">{{'INV-AC-' . str_pad($invoice->id, 5, '0', STR_PAD_LEFT)}}</a></td>
                                    <td>{{ "{$invoice->client->Account} {$invoice->client->Name}"}}</td>
                                    <td>{{ $invoice->status ? 'Invoice' : 'Proforma' }}</td>
                                    <td>{{ $invoice->waybill->waybill_number }}</td>
                                    <td>{{ is_array($invoice->invoice_data) ? number_format(array_sum(array_map(function($charge){ return $charge->value; }, $invoice->invoice_data)), 2) : 0 }}</td>
                                    <td>{{ Carbon\Carbon::parse($invoice->created_at)->format('Y-M-d') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Client</th>
                                <th>Type</th>
                                <th>Waybill</th>
                                <th>Amount</th>
                                <th>Date Created</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
