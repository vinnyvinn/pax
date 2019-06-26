@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="panel">
          <div class="panel-body">
            <p>Welcome <strong>{{ ucwords(Auth::user()->name) }}</strong></p>
          </div>
        
        </div>
      </div>
      <div class="row">
        @if(hasInbound())
        <div class="col-sm-6 col-md-2">
          <div class="thumbnail text-center bg-deltahs">
            <i class="fa fa-car fa-4x font-white"></i>
            <div class="caption text-center">
              <p>
                <a href="{{ route('inbound-dashboard') }}" class="btn btn-sm btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Inbound</a>
              </p>
            </div>
          </div>
        </div>
        @endif
        @if(hasOutbound())
          <div class="col-sm-6 col-md-2">
            <div class="thumbnail text-center bg-deltahs">
              <i class="fa fa-plane fa-4x font-white"></i>
              <div class="caption text-center">
                <p>
                  <a href="{{ route('outbound-dashboard') }}" class="btn btn-sm btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Outbound</a>
                </p>
              </div>
            </div>
          </div>
        @endif
          <div class="col-sm-6 col-md-2">
            <div class="thumbnail text-center bg-deltahs">
              <i class="fa fa-truck fa-4x font-white"></i>
              <div class="caption text-center">
                <p>
                  <a href="#" class="btn btn-sm btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Domestic</a>
                </p>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-2">
            <div class="thumbnail text-center bg-deltahs">
              <i class="fa fa-anchor fa-4x font-white"></i>
              <div class="caption text-center">
                <p>
                  <a href="#" class="btn btn-sm btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> NonFedex</a>
                </p>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-2">
            <div class="thumbnail text-center bg-deltahs">
              <i class="fa fa-motorcycle fa-4x font-white"></i>
              <div class="caption text-center">
                <p>
                <a href="{{ route('dispatch-dashboard') }}" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Dispatch</a>
                </p>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-2">
            <div class="thumbnail text-center bg-deltahs">
              <i class="fa fa-cog fa-4x font-white"></i>
              <div class="caption text-center">
                <p>
                <a href="{{ route('setting-dashboard') }}" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Masters</a>
                </p>
              </div>
            </div>
          </div>
      </div>
</div>
@endsection
@section('css')
    <link rel="stylesheet" href="/css/style.css">
@endsection
