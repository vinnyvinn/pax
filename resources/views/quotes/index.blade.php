@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Customer Quotes
                    </div>
                    <div class="panel-body">
                        <table class="table dataTable">
                            <thead>
                            <tr>
                                <th class="printable">#</th>
                                <th class="printable">Client</th>
                                <th class="text-right printable">Proforma Amount</th>
                                <th class="text-right printable">Actual Amount</th>
                                <th class="text-right printable">Variance Amount</th>
                                <th class="printable">Date Created</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($invoices as $invoice)
                                <tr>
                                    <td><a target="_blank" href="{{ route('quote.show', $invoice->id) }}">QT{{ str_pad($invoice->id, 5, '0', STR_PAD_LEFT) }}</a></td>
                                    <td>{{ $invoice->client->Name }} ({{ $invoice->client->Account }})</td>
                                    <td class="text-right">{{ $currency }} {{ number_format($invoice->proforma_total, 2) }}</td>
                                    <td class="text-right">{{ $currency }} {{ number_format($invoice->invoice_total, 2) }}</td>
                                    <td class="text-right">{{ $currency }} {{ number_format($invoice->variance, 2) }}</td>
                                    <td>{{ Carbon\Carbon::parse($invoice->created_at)->format('d F Y') }}</td>

                                    <td class="text-center">
                                        @if($invoice->invoice_count == 0 && $invoice->waybill_count == 0)
                                            <a href="{{route('quote.edit', $invoice->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                            <button type="button" class="btn btn-danger btn-xs btn-destroy" data-token="{{ csrf_token() }}" data-url="{{ route('quote.destroy', $invoice->id) }}"><i class="fa fa-trash"></i></button>
                                        @endif

                                        @if($invoice->waybill && $invoice->category != PAX\Models\Quote::CATEGORY_OUTBOUND)
                                            @if($invoice->waybill->status == '0')
                                                <a href="{{ route('non-receive', $invoice->waybill->id) }}" class="btn btn-primary btn-xs">RECEIVE</a>
                                            @endif
                                            @if($invoice->waybill->status == '71' || $invoice->waybill->status == '72')
                                                @if($invoice->waybill->type == '71')
                                                    <a target="_blank" href="{{ route('non-release-order', $invoice->waybill->id) }}" class="btn btn-primary btn-xs">RO</a>
                                                @endif
                                                <a href="{{ route('non-dispatch', $invoice->waybill->id) }}" class="btn btn-primary btn-xs">DISPATCH</a>
                                            @endif
                                            @if($invoice->waybill->status == '65')
                                                <a href="{{ route('non-load', $invoice->waybill->id) }}" class="btn btn-primary btn-xs">LOAD</a>
                                            @endif
                                            @if($invoice->waybill->status == '63' || $invoice->waybill->status == '61')
                                                <a href="{{ route('non-pod', $invoice->waybill->id) }}" class="btn btn-success btn-xs">POD</a>
                                                <a href="{{ route('non-dex', $invoice->waybill->id) }}" class="btn btn-danger btn-xs">DEX</a>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Client</th>
                                <th class="text-right">Proforma Amount</th>
                                <th class="text-right">Actual Amount</th>
                                <th class="text-right">Variance Amount</th>
                                <th>Date Created</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
