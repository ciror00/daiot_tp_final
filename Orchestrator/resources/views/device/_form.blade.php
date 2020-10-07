@csrf

<div class="form-group">
    <label for="uuid">UUID</label>
    <input class="form-control" type="text" name="uuid" id="uuid" value="{{ old('uuid',$device->uuid) }}">

    @error('uuid')
    <small class="text-danger">{{ $message }}</small>
    @enderror

</div>

<div class="form-group">
    <label for="posted">Habilitado</label>
    <select class="form-control" name="posted" id="posted">
      @include('partials.option-yes-not',['val' => $device->enable])
    </select>
</div>

<input type="submit" value="Enviar" class="btn btn-primary">