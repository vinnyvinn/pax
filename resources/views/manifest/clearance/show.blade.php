@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li><a href="{{ route('inbound-dashboard') }}">Inbound dashboard</a></li>
                  <li><a href="{{ route('manifest.index', ['page' => 'clearance']) }}">Manifests</a></li>
                  <li class="active">Manifest details</li>
                </ol>
                <hr>
            </div>
            <div class="col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        MAN-{{ str_pad($manifest->id, 5, '0', STR_PAD_LEFT) }}

                        <a href="{{ url('/overage/' . $manifest->id) }}" class="btn btn-danger btn-sm pull-right">Add Waybill</a>
                    </div>

                    <div class="panel-body">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#details" aria-controls="details" role="tab" data-toggle="tab"><h4>Manifest Details</h4></a></li>
                            @if (\Auth::user()->can('view-nfbrk-report'))
                            <li role="presentation"><a href="#nfbrk" aria-controls="nfbrk" role="tab" data-toggle="tab"><h4>NFBRK</h4></a></li>
                            @endif
                            @if (\Auth::user()->can('view-oda-report'))
                            <li role="presentation"><a href="#oda_report" aria-controls="oda_report" role="tab" data-toggle="tab"><h4>ODA Report</h4></a></li>
                            @endif
                            <li role="presentation"><a href="#bill_f_s" aria-controls="bill_f_s" role="tab" data-toggle="tab"><h4>Freight BS</h4></a></li>
                            <li role="presentation"><a href="#bill_f_c" aria-controls="bill_f_c" role="tab" data-toggle="tab"><h4>Freight BC</h4></a></li>
                            <li role="presentation"><a href="#bill_f_o" aria-controls="bill_f_o" role="tab" data-toggle="tab"><h4>Freight BO</h4></a></li>
                            <li role="presentation"><a href="#waybills" aria-controls="waybills" role="tab" data-toggle="tab"><h4>Shortages</h4></a></li>
                            <li role="presentation"><a href="#overages" aria-controls="overages" role="tab" data-toggle="tab"><h4>Overages</h4></a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="details">
                                <br>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h5>City</h5>
                                        <h5>{{ $manifest->city->name }}</h5>

                                        <hr>
                                        <h5>Flight Number</h5>
                                        <h5>{{ $manifest->flight_number }}</h5>

                                    </div>
                                    <div class="col-sm-6">

                                        <h5>Flight Date</h5>
                                        <h5>{{ Carbon\Carbon::parse($manifest->flight_date)->format('l dS F Y') }}</h5>

                                        <hr>

                                        <h5>Flight Arrival Time</h5>
                                        <h5>{{ Carbon\Carbon::parse($manifest->arrival_time)->toTimeString() }}</h5>

                                    </div>
                                </div>
                                <hr>
                                <h4>CBV Details</h4>
                                @if('create-inbound-shipments')
                                <br>
                                <form action="{{ route('inbound-cbv.store') }}" method="post" role="form" enctype="multipart/form-data">
                                    <h5><strong>Add New CBV</strong></h5>
                                    {{ csrf_field() }}
                                    <input type="hidden" name="manifest_id" value="{{ $manifest->id }}">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group{{ $errors->has('cbv_number') ? ' has-error' : '' }}">
                                                <label for="cbv_number">CBV Number*</label>
                                                <input required class="form-control" name="cbv_number" id="cbv_number" value="{{ old('cbv_number') }}">

                                                @if($errors->has('cbv_number'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('cbv_number') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group{{ $errors->has('cbv_date') ? ' has-error' : '' }}">
                                                <label for="cbv_date">CBV Date*</label>
                                                <input class="form-control datepicker" name="cbv_date" id="cbv_date" value="{{ old('cbv_date') }}" required>

                                                @if($errors->has('cbv_date'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('cbv_date') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group{{ $errors->has('handlers') ? ' has-error' : '' }}">
                                                <label for="handlers">Handlers</label>
                                                <input class="form-control" name="handlers" id="handlers" value="{{ old('handlers') }}" required>

                                                @if($errors->has('handlers'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('handlers') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group{{ $errors->has('cbv_rate') ? ' has-error' : '' }}">
                                                <label for="cbv_rate">Rate per KG*</label>

                                                <div class="input-group">
                                                    <span class="input-group-addon">$</span>
                                                    <input required step="0.01" aria-label="Rate per KG in decimal format" title="Rate per KG in decimal format" type="number" class="form-control" name="cbv_rate" id="cbv_rate" value="{{ old('cbv_rate') }}">
                                                    <span class="input-group-addon">Per KG</span>
                                                </div>
                                                @if($errors->has('cbv_rate'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('cbv_rate') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group{{ $errors->has('consignment_weight') ? ' has-error' : '' }}">
                                                <label for="consignment_weight">Total Consignment Weight*</label>

                                                <div class="input-group">
                                                    <input required step="0.01" aria-label="Total consignment weight in decimal format" title="Total consignment weight in decimal format" type="number" class="form-control" name="consignment_weight" id="consignment_weight" value="{{ old('consignment_weight') }}">
                                                    <span class="input-group-addon">KGs</span>
                                                </div>
                                                @if($errors->has('consignment_weight'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('consignment_weight') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group{{ $errors->has('invoices') ? ' has-error' : '' }}">
                                                <label for="invoices">Scanned Invoice*</label>

                                                <input required type="file" class="form-control" name="invoices" id="invoices">
                                                @if($errors->has('invoices'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('invoices') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <br>
                                                <input type="submit" class="btn btn-success pull-right" value="Save CBV Details">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                @endif
                                <hr>
                                <table class="table dataTable table-striped">
                                    <thead>
                                    <tr>
                                        <th class="printable">#</th>
                                        <th class="printable">Date</th>
                                        <th class="printable">Rate</th>
                                        <th class="printable">Con Weight</th>
                                        <th class="printable">Handlers</th>
                                        <th width="100px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cbvs as $cbv)
                                        <tr>
                                            @if(Auth::user()->can('view-inbound-shipments'))
                                                <td><a href="{{ route('inbound-cbv.show', $cbv->id) }}">{{ $cbv->cbv_number }}</a></td>
                                            @else
                                                <td>{{ $cbv->cbv_number }}</td>
                                            @endif
                                            <td>{{ $cbv->cbv_date }}</td>
                                            <td>${{ $cbv->cbv_rate }}/KG</td>
                                            <td>{{ $cbv->consignment_weight }} KGs</td>
                                            <td>{{ $cbv->handlers }}</td>
                                            <td>
                                                @if($cbv->invoices)
                                                <a href="{{ url($cbv->invoices) }}" class="btn btn-xs btn-warning" target="_blank">INVOICE</a>
                                                @endif
                                                @can('edit-inbound-shipments')
                                                    <a href="{{route('inbound-cbv.edit', $cbv->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                                @endcan
                                                @can('delete-inbound-shipments')
                                                    <button type="button" class="btn btn-danger btn-xs btn-destroy" data-token="{{ csrf_token() }}" data-url="{{ route('inbound-cbv.destroy', $cbv->id) }}"><i class="fa fa-trash"></i></button>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th class="printable">#</th>
                                        <th class="printable">Manifest</th>
                                        <th class="printable">Rate</th>
                                        <th class="printable">Con Weight</th>
                                        <th class="printable">Handlers</th>
                                        <th width="100px">Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            
                            @if (\Auth::user()->can('view-nfbrk-report'))
                            <div role="tabpanel" class="tab-pane" id="nfbrk">

                                <br>

                                <div class="table-responsive">
                                    <table class="table table-striped nowrap">
                                        <thead>

                                        <tr>
                                            <th class="printable">Waybill #</th>
                                            <th class="printable">Agent Name</th>
                                            <th class="printable">CRN #</th>
                                            <th class="printable">Status</th>
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
                                        @foreach($manifest->waybills->where('clearing_agent', '!=', \PAX\Models\Waybill::CA_PAX) as $waybill)
                                            <tr>
                                                @if(Auth::user()->can('view-inbound-waybills'))
                                                    <td><strong><a href="{{ route('waybill.show', $waybill->id) }}">{{ $waybill->waybill_number }}</a></strong></td>
                                                @else
                                                    <td>{{ $waybill->waybill_number }}</td>
                                                @endif
                                                <td>{{ $waybill->clearing_agent_name  ? $waybill->clearing_agent_name : '-' }}</td>
                                                <td><strong>{{ $waybill->crn_number }}</strong></td>
                                                <td><strong>{{ $waybill->status }}</strong></td>
                                                <td><strong>{{ Carbon\Carbon::parse($waybill->shipped_date)->format('d F Y') }}</strong></td>
                                                <td class="text-right"><strong>{{ $waybill->weight }}</strong></td>
                                                <td class="text-right"><strong>{{ $waybill->currency }} {{ number_format($waybill->value, 4) }}</strong></td>


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
                            @endif

                            @if (\Auth::user()->can('view-oda-report'))
                            <div role="tabpanel" class="tab-pane" id="oda_report">

                                <br>

                                <div class="table-responsive">
                                    <table class="table table-striped nowrap">
                                        <thead>

                                        <tr>
                                            <th class="printable">Waybill #</th>
                                            <th class="printable">CRN #</th>
                                            <th class="printable">Status</th>
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
                                        @foreach($manifest->waybills->where('oda', 1) as $waybill)
                                            <tr>
                                                @if(Auth::user()->can('view-inbound-waybills'))
                                                    <td><strong><a href="{{ route('waybill.show', $waybill->id) }}">{{ $waybill->waybill_number }}</a></strong></td>
                                                @else
                                                    <td>{{ $waybill->waybill_number }}</td>
                                                @endif
                                                <td><strong>{{ $waybill->crn_number }}</strong></td>
                                                <td><strong>{{ $waybill->status }}</strong></td>
                                                <td><strong>{{ Carbon\Carbon::parse($waybill->shipped_date)->format('d F Y') }}</strong></td>
                                                <td class="text-right"><strong>{{ $waybill->weight }}</strong></td>
                                                <td class="text-right"><strong>{{ $waybill->currency }} {{ number_format($waybill->value, 4) }}</strong></td>


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
                            @endif

                            <div role="tabpanel" class="tab-pane" id="bill_f_s">

                                <br>

                                <div class="table-responsive">
                                    <table class="table table-striped nowrap">
                                        <thead>

                                        <tr>
                                            <th class="printable">Waybill #</th>
                                            <th class="printable">CRN #</th>
                                            <th class="printable">Status</th>
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
                                        @foreach($manifest->waybills->where('bill_to', 'S')->where('status', 'Undergoing Clearance') as $waybill)
                                            <tr>
                                                @if(Auth::user()->can('view-inbound-waybills'))
                                                <td><strong><a href="{{ route('waybill.show', $waybill->id) }}">{{ $waybill->waybill_number }}</a></strong></td>
                                                @else
                                                <td>{{ $waybill->waybill_number }}</td>
                                                @endif
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

                            <div role="tabpanel" class="tab-pane" id="bill_f_c">

                                <br>

                                <div class="table-responsive">
                                    <table class="table table-striped nowrap">
                                        <thead>

                                        <tr>
                                            <th class="printable">Waybill #</th>
                                            <th class="printable">CRN #</th>
                                            <th class="printable">Status</th>
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
                                        @foreach($manifest->waybills->where('bill_to', 'C')->where('status', 'Undergoing Clearance') as $waybill)
                                            <tr>
                                                @if(Auth::user()->can('view-inbound-waybills'))
                                                    <td><strong><a href="{{ route('waybill.show', $waybill->id) }}">{{ $waybill->waybill_number }}</a></strong></td>
                                                @else
                                                    <td>{{ $waybill->waybill_number }}</td>
                                                @endif
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

                            <div role="tabpanel" class="tab-pane" id="bill_f_o">

                                <br>

                                <div class="table-responsive">
                                    <table class="table table-striped nowrap">
                                        <thead>

                                        <tr>
                                            <th class="printable">Waybill #</th>
                                            <th class="printable">CRN #</th>
                                            <th class="printable">Status</th>
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
                                        @foreach($manifest->waybills->where('bill_to', 'O')->where('status', 'Undergoing Clearance') as $waybill)
                                            <tr>
                                                @if(Auth::user()->can('view-inbound-waybills'))
                                                    <td><strong><a href="{{ route('waybill.show', $waybill->id) }}">{{ $waybill->waybill_number }}</a></strong></td>
                                                @else
                                                    <td>{{ $waybill->waybill_number }}</td>
                                                @endif
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
                            <div role="tabpanel" class="tab-pane" id="waybills">

                                <br>

                                <div class="table-responsive">
                                    <table class="table table-striped nowrap">
                                        <thead>

                                        <tr>
                                            <th class="printable">Waybill #</th>
                                            <th class="printable">CRN #</th>
                                            <th class="printable">Status</th>
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
                                        @foreach($manifest->waybills->where('status', 'Awaiting Recovery') as $waybill)
                                            <tr>
                                                @if(Auth::user()->can('view-inbound-waybills'))
                                                    <td><strong><a href="{{ route('waybill.show', $waybill->id) }}">{{ $waybill->waybill_number }}</a></strong></td>
                                                @else
                                                    <td>{{ $waybill->waybill_number }}</td>
                                                @endif
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

                            <div role="tabpanel" class="tab-pane" id="overages">

                                <br>

                                <div class="table-responsive">
                                    <table class="table table-striped nowrap">
                                        <thead>

                                        <tr>
                                            <th class="printable">Waybill #</th>
                                            <th class="printable">CRN #</th>
                                            <th class="printable">Status</th>
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
                                        @foreach($manifest->waybills->where('overage', 1) as $waybill)
                                            <tr>
                                                @if(Auth::user()->can('view-inbound-waybills'))
                                                    <td><strong><a href="{{ route('waybill.show', $waybill->id) }}">{{ $waybill->waybill_number }}</a></strong></td>
                                                @else
                                                    <td>{{ $waybill->waybill_number }}</td>
                                                @endif
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
                        <a href="{{ route('manifest.index', ['page' => 'clearance']) }}" class="btn btn-danger">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection