@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{ route('non-invoice.store') }}" method="post" role="form">
                    {{ csrf_field() }}

                    <input type="hidden" name="quote_id" value="{{ $waybill->id }}">

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Waybill {{ $waybill->waybill_number }} Details
                        </div>

                        <div class="panel-body">

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#waybills" aria-controls="waybills" role="tab" data-toggle="tab">Waybill Details</a></li>
                                <li role="presentation"><a href="#dutiable-waybills" aria-controls="dutiable-waybills" role="tab" data-toggle="tab">Consignee Details</a></li>
                                <li role="presentation"><a href="#non-dutiable-waybills" aria-controls="non-dutiable-waybills" role="tab" data-toggle="tab">Shipper Details</a></li>
                                <li role="presentation"><a href="#billing" aria-controls="billing" role="tab" data-toggle="tab">Billing Details</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="waybills">
                                    <br>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="waybill_number"><strong>Waybill Number</strong></label>
                                            <input type="number" class="form-control" id="waybill_number" name="waybill_number" value="{{ $waybill->waybill_number }}">

                                            <label for="crn_number"><strong>CRN Number</strong></label>
                                            <input type="number" class="form-control" name="crn_number" id="crn_number" value="{{ $waybill->crn_number }}">

                                            <label for="shipped_date"><strong>Shipping Date</strong></label>
                                            <input type="text" class="form-control datepicker" id="shipped_date" name="shipped_date" value="{{  Carbon\Carbon::parse($waybill->shipped_date)->format('Y-m-d') }}">

                                            <label for="weight"><strong>Weight</strong></label>
                                            <input type="text" class="form-control" id="weight" name="weight" value="{{ $waybill->weight }}" required>

                                        </div>

                                        <div class="col-sm-4">

                                            <label for="origin"><strong>Origin</strong></label>
                                            <input type="text" class="form-control" id="origin" name="origin" value="{{ $waybill->origin }}" required>


                                            <label for="destination"><strong>Destination</strong></label>
                                            <input type="text" class="form-control" id="destination" name="destination" value="{{ $waybill->destination }}" required>

                                            <label for="export_city"><strong>Export City</strong></label>
                                            <input type="text" class="form-control" id="export_city" name="export_city" value="{{ $waybill->export_city }}" required>

                                            <label for="value"><strong>Value</strong></label>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <select name="currency" id="currency" class="form-control">
                                                        @foreach(currencies() as $value)
                                                            <option value="{{ $value }}"{{ $waybill->currency == $value ? ' selected' : '' }}>{{ $value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="number" step="0.01" min="0" class="form-control" id="value" name="value" value="{{ $waybill->value }}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">

                                            <label for="bill_to"><strong>Bill To</strong></label>
                                            <select name="bill_to" id="bill_to" class="form-control">
                                                <option value="O"{{ $waybill->bill_to == 'O' ? ' selected' : '' }}>O</option>
                                                <option value="S"{{ $waybill->bill_to == 'S' ? ' selected' : '' }}>S</option>
                                                <option value="C"{{ $waybill->bill_to == 'C' ? ' selected' : '' }}>C</option>
                                            </select>

                                            <label for="bill_duty"><strong>Bill Duty</strong></label>
                                            <select name="bill_duty" id="bill_duty" class="form-control">
                                                <option value="O"{{ $waybill->bill_duty == 'O' ? ' selected' : '' }}>O</option>
                                                <option value="S"{{ $waybill->bill_duty == 'S' ? ' selected' : '' }}>S</option>
                                                <option value="C"{{ $waybill->bill_duty == 'C' ? ' selected' : '' }}>C</option>
                                            </select>

                                            <label for="total"><strong>Total</strong></label>
                                            <input type="number" class="form-control" id="total" name="total" value="{{ $waybill->total }}" required>

                                            <label for="description"><strong>Description</strong></label>
                                            <textarea class="form-control" id="description" name="description" required>{{ $waybill->description }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane" id="dutiable-waybills">

                                    <br>
                                    <div class="row">
                                        <div class="col-sm-4">

                                            <label for="con_name"><strong>Name</strong></label>
                                            <input type="text" class="form-control" id="con_name" name="con_name" value="{{ $waybill->con_name }}" required>

                                            <label for="con_company"><strong>Company</strong></label>
                                            <input type="text" class="form-control" id="con_company" name="con_company" value="{{ $waybill->con_company }}" required>

                                            <label for="con_phone"><strong>Phone</strong></label>
                                            <input type="text" class="form-control" id="con_phone" name="con_phone" value="{{ $waybill->con_phone }}" required>
                                        </div>

                                        <div class="col-sm-4">

                                            <label for="con_address"><strong>Address</strong></label>
                                            <input type="text" class="form-control" id="con_address" name="con_address" value="{{ $waybill->con_address }}" required>

                                            <label for="con_address_alternate"><strong>Alternate Address</strong></label>
                                            <input type="text" class="form-control" id="con_address_alternate" name="con_address_alternate" value="{{ $waybill->con_address_alternate }}">

                                            <label for="con_city"><strong>City</strong></label>
                                            <input type="text" class="form-control" id="con_city" name="con_city" value="{{ $waybill->con_city }}" required>

                                        </div>
                                        <div class="col-sm-4">

                                            <label for="con_state"><strong>State</strong></label>
                                            <input type="text" class="form-control" id="con_state" name="con_state" value="{{ $waybill->con_state }}">

                                            <label for="con_country"><strong>Country</strong></label>
                                            <input type="text" class="form-control" id="con_country" name="con_country" value="{{ $waybill->con_country }}">

                                            <label for="con_postal"><strong>Postal</strong></label>
                                            <input type="text" class="form-control" id="con_postal" name="con_postal" value="{{ $waybill->con_postal }}">

                                        </div>
                                    </div>
                                    
                                </div>

                                <div role="tabpanel" class="tab-pane" id="non-dutiable-waybills">

                                    <br>

                                    <div class="row">
                                        <div class="col-sm-4">

                                            <label for="shipper_name"><strong>Name</strong></label>
                                            <input type="text" class="form-control" id="shipper_name" name="shipper_name" value="{{ $waybill->shipper_name }}" required>

                                            <label for="shipper_company"><strong>Company</strong></label>
                                            <input type="text" class="form-control" id="shipper_company" name="shipper_company" value="{{ $waybill->shipper_company }}" required>

                                            <label for="shipper_phone"><strong>Phone</strong></label>
                                            <input type="text" class="form-control" id="shipper_phone" name="shipper_phone" value="{{ $waybill->shipper_phone }}" required>
                                        </div>

                                        <div class="col-sm-4">

                                            <label for="shipper_address"><strong>Address</strong></label>
                                            <input type="text" class="form-control" id="shipper_address" name="shipper_address" value="{{ $waybill->shipper_address }}" required>

                                            <label for="shipper_address_alternate"><strong>Alternate Address</strong></label>
                                            <input type="text" class="form-control" id="shipper_address_alternate" name="shipper_address_alternate" value="{{ $waybill->shipper_address_alternate }}">

                                            <label for="shipper_city"><strong>City</strong></label>
                                            <input type="text" class="form-control" id="shipper_city" name="shipper_city" value="{{ $waybill->shipper_city }}" required>

                                        </div>

                                        <div class="col-sm-4">

                                            <label for="shipper_state"><strong>State</strong></label>
                                            <input type="text" class="form-control" id="shipper_state" name="shipper_state" value="{{ $waybill->shipper_state }}">

                                            <label for="shipper_country"><strong>Country</strong></label>
                                            <input type="text" class="form-control" id="shipper_country" name="shipper_country" value="{{ $waybill->shipper_country }}">

                                            <label for="shipper_postal"><strong>Postal</strong></label>
                                            <input type="text" class="form-control" id="shipper_postal" name="shipper_postal" value="{{ $waybill->shipper_postal }}">

                                        </div>

                                        <div class="col-sm-12">
                                            <br>
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-success pull-right" value="Save Changes">
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div role="tabpanel" class="tab-pane" id="billing">
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-4">

                                            <label for="city_id"><strong>Billing City</strong></label>
                                            <select class="form-control" id="city_id" name="city_id" required>
                                            @foreach($cities as $city)
                                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                            @endforeach
                                            </select>

                                            <label for="shipper_company"><strong>Company</strong></label>
                                            <input type="text" class="form-control" id="shipper_company" name="shipper_company" value="{{ $waybill->shipper_company }}" required>

                                            <label for="shipper_phone"><strong>Phone</strong></label>
                                            <input type="text" class="form-control" id="shipper_phone" name="shipper_phone" value="{{ $waybill->shipper_phone }}" required>
                                        </div>

                                        <div class="col-sm-4">

                                            <label for="shipper_address"><strong>Address</strong></label>
                                            <input type="text" class="form-control" id="shipper_address" name="shipper_address" value="{{ $waybill->shipper_address }}" required>

                                            <label for="shipper_address_alternate"><strong>Alternate Address</strong></label>
                                            <input type="text" class="form-control" id="shipper_address_alternate" name="shipper_address_alternate" value="{{ $waybill->shipper_address_alternate }}">

                                            <label for="shipper_city"><strong>City</strong></label>
                                            <input type="text" class="form-control" id="shipper_city" name="shipper_city" value="{{ $waybill->shipper_city }}" required>

                                        </div>

                                        <div class="col-sm-4">

                                            <label for="shipper_state"><strong>State</strong></label>
                                            <input type="text" class="form-control" id="shipper_state" name="shipper_state" value="{{ $waybill->shipper_state }}">

                                            <label for="shipper_country"><strong>Country</strong></label>
                                            <input type="text" class="form-control" id="shipper_country" name="shipper_country" value="{{ $waybill->shipper_country }}">

                                            <label for="shipper_postal"><strong>Postal</strong></label>
                                            <input type="text" class="form-control" id="shipper_postal" name="shipper_postal" value="{{ $waybill->shipper_postal }}">

                                        </div>

                                        <div class="col-sm-12">
                                            <br>
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-success pull-right" value="Save Changes">
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection