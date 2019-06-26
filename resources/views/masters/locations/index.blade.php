@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
              <li><a href="/">Home</a></li>
              <li><a href="{{ route('setting-dashboard') }}">Setting Dashboard</a></li>
              <li class="active">Domestic locations</li>
            </ol>
            <hr>
        </div>
    </div>
    <div class="col-sm-8 col-sm-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                Domestic Locations
                @can('create-domestic-locations')
                <a href="{{ route('domestic-locations.create') }}" class="btn btn-primary btn-xs pull-right">Add New</a>
                @endcan
            </div>
            <div class="panel-body">
                <table class="table table-responsive table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($locations as $location)
                    <tr>
                        <td>{{ $location->name }}</td>
                        <td class="text-center">
                            @can('edit-domestic-locations')
                                <a href="{{route('domestic-locations.edit', $location->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                            @endcan
                            @can('delete-domestic-locations')
                                <button type="button" class="btn btn-danger btn-xs btn-destroy" data-token="{{ csrf_token() }}" data-url="{{ route('domestic-locations.destroy', $location->id) }}"><i class="fa fa-trash"></i></button>
                            @endcan
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    @endsection