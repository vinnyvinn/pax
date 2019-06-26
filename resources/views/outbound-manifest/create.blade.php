@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Import Manifest
                    </div>

                    <div class="panel-body">

                        <form action="{{ route('outbound.store') }}" method="post" role="form" enctype="multipart/form-data">

                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('city_id') ? ' has-error' : '' }}">
                                <label for="city_id">City*</label>
                                <select class="form-control" name="city_id" id="city_id" required>
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>

                                @if($errors->has('city_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city_id') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('flight_number') ? ' has-error' : '' }}">
                                <label for="flight_number">Flight Number*</label>
                                <input type="text" class="form-control text-uppercase" name="flight_number" id="flight_number" value="{{ old('flight_number') }}" required>

                                @if($errors->has('flight_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('flight_number') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('flight_date') ? ' has-error' : '' }}">
                                <label for="flight_date">Flight Date*</label>
                                <input type="text" class="form-control datepicker" name="flight_date" id="flight_date" value="{{ old('flight_date') }}" required>

                                @if($errors->has('flight_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('flight_date') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('arrival_time') ? ' has-error' : '' }}">
                                <label for="arrival_time">Departure Hour</label>
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

                            <div class="form-group{{ $errors->has('cvb_id') ? ' has-error' : '' }}">
                                <label for="cbv_id">CBV</label>
                                <select required class="form-control" name="cbv_id" id="cbv_id">
                                    @foreach($cbvs as $cbv)
                                        <option value="{{ $cbv->id }}">{{ $cbv->number }} @ ${{ $cbv->rate }}/KG</option>
                                    @endforeach
                                </select>

                                @if($errors->has('arrival_time'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('arrival_time') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="form-group{{ $errors->has('consignment_weight') ? ' has-error' : '' }}">
                                <label for="consignment_weight">Total Consignment Weight</label>

                                <div class="input-group">
                                    <input pattern="[0-9\.]+$" aria-label="Total consignment weight in decimal format" title="Total consignment weight in decimal format" type="text" class="form-control" name="consignment_weight" id="consignment_weight" value="{{ old('consignment_weight') }}">
                                    <span class="input-group-addon">KGs</span>
                                </div>
                                @if($errors->has('consignment_weight'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('consignment_weight') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('uploaded_file') ? ' has-error' : '' }}">
                                <label for="uploaded_file">Manifest File*</label>
                                <input type="file" class="form-control" name="uploaded_file" id="uploaded_file" required>

                                @if($errors->has('uploaded_file'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('uploaded_file') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Import</button>
                                <a href="{{ route('manifest.index') }}" class="btn btn-danger">Back</a>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection