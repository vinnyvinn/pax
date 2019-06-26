@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
              <li><a href="/">Home</a></li>
              <li><a href="{{ route('setting-dashboard') }}">Setting Dashboard</a></li>
              <li class="active">Domestic rates</li>
            </ol>
            <hr>
        </div>
    </div>
    <div class="col-sm-10 col-sm-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                Domestic Rates
            </div>
            <div class="panel-body">
                <table class="table table-responsive table-striped">
                    <thead>
                    <tr>
                        <th>Location A</th>
                        <th>Location B</th>
                        <th class="text-right">Amount</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rates as $rate)
                    <tr>
                        <td>{{ $rate->from->name }}</td>
                        <td>{{ $rate->to->name }}</td>
                        <td class="text-right">{{ number_format($rate->amount, 2) }}</td>
                        <td class="text-center">
                            @can('edit-domestic-rates')
                                <a href="{{route('domestic-rates.edit', $rate->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                            @endcan
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Location A</th>
                            <th>Location B</th>
                            <th class="text-right">Amount</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    @endsection