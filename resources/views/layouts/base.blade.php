<!--

Bienvenido <3

Este proyecto es libre: https://github.com/protecms
Creado por Jaime Sares <http://jaimesares.com>

    /\„,„/\          //^ ^\\
   ( =';'=)        (/(_•_)\)
   /*♥♥*\         _/''*''\_
  (.|.|.|.|.)…   (,,,)^(,,,)

-->
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('layouts.partials.meta')

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <link rel="stylesheet" href="{{ mix('build/app.css') }}">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-87608426-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-87608426-2');
    </script>

</head>
<body>

    @include('layouts.header')

    @yield('content')

    @include('layouts.footer')

    <script src="{{ mix('build/app.js') }}"></script>

    @if (session()->has('flash'))
        <script>
            swal("{{ session()->get('flash.title') }}", "{{ session()->get('flash.text') }}", "{{ session()->get('flash.type') }}");
        </script>
    @endif
</body>
</html>