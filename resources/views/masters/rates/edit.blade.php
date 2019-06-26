@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
              <li><a href="/">Home</a></li>
              <li><a href="{{ route('setting-dashboard') }}">Setting Dashboard</a></li>
              <li><a href="{{ route('domestic-rates.index') }}">Domestic rates</a></li>
              <li class="active">Edit domestic rates</li>
            </ol>
            <hr>
        </div>
    </div>
    <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <form action="{{ route('domestic-rates.update', $rate->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <h4>Location A</h4>
                    <p>{{ $rate->from->name }}</p>

                    <h4>Location B</h4>
                    <p>{{ $rate->to->name }}</p>


                    <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                        <label for="amount">Rate</label>
                        <input type="number" min="0" name="amount" id="amount" class="form-control" required value="{{ $rate->amount }}">

                        @if($errors->has('amount'))
                            <span class="help-block">{{ $errors->first('amount') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="{{ route('domestic-rates.index') }}" class="btn btn-danger">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection