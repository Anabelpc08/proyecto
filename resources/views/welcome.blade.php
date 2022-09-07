<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SIPA</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito';
            background: #f7fafc;
        }
    </style>
</head>
<body>


    <div class="container-fluid my-5 pt-5 px-5">
        <div class="row justify-content-center px-4">
            <div class="col-md-12 col-lg-9">
                <h1 style="color: #00556e; font-family: Verdana, Geneva, Tahoma, sans-serif">MENU PRINCIPAL</h1>

                <div class="card shadow-sm">
                    <div class="row">
                        <div class="col-md-6 pr-0">
                            <div class="card-body border-right border-bottom p-3 h-100">
                                <div class="d-flex flex-row bd-highlight pt-2">
                                    <div>
                                        <svg fill="none" stroke="currentColor" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="warehouse" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 640 512" class="svg-inline--fa fa-warehouse fa-w-20 text-muted" role="img" xmlns="http://www.w3.org/2000/svg" width="32"><path fill="currentColor" d="M504 352H136.4c-4.4 0-8 3.6-8 8l-.1 48c0 4.4 3.6 8 8 8H504c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8zm0 96H136.1c-4.4 0-8 3.6-8 8l-.1 48c0 4.4 3.6 8 8 8h368c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8zm0-192H136.6c-4.4 0-8 3.6-8 8l-.1 48c0 4.4 3.6 8 8 8H504c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8zm106.5-139L338.4 3.7a48.15 48.15 0 0 0-36.9 0L29.5 117C11.7 124.5 0 141.9 0 161.3V504c0 4.4 3.6 8 8 8h80c4.4 0 8-3.6 8-8V256c0-17.6 14.6-32 32.6-32h382.8c18 0 32.6 14.4 32.6 32v248c0 4.4 3.6 8 8 8h80c4.4 0 8-3.6 8-8V161.3c0-19.4-11.7-36.8-29.5-44.3z"></path></svg>
                                    </div>
                                    <div class="pl-3">
                                        <div class="mb-2">
                                            <a href="{{ route('login') }}" class="h5 font-weight-bolder text-dark">Almacén General</a>
                                        </div>
                                        <p class="text-muted small">
                                            Módulo para el almacén general y sus respectivas operaciones como son: alta, modificación o baja de proveedores, servicios, categoría de artículos, artículos, usuarios; permite registro de entradas, salidas, consultas y generación de reportes en formatos xmlns (Excel) y PDF.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 pl-0">
                            <div class="card-body border-bottom p-3 h-100">
                                <div class="d-flex flex-row bd-highlight pt-2">
                                    <div>
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="text-muted" width="32"><path d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </div>
                                    <div class="pl-3">
                                        <div class="mb-2">
                                            <a href="" class="h5 font-weight-bolder text-dark">-</a>
                                        </div>
                                        <p class="text-muted small">
                                            -
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 pr-0">
                            <div class="card-body border-right p-3 h-100">
                                <div class="d-flex flex-row bd-highlight pt-2">
                                    <div>
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="text-muted" width="32"><path d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                                    </div>
                                    <div class="pl-3 text-sm">
                                        <div class="mb-2">
                                            <a href="" class="h5 font-weight-bolder text-dark">-</a>
                                        </div>
                                        <p class="text-muted small">
                                            -
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 pl-0">
                            <div class="card-body p-3 h-100">
                                <div class="d-flex flex-row bd-highlight pt-2">
                                    <div>
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="text-muted" width="32"><path d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <div class="pl-3">
                                        <div class="mb-2">
                                            <span class="h5 font-weight-bolder text-dark">-</span>
                                        </div>
                                        <p class="text-muted small">
                                            -
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
