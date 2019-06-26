@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
              <li><a href="/">Home</a></li>
              <li><a href="{{ route('setting-dashboard') }}">Setting Dashboard</a></li>
              <li class="active">CBVs</li>
            </ol>
            <hr>
        </div>
    </div>
    <div class="col-sm-10 col-sm-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                CBVS
                @can('create-cbv')
                    <a href="{{ route('cbv.create') }}" class="btn btn-primary btn-xs pull-right">New CBV</a>
                @endcan
            </div>
            <div class="panel-body">
                <table class="table table-responsive table-striped">
                    <thead>
                    <tr>
                        <th>CBV Number</th>
                        <th>Date Issued</th>
                        <th>Date Used</th>
                        <th class="text-right">Rate</th>
                        <th class="text-right">Handling Rate</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($cbvs as $cbv)
                        <tr>
                            <td>{{ $cbv->number }}</td>
                            <td>{{Carbon\Carbon::parse($cbv->date_issued)->format('d F Y') }}</td>
                            <td>{{ $cbv->used_on ? Carbon\Carbon::parse($cbv->used_on)->format('d F Y') : ''}}</td>
                            <td class="text-right">${{ $cbv->rate }} Per KG</td>
                            <td class="text-right">${{ $cbv->handling_rate }} Per KG</td>
                            <td>{{ $cbv->used ? 'Used' : 'Unused' }}</td>
                            <td class="text-center">
                                @can('edit-cbv')
                                    <a href="{{route('cbv.edit', $cbv->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                @endcan
                                @can('delete-cbv')
                                    <button type="button" class="btn btn-danger btn-xs btn-destroy" data-token="{{ csrf_token() }}" data-url="{{ route('cbv.destroy', $cbv->id) }}"><i class="fa fa-trash"></i></button>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>CBV Number</th>
                            <th>Date Issued</th>
                            <th>Date Used</th>
                            <th class="text-right">Rate</th>
                            <th class="text-right">Handling Rate</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    @endsection