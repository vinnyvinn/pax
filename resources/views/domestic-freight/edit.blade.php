@extends('layouts.app')

@section('content')
    <domestic-freight :id="{{ $id }}" :canf="{{ Auth::user()->can('finalize-domestic-freight-invoice') }} == 1"></domestic-freight>
@endsection