@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <div class="col-md-6">
                                Other charges - Outbound freight
                        </div>
                        <div class="col-md-6">
                        <a href="{{ route('other-charges.create') }}" class="btn btn-sm btn-info pull-right">Add Other Charges</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table dataTable">
                                <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Description</th>
                                    <th>Cost</th>
                                    <th width="100px">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $charge)
                                    <tr>
                                        <td>{{ $charge->code }}</td>
                                        <td>{{ $charge->description }}</td>
                                        <td>{{ $charge->cost }}</td>
                                        <td>
                                            @can('view-settings')
                                                <a href="{{route('other-charges.edit', $charge->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                            @endcan
                                            @can('view-settings')
                                                <button type="button" class="btn btn-danger btn-xs btn-destroy" data-token="{{ csrf_token() }}" data-url="{{ route('other-charges.destroy', $charge->id) }}"><i class="fa fa-trash"></i></button>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Code</th>
                                        <th>Description</th>
                                        <th>Cost</th>
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
