@extends('layouts.app')

@section('content')
    <outbound-quote :id="{{ $id }}" :canf="{{ Auth::user()->can('finalize-outbound-freight-invoice') }} == 1"></outbound-quote>
@endsection