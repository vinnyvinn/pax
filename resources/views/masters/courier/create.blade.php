@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
              <li><a href="/">Home</a></li>
              <li><a href="{{ route('setting-dashboard') }}">Setting Dashboard</a></li>
              <li><a href="{{ route('courier.index') }}">Couriers</a></li>
              <li class="active">Add courier</li>
            </ol>
            <hr>
        </div>
    </div>
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                Add Courier
            </div>
            <form action="{{route('courier.store')}}" method="post">
                {{csrf_field()}}
                
                <div class="panel-body">
                
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name">Name</label>
                                <input type="text" id="name" value="{{ old('name') }}" name="name" required class="form-control">
                                @if($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('national_id') ? ' has-error' : '' }}">
                                <label for="national_id">National/Passport NO:</label>
                                <input type="text" id="national_id" value="{{ old('national_id') }}" name="national_id" required class="form-control">
                                @if($errors->has('national_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('national_id') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone">Phone NO:</label>
                                <input type="text" id="phone" value="{{ old('phone') }}" name="phone" required class="form-control">
                                @if($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group{{ $errors->has('fedex_id') ? ' has-error' : '' }}">
                                <label for="fedex_id">FedEx ID</label>
                                <input type="text" id="fedex_id" value="{{ old('fedex_id') }}" name="fedex_id" required class="form-control">
                                @if($errors->has('fedex_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fedex_id') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('route_id') ? ' has-error' : '' }}">
                                <label for="route_id">Courier Route</label>
                                <select id="route_id" name="route_id" required class="form-control">
                                    @foreach($routes as $route)
                                        <option value="{{ $route->id }}">{{ $route->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('route_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('route_id') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>
    
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="{{ route('courier.index')  }}" class="btn btn-danger">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @endsection