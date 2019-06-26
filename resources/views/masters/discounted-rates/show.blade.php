@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li><a href="{{ route('setting-dashboard') }}">Setting Dashboard</a></li>
                  <li><a href="{{ route('discount-rate-card.index') }}">Discount sale rates</a></li>
                  <li class="active">Discount rate details</li>
                </ol>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="card-title">Rate card details (USD)</h4>
                        </div>
                        <div class="col-md-4">
                            <h4 class="card-title">
                             Client: {{ $data->client->Name }}
                            </h4>
                        </div>
                        <div class="col-md-4">
                            <h4 class="card-title">
                              Effective from: {{ pax_date_format($data->effective_from) }} Effective to: {{ pax_date_format($data->effective_to) }}
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Package</th>
                                    <th>Weight</th>
                                    <th>A</th>
                                    <th>B</th>
                                    <th>C</th>
                                    <th>D</th>
                                    <th>E</th>
                                    <th>F</th>
                                    <th>G</th>
                                    <th>H</th>
                                    <th>I</th>
                                    <th>J</th>
                                    <th>K</th>
                                    <th>L</th>
                                    <th>M</th>
                                    <th>N</th>
                                    <th>O</th>
                                    <th>P</th>
                                    <th>Q</th>
                                    <th>R</th>
                                    <th>S</th>
                                    <th>T</th>
                                    <th>U</th>
                                    <th>V</th>
                                    <th>W</th>
                                    <th>X</th>
                                    <th>Y</th>
                                    <th>Z</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data->rates as $rate)
                                 <tr>
                                    <td>{{ $rate->package_type }}</td>
                                    <td>{{ $rate->weight }}</td>
                                    <td>{{ $rate->a ?  number_format($rate->a, 4) : '-' }}</td>
                                    <td>{{ $rate->b ?  number_format($rate->b, 4) : '-' }}</td>
                                    <td>{{ $rate->c ?  number_format($rate->c, 4) : '-' }}</td>
                                    <td>{{ $rate->d ?  number_format($rate->d, 4) : '-' }}</td>
                                    <td>{{ $rate->e ?  number_format($rate->e, 4) : '-' }}</td>
                                    <td>{{ $rate->f ?  number_format($rate->f, 4) : '-' }}</td>
                                    <td>{{ $rate->g ?  number_format($rate->g, 4) : '-' }}</td>
                                    <td>{{ $rate->h ?  number_format($rate->h, 4) : '-' }}</td>
                                    <td>{{ $rate->i ?  number_format($rate->i, 4) : '-' }}</td>
                                    <td>{{ $rate->j ?  number_format($rate->j, 4) : '-' }}</td>
                                    <td>{{ $rate->k ?  number_format($rate->k, 4) : '-' }}</td>
                                    <td>{{ $rate->l ?  number_format($rate->l, 4) : '-' }}</td>
                                    <td>{{ $rate->m ?  number_format($rate->m, 4) : '-' }}</td>
                                    <td>{{ $rate->n ?  number_format($rate->n, 4) : '-' }}</td>
                                    <td>{{ $rate->o ?  number_format($rate->o, 4) : '-'}}</td>
                                    <td>{{ $rate->p ?  number_format($rate->p, 4) : '-' }}</td>
                                    <td>{{ $rate->q ?  number_format($rate->q, 4) : '-' }}</td>
                                    <td>{{ $rate->r ?  number_format($rate->r, 4) : '-' }}</td>
                                    <td>{{ $rate->s ?  number_format($rate->s, 4) : '-' }}</td>
                                    <td>{{ $rate->t ?  number_format($rate->t, 4) : '-' }}</td>
                                    <td>{{ $rate->u ?  number_format($rate->u, 4) : '-' }}</td>
                                    <td>{{ $rate->v ?  number_format($rate->v, 4) : '-' }}</td>
                                    <td>{{ $rate->w ?  number_format($rate->w, 4) : '-' }}</td>
                                    <td>{{ $rate->x ?  number_format($rate->x, 4) : '-' }}</td>
                                    <td>{{ $rate->y ?  number_format($rate->y, 4) : '-' }}</td>
                                    <td>{{ $rate->z ?  number_format($rate->z, 4) : '-' }}</td>
                                </tr>   
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection