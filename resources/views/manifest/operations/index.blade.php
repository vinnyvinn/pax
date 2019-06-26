@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li><a href="{{ route('operations-dashboard') }}">Operations dashboard</a></li>
                  <li class="active">Shipments</li>
                </ol>
                <hr>
            </div>
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Manifests
                    </div>
                    <div class="panel-body">
                        <table class="table dataTable table-striped">
                            <thead>
                            <tr>
                                <th class="printable">#</th>
                                <th class="printable">Flight Date</th>
                                <th class="printable">Flight Number</th>
                                <th class="printable">Is TNT</th>
                                <th class="printable">Type</th>
                                <th class="printable">Arrival Time</th>
                                <th width="100px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($manifests as $manifest)
                                <tr>
                                    @if(Auth::user()->can('view-inbound-shipments'))
                                        <td><a href="{{ route('manifest.show',  [$manifest->id, 'page' => 'operations']) }}">MAN-{{ str_pad($manifest->id, 5, '0', STR_PAD_LEFT) }}</a></td>
                                    @else
                                        <td>MAN-{{ str_pad($manifest->id, 5, '0', STR_PAD_LEFT) }}</td>
                                    @endif
                                    <td>{{ Carbon\Carbon::parse($manifest->flight_date)->format('d F Y') }}</td>
                                    <td>{{ $manifest->flight_number }}</td>
                                    <td>{{ $manifest->is_tnt ? 'TNT' : 'Normal'}}</td>
                                    <td>{{ $manifest->manifest_type }}</td>
                                    <td>{{ Carbon\Carbon::parse($manifest->arrival_time)->toTimeString() }}</td>
                                    <td>
                                        @can('edit-inbound-shipments')
                                            <a href="{{route('manifest.edit', $manifest->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                        @endcan
                                        @can('delete-inbound-shipments')
                                            <button type="button" class="btn btn-danger btn-xs btn-destroy" data-token="{{ csrf_token() }}" data-url="{{ route('manifest.destroy', $manifest->id) }}"><i class="fa fa-trash"></i></button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th class="printable">#</th>
                                <th class="printable">Flight Date</th>
                                <th class="printable">Flight Number</th>
                                <th class="printable">Is TNT</th>
                                <th class="printable">Type</th>
                                <th class="printable">Arrival Time</th>
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
