@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Inbound CBV Details
                    </div>

                    <div class="panel-body">

                        <form action="{{ route('inbound-cbv.store') }}" method="post" role="form" enctype="multipart/form-data">

                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('manifest_id') ? ' has-error' : '' }}">
                                <label for="manifest_id">Manifest*</label>
                                <select class="form-control" name="manifest_id" id="manifest_id" required>
                                    @foreach($manifests as $manifest)
                                        <option value="{{ $manifest->id }}">
                                            MAN-{{ str_pad($manifest->id, 5, '0', STR_PAD_LEFT) }} ({{ $manifest->flight_date }} {{ $manifest->flight_number }})
                                        </option>
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
                                <input class="form-control text-uppercase" name="flight_number" id="flight_number" value="{{ old('flight_number') }}" required>

                                @if($errors->has('flight_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('flight_number') }}</strong>
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

                            <div class="form-group{{ $errors->has('cbv_number') ? ' has-error' : '' }}">
                                <label for="cbv_number">CBV Number</label>
                                <input class="form-control" name="cbv_number" id="cbv_number" value="{{ old('cbv_number') }}">

                                @if($errors->has('cbv_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cbv_number') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('cbv_rate') ? ' has-error' : '' }}">
                                <label for="cbv_rate">Rate per KG</label>

                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input step="0.01" aria-label="Rate per KG in decimal format" title="Rate per KG in decimal format" type="number" class="form-control" name="cbv_rate" id="cbv_rate" value="{{ old('cbv_rate') }}">
                                    <span class="input-group-addon">Per KG</span>
                                </div>
                                @if($errors->has('cbv_rate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cbv_rate') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('consignment_weight') ? ' has-error' : '' }}">
                                <label for="consignment_weight">Total Consignment Weight</label>

                                <div class="input-group">
                                    <input step="0.01" aria-label="Total consignment weight in decimal format" title="Total consignment weight in decimal format" type="number" class="form-control" name="consignment_weight" id="consignment_weight" value="{{ old('consignment_weight') }}">
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