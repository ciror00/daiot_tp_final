@extends('master')

@section('content')

@include('partials.validation-error')

<form action="{{ route("device.store") }}" method="POST">
    @include('device._form')
</form>

@endsection