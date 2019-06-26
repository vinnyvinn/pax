@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li><a href="{{ route('setting-dashboard') }}">Setting Dashboard</a></li>
                  <li class="active">Routes</li>
                </ol>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <div class="col-md-6">
                                Routes
                        </div>
                        <div class="col-md-6">
                            @can('create-routes')
                            <form action="{{ route('routes.import') }}" enctype="multipart/form-data" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="input-group pull-right">
                                        <input type="file" name="routes" id="routes" class="form-control input-sm">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm btn-info">Import</button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                            @endcan
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table dataTable">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Area Code</th>
                                    <th width="100px">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($routes as $route)
                                    <tr>
                                        <td>{{ $route->name }}</td>
                                        <td>{{ $route->areaCode->name }}</td>
                                        <td>
                                            @can('edit-routes')
                                                <a href="{{route('route.edit', $route->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                            @endcan
                                            @can('delete-routes')
                                                <button type="button" class="btn btn-danger btn-xs btn-destroy" data-token="{{ csrf_token() }}" data-url="{{ route('route.destroy', $route->id) }}"><i class="fa fa-trash"></i></button>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Code</th>
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
