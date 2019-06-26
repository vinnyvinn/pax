@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        CBV Details
                    </div>

                    <div class="panel-body">

                        <form action="{{ route('inbound-cbv.update', $cbv->id) }}" method="post" role="form" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <input type="hidden" name="ref" value="{{ URL::previous() }}">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('cbv_number') ? ' has-error' : '' }}">
                                        <label for="cbv_number">CBV Number*</label>
                                        <input required class="form-control" name="cbv_number" id="cbv_number" value="{{ $cbv->cbv_number or old('cbv_number') }}">

                                        @if($errors->has('cbv_number'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('cbv_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('cbv_date') ? ' has-error' : '' }}">
                                        <label for="cbv_date">CBV Date*</label>
                                        <input class="form-control datepicker" name="cbv_date" id="cbv_date" value="{{ $cbv->cbv_date or old('cbv_date') }}" required>

                                        @if($errors->has('cbv_date'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('cbv_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('handlers') ? ' has-error' : '' }}">
                                        <label for="handlers">Handlers</label>
                                        <input class="form-control" name="handlers" id="handlers" value="{{ $cbv->handlers or old('handlers') }}" required>

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
                                            <input required step="0.01" aria-label="Rate per KG in decimal format" title="Rate per KG in decimal format" type="number" class="form-control" name="cbv_rate" id="cbv_rate" value="{{ $cbv->cbv_rate or old('cbv_rate') }}">
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
                                            <input required step="0.01" aria-label="Total consignment weight in decimal format" title="Total consignment weight in decimal format" type="number" class="form-control" name="consignment_weight" id="consignment_weight" value="{{ $cbv->consignment_weight or old('consignment_weight') }}">
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
                                        <a href="{{ URL::previous('/manifest') }}" class="btn btn-danger pull-right">Back</a>
                                        <input type="submit" class="btn btn-success pull-right" value="Save CBV Details">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection