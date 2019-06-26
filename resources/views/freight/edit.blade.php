@extends('layouts.app')

@section('content')
    <freight :id="{{ $id }}" :canf="{{ Auth::user()->can('finalize-inbound-freight-invoice') }} == 1"{!! isset($route) ? "route='$route'" : '' !!}></freight>
@endsection