@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li><a href="{{ route('setting-dashboard') }}">Setting Dashboard</a></li>
                  <li class="active">Discount rate cards</li>
                </ol>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="text-left">Discount rate cards</h4>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('discount-rate-card.create') }}" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus"></i> Rate card</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                           <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Client</th>
                                        <th>Effective from</th>
                                        <th>Effective to</th>
                                        <th>Status</th>
                                        <th>Created at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $rateCard)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $rateCard->client->Name }}</td>
                                        <td>{{ pax_date_format($rateCard->effective_from) }}</td>
                                        <td>{{ pax_date_format($rateCard->effective_to) }}</td>
                                        <td>{{ $rateCard->status ? 'Active' : 'Inactive' }}</td>
                                        <td>{{ pax_date_format($rateCard->created_at) }}</td>
                                        <td>
                                        <a href="{{ route('discount-rate-card.edit', $rateCard->id) }}" class="btn btn-sm btn-info" title="Edit">
                                            <i class="fa fa-edit"></i></a>
                                            <a href="{{ route('discount-rate-card.show', $rateCard->id) }}" class="btn btn-sm btn-info" title="Show">
                                                <i class="fa fa-eye"></i></a>
                                            <button type="button" class="btn btn-danger btn-sm btn-destroy" data-token="{{ csrf_token() }}" data-url="{{ route('discount-rate-card.destroy', $rateCard->id) }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>   
                                    @endforeach
                                </tbody>
                            </table> 
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection