@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        MAN-{{ str_pad($manifest->id, 5, '0', STR_PAD_LEFT) }}
                    </div>

                    <div class="panel-body">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#details" aria-controls="details" role="tab" data-toggle="tab">Manifest Details</a></li>
                            <li role="presentation"><a href="#waybills" aria-controls="waybills" role="tab" data-toggle="tab">Shipped</a></li>
                            <li role="presentation"><a href="#bill_s" aria-controls="bill_s" role="tab" data-toggle="tab">Bill Shipper</a></li>
                            <li role="presentation"><a href="#bill_c" aria-controls="bill_c" role="tab" data-toggle="tab">Bill Consignee</a></li>
                            <li role="presentation"><a href="#bill_o" aria-controls="bill_o" role="tab" data-toggle="tab">Bill Other</a></li>
                            <li role="presentation"><a href="#not_invoiced" aria-controls="not_invoiced" role="tab" data-toggle="tab">Not Invoiced</a></li>
                            <li role="presentation"><a href="#invoiced" aria-controls="invoiced" role="tab" data-toggle="tab">Invoiced</a></li>
                            {{--<li role="presentation"><a href="#dutiable-waybills" aria-controls="dutiable-waybills" role="tab" data-toggle="tab">Waybills Undergoing Clearance</a></li>--}}
                            {{--<li role="presentation"><a href="#non-dutiable-waybills" aria-controls="non-dutiable-waybills" role="tab" data-toggle="tab">Non-Dutiable Waybills</a></li>--}}
                            {{--<li role="presentation"><a href="#released-waybills" aria-controls="waybills" role="tab" data-toggle="tab">Released Waybills</a></li>--}}
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="details">
                                <br>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h4>Flight Number</h4>
                                        <h5>{{ $manifest->flight_number }}</h5>

                                        <hr>

                                        <h4>Flight Date</h4>
                                        <h5>{{ Carbon\Carbon::parse($manifest->flight_date)->format('l dS F Y') }}</h5>

                                        <hr>

                                        <h4>Flight Arrival Time</h4>
                                        <h5>{{ Carbon\Carbon::parse($manifest->arrival_time)->toTimeString() }}</h5>

                                    </div>
                                    <div class="col-sm-6">
                                        <h4>CBV Number</h4>
                                        <h5>{{ $manifest->cbv_number }}</h5>

                                        <hr>

                                        <h4>CBV Rate</h4>
                                        <h5>${{ number_format($manifest->cbv_rate, 0) }}</h5>

                                        <hr>

                                        <h4>Total Consignment Weight</h4>
                                        <h5>{{ number_format($manifest->consignment_weight, 0) }} KGs</h5>


                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="waybills">

                                <br>

                                <div class="table-responsive">
                                    <table class="table nowrap">
                                        <thead>
                                        <tr>
                                            <th class="printable">Waybill #</th>
                                            <th class="printable">CRN #</th>
                                            <th class="printable">Shipped Date</th>
                                            <th class="printable text-right">Weight</th>
                                            <th class="printable text-right">Value</th>

                                            <th class="printable">Origin</th>
                                            <th class="printable">Destination</th>
                                            <th class="printable">Export City</th>
                                            <th class="printable">Con. Name</th>
                                            <th class="printable">Con. Company</th>

                                            <th class="printable">Con. Phone</th>
                                            <th class="printable">Con. Country</th>
                                            <th class="printable">Con. State</th>
                                            <th class="printable">Con. City</th>
                                            <th class="printable">Con. Address</th>

                                            <th class="printable">Con. Address 2</th>
                                            <th class="printable">Con. Postal</th>
                                            <th class="printable">Shipper Name</th>
                                            <th class="printable">Shipper Company</th>
                                            <th class="printable">Shipper Phone</th>

                                            <th class="printable">Shipper Country</th>
                                            <th class="printable">Shipper State</th>
                                            <th class="printable">Shipper City</th>
                                            <th class="printable">Shipper Address</th>
                                            <th class="printable">Shipper Address 2</th>

                                            <th class="printable">Shipper Postal</th>
                                            <th class="printable">Bill To</th>
                                            <th class="printable">Bill Duty</th>
                                            <th class="printable">Total</th>
                                            <th class="printable">Description</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($manifest->waybills as $waybill)
                                            <tr>
                                                <td><strong><a href="{{ route('waybill.show', $waybill->id) }}">{{ $waybill->waybill_number }}</a></strong></td>
                                                <td><strong>{{ $waybill->crn_number }}</strong></td>
                                                <td><strong>{{ Carbon\Carbon::parse($waybill->shipped_date)->format('d F Y') }}</strong></td>
                                                <td class="text-right"><strong>{{ $waybill->weight }}</strong></td>
                                                <td class="text-right"><strong>{{ $waybill->currency }} {{ $waybill->value ? $waybill->value : 0 }}</strong></td>


                                                <td>{{ $waybill->origin }}</td>
                                                <td>{{ $waybill->destination }}</td>
                                                <td>{{ $waybill->export_city }}</td>
                                                <td>{{ $waybill->con_name }}</td>
                                                <td>{{ $waybill->con_company }}</td>


                                                <td>{{ $waybill->con_phone }}</td>
                                                <td>{{ $waybill->con_country }}</td>
                                                <td>{{ $waybill->con_state }}</td>
                                                <td>{{ $waybill->con_city }}</td>
                                                <td>{{ $waybill->con_address }}</td>


                                                <td>{{ $waybill->con_address_alternate }}</td>
                                                <td>{{ $waybill->con_postal }}</td>
                                                <td>{{ $waybill->shipper_name }}</td>
                                                <td>{{ $waybill->shipper_company }}</td>
                                                <td>{{ $waybill->shipper_phone }}</td>


                                                <td>{{ $waybill->shipper_country }}</td>
                                                <td>{{ $waybill->shipper_state }}</td>
                                                <td>{{ $waybill->shipper_city }}</td>
                                                <td>{{ $waybill->shipper_address }}</td>
                                                <td>{{ $waybill->shipper_address_alternate }}</td>


                                                <td>{{ $waybill->shipper_postal }}</td>
                                                <td>{{ $waybill->bill_to }}</td>
                                                <td>{{ $waybill->bill_duty }}</td>
                                                <td>{{ $waybill->total }}</td>
                                                <td>{{ $waybill->description }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div role="tabpanel" class="tab-pane" id="bill_s">

                                <br>

                                <div class="table-responsive">
                                    <table class="table table-striped nowrap">
                                        <thead>

                                        <tr>
                                            <th class="printable">Waybill #</th>
                                            <th class="printable">CRN #</th>
                                            <th class="printable">Shipped Date</th>
                                            <th class="text-right printable">Weight</th>
                                            <th class="text-right printable">Value</th>

                                            <th class="printable">Origin</th>
                                            <th class="printable">Destination</th>
                                            <th class="printable">Export City</th>
                                            <th class="printable">Con. Name</th>
                                            <th class="printable">Con. Company</th>

                                            <th class="printable">Con. Phone</th>
                                            <th class="printable">Con. Country</th>
                                            <th class="printable">Con. State</th>
                                            <th class="printable">Con. City</th>
                                            <th class="printable">Con. Address</th>

                                            <th class="printable">Con. Address 2</th>
                                            <th class="printable">Con. Postal</th>
                                            <th class="printable">Shipper Name</th>
                                            <th class="printable">Shipper Company</th>
                                            <th class="printable">Shipper Phone</th>

                                            <th class="printable">Shipper Country</th>
                                            <th class="printable">Shipper State</th>
                                            <th class="printable">Shipper City</th>
                                            <th class="printable">Shipper Address</th>
                                            <th class="printable">Shipper Address 2</th>

                                            <th class="printable">Shipper Postal</th>
                                            <th class="printable">Bill To</th>
                                            <th class="printable">Bill Duty</th>
                                            <th class="printable">Total</th>
                                            <th class="printable">Description</th>

                                        </tr>

                                        </thead>
                                        <tbody>
                                        @foreach($manifest->waybills->where('bill_to', 'S') as $waybill)
                                            <tr>
                                                <td><strong><a href="{{ route('waybill.show', $waybill->id) }}">{{ $waybill->waybill_number }}</a></strong></td>
                                                <td><strong>{{ $waybill->crn_number }}</strong></td>
                                                <td><strong>{{ Carbon\Carbon::parse($waybill->shipped_date)->format('d F Y') }}</strong></td>
                                                <td class="text-right"><strong>{{ $waybill->weight }}</strong></td>
                                                <td class="text-right"><strong>{{ $waybill->currency }} {{ $waybill->value }}</strong></td>


                                                <td>{{ $waybill->origin }}</td>
                                                <td>{{ $waybill->destination }}</td>
                                                <td>{{ $waybill->export_city }}</td>
                                                <td>{{ $waybill->con_name }}</td>
                                                <td>{{ $waybill->con_company }}</td>


                                                <td>{{ $waybill->con_phone }}</td>
                                                <td>{{ $waybill->con_country }}</td>
                                                <td>{{ $waybill->con_state }}</td>
                                                <td>{{ $waybill->con_city }}</td>
                                                <td>{{ $waybill->con_address }}</td>


                                                <td>{{ $waybill->con_address_alternate }}</td>
                                                <td>{{ $waybill->con_postal }}</td>
                                                <td>{{ $waybill->shipper_name }}</td>
                                                <td>{{ $waybill->shipper_company }}</td>
                                                <td>{{ $waybill->shipper_phone }}</td>


                                                <td>{{ $waybill->shipper_country }}</td>
                                                <td>{{ $waybill->shipper_state }}</td>
                                                <td>{{ $waybill->shipper_city }}</td>
                                                <td>{{ $waybill->shipper_address }}</td>
                                                <td>{{ $waybill->shipper_address_alternate }}</td>


                                                <td>{{ $waybill->shipper_postal }}</td>
                                                <td>{{ $waybill->bill_to }}</td>
                                                <td>{{ $waybill->bill_duty }}</td>
                                                <td>{{ $waybill->total }}</td>
                                                <td>{{ $waybill->description }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div role="tabpanel" class="tab-pane" id="bill_c">

                                <br>

                                <div class="table-responsive">
                                    <table class="table table-striped nowrap">
                                        <thead>

                                        <tr>
                                            <th class="printable">Waybill #</th>
                                            <th class="printable">CRN #</th>
                                            <th class="printable">Shipped Date</th>
                                            <th class="text-right printable">Weight</th>
                                            <th class="text-right printable">Value</th>

                                            <th class="printable">Origin</th>
                                            <th class="printable">Destination</th>
                                            <th class="printable">Export City</th>
                                            <th class="printable">Con. Name</th>
                                            <th class="printable">Con. Company</th>

                                            <th class="printable">Con. Phone</th>
                                            <th class="printable">Con. Country</th>
                                            <th class="printable">Con. State</th>
                                            <th class="printable">Con. City</th>
                                            <th class="printable">Con. Address</th>

                                            <th class="printable">Con. Address 2</th>
                                            <th class="printable">Con. Postal</th>
                                            <th class="printable">Shipper Name</th>
                                            <th class="printable">Shipper Company</th>
                                            <th class="printable">Shipper Phone</th>

                                            <th class="printable">Shipper Country</th>
                                            <th class="printable">Shipper State</th>
                                            <th class="printable">Shipper City</th>
                                            <th class="printable">Shipper Address</th>
                                            <th class="printable">Shipper Address 2</th>

                                            <th class="printable">Shipper Postal</th>
                                            <th class="printable">Bill To</th>
                                            <th class="printable">Bill Duty</th>
                                            <th class="printable">Total</th>
                                            <th class="printable">Description</th>

                                        </tr>

                                        </thead>
                                        <tbody>
                                        @foreach($manifest->waybills->where('bill_to', 'C') as $waybill)
                                            <tr>
                                                <td><strong><a href="{{ route('waybill.show', $waybill->id) }}">{{ $waybill->waybill_number }}</a></strong></td>
                                                <td><strong>{{ $waybill->crn_number }}</strong></td>
                                                <td><strong>{{ Carbon\Carbon::parse($waybill->shipped_date)->format('d F Y') }}</strong></td>
                                                <td class="text-right"><strong>{{ $waybill->weight }}</strong></td>
                                                <td class="text-right"><strong>{{ $waybill->currency }} {{ $waybill->value }}</strong></td>


                                                <td>{{ $waybill->origin }}</td>
                                                <td>{{ $waybill->destination }}</td>
                                                <td>{{ $waybill->export_city }}</td>
                                                <td>{{ $waybill->con_name }}</td>
                                                <td>{{ $waybill->con_company }}</td>


                                                <td>{{ $waybill->con_phone }}</td>
                                                <td>{{ $waybill->con_country }}</td>
                                                <td>{{ $waybill->con_state }}</td>
                                                <td>{{ $waybill->con_city }}</td>
                                                <td>{{ $waybill->con_address }}</td>


                                                <td>{{ $waybill->con_address_alternate }}</td>
                                                <td>{{ $waybill->con_postal }}</td>
                                                <td>{{ $waybill->shipper_name }}</td>
                                                <td>{{ $waybill->shipper_company }}</td>
                                                <td>{{ $waybill->shipper_phone }}</td>


                                                <td>{{ $waybill->shipper_country }}</td>
                                                <td>{{ $waybill->shipper_state }}</td>
                                                <td>{{ $waybill->shipper_city }}</td>
                                                <td>{{ $waybill->shipper_address }}</td>
                                                <td>{{ $waybill->shipper_address_alternate }}</td>


                                                <td>{{ $waybill->shipper_postal }}</td>
                                                <td>{{ $waybill->bill_to }}</td>
                                                <td>{{ $waybill->bill_duty }}</td>
                                                <td>{{ $waybill->total }}</td>
                                                <td>{{ $waybill->description }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div role="tabpanel" class="tab-pane" id="bill_o">

                                <br>

                                <div class="table-responsive">
                                    <table class="table table-striped nowrap">
                                        <thead>

                                        <tr>
                                            <th class="printable">Waybill #</th>
                                            <th class="printable">CRN #</th>
                                            <th class="printable">Shipped Date</th>
                                            <th class="text-right printable">Weight</th>
                                            <th class="text-right printable">Value</th>

                                            <th class="printable">Origin</th>
                                            <th class="printable">Destination</th>
                                            <th class="printable">Export City</th>
                                            <th class="printable">Con. Name</th>
                                            <th class="printable">Con. Company</th>

                                            <th class="printable">Con. Phone</th>
                                            <th class="printable">Con. Country</th>
                                            <th class="printable">Con. State</th>
                                            <th class="printable">Con. City</th>
                                            <th class="printable">Con. Address</th>

                                            <th class="printable">Con. Address 2</th>
                                            <th class="printable">Con. Postal</th>
                                            <th class="printable">Shipper Name</th>
                                            <th class="printable">Shipper Company</th>
                                            <th class="printable">Shipper Phone</th>

                                            <th class="printable">Shipper Country</th>
                                            <th class="printable">Shipper State</th>
                                            <th class="printable">Shipper City</th>
                                            <th class="printable">Shipper Address</th>
                                            <th class="printable">Shipper Address 2</th>

                                            <th class="printable">Shipper Postal</th>
                                            <th class="printable">Bill To</th>
                                            <th class="printable">Bill Duty</th>
                                            <th class="printable">Total</th>
                                            <th class="printable">Description</th>

                                        </tr>

                                        </thead>
                                        <tbody>
                                        @foreach($manifest->waybills->where('bill_to', 'O') as $waybill)
                                            <tr>
                                                <td><strong><a href="{{ route('waybill.show', $waybill->id) }}">{{ $waybill->waybill_number }}</a></strong></td>
                                                <td><strong>{{ $waybill->crn_number }}</strong></td>
                                                <td><strong>{{ Carbon\Carbon::parse($waybill->shipped_date)->format('d F Y') }}</strong></td>
                                                <td class="text-right"><strong>{{ $waybill->weight }}</strong></td>
                                                <td class="text-right"><strong>{{ $waybill->currency }} {{ $waybill->value }}</strong></td>


                                                <td>{{ $waybill->origin }}</td>
                                                <td>{{ $waybill->destination }}</td>
                                                <td>{{ $waybill->export_city }}</td>
                                                <td>{{ $waybill->con_name }}</td>
                                                <td>{{ $waybill->con_company }}</td>


                                                <td>{{ $waybill->con_phone }}</td>
                                                <td>{{ $waybill->con_country }}</td>
                                                <td>{{ $waybill->con_state }}</td>
                                                <td>{{ $waybill->con_city }}</td>
                                                <td>{{ $waybill->con_address }}</td>


                                                <td>{{ $waybill->con_address_alternate }}</td>
                                                <td>{{ $waybill->con_postal }}</td>
                                                <td>{{ $waybill->shipper_name }}</td>
                                                <td>{{ $waybill->shipper_company }}</td>
                                                <td>{{ $waybill->shipper_phone }}</td>


                                                <td>{{ $waybill->shipper_country }}</td>
                                                <td>{{ $waybill->shipper_state }}</td>
                                                <td>{{ $waybill->shipper_city }}</td>
                                                <td>{{ $waybill->shipper_address }}</td>
                                                <td>{{ $waybill->shipper_address_alternate }}</td>


                                                <td>{{ $waybill->shipper_postal }}</td>
                                                <td>{{ $waybill->bill_to }}</td>
                                                <td>{{ $waybill->bill_duty }}</td>
                                                <td>{{ $waybill->total }}</td>
                                                <td>{{ $waybill->description }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div role="tabpanel" class="tab-pane" id="not_invoiced">

                                <br>

                                <div class="table-responsive">
                                    <table class="table table-striped nowrap">
                                        <thead>

                                        <tr>
                                            <th class="printable">Waybill #</th>
                                            <th class="printable">CRN #</th>
                                            <th class="printable">Shipped Date</th>
                                            <th class="text-right printable">Weight</th>
                                            <th class="text-right printable">Value</th>

                                            <th class="printable">Origin</th>
                                            <th class="printable">Destination</th>
                                            <th class="printable">Export City</th>
                                            <th class="printable">Con. Name</th>
                                            <th class="printable">Con. Company</th>

                                            <th class="printable">Con. Phone</th>
                                            <th class="printable">Con. Country</th>
                                            <th class="printable">Con. State</th>
                                            <th class="printable">Con. City</th>
                                            <th class="printable">Con. Address</th>

                                            <th class="printable">Con. Address 2</th>
                                            <th class="printable">Con. Postal</th>
                                            <th class="printable">Shipper Name</th>
                                            <th class="printable">Shipper Company</th>
                                            <th class="printable">Shipper Phone</th>

                                            <th class="printable">Shipper Country</th>
                                            <th class="printable">Shipper State</th>
                                            <th class="printable">Shipper City</th>
                                            <th class="printable">Shipper Address</th>
                                            <th class="printable">Shipper Address 2</th>

                                            <th class="printable">Shipper Postal</th>
                                            <th class="printable">Bill To</th>
                                            <th class="printable">Bill Duty</th>
                                            <th class="printable">Total</th>
                                            <th class="printable">Description</th>

                                        </tr>

                                        </thead>
                                        <tbody>
                                        @foreach($manifest->waybills->where('freight_billed', false) as $waybill)
                                            <tr>
                                                <td><strong><a href="{{ route('waybill.show', $waybill->id) }}">{{ $waybill->waybill_number }}</a></strong></td>
                                                <td><strong>{{ $waybill->crn_number }}</strong></td>
                                                <td><strong>{{ Carbon\Carbon::parse($waybill->shipped_date)->format('d F Y') }}</strong></td>
                                                <td class="text-right"><strong>{{ $waybill->weight }}</strong></td>
                                                <td class="text-right"><strong>{{ $waybill->currency }} {{ $waybill->value }}</strong></td>


                                                <td>{{ $waybill->origin }}</td>
                                                <td>{{ $waybill->destination }}</td>
                                                <td>{{ $waybill->export_city }}</td>
                                                <td>{{ $waybill->con_name }}</td>
                                                <td>{{ $waybill->con_company }}</td>


                                                <td>{{ $waybill->con_phone }}</td>
                                                <td>{{ $waybill->con_country }}</td>
                                                <td>{{ $waybill->con_state }}</td>
                                                <td>{{ $waybill->con_city }}</td>
                                                <td>{{ $waybill->con_address }}</td>


                                                <td>{{ $waybill->con_address_alternate }}</td>
                                                <td>{{ $waybill->con_postal }}</td>
                                                <td>{{ $waybill->shipper_name }}</td>
                                                <td>{{ $waybill->shipper_company }}</td>
                                                <td>{{ $waybill->shipper_phone }}</td>


                                                <td>{{ $waybill->shipper_country }}</td>
                                                <td>{{ $waybill->shipper_state }}</td>
                                                <td>{{ $waybill->shipper_city }}</td>
                                                <td>{{ $waybill->shipper_address }}</td>
                                                <td>{{ $waybill->shipper_address_alternate }}</td>


                                                <td>{{ $waybill->shipper_postal }}</td>
                                                <td>{{ $waybill->bill_to }}</td>
                                                <td>{{ $waybill->bill_duty }}</td>
                                                <td>{{ $waybill->total }}</td>
                                                <td>{{ $waybill->description }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div role="tabpanel" class="tab-pane" id="invoiced">

                                <br>

                                <div class="table-responsive">
                                    <table class="table table-striped nowrap">
                                        <thead>

                                        <tr>
                                            <th class="printable">Waybill #</th>
                                            <th class="printable">CRN #</th>
                                            <th class="printable">Shipped Date</th>
                                            <th class="text-right printable">Weight</th>
                                            <th class="text-right printable">Value</th>

                                            <th class="printable">Origin</th>
                                            <th class="printable">Destination</th>
                                            <th class="printable">Export City</th>
                                            <th class="printable">Con. Name</th>
                                            <th class="printable">Con. Company</th>

                                            <th class="printable">Con. Phone</th>
                                            <th class="printable">Con. Country</th>
                                            <th class="printable">Con. State</th>
                                            <th class="printable">Con. City</th>
                                            <th class="printable">Con. Address</th>

                                            <th class="printable">Con. Address 2</th>
                                            <th class="printable">Con. Postal</th>
                                            <th class="printable">Shipper Name</th>
                                            <th class="printable">Shipper Company</th>
                                            <th class="printable">Shipper Phone</th>

                                            <th class="printable">Shipper Country</th>
                                            <th class="printable">Shipper State</th>
                                            <th class="printable">Shipper City</th>
                                            <th class="printable">Shipper Address</th>
                                            <th class="printable">Shipper Address 2</th>

                                            <th class="printable">Shipper Postal</th>
                                            <th class="printable">Bill To</th>
                                            <th class="printable">Bill Duty</th>
                                            <th class="printable">Total</th>
                                            <th class="printable">Description</th>

                                        </tr>

                                        </thead>
                                        <tbody>
                                        @foreach($manifest->waybills->where('freight_billed', true) as $waybill)
                                            <tr>
                                                <td><strong><a href="{{ route('waybill.show', $waybill->id) }}">{{ $waybill->waybill_number }}</a></strong></td>
                                                <td><strong>{{ $waybill->crn_number }}</strong></td>
                                                <td><strong>{{ Carbon\Carbon::parse($waybill->shipped_date)->format('d F Y') }}</strong></td>
                                                <td class="text-right"><strong>{{ $waybill->weight }}</strong></td>
                                                <td class="text-right"><strong>{{ $waybill->currency }} {{ $waybill->value }}</strong></td>


                                                <td>{{ $waybill->origin }}</td>
                                                <td>{{ $waybill->destination }}</td>
                                                <td>{{ $waybill->export_city }}</td>
                                                <td>{{ $waybill->con_name }}</td>
                                                <td>{{ $waybill->con_company }}</td>


                                                <td>{{ $waybill->con_phone }}</td>
                                                <td>{{ $waybill->con_country }}</td>
                                                <td>{{ $waybill->con_state }}</td>
                                                <td>{{ $waybill->con_city }}</td>
                                                <td>{{ $waybill->con_address }}</td>


                                                <td>{{ $waybill->con_address_alternate }}</td>
                                                <td>{{ $waybill->con_postal }}</td>
                                                <td>{{ $waybill->shipper_name }}</td>
                                                <td>{{ $waybill->shipper_company }}</td>
                                                <td>{{ $waybill->shipper_phone }}</td>


                                                <td>{{ $waybill->shipper_country }}</td>
                                                <td>{{ $waybill->shipper_state }}</td>
                                                <td>{{ $waybill->shipper_city }}</td>
                                                <td>{{ $waybill->shipper_address }}</td>
                                                <td>{{ $waybill->shipper_address_alternate }}</td>


                                                <td>{{ $waybill->shipper_postal }}</td>
                                                <td>{{ $waybill->bill_to }}</td>
                                                <td>{{ $waybill->bill_duty }}</td>
                                                <td>{{ $waybill->total }}</td>
                                                <td>{{ $waybill->description }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="panel-footer">
                        <a href="{{ route('outbound.index') }}" class="btn btn-danger">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection