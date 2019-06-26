@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Manifest Details
                    </div>

                    <div class="panel-body">

                        <form action="{{ route('manifest.update', $manifest->id) }}" method="post" role="form">

                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="form-group{{ $errors->has('flight_number') ? ' has-error' : '' }}">
                                <label for="flight_number">Flight Number*</label>
                                <input type="text" class="form-control text-uppercase" name="flight_number" id="flight_number" value="{{ $manifest->flight_number or old('flight_number') }}" required>

                                @if($errors->has('flight_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('flight_number') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('flight_date') ? ' has-error' : '' }}">
                                <label for="flight_date">Flight Date*</label>
                                <input type="text" class="form-control datepicker" name="flight_date" id="flight_date" value="{{ $manifest->flight_date->format('Y-m-d') }}" required>

                                @if($errors->has('flight_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('flight_date') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('arrival_time') ? ' has-error' : '' }}">
                                <label for="arrival_time">Arrival Hour</label>
                                <select class="form-control" name="arrival_time" id="arrival_time">
                                    @for($i = 0; $i <= 23; $i++)
                                        <option value="{{ $i }}:00">{{ $i }}:00 HRS</option>
                                    @endfor
                                </select>

                                @if($errors->has('arrival_time'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('arrival_time') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('cbv_number') ? ' has-error' : '' }}">
                                <label for="cbv_number">CBV Number</label>
                                <input type="text" class="form-control" name="cbv_number" id="cbv_number" value="{{ $manifest->cbv_number or old('cbv_number') }}">

                                @if($errors->has('cbv_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cbv_number') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('cbv_rate') ? ' has-error' : '' }}">
                                <label for="cbv_rate">Rate per KG</label>
                                <input pattern="[0-9\.]+$" title="Rate per KG in decimal format" type="text" class="form-control" name="cbv_rate" id="cbv_rate" value="{{ $manifest->cbv_rate or old('cbv_rate') }}">

                                @if($errors->has('cbv_rate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cbv_rate') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('consignment_weight') ? ' has-error' : '' }}">
                                <label for="consignment_weight">Total Consignment Weight</label>
                                <input pattern="[0-9\.]+$" title="Total consignment weight in decimal format" type="text" class="form-control" name="consignment_weight" id="consignment_weight" value="{{ $manifest->consignment_weight or old('consignment_weight') }}">

                                @if($errors->has('consignment_weight'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('consignment_weight') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Save</button>
                                <a href="{{ route('outbound.index') }}" class="btn btn-danger">Back</a>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection