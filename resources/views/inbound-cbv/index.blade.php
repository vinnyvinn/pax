@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Inbound CBVs
                        @can('create-inbound-shipments')
                            <a href="{{ route('inbound-cbv.create') }}" class="btn btn-primary btn-xs pull-right">
                                <i class="fa fa-plus"></i> New
                            </a>
                        @endcan
                    </div>
                    <div class="panel-body">
                        <table class="table dataTable table-striped">
                            <thead>
                            <tr>
                                <th class="printable">#</th>
                                <th class="printable">Manifest</th>
                                <th class="printable">Rate</th>
                                <th class="printable">Con Weight</th>
                                <th class="printable">Handlers</th>
                                <th width="100px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cbvs as $cbv)
                                <tr>
                                    @if(Auth::user()->can('view-inbound-shipments'))
                                        <td><a href="{{ route('inbound-cbv.show', $cbv->id) }}">{{ $cbv->cbv_number }}</a></td>
                                        <td><a href="{{ route('manifest.show', $cbv->manifest_id) }}">MAN-{{ str_pad($cbv->manifest_id, 5, '0', STR_PAD_LEFT) }}</a></td>
                                    @else
                                        <td>{{ $cbv->cbv_number }}</td>
                                        <td>MAN-{{ str_pad($cbv->manifest_id, 5, '0', STR_PAD_LEFT) }}</td>
                                    @endif
                                    <td>{{ $cbv->cbv_rate }}/KG</td>
                                    <td>{{ $cbv->consignment_weight }} KGs</td>
                                    <td>{{ $cbv->handlers }}</td>
                                    <td>
                                        @can('edit-inbound-shipments')
                                            <a href="{{route('inbound-cbv.edit', $cbv->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                        @endcan
                                        @can('delete-inbound-shipments')
                                            <button type="button" class="btn btn-danger btn-xs btn-destroy" data-token="{{ csrf_token() }}" data-url="{{ route('inbound-cbv.destroy', $cbv->id) }}"><i class="fa fa-trash"></i></button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th class="printable">#</th>
                                <th class="printable">Manifest</th>
                                <th class="printable">Rate</th>
                                <th class="printable">Con Weight</th>
                                <th class="printable">Handlers</th>
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
