@extends('layouts.app')
@section('content')
    <div class="col-sm-10 col-sm-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                Edit the Waybill
            </div>
            <div class="panel-body">
                <form action="{{ route('domestic.update', $domestic->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                <domestic-waybill-create :id="{{ $id }}"></domestic-waybill-create>
                </form>
            </div>
        </div>
    </div>
@endsection