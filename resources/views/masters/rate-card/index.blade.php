@extends('layouts.app')
@section('content')
    <div class="col-sm-10 col-sm-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                Outbound Rates
            </div>
            <div class="panel-body">
                <table class="table table-responsive table-striped">
                    <thead>
                    <tr>
                        <th>Packaging</th>
                        <th class="text-right">Weight</th>
                        <th class="text-right">Zone A</th>
                        <th class="text-right">Zone B</th>
                        <th class="text-right">Zone C</th>
                        <th class="text-right">Zone D</th>
                        <th class="text-right">Zone E</th>
                        <th class="text-right">Zone F</th>
                        <th class="text-right">Zone G</th>
                        <th class="text-right">Zone H</th>
                        <th class="text-right">Zone I</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rates as $rate)
                    <tr>
                        <td>{{ $rate->getPackaging() }}</td>
                        <td class="text-right">{{ number_format($rate->weight, 2) }}</td>
                        <td class="text-right">{{ number_format($rate->zone_a, 2) }}</td>
                        <td class="text-right">{{ number_format($rate->zone_b, 2) }}</td>
                        <td class="text-right">{{ number_format($rate->zone_c, 2) }}</td>
                        <td class="text-right">{{ number_format($rate->zone_d, 2) }}</td>
                        <td class="text-right">{{ number_format($rate->zone_e, 2) }}</td>
                        <td class="text-right">{{ number_format($rate->zone_f, 2) }}</td>
                        <td class="text-right">{{ number_format($rate->zone_g, 2) }}</td>
                        <td class="text-right">{{ number_format($rate->zone_h, 2) }}</td>
                        <td class="text-right">{{ number_format($rate->zone_i, 2) }}</td>
                        <td class="text-center">
                            @can('edit-outbound-rate-card')
                                <a href="{{route('rate-card.edit', $rate->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                            @endcan
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Packaging</th>
                            <th>Weight</th>
                            <th class="text-right">Zone A</th>
                            <th class="text-right">Zone B</th>
                            <th class="text-right">Zone C</th>
                            <th class="text-right">Zone D</th>
                            <th class="text-right">Zone E</th>
                            <th class="text-right">Zone F</th>
                            <th class="text-right">Zone G</th>
                            <th class="text-right">Zone H</th>
                            <th class="text-right">Zone I</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    @endsection