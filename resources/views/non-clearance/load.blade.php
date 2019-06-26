@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Load Shipment To Van
                    </div>

                    <div class="panel-body">
                        <form action="{{ route('non-load.store', $waybill->id) }}" method="post" role="form">
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="col-sm-6">
                                    <h4>Waybill Number</h4>
                                    <h5>{{ $waybill->waybill_number }}</h5>

                                    <h4>Shipped From</h4>
                                    <h5>{{ getCountry($waybill->export_city) }}</h5>

                                    <h4>Consignee Address</h4>
                                    <h5>{{ $waybill->con_address }}</h5>

                                </div>

                                <div class="col-sm-6">
                                    <h4>Consignee</h4>
                                    <h5>{{ $waybill->con_name }} {{ $waybill->con_phone }}</h5>

                                    <h4>Shipper</h4>
                                    <h5>{{ $waybill->shipper_name }} {{ $waybill->shipper_phone }}</h5>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                <label for="courier_id">Courier*</label>
                                <select class="form-control" name="courier_id" id="courier_id" required>
                                    @foreach($couriers as $courier)
                                        <option value="{{ $courier->id }}">{{ $courier->name }} (FedEx ID: {{ $courier->fedex_id }})</option>
                                    @endforeach
                                </select>

                                @if($errors->has('courier_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('courier_id') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Update</button>
                                <a href="{{ URL::previous() }}" class="btn btn-danger">Back</a>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection