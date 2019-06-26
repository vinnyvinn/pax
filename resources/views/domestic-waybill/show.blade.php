@extends('layouts.app')
@section('content')
    <div class="col-sm-8 col-sm-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                View Waybill
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h3>From</h3>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="shipper_name">Shipper's Name</label>
                            <div>{{ $domestic->shipper_name }}</div>
                        </div>
                        <div class="form-group">
                            <label for="shipper_phone">Phone</label>
                            <div>{{ $domestic->shipper_phone}}</div>
                        </div>
                        <div class="form-group">
                            <label for="shipper_company">Company</label>
                            <div>{{ $domestic->shipper_company }}</div>
                        </div>
                        <div class="form-group">
                            <label for="shipper_country">Country</label>
                            <div>{{ $domestic->shipper_country }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="shipper_address">Address</label>
                            <div>{{ $domestic->shipper_address }}</div>
                        </div>
                        <div class="form-group">
                            <label for="shipper_address_alternate">Alternative Address</label>
                            <div>{{ $domestic->shipper_address_alternate }}</div>
                        </div>
                        <div class="form-group">
                            <label for="shipper_city">City</label>
                            <div>{{ $domestic->shipper_city }}</div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-sm-12">
                        <h3>To</h3>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="con_name">Consignee's Name</label>
                            <div>{{ $domestic->con_name }}</div>
                        </div>
                        <div class="form-group">
                            <label for="con_phone">Phone</label>
                            <div>{{ $domestic->con_phone}}</div>
                        </div>
                        <div class="form-group">
                            <label for="con_company">Company</label>
                            <div>{{ $domestic->con_company }}</div>
                        </div>
                        <div class="form-group">
                            <label for="con_country">Country</label>
                            <div>{{ $domestic->con_country }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="con_address">Address</label>
                            <div>{{ $domestic->con_address }}</div>
                        </div>
                        <div class="form-group">
                            <label for="con_address_alternate">Alternative Address</label>
                            <div>{{ $domestic->con_address_alternate }}</div>
                        </div>
                        <div class="form-group">
                            <label for="con_city">City</label>
                            <div>{{ $domestic->con_city }}</div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-sm-12">
                        <h3>Shipment Information</h3>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="total_package">Total Packages</label>
                            <div>{{ $domestic->total_package }}</div>
                        </div>
                        <div class="form-group">
                            <label for="shipment_description">Description</label>
                            <div>{{ $domestic->shipment_description }}</div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="weight">Total Weight(kgs)</label>
                            <div>{{ $domestic->weight }}</div>
                        </div>
                        <div class="form-group">
                            <label for="shipment_value">Value</label>
                            <div>{{ $domestic->shipment_value }}</div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <h3>Packaging</h3>
                        <div class="form-group">
                            <label for="packaging">Packaging</label>
                            <div>{{ $domestic->packaging }}</div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <a href="{{ route('domestic.edit', $domestic->id) }}" class="btn btn-success">Edit</a>
                            <a href="{{ route('domestic.index') }}" class="btn btn-danger">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection