<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>SIPA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#128034;</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="bg-light font-sans antialiased ">
        {{ $slot }}
    </body>
    <footer style="
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 0px;" class="align-bottom  text-center text-lg-start bg-light text-muted">

        <div class="align-bottom text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
         <!--   <span style="color: #cacaca" > 2021 Desarrollado por Karla Elvira Enriquez Francisco // Hugo Enrique Jaramillo Castro // Erick Estrada Senado</span>-->
          </div>
    </footer>
</html>
