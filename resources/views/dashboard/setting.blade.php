@extends('layouts.app')

@section('content')
<div class="container-fluid">
      <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li class="active">Settings</li>
                </ol>
                <hr>
            </div>
      </div>
      <div class="row">
        @if(canAny(['Create Area Codes', 'View Area Codes', 'Edit Area Codes', 'Delete Area Codes']))
        <div class="col-sm-6 col-md-2">
          <div class="thumbnail text-center bg-deltahs">
            <i class="fa fa-car fa-4x font-white"></i>
            <div class="caption text-center">
              <p>
                <a href="{{ route('area-code.index') }}" class="btn btn-sm btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Area-Codes</a>
              </p>
            </div>
          </div>
        </div>
        @endif
        @if(canAny(['Create CBV', 'View CBV', 'Edit CBV', 'Delete CBV']))
        <div class="col-sm-6 col-md-2">
            <div class="thumbnail text-center bg-deltahs">
              <i class="fa fa-file fa-4x font-white"></i>
              <div class="caption text-center">
                <p>
                  <a href="{{ route('cbv.index') }}" class="btn btn-sm btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> CBVs</a>
                </p>
              </div>
            </div>
          </div>
          @endif
          @if(canAny(['Create Cities', 'View Cities', 'Edit Cities', 'Delete Cities']))
          <div class="col-sm-6 col-md-2">
            <div class="thumbnail text-center bg-deltahs">
              <i class="fa fa-building fa-4x font-white"></i>
              <div class="caption text-center">
                <p>
                  <a href="{{ route('city.index') }}" class="btn btn-sm btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Cities</a>
                </p>
              </div>
            </div>
          </div>
          @endif
          @if(canAny(['Create Couriers', 'View Couriers', 'Edit Couriers', 'Delete Couriers']))
          <div class="col-sm-6 col-md-2">
              <div class="thumbnail text-center bg-deltahs">
                <i class="fa fa-motorcycle fa-4x font-white"></i>
                <div class="caption text-center">
                  <p>
                    <a href="{{ route('courier.index') }}" class="btn btn-sm btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Couriers</a>
                  </p>
                </div>
              </div>
            </div>
            @endif
            @if(canAny(['Create Domestic Locations', 'View Domestic Locations', 'Edit Domestic Locations', 'Delete Domestic Locations']))
            <div class="col-sm-6 col-md-2">
              <div class="thumbnail text-center bg-deltahs">
                <i class="fa fa-map-marker fa-4x font-white"></i>
                <div class="caption text-center">
                  <p>
                    <a href="{{ route('domestic-locations.index') }}" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Domestic Locations</a>
                  </p>
                </div>
              </div>
            </div>
            @endif
            @if(canAny(['Edit Domestic Rates']))
            <div class="col-sm-6 col-md-2">
              <div class="thumbnail text-center bg-deltahs">
                <i class="fa fa-calendar fa-4x font-white"></i>
                <div class="caption text-center">
                  <p>
                    <a href="{{ route('domestic-rates.index') }}" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Domestic Rates</a>
                  </p>
                </div>
              </div>
            </div>
            @endif
            @if(canAny(['Create Routes', 'View Routes', 'Edit Routes', 'Delete Routes']))
            <div class="col-sm-6 col-md-2">
              <div class="thumbnail text-center bg-deltahs">
                <i class="fa fa-map-marker fa-4x font-white"></i>
                <div class="caption text-center">
                  <p>
                    <a href="{{ route('route.index') }}" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Routes</a>
                  </p>
                </div>
              </div>
            </div>
            @endif
            @if(canAny(['Edit Outbound Zones', 'View Outbound Zones']))
            <div class="col-sm-6 col-md-2">
              <div class="thumbnail text-center bg-deltahs">
                <i class="fa fa-map-marker fa-4x font-white"></i>
                <div class="caption text-center">
                  <p>
                    <a href="{{ route('outbound-zones.index') }}" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Outbound Zones</a>
                  </p>
                </div>
              </div>
            </div>
            @endif
            @if(canAny(['Edit Outbound Rate Card', 'View Outbound Rate Card']))
            <div class="col-sm-6 col-md-2">
              <div class="thumbnail text-center bg-deltahs">
                <i class="fa fa-calendar fa-4x font-white"></i>
                <div class="caption text-center">
                  <p>
                    <a href="{{ route('sales-rate-card.index') }}" class="btn btn-danger" style="width:100%" role="button">
                      <i class="fa fa-caret-right"></i> Outbound Sales Rate Card
                    </a>
                  </p>
                </div>
              </div>
            </div>
            @endif
            @if(canAny(['Edit Outbound Rate Card', 'View Outbound Rate Card']))
            <div class="col-sm-6 col-md-2">
              <div class="thumbnail text-center bg-deltahs">
                <i class="fa fa-calendar fa-4x font-white"></i>
                <div class="caption text-center">
                  <p>
                    <a href="{{ route('discount-rate-card.index') }}" class="btn btn-danger" style="width:100%" role="button">
                      <i class="fa fa-caret-right"></i> Discount Sales Rate Card
                    </a>
                  </p>
                </div>
              </div>
            </div>
            @endif
            @if(canAny(['Edit Outbound Rate Card', 'View Outbound Rate Card']))
            <div class="col-sm-6 col-md-2">
              <div class="thumbnail text-center bg-deltahs">
                <i class="fa fa-calendar fa-4x font-white"></i>
                <div class="caption text-center">
                  <p>
                    <a href="{{ route('gdr.index') }}" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> GDR rates</a>
                  </p>
                </div>
              </div>
            </div>
            @endif
            @if(canAny(['Create Users', 'View Users', 'Edit Users', 'Delete Users']))
            <div class="col-sm-6 col-md-2">
              <div class="thumbnail text-center bg-deltahs">
                <i class="fa fa-users fa-4x font-white"></i>
                <div class="caption text-center">
                  <p>
                    <a href="{{ route('user.index') }}" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Users</a>
                  </p>
                </div>
              </div>
            </div>
            @endif
            @can('view-settings')
            <div class="col-sm-6 col-md-2">
              <div class="thumbnail text-center bg-deltahs">
                <i class="fa fa-cog fa-4x font-white"></i>
                <div class="caption text-center">
                  <p>
                    <a href="{{ route('settings.index') }}" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Settings</a>
                  </p>
                </div>
              </div>
            </div>
            @endcan
            @can('view-settings')
            <div class="col-sm-6 col-md-2">
              <div class="thumbnail text-center bg-deltahs">
                <i class="fa fa-dollar fa-4x font-white"></i>
                <div class="caption text-center">
                  <p>
                    <a href="{{ route('other-charges.index') }}" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Other charges</a>
                  </p>
                </div>
              </div>
            </div>
            @endcan
            <div class="col-sm-6 col-md-2">
              <div class="thumbnail text-center bg-deltahs">
                <i class="fa fa-user fa-4x font-white"></i>
                <div class="caption text-center">
                  <p>
                    <a href="{{ route('clients.index') }}" class="btn btn-danger" style="width:100%" role="button"><i class="fa fa-caret-right"></i> Clients</a>
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
