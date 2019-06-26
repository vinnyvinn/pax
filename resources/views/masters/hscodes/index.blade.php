@extends('layouts.app')
@section('content')

    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                HS Codes
                <a href="{{route('hscode.create')}}" class="btn btn-primary btn-xs pull-right">Add HS Code</a>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>NO:</th>
                            <th>Code</th>
                            <th>Description</th>
                            <th>Unit of QTY</th>
                            <th>Rate</th>
                            <th >Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($hscodes as $hscode)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ ucwords($hscode->code) }}</td>
                                <td>{{ $hscode->description }}</td>
                                <td>{{ $hscode->unit_of_qty }}</td>
                                <td>{{ $hscode->rate }}</td>
                                <td>
                                    <a href="{{ route('hscode.edit', $hscode->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                    <button type="button" class="btn btn-danger btn-xs btn-destroy" data-token="{{ csrf_token() }}"
                                            data-url="{{ route('hscode.destroy', $hscode->id) }}"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
