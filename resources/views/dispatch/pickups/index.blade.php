@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li><a href="{{ route('dispatch-dashboard') }}">Dispatch dashboard</a></li>
                  <li class="active">Pickup Management</li>
                </ol>
                <hr>
            </div>
          </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Pickup Management
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 clearfix">
                            <a href="{{ route('pickups.create')}}" class="btn btn-primary pull-right">Add pickup</a>
                            </div>
                        </div>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            @can('view-pickups')
                              <li role="presentation" class="active"><a href="#all" aria-controls="all" role="tab" data-toggle="tab">All</a></li>
                            @endcan
                            @can('view-tnt-pickups')
                              <li role="presentation"><a href="#tnt" aria-controls="tnt" role="tab" data-toggle="tab">TNT</a></li>
                            @endcan
                            @can('view-fedex-pickups')
                              <li role="presentation"><a href="#fedex" aria-controls="fedex" role="tab" data-toggle="tab">FEDEX</a></li>
                            @endcan
                            @can('view-recurrent-pickups')
                              <li role="presentation"><a href="#recurrent" aria-controls="recurrent" role="tab" data-toggle="tab">Recurrent</a></li>
                            @endcan
                            @can('view-not-assigned-pickups')
                              <li role="presentation"><a href="#posted" aria-controls="posted" role="tab" data-toggle="tab">Not Assigned</a></li>
                            @endcan
                            @can('view-assigned-pickups')
                              <li role="presentation"><a href="#assigned" aria-controls="assigned" role="tab" data-toggle="tab">Assigned</a></li>
                            @endcan
                            @can('view-delayed-pickups')
                              <li role="presentation"><a href="#over_60_mins" aria-controls="over_60_mins" role="tab" data-toggle="tab">Over 60 Mins</a></li>
                              <li role="presentation"><a href="#missed" aria-controls="missed" role="tab" data-toggle="tab">Missed</a></li> 
                            @endcan
                            @can('view-done-pickups')
                              <li role="presentation"><a href="#done" aria-controls="done" role="tab" data-toggle="tab">Done</a></li>
                            @endcan
                            @can('view-cancelled-pickups')
                              <li role="presentation"><a href="#cancelled" aria-controls="cancelled" role="tab" data-toggle="tab">Cancelled</a></li> 
                            @endcan
                            @can('view-cancelled-pickups')
                              <li role="presentation"><a href="#rescheduled" aria-controls="rescheduled" role="tab" data-toggle="tab">Rescheduled</a></li> 
                            @endcan
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            @can('view-pickups')
                              <div role="tabpanel" class="tab-pane active" id="all">
                              <form action="{{ route('pickups.report') }}" method="post">
                                  <div class="row">
                                      {{ csrf_field() }}
                                    <div class="form-group col-md-3">
                                      <label for="date_from" class="control-label">Date from:</label>
                                      <input type="date" name="date_from" id="date_from" class="form-control">
                                    </div>
                                    <div class="form-group col-md-3">
                                      <label for="date_to" class="control-label">Date to:</label>
                                      <input type="date" name="date_to" id="date_to" class="form-control">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="type" class="control-label">Type:</label>
                                        <select name="type" id="type" class="form-control">
                                          <option value="">Select pickup type</option>
                                          <option value="{{ \PAX\Models\Pickup::TYPE_tnt }}">TNT</option>
                                          <option value="{{ \PAX\Models\Pickup::TYPE_fedex }}">FEDEX</option>
                                          <option value="{{ \PAX\Models\Pickup::TYPE_recurrent }}">Recurrent</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                      <label for="status" class="control-label">Status:</label>
                                      <div class="input-group">
                                        <select name="status" id="status" class="form-control">
                                          <option value="">Select pickup status</option>
                                          <option value="{{ \PAX\Models\Pickup::STATUS_pending }}">Not assigned</option>
                                          <option value="{{ \PAX\Models\Pickup::STATUS_assigned }}">Assigned</option>
                                          <option value="{{ \PAX\Models\Pickup::STATUS_done }}">Done</option>
                                          <option value="{{ \PAX\Models\Pickup::STATUS_rescheduled }}">Rescheduled</option>
                                          <option value="{{ \PAX\Models\Pickup::STATUS_cancelled }}">Cancelled</option>
                                        </select>
                                        <span class="input-group-btn">
                                          <button class="btn btn-primary" type="submit"><i class="fa fa-download"></i></button>
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                                </form>
                                <br>
                                @component('dispatch.pickups.partials.table', ['data' => $pickupsAll, 'table' => 'all'])
                                @endcomponent
                              </div>  
                            @endcan
                            @can('view-tnt-pickups')
                            <div role="tabpanel" class="tab-pane" id="tnt">
                                <br>
                                @component('dispatch.pickups.partials.table', ['data' => $pickupTNT, 'table' => 'tnt'])
                                @endcomponent
                            </div>
                            @endcan
                            @can('view-fedex-pickups')
                            <div role="tabpanel" class="tab-pane" id="fedex">
                                <br>
                                @component('dispatch.pickups.partials.table', ['data' => $pickupFEDEX, 'table' => 'fedex'])
                                @endcomponent
                            </div>
                            @endcan
                            @can('view-recurrent-pickups')
                            <div role="tabpanel" class="tab-pane" id="recurrent">
                                <br>
                                @component('dispatch.pickups.partials.table', ['data' => $pickupsRecurrent, 'table' => 'recurrent'])
                                @endcomponent
                            </div>
                            @endcan
                            @can('view-not-assigned-pickups')
                            <div role="tabpanel" class="tab-pane" id="posted">
                                <br>
                                @component('dispatch.pickups.partials.table', ['data' => $pickupsPosted, 'table' => 'posted'])
                                @endcomponent
                            </div>
                            @endcan
                            @can('view-assigned-pickups')
                            <div role="tabpanel" class="tab-pane" id="assigned">
                                <br>
                                @component('dispatch.pickups.partials.table', ['data' => $pickupsAssigned, 'table' => 'assigned'])
                                @endcomponent
                            </div>
                            @endcan
                            @can('view-delayed-pickups')
                            <div role="tabpanel" class="tab-pane" id="over_60_mins">
                                <br>
                                @component('dispatch.pickups.partials.table', ['data' => $pickupOver60, 'table' => 'over60'])
                                @endcomponent
                            </div>
                            <div role="tabpanel" class="tab-pane" id="missed">
                                <br>
                                @component('dispatch.pickups.partials.table', ['data' => $pickupMissed, 'table' => 'missed'])
                                @endcomponent
                            </div>
                            @endcan
                            @can('view-done-pickups')
                            <div role="tabpanel" class="tab-pane" id="done">
                                <br>
                                @component('dispatch.pickups.partials.table', ['data' => $pickupDone, 'table' => 'done'])
                                @endcomponent
                            </div>
                            @endcan
                            @can('view-cancelled-pickups')
                            <div role="tabpanel" class="tab-pane" id="cancelled">
                                <br>
                                @component('dispatch.pickups.partials.table', ['data' => $pickupCancelled, 'table' => 'cancelled'])
                                @endcomponent
                            </div>
                            @endcan
                            @can('view-cancelled-pickups')
                            <div role="tabpanel" class="tab-pane" id="rescheduled">
                                <br>
                                @component('dispatch.pickups.partials.table', ['data' => $pickupRescheduled, 'table' => 'rescheduled'])
                                @endcomponent
                            </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
<style>
  .table>tr>td {
    font-size: 10px;
  }
</style>
@endsection