@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li><a href="{{ route('setting-dashboard') }}">Setting Dashboard</a></li>
                  <li><a href="{{ route('city.index') }}">Cities</a></li>
                  <li class="active">Edit city</li>
                </ol>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Cities
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('city.update', $city->id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }})">
                                <label for="name">Name</label>
                                <input name="name" id="name" value="{{ $city->name or old('name') }}" class="form-control" required>
                                <span>
                                    @if ($errors->has('name'))
                                        <strong class="help-block">{{ $errors->first('name') }} </strong>
                                    @endif
                                </span>
                            </div>


                            <div class="form-group{{ $errors->has('import_duty') ? ' has-error' : '' }})">
                                <label for="import_duty">Import Duty Account</label>
                                <select name="import_duty" id="import_duty" class="form-control" required>
                                    @foreach($accounts as $account)
                                        <option value="{{ $account->AccountLink }}"{{ $city->import_duty == $account->AccountLink ? ' selected' : '' }}>{{ $account->Account }} - {{ $account->Description }}</option>
                                    @endforeach
                                </select>
                                <span>
                                    @if ($errors->has('import_duty'))
                                        <strong class="help-block">{{ $errors->first('import_duty') }} </strong>
                                    @endif
                                </span>
                            </div>

                            <div class="form-group{{ $errors->has('agency_fee') ? ' has-error' : '' }})">
                                <label for="agency_fee">Agency Fee Account</label>
                                <select name="agency_fee" id="agency_fee" class="form-control" required>
                                    @foreach($accounts as $account)
                                        <option value="{{ $account->AccountLink }}"{{ $city->agency_fee == $account->AccountLink ? ' selected' : '' }}>{{ $account->Account }} - {{ $account->Description }}</option>
                                    @endforeach
                                </select>
                                <span>
                                    @if ($errors->has('agency_fee'))
                                        <strong class="help-block">{{ $errors->first('agency_fee') }} </strong>
                                    @endif
                                </span>
                            </div>

                            <div class="form-group{{ $errors->has('outbound_freight') ? ' has-error' : '' }})">
                                <label for="outbound_freight">Outbound Freight Account</label>
                                <select name="outbound_freight" id="outbound_freight" class="form-control" required>
                                    @foreach($accounts as $account)
                                        <option value="{{ $account->AccountLink }}"{{ $city->outbound_freight == $account->AccountLink ? ' selected' : '' }}>{{ $account->Account }} - {{ $account->Description }}</option>
                                    @endforeach
                                </select>
                                <span>
                                    @if ($errors->has('outbound_freight'))
                                        <strong class="help-block">{{ $errors->first('outbound_freight') }} </strong>
                                    @endif
                                </span>
                            </div>

                            <div class="form-group{{ $errors->has('break_bulk') ? ' has-error' : '' }})">
                                <label for="break_bulk">Clearance Break Bulk Fee Account</label>
                                <select name="break_bulk" id="break_bulk" class="form-control" required>
                                    @foreach($accounts as $account)
                                        <option value="{{ $account->AccountLink }}"{{ $city->break_bulk == $account->AccountLink ? ' selected' : '' }}>{{ $account->Account }} - {{ $account->Description }}</option>
                                    @endforeach
                                </select>
                                <span>
                                    @if ($errors->has('break_bulk'))
                                        <strong class="help-block">{{ $errors->first('break_bulk') }} </strong>
                                    @endif
                                </span>
                            </div>

                            <div class="form-group{{ $errors->has('storage_fee') ? ' has-error' : '' }})">
                                <label for="storage_fee">Clearance Storage Fee Account</label>
                                <select name="storage_fee" id="storage_fee" class="form-control" required>
                                    @foreach($accounts as $account)
                                        <option value="{{ $account->AccountLink }}"{{ $city->storage_fee == $account->AccountLink ? ' selected' : '' }}>{{ $account->Account }} - {{ $account->Description }}</option>
                                    @endforeach
                                </select>
                                <span>
                                    @if ($errors->has('storage_fee'))
                                        <strong class="help-block">{{ $errors->first('storage_fee') }} </strong>
                                    @endif
                                </span>
                            </div>

                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group">
                                <button class="btn btn-success">Save</button>
                                <a href="{{ route('city.index') }}" class="btn btn-danger">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
