@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li><a href="{{ route('outbound-dashboard') }}">Outbound dashboard</a></li>
                  <li class="active">Outbound Manifests</li>
                </ol>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Outbound Manifests
                        <a href="{{ route('outbound.create') }}" class="btn btn-primary btn-xs pull-right">
                            <i class="fa fa-plus"></i> New
                        </a>
                    </div>
                    <div class="panel-body">
                        <table class="table dataTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Flight Date</th>
                                <th>Flight Number</th>
                                <th>Departure Time</th>
                                <th>CBV Number</th>
                                <th class="text-right">CBV Rate</th>
                                <th class="text-right">Consignment Weight</th>
                                <th width="100px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($manifests as $manifest)
                                <tr>
                                    <td><a href="{{ route('outbound.show', $manifest->id) }}">MAN-{{ str_pad($manifest->id, 5, '0', STR_PAD_LEFT) }}</a></td>
                                    <td>{{ Carbon\Carbon::parse($manifest->flight_date)->format('d F Y') }}</td>
                                    <td>{{ $manifest->flight_number }}</td>
                                    <td>{{ Carbon\Carbon::parse($manifest->arrival_time)->toTimeString() }}</td>
                                    <td>{{ $manifest->cbv_number }}</td>
                                    <td class="text-right">${{ $manifest->cbv_rate }}/KG</td>
                                    <td class="text-right">{{ $manifest->consignment_weight }} KGs</td>
                                    <td>
                                        <a href="{{route('outbound.edit', $manifest->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                                        <button type="button" class="btn btn-danger btn-sm btn-destroy" data-token="{{ csrf_token() }}" data-url="{{ route('outbound.destroy', $manifest->id) }}"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Flight Date</th>
                                <th>Flight Number</th>
                                <th>Departure Time</th>
                                <th>CBV Number</th>
                                <th>CBV Rate</th>
                                <th>Consignment Weight</th>
                                <th width="100px">Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
