@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li><a href="{{ route('setting-dashboard') }}">Setting Dashboard</a></li>
                  <li><a href="{{ route('discount-rate-card.index') }}">Discount rates</a></li>
                  <li class="active">Create Discount rate card</li>
                </ol>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel">
                <form action="{{ route('discount-rate-card.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="text-left panel-title">Add Discount rate card</h4>
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="client_id">Client</label>
                            <select name="client_id" id="client_id" class="form-control">
                                <option value="">Select Client</option>
                                @foreach ($clients as $client)
                                <option value="{{ $client->DCLink }}">{{ "{$client->Name} - {$client->Account}" }}</option>   
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="effective_from">Effective from</label>
                            <input type="text" name="effective_from" id="effective_from" class="form-control datepicker" required>
                        </div>
                        <div class="form-group">
                                <label for="effective_from">Effective to</label>
                            <input type="text" name="effective_to" id="effective_to" class="form-control datepicker" required>
                        </div>
                        <div class="form-group">
                            <label for="status"><input type="checkbox" value="1" name="status" id="status" class="form-check"> Active</label>
                        </div>
                        <div class="form-group">
                            <label for="rates">Rates</label>
                            <input type="file" accept=".xlsx, .xls" name="rates" id="rates" class="form-control" required>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-right">
                                    <a href="{{ route('gdr.index') }}" class="btn btn-danger">Back</a>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
                
            </div>
        </div>
    </div>
@endsection