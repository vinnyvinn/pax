@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
              <li><a href="/">Home</a></li>
              <li><a href="{{ route('setting-dashboard') }}">Setting Dashboard</a></li>
              <li><a href="{{ route('cbv.index') }}">CBVs</a></li>
              <li class="active">Add CBVs</li>
            </ol>
            <hr>
        </div>
    </div>
    <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <form action="{{ route('cbv.store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('number') ? ' has-error' : '' }}">
                        <label for="number">CBV Number</label>
                        <input type="text" name="number" id="number" class="form-control" value="{{ old('number') }}" required>
                        @if($errors->has('number'))
                            <span class="help-block">{{ $errors->first('number') }}</span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('rate') ? ' has-error' : '' }}">
                        <label for="rate">Rate</label>
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input pattern="[0-9\.]+$" title="Decimals" type="text" name="rate" id="rate" class="form-control" value="{{ old('rate') }}" required>
                            <span class="input-group-addon">Per KG</span>
                        </div>

                        @if($errors->has('rate'))
                            <span class="help-block">{{ $errors->first('rate') }}</span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('handling_rate') ? ' has-error' : '' }}">
                        <label for="handling_rate">Handling Rate</label>
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input pattern="[0-9\.]+$" title="Decimals" type="text" name="handling_rate" id="handling_rate" class="form-control" value="{{ old('handling_rate') }}" required>
                            <span class="input-group-addon">Per KG</span>
                        </div>

                        @if($errors->has('handling_rate'))
                            <span class="help-block">{{ $errors->first('handling_rate') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('date_issued') ? ' has-error' : '' }}">
                        <label for="date_issued">Date Issued</label>
                        <input type="text" name="date_issued" id="date_issued" value="{{ old('date_issued') }}" class="form-control datepicker" required>
                        @if($errors->has('date_issued'))
                            <span class="help-block">{{ $errors->first('date_issued') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="{{ route('cbv.index') }}" class="btn btn-danger">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection