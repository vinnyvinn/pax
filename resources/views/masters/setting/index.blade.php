@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <div class="col-md-6">
                                Setting
                        </div>
                        <div class="col-md-6">
                            @can('create-routes')
                            <form action="{{ route('settings.store') }}" enctype="multipart/form-data" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="input-group pull-right">
                                        <input type="file" name="uploaded_file" id="uploaded_file" class="form-control input-sm">
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
                                    <th>Value</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($settings as $setting)
                                    <tr>
                                        <td>{{ $setting->key }}</td>
                                        <td>{{ $setting->current_value }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-info"><i class="fa fa-edit"></i></button>
                                        </td>
                                    </tr>
                                    @include('masters.setting.edit')
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Value</th>
                                    <th>Action</th>
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
