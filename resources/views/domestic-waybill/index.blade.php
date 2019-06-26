@extends('layouts.app')
@section('content')
    <div class="col-sm-10 col-sm-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                Domestic Waybill
                @can('create-domestic-shipments')
                <a href= "{{ route('domestic.create') }}" class="btn btn-primary btn-xs pull-right">
                    New Waybill
                </a>
                @endcan
            </div>
            <div class="panel-body">
                <table class="table table-responsive table-hover">
                    <thead>
                    <tr>
                        <th>Waybill #</th>
                        <th>Shipper Name</th>
                        <th>Shipper Phone</th>
                        <th>Shipper Address</th>
                        <th>Consignee Name</th>
                        <th>Consignee Phone</th>
                        <th>Consignee Address</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($domestics as $domestic)
                    <tr>
                        @can('view-domestic-shipments')
                            <td><a target="_blank" href="{{ route('domestic.show', $domestic->id) }}">{{ $domestic->waybill_number }}</a></td>
                        @else
                            <td>{{ $domestic->waybill_number }}</td>
                        @endcan
                        <td>{{ $domestic->con_name }}</td>
                        <td>{{ $domestic->con_phone }}</td>
                        <td>{{ $domestic->con_address }}</td>
                        <td>{{ $domestic->shipper_name }}</td>
                        <td>{{ $domestic->shipper_phone }}</td>
                        <td>{{ $domestic->shipper_address }}</td>
                        <td>
                            @if($domestic->status == PAX\Models\DomesticWaybill::STATUS_RAW && Auth::user()->can('edit-domestic-shipments'))
                                <a href="{{ route('domestic.edit', $domestic->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                            @endif
                            @if($domestic->status == PAX\Models\DomesticWaybill::STATUS_RAW && Auth::user()->can('delete-domestic-shipments'))
                                <button type="button" class="btn btn-danger btn-xs btn-destroy" data-token="{{ csrf_token() }}" data-url="{{ route('domestic.destroy', $domestic->id) }}"><i class="fa fa-trash"></i></button>
                            @endif
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Waybill #</th>
                        <th>Shipper Name</th>
                        <th>Shipper Phone</th>
                        <th>Shipper Address</th>
                        <th>Consignee Name</th>
                        <th>Consignee Phone</th>
                        <th>Consignee Address</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    @endsection