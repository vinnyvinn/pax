@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Tabulations
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('tabulations.store') }}" method="post" role="form">
                            {{csrf_field()}}
                            <div class="form-group{{ $errors->has('freight') ? ' has-error' : '' }}">
                                <label for="freight">Freight*</label>
                                <input type="text" class="form-control text-uppercase" name="freight"
                                       id="freight" value="{{ old('freight') }}" required>
                                @if($errors->has('freight'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('freight') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('exchange_rate') ? ' has-error' : '' }}">
                            <label for="exchange_rate">Exchange Rate*</label>
                            <input type="text" class="form-control text-uppercase" name="exchange_rate"
                                   id="exchange_rate" value="{{ old('exchange_rate') }}" required>
                            @if($errors->has('exchange_rate'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('exchange_rate') }}</strong>
                                    </span>
                        @endif
                                </div>

                            <div class="form-group{{ $errors->has('import_duty_rate') ? ' has-error' : '' }}">
                            <label for="import_duty_rate">Import Duty Rate*</label>
                            <input type="text" class="form-control text-uppercase" name="import_duty_rate" id="import_duty_rate"
                                   value="{{ old('import_duty_rate') }}" required>
                            @if($errors->has('import_duty_rate'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('import_duty_rate') }}</strong>
                                    </span>
                        @endif
                                </div>
                            <div class="form-group{{ $errors->has('vat_rate') ? ' has-error' : '' }}">
                                <label for="vat_rate">VAT RATE*</label>
                                <input type="text" class="form-control text-uppercase" name="vat_rate" id="vat_rate"
                                       value="{{ old('vat_rate') }}" required>
                                @if($errors->has('vat_rate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('vat_rate') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('kebs_amount') ? ' has-error' : '' }}">
                                <label for="kebs_amount">KEBS AMOUNT</label>
                                <input type="text" class="form-control text-uppercase" name="kebs_amount" id="kebs_amount"
                                       value="{{ old('kebs_amount') }}" required>
                                @if($errors->has('kebs_amount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kebs_amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('other_charges') ? ' has-error' : '' }}">
                                <label for="other_charges">Other charges</label>
                                <input type="text" class="form-control text-uppercase" name="other_charges" id="other_charges"
                                       value="{{ old('other_charges') }}" required>
                                @if($errors->has('other_charges'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('other_charges') }}</strong>
                             </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Submit</button>
                                <a href="{{ route('tabulations.index') }}" class="btn btn-danger">Back</a>
                            </div>
                        </form>
                    </div>

                </div>
            </div>


        </div>
    </div>
@endsection