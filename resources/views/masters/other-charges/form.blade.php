@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <div class="col-md-6">
                            Other charges
                        </div>
                        
                    </div>
                    <div class="panel-body">
                        <form action="{{ $data->id ? route('other-charges.update', $data->id) : route('other-charges.store') }}" method="post" role="form">
                            {{ csrf_field() }}
                            {{ $data->id ? method_field('PUT') : ''}}
                            <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }})">
                                <label for="name">Code</label>
                                <input type="text" name="code" id="code" value="{{ $data->id ? $data->code : old('code') }}" class="form-control" required>
                                <span>
                                    @if ($errors->has('code'))
                                        <strong class="help-block">{{ $errors->first('code') }} </strong>
                                    @endif
                                </span>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }})">
                                <label for="description">Description</label>
                                <input type="text" name="description" id="description" value="{{ $data->id ? $data->description : old('description') }}" class="form-control" required>
                                <span>
                                    @if ($errors->has('description'))
                                        <strong class="help-block">{{ $errors->first('description') }} </strong>
                                    @endif
                                </span>
                            </div>

                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Save</button>
                                <a href="{{ route('route.index') }}" class="btn btn-danger">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection