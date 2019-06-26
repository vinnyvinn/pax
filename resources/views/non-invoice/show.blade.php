@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        MAN{{ $manifest->id }}
                    </div>

                    <div class="panel-body">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#details" aria-controls="details" role="tab" data-toggle="tab">Manifest Details</a></li>
                            <li role="presentation"><a href="#waybills" aria-controls="waybills" role="tab" data-toggle="tab">Waybills Awaiting Recovery</a></li>
                            <li role="presentation"><a href="#dutiable-waybills" aria-controls="dutiable-waybills" role="tab" data-toggle="tab">Waybills Undergoing Clearance</a></li>
                            <li role="presentation"><a href="#non-dutiable-waybills" aria-controls="non-dutiable-waybills" role="tab" data-toggle="tab">Non-Dutiable Waybills</a></li>
                            <li role="presentation"><a href="#released-waybills" aria-controls="waybills" role="tab" data-toggle="tab">Released Waybills</a></li>
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
                                        <h5>{{ $manifest->arrival_time }}</h5>

                                    </div>
                                    <div class="col-sm-6">
                                        <h4>CBV Number</h4>
                                        <h5>{{ $manifest->cbv_number }}</h5>

                                        <hr>

                                        <h4>CBV Rate</h4>
                                        <h5>{{ $manifest->cbv_rate }}</h5>

                                        <hr>

                                        <h4>Total Consignment Weight</h4>
                                        <h5>{{ $manifest->consignment_weight }}</h5>


                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="waybills">

                                <br>

                                <div class="table-responsive">
                                    <table class="table nowrap">
                                        <thead>
                                        <tr>
                                            <th>Waybill #</th>
                                            <th>CRN #</th>
                                            <th>Status</th>
                                            <th>Shipped Date</th>
                                            <th class="text-right">Weight</th>
                                            <th class="text-right">Value</th>


                                            <th>Origin</th>
                                            <th>Destination</th>
                                            <th>Export City</th>
                                            <th>Con. Name</th>
                                            <th>Con. Company</th>


                                            <th>Con. Phone</th>
                                            <th>Con. Country</th>
                                            <th>Con. State</th>
                                            <th>Con. City</th>
                                            <th>Con. Address</th>


                                            <th>Con. Address 2</th>
                                            <th>Con. Postal</th>
                                            <th>Shipper Name</th>
                                            <th>Shipper Company</th>
                                            <th>Shipper Phone</th>


                                            <th>Shipper Country</th>
                                            <th>Shipper State</th>
                                            <th>Shipper City</th>
                                            <th>Shipper Address</th>
                                            <th>Shipper Address 2</th>


                                            <th>Shipper Postal</th>
                                            <th>Bill To</th>
                                            <th>Bill Duty</th>
                                            <th>Total</th>
                                            <th>Description</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($manifest->waybills->where('status', 'Awaiting Recovery') as $waybill)
                                            <tr>
                                                <td><strong>{{ $waybill->waybill_number }}</strong></td>
                                                <td><strong>{{ $waybill->crn_number }}</strong></td>
                                                <td><strong>{{ $waybill->status }}</strong></td>
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

                            <div role="tabpanel" class="tab-pane" id="dutiable-waybills">

                                <br>

                                <div class="table-responsive">
                                    <table class="table nowrap">
                                        <thead>
                                        <tr>
                                            <th>Waybill #</th>
                                            <th>CRN #</th>
                                            <th>Status</th>
                                            <th>Shipped Date</th>
                                            <th class="text-right">Weight</th>
                                            <th class="text-right">Value</th>


                                            <th>Origin</th>
                                            <th>Destination</th>
                                            <th>Export City</th>
                                            <th>Con. Name</th>
                                            <th>Con. Company</th>


                                            <th>Con. Phone</th>
                                            <th>Con. Country</th>
                                            <th>Con. State</th>
                                            <th>Con. City</th>
                                            <th>Con. Address</th>


                                            <th>Con. Address 2</th>
                                            <th>Con. Postal</th>
                                            <th>Shipper Name</th>
                                            <th>Shipper Company</th>
                                            <th>Shipper Phone</th>


                                            <th>Shipper Country</th>
                                            <th>Shipper State</th>
                                            <th>Shipper City</th>
                                            <th>Shipper Address</th>
                                            <th>Shipper Address 2</th>


                                            <th>Shipper Postal</th>
                                            <th>Bill To</th>
                                            <th>Bill Duty</th>
                                            <th>Total</th>
                                            <th>Description</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($manifest->waybills->where('status', 'Undergoing Clearance') as $waybill)
                                            <tr>
                                                <td><strong>{{ $waybill->waybill_number }}</strong></td>
                                                <td><strong>{{ $waybill->crn_number }}</strong></td>
                                                <td><strong>{{ $waybill->status }}</strong></td>
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

                            <div role="tabpanel" class="tab-pane" id="non-dutiable-waybills">

                                <br>

                                <div class="table-responsive">
                                    <table class="table nowrap">
                                        <thead>
                                        <tr>
                                            <th>Waybill #</th>
                                            <th>CRN #</th>
                                            <th>Status</th>
                                            <th>Shipped Date</th>
                                            <th class="text-right">Weight</th>
                                            <th class="text-right">Value</th>


                                            <th>Origin</th>
                                            <th>Destination</th>
                                            <th>Export City</th>
                                            <th>Con. Name</th>
                                            <th>Con. Company</th>


                                            <th>Con. Phone</th>
                                            <th>Con. Country</th>
                                            <th>Con. State</th>
                                            <th>Con. City</th>
                                            <th>Con. Address</th>


                                            <th>Con. Address 2</th>
                                            <th>Con. Postal</th>
                                            <th>Shipper Name</th>
                                            <th>Shipper Company</th>
                                            <th>Shipper Phone</th>


                                            <th>Shipper Country</th>
                                            <th>Shipper State</th>
                                            <th>Shipper City</th>
                                            <th>Shipper Address</th>
                                            <th>Shipper Address 2</th>


                                            <th>Shipper Postal</th>
                                            <th>Bill To</th>
                                            <th>Bill Duty</th>
                                            <th>Total</th>
                                            <th>Description</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($manifest->waybills->where('status', 'Non-Dutiable') as $waybill)
                                            <tr>
                                                <td><strong>{{ $waybill->waybill_number }}</strong></td>
                                                <td><strong>{{ $waybill->crn_number }}</strong></td>
                                                <td><strong>{{ $waybill->status }}</strong></td>
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

                            <div role="tabpanel" class="tab-pane" id="released-waybills">

                                <br>

                                <div class="table-responsive">
                                    <table class="table nowrap">
                                        <thead>
                                        <tr>
                                            <th>Waybill #</th>
                                            <th>CRN #</th>
                                            <th>Status</th>
                                            <th>Shipped Date</th>
                                            <th class="text-right">Weight</th>
                                            <th class="text-right">Value</th>


                                            <th>Origin</th>
                                            <th>Destination</th>
                                            <th>Export City</th>
                                            <th>Con. Name</th>
                                            <th>Con. Company</th>


                                            <th>Con. Phone</th>
                                            <th>Con. Country</th>
                                            <th>Con. State</th>
                                            <th>Con. City</th>
                                            <th>Con. Address</th>


                                            <th>Con. Address 2</th>
                                            <th>Con. Postal</th>
                                            <th>Shipper Name</th>
                                            <th>Shipper Company</th>
                                            <th>Shipper Phone</th>


                                            <th>Shipper Country</th>
                                            <th>Shipper State</th>
                                            <th>Shipper City</th>
                                            <th>Shipper Address</th>
                                            <th>Shipper Address 2</th>


                                            <th>Shipper Postal</th>
                                            <th>Bill To</th>
                                            <th>Bill Duty</th>
                                            <th>Total</th>
                                            <th>Description</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($manifest->waybills->where('status', 'Released') as $waybill)
                                            <tr>
                                                <td><strong>{{ $waybill->waybill_number }}</strong></td>
                                                <td><strong>{{ $waybill->crn_number }}</strong></td>
                                                <td><strong>{{ $waybill->status }}</strong></td>
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
                        <a href="{{ route('manifest.index') }}" class="btn btn-danger">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection