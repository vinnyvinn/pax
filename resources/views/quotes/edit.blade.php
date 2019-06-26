@extends('layouts.app')

@section('content')
    <inbound-quote :id="{{ $id }}" :canf="{{ Auth::user()->can('finalize-inbound-freight-invoice') }} == 1"></inbound-quote>
@endsection