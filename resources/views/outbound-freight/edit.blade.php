@extends('layouts.app')

@section('content')
    <outbound-freight :id="{{ $id }}" :canf="{{ Auth::user()->can('finalize-outbound-freight-invoice') }} == 1"{!! isset($route) ? "route='$route'" : '' !!}></outbound-freight>
@endsection