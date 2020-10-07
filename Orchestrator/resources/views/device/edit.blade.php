@extends('master')

@section('content')

@include('partials.validation-error')

<form action="{{ route("device.update", $device->id) }}" method="POST">
    @method('PUT')
    @include('device._form')
</form>

@endsection