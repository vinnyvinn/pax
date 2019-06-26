@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
              <li><a href="/">Home</a></li>
              <li><a href="{{ route('outbound-dashboard') }}">Outbound dashboard</a></li>
              <li><a href="{{ route('additional-charges-outbound.index') }}">Airwaybill additional charges</a></li>
              <li class="active">Create Additional charge</li>
            </ol>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <outbound-additional-charge></outbound-additional-charge>
        </div>
    </div>
</div>
@endsection