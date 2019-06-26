@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
              <li><a href="/">Home</a></li>
              <li><a href="{{ route('dispatch-dashboard') }}">Dispatch dashboard</a></li>
              <li><a href="{{ route('pickups.index') }}">Pickup management</a></li>
              <li class="active">Import pickups</li>
            </ol>
            <hr>
        </div>
      </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="m-b-0 text-white">
                        Import pickups
                         @if($type == \PAX\Models\Pickup::TYPE_tnt) (TNT)
                         @elseif($type == \PAX\Models\Pickup::TYPE_fedex) (FEDEX)
                         @elseif($type == \PAX\Models\Pickup::TYPE_tnt) (Recurrent)
                         @endif
                    </h4>
                </div>
                <form action="{{ route('pickups.imports') }}" class="form-bordered" method="POST"  enctype="multipart/form-data">
                  <div class="panel-body">
                    {{ csrf_field() }}
                   <input type="hidden" name="type" value="{{ $type }}">
                    <div class="row">
                        <div class="form-group col-md-4 col-md-offset-4">
                            <input type="file" name="pickups" id="pickups" class="form-control" required>
                        </div>
                    </div>
                    <hr>
                  </div>
                <div class="panel-footer">
                    <div class="row">
                      <div class="col-12">
                        <div class="pull-right clearfix">
                           <button type="submit" class="btn btn-info btn-sm">
                             <i class="fa fa-save"></i> Import
                            </button>
                           <a href="{{ route('pickups.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-caret-left"></i> Back</a>
                        </div>
                      </div>
                    </div>
                </div>
              </form>
            </div>
        </div>
    </div>
</div>
    
@endsection
@section('css')
    <link rel="stylesheet" href="/dismod/date-picker/css/bootstrap-datepicker.standalone.css">
@endsection
@section('scripts')
    <script src="/dismod/date-picker/js/bootstrap-datepicker.min.js"></script>
    <script>
      $(function() {
        $('#date-picker').datepicker({
            autoclose: true
        });
      });
    </script>
@endsection