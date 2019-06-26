@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Freight Invoices
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
                                    @can('view-domestic-freight-invoice')
                                        <td><a target="_blank" href="{{ route('domestic-freight.show', $invoice->id) }}">INV{{ $invoice->id }}</a></td>
                                    @else
                                        <td>INV{{ $invoice->id }}</td>
                                    @endcan
                                    <td>{{ $invoice->client->Name }} ({{ $invoice->client->Account }})</td>
                                    <td>{{ $invoice->type }}</td>
                                    <td class="text-right">KES {{ number_format($invoice->proforma_total, 2) }}</td>
                                    <td class="text-right">KES {{ number_format($invoice->invoice_total, 2) }}</td>
                                    <td class="text-right">KES {{ number_format($invoice->variance, 2) }}</td>
                                    <td>{{ Carbon\Carbon::parse($invoice->created_at)->format('d F Y') }}</td>

                                    <td>
                                        @if($invoice->type != PAX\Models\Invoice::ACTUAL_DOMESTIC)
                                            @can('edit-domestic-freight-invoice')
                                                <a href="{{route('domestic-freight.edit', $invoice->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                            @endcan

                                            @can('delete-domestic-freight-invoice')
                                                <button type="button" class="btn btn-danger btn-xs btn-destroy" data-token="{{ csrf_token() }}" data-url="{{ route('domestic-freight.destroy', $invoice->id) }}"><i class="fa fa-trash"></i></button>
                                            @endcan
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
