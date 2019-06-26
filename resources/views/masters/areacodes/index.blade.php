@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li><a href="{{ route('setting-dashboard') }}">Setting Dashboard</a></li>
                  <li class="active">Area codes</li>
                </ol>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Area Codes
                        @can('create-area-codes')
                        <a href="{{ route('area-code.create') }}" class="btn btn-primary btn-xs pull-right">New</a>
                        @endcan
                    </div>
                    <div class="panel-body">
                        <table class="table dataTable">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Code</th>
                                <th width="100px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($codes as $code)
                                <tr>
                                    <td>{{ $code->name }}</td>
                                    <td>{{ $code->code }}</td>
                                    <td>
                                        @can('edit-area-codes')
                                            <a href="{{route('area-code.edit', $code->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                        @endcan
                                        @can('delete-area-codes')
                                            <button type="button" class="btn btn-danger btn-xs btn-destroy" data-token="{{ csrf_token() }}" data-url="{{ route('area-code.destroy', $code->id) }}"><i class="fa fa-trash"></i></button>
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
@endsection
