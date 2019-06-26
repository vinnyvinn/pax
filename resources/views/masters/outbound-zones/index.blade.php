@extends('layouts.app')
@section('content')
    <div class="col-sm-8 col-sm-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                Outbound Zones
                @can('create-domestic-locations')
                <a href="{{ route('outbound-zones.create') }}" class="btn btn-primary btn-xs pull-right">Add New</a>
                @endcan
            </div>
            <div class="panel-body">
                <table class="table table-responsive table-striped">
                    <thead>
                    <tr>
                        <th>Zone</th>
                        <th>Location</th>
                        <th>Country Code</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($zones as $zone)
                    <tr>
                        <td>{{ $zone->zone }}</td>
                        <td>{{ $zone->name }}</td>
                        <td>{{ $zone->code }}</td>
                        <td class="text-center">
                            @can('edit-outbound-zones')
                                <a href="{{route('outbound-zones.edit', $zone->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                            @endcan
                            @can('delete-outbound-zones')
                                <button type="button" class="btn btn-danger btn-xs btn-destroy" data-token="{{ csrf_token() }}" data-url="{{ route('outbound-zones.destroy', $zone->id) }}"><i class="fa fa-trash"></i></button>
                            @endcan
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Zone</th>
                            <th>Location</th>
                            <th>Country Code</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    @endsection