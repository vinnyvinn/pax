@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
              <li><a href="/">Home</a></li>
              <li><a href="{{ route('setting-dashboard') }}">Setting Dashboard</a></li>
              <li class="active">Couriers</li>
            </ol>
            <hr>
        </div>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                Couriers
                @can('create-couriers')
                    <a href="{{route('courier.create')}}" class="btn btn-primary btn-xs pull-right">Add Courier</a>
                @endcan
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>NO:</th>
                            <th>Name</th>
                            <th>FedEx ID</th>
                            <th>National/Passport NO:</th>
                            <th>Phone</th>
                            <th >Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($couriers as $courier)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ucwords($courier->name)}}</td>
                                <td>{{$courier->fedex_id}}</td>
                                <td>{{$courier->national_id}}</td>
                                <td>{{$courier->phone}}</td>
                                <td>
                                    @can('edit-couriers')
                                        <a href="{{route('courier.edit', $courier->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                    @endcan
                                    @can('delete-couriers')
                                        <button type="button" class="btn btn-danger btn-xs btn-destroy" data-token="{{ csrf_token() }}"
                                            data-url="{{ route('courier.destroy', $courier->id) }}"><i class="fa fa-trash"></i></button>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
