@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Manifests
                        <a href="{{ route('tabulations.create') }}" class="btn btn-primary btn-xs pull-right">
                            <i class="fa fa-plus"></i> New
                        </a>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-5">
                                Freight
                            </div>
                            <div class="col-md-8">

                            </div>
                            <div class="col-md-5">
                                Exchange Rate
                            </div>
                            <div class="col-md-8">

                            </div>
                            <div class="col-md-5">
                                VAT RATE
                            </div>
                            <div class="col-md-8">

                            </div>
                            <div class="col-md-5">
                                KEBS
                            </div>
                            <div class="col-md-8">

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
