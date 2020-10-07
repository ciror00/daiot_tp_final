@extends('master')

@section('content')

<div class="form-group">
    <label for="uuid">Identificador único</label>
    <input readonly class="form-control" type="text" name="uuid" id="uuid" value="{{ $device->uuid }}">
</div>
<div class="form-group">
    <label for="enable">Habilitado para enviar mediciones</label>
    <input readonly class="form-control" type="text" name="enable" id="enable" value="{{ $device->enable }}">
</div>

@endsection