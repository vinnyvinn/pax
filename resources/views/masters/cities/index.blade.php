@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li><a href="{{ route('setting-dashboard') }}">Setting Dashboard</a></li>
                  <li class="active">Cities</li>
                </ol>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Cities
                        @can('create-cities')
                            <a href="{{ route('city.create') }}" class="btn btn-primary btn-xs pull-right">New</a>
                        @endcan
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table dataTable">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th width="100px">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cities as $city)
                                    <tr>
                                        <td>{{ $city->name }}</td>
                                        <td>
                                            @can('edit-cities')
                                            <a href="{{route('city.edit', $city->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                            @endcan
                                            @can('delete-cities')
                                                <button type="button" class="btn btn-danger btn-xs btn-destroy" data-token="{{ csrf_token() }}" data-url="{{ route('city.destroy', $city->id) }}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th width="100px">Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
