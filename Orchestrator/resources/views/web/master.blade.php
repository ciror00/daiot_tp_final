<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Ciro Edgardo Romero">
    <link rel="stylesheet" href="{{ asset("css/app.css") }}">
    <title>CEIOT - DAIoT</title>
</head>

<body>
    @include('web.partials.nav-header')
    <div class="container" id="app">
        @yield('content')
    </div>
    <script src="{{ asset("js/app.js") }}"></script>
    @include('web.partials.footer')
</body>

</html>