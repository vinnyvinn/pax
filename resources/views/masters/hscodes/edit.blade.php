@extends('layouts.app')

@section('content')

    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Edit HS Code</h4>
            </div>
            <form action="{{ route('hscode.update', $code->id) }}" method="post">
                <div class="panel-body">
                    {{csrf_field()}}
                    {{ method_field('PUT') }}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                                <label for="code">Code</label>
                                <input type="text" class="form-control" name="code" id="code" value="{{ $code->code or old('code') }}">

                                @if($errors->has('code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" name="description" id="description" value="{{ $code->description or old('description') }}">

                                @if($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="form-group{{ $errors->has('unit_of_qty') ? ' has-error' : '' }}">
                                <label for="unit_of_qty">Unit of Quantity</label>
                                <input type="text" class="form-control" name="unit_of_qty" id="unit_of_qty" value="{{ $code->unit_of_qty or old('unit_of_qty') }}">

                                @if($errors->has('unit_of_qty'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('unit_of_qty') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('rate') ? ' has-error' : '' }}">
                                <label for="rate">Rate per Unit</label>
                                <input type="text" class="form-control" name="rate" id="rate" value="{{ $code->rate or old('rate') }}">

                                @if($errors->has('rate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('rate') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="{{ route('hscode.index') }}" class="btn btn-danger">Back</a>
                    </div>

                </div>
            </form>
        </div>
    </div>

@endsection