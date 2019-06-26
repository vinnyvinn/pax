@extends('layouts.app')
@section('content')
    <div class="col-sm-10 col-sm-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                Create new Waybill
            </div>
            <div class="panel-body">
                <form action="{{ route('domestic.store') }}" method="post">
                    {{ csrf_field() }}
                    <domestic-waybill-create></domestic-waybill-create>
                </form>
            </div>
        </div>
    </div>
@endsection