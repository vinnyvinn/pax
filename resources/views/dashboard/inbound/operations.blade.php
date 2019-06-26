@extends('layouts.app')

@section('content')
<div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
              <li><a href="/">Home</a></li>
              <li><a href="{{ route('inbound-dashboard') }}">Inbound</a></li>
              <li class="active">Operations</li>
            </ol>
            <hr>
        </div>
        @if(hasShipments('Inbound'))
        <div class="col-sm-6 col-md-3">
          <div class="thumbnail text-center bg-deltahs">
            <i class="fa fa-gift fa-4x font-white"></i>
            <div class="caption text-center">
              <p>
                <a href="{{ route('manifest.index', ['page' => 'operations']) }}" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Shipments</a>
              </p>
            </div>
          </div>
        </div>
        @endif
        <div class="col-sm-6 col-md-3">
          <div class="thumbnail text-center bg-deltahs">
            <i class="fa fa-file fa-4x font-white"></i>
            <div class="caption text-center">
              <p>
                <a href="{{ route('manifest.scan', 'oda') }}" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i>ODA scan</a>
              </p>
            </div>
          </div>
        </div>
        @can('import-van-scan')
        <div class="col-sm-6 col-md-3">
          <div class="thumbnail text-center bg-deltahs">
            <i class="fa fa-file fa-4x font-white"></i>
            <div class="caption text-center">
              <p>
                <a href="{{ route('manifest.scan', 'van') }}" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i>Van Scan</a>
              </p>
            </div>
          </div>
        </div>
        @endcan
        @can('import-dex-scan')
        <div class="col-sm-6 col-md-3">
          <div class="thumbnail text-center bg-deltahs">
            <i class="fa fa-file fa-4x font-white"></i>
            <div class="caption text-center">
              <p>
                <a href="{{ route('manifest.scan', 'dex') }}" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> DEX Scan</a>
              </p>
            </div>
          </div>
        </div>
        @endcan
</div>
@endsection
@section('css')
    <link rel="stylesheet" href="/css/style.css">
@endsection
