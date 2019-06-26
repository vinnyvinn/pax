@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li><a href="{{ route('setting-dashboard') }}">Setting Dashboard</a></li>
                  <li><a href="{{ route('area-code.index') }}">Area codes</a></li>
                  <li class="active">Edit area codes</li>
                </ol>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Area Codes
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('area-code.update', $code->id) }}" method="post" role="form">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }})">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" value="{{ $code->name or old('name') }}" class="form-control" required>
                                <span>
                                    @if ($errors->has('name'))
                                        <strong class="help-block">{{ $errors->first('name') }} </strong>
                                    @endif
                                </span>
                            </div>


                            <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }})">
                                <label for="code">Code</label>
                                <input type="text" name="code" id="code" value="{{ $code->code or old('code') }}" class="form-control" required>
                                <span>
                                    @if ($errors->has('code'))
                                        <strong class="help-block">{{ $errors->first('code') }} </strong>
                                    @endif
                                </span>
                            </div>


                            <div class="form-group{{ $errors->has('inbound_freight') ? ' has-error' : '' }})">
                                <label for="inbound_freight">Inbound Freight Account</label>
                                <select name="inbound_freight" id="inbound_freight" class="form-control" required>
                                    @foreach($accounts as $account)
                                        <option value="{{ $account->AccountLink }}"{{ $code->inbound_freight == $account->AccountLink ? ' selected' : '' }}>{{ $account->Account }} - {{ $account->Description }}</option>
                                    @endforeach
                                </select>
                                <span>
                                    @if ($errors->has('inbound_freight'))
                                        <strong class="help-block">{{ $errors->first('inbound_freight') }} </strong>
                                    @endif
                                </span>
                            </div>


                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Save</button>
                                <a href="{{ route('area-code.index') }}" class="btn btn-danger">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection