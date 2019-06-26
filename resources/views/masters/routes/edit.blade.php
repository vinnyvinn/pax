@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Routes
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('route.update', $route->id) }}" method="post" role="form">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }})">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" value="{{ $route->name or old('name') }}" class="form-control" required>
                                <span>
                                    @if ($errors->has('name'))
                                        <strong class="help-block">{{ $errors->first('name') }} </strong>
                                    @endif
                                </span>
                            </div>


                            <div class="form-group{{ $errors->has('area_code_id') ? ' has-error' : '' }})">
                                <label for="area_code_id">Area Code</label>
                                <select name="area_code_id" id="area_code_id" class="form-control">
                                    @foreach($codes as $code)
                                        <option value="{{ $code->id }}"{{ $route->area_code_id == $code->id ? ' selected' : '' }}>{{ $code->name }}</option>
                                    @endforeach
                                </select>
                                <span>
                                    @if ($errors->has('area_code_id'))
                                        <strong class="help-block">{{ $errors->first('area_code_id') }} </strong>
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