@extends('layouts.app')

@section('content')
    @if(isset($id))
        <non-tabulations :id="{{ $id }}"></non-tabulations>
    @else
        <non-tabulations></non-tabulations>
    @endif
@endsection