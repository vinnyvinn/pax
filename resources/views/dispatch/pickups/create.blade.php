@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-12">
          <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li><a href="{{ route('dispatch-dashboard') }}">Dispatch dashboard</a></li>
            <li><a href="{{ route('pickups.index') }}">Pickup management</a></li>
            <li class="active">Create/Edit piickup</li>
          </ol>
          <hr>
      </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @component('dispatch.pickups.partials.form', ['pickup' => $pickup, 'clients' => $clients])
            @endcomponent
        </div>
    </div>
</div>
@endsection
