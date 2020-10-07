<form action="{{route('device.store')}}" method="POST">
    <!-- token para evitar phishing del tipo cross-site request forgery-->
    @csrf 
    <input type="text">
    <input type="submit" value="Boton">
</form>