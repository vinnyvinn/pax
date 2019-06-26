@extends('layouts.app')

@section('content')
<div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
              <li><a href="/">Home</a></li>
            <li><a href="{{ route('inbound-dashboard') }}">Inbound</a></li>
              <li class="active">Finance dashoard</li>
            </ol>
            <hr>
        </div>
        @if(hasShipments('Inbound'))
        <div class="col-sm-6 col-md-3">
          <div class="thumbnail text-center bg-deltahs">
            <i class="fa fa-gift fa-4x font-white"></i>
            <div class="caption text-center">
              <p>
                <a href="{{ route('manifest.index', ['page' => 'finance']) }}" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Shipments</a>
              </p>
            </div>
          </div>
        </div>
        @endif
        @if(canAny(['Create Clearance Invoice', 'View Clearance Invoice', 'Edit Clearance Invoice', 'Delete Clearance Invoice', 'Finalize Clearance Invoice']))
        <div class="col-sm-6 col-md-3">
          <div class="thumbnail text-center bg-deltahs">
            <i class="fa fa-money fa-4x font-white"></i>
            <div class="caption text-center">
              <p>
                <a href="{{ route('invoice.index') }}" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Clearance Billing</a>
              </p>
            </div>
          </div>
        </div>
        @endif
        @if(canAny(['Create Clearance Invoice', 'View Clearance Invoice', 'Edit Clearance Invoice', 'Delete Clearance Invoice', 'Finalize Clearance Invoice']))
        <div class="col-sm-6 col-md-3">
          <div class="thumbnail text-center bg-deltahs">
            <i class="fa fa-bookmark fa-4x font-white"></i>
            <div class="caption text-center">
              <p>
                <a href="{{ route('invoice.index') }}" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Clearance Invoices</a>
              </p>
            </div>
          </div>
        </div>
        @endif
        @can('import-pod-scan')
        <div class="col-sm-6 col-md-3">
          <div class="thumbnail text-center bg-deltahs">
            <i class="fa fa-gift fa-4x font-white"></i>
            <div class="caption text-center">
              <p>
                <a href="{{ route('freight.pod-scan') }}" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> POD Scan</a>
              </p>
            </div>
          </div>
        </div>
        @endcan
        @if(canAny(['Create Inbound Freight Invoice', 'View Inbound Freight Invoice', 'Edit Inbound Freight Invoice', 'Delete Inbound Freight Invoice', 'Finalize Inbound Freight Invoice']))
        <div class="col-sm-6 col-md-3">
          <div class="thumbnail text-center bg-deltahs">
            <i class="fa fa-dollar fa-4x font-white"></i>
            <div class="caption text-center">
              <p>
                <a href="{{ route('freight.index') }}" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Freight Billing</a>
              </p>
            </div>
          </div>
        </div>
        @endif
        @if(canAny(['Create Inbound Freight Invoice', 'View Inbound Freight Invoice', 'Edit Inbound Freight Invoice', 'Delete Inbound Freight Invoice', 'Finalize Inbound Freight Invoice']))
        <div class="col-sm-6 col-md-3">
          <div class="thumbnail text-center bg-deltahs">
            <i class="fa fa-bookmark fa-4x font-white"></i>
            <div class="caption text-center">
              <p>
                <a href="{{ route('freight.index') }}" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Freight Invoices</a>
              </p>
            </div>
          </div>
        </div>
        @endif
      </div>
</div>
@endsection
@section('css')
    <link rel="stylesheet" href="/css/style.css">
@endsection
