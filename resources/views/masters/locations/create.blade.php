@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
              <li><a href="/">Home</a></li>
              <li><a href="{{ route('setting-dashboard') }}">Setting Dashboard</a></li>
              <li><a href="{{ route('domestic-locations.index') }}">Domestic locations</a></li>
              <li class="active">Add domestic locations</li>
            </ol>
            <hr>
        </div>
    </div>
    <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <form action="{{ route('domestic-locations.store') }}" method="post">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name">City Name</label>

                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                        @if($errors->has('name'))
                            <span class="help-block">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('freight_account') ? ' has-error' : '' }})">
                        <label for="freight_account">Domestic Freight Account</label>
                        <select name="freight_account" id="freight_account" class="form-control" required>
                            @foreach($accounts as $account)
                                <option value="{{ $account->AccountLink }}">{{ $account->Account }} - {{ $account->Description }}</option>
                            @endforeach
                        </select>
                        <span>
                            @if ($errors->has('freight_account'))
                                <strong class="help-block">{{ $errors->first('freight_account') }} </strong>
                            @endif
                        </span>
                    </div>

                    <br class="clearfix" />

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="{{ route('domestic-locations.index') }}" class="btn btn-danger">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection