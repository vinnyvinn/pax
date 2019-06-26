@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li><a href="{{ route('setting-dashboard') }}">Setting Dashboard</a></li>
                  <li class="active">Clients</li>
                </ol>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        
                        <div class="row">
                        <div class="col-lg-8">Clients</div>
                         <div class="col-lg-4 pull-right">
                            <form action="{{ route('clients.store') }}" method="post" enctype="multipart/form-data">
                                   {{ csrf_field() }}
                                   <div class="input-group">
                                       <input type="file" name="file" id="file" accept=".xls, .xlsx" placeholder="GDR rate" class="form-control input-sm pull-right" required>
                                       <span class="input-group-btn">
                                           <button type="submit" class="btn btn-sm btn-primary">Import</button>
                                       </span>
                                   </div>
                               </form>
                          </div>   
                        </div>
                        
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table dataTable">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Account</th>
                                    <th>FEDEXID</th>
                                    <th>Discount</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($clients as $client)
                                    <tr>
                                        <td>{{ $client->Name }}</td>
                                        <td>{{ $client->Account }}</td>
                                        <td>{{ $client->FedexId }}</td>
                                        <td>{{ $client->Discount }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Account</th>
                                        <th>FEDEXID</th>
                                        <th>Discount</th>
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
