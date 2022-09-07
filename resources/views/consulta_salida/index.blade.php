@extends('adminlte::page')

@section('title', 'SIPA')

@section('content_header')
    <h2>Consulta De Salidas</h2>
    <hr class="cb-dark border-2 ">
@stop
<?php
header('Cache-Control: no-cache, must-revalidate');
?>
@section('content')
    <div class="card cb-light">
        <div class="card-body">
            <div class="container px-3">
                <div class="row">
                    <!--CODIGO PHP PARA REALIZAR LAS BUSQUEDAS POR FILTROS  -->
                    <form action="{{ route('consulta_salida.index') }}" method="GET" autocomplete="off">
                        @csrf
                        <div class="row input-group input-group-sm">
                            <div class="mb-3 col-3">
                                <label class="control-label">Folio de Salida:</label>
                                <input type="text" class="form-control" name="folio_salida" value="{{ $salida }}"
                                    placeholder="INF-000" maxlength="20">
                            </div>
                            <div class="mb-3 col-3">
                                <label class="control-label">Del:</label>
                                <input type="date" class="form-control" name="from">
                            </div>
                            <div class="mb-3 col-3">
                                <label class="control-label">Al:</label>
                                <input type="date" class="form-control" name="to">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-2 col-7">
                                <label for="nombre" class="form-label">Servicio:</label>
                                <select name="nombre" class="form-select" required>
                                    <option selected disabled>&#187; Seleccione un Servicio</option>
                                    @foreach ($servicios as $servicio)
                                        <option value="{{ $servicio->nombre }}">{{ $servicio->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2 col-3">
                                <button type="submit" class="btn btn-success m-4 cb-success"><i class="fas fa-search"
                                    title="Buscar"></i><span class="ml-3 mr-2 fw-bold">Buscar</span></button>
                            </div>
                        </div>
                    </form>
                </div>
                <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
                <script>
                    $('input').val("");
                </script>
                <div class="row mt-5">
                    <table id="consulta_salidas"  class="table table-sm col-12 table-hover table-striped mt-2">
                        <thead class="cb-primary color-light ">
                            <tr>
                                <th scope="col" class="pr-4 py-2">Folio</th>
                                <th scope="col" class="pr-4 py-2">Fecha</th>
                                <th scope="col" class="pr-4 py-2">Hora</th>
                                <th scope="col" class="pr-4 py-2">Servicio</th>
                                <th scope="col" class="pr-4 py-2">Total</th>
                                <th scope="col" class="pr-4 py-2">Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--?En esta parte Idencitifica si hay resultados, de lo contrario muestra el siguiente texto al usuario-->
                            @if (count($salida) <= 0)
                                <tr>
                                    <td colspan="7"> No hay Resultados En la Busqueda</td>
                                </tr>
                            @else
                                @foreach ($salida as $salidas)
                                    <tr>
                                        <td>{{ $salidas->folio_salida }}</td>
                                        <td>{{ $salidas->fecha }}</td>
                                        <td>{{ $salidas->hora}}</td>
                                        <td>{{ $salidas->nombre }}</td>
                                        <td>$ {{ number_format($salidas->total, 2) }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <!-- BOTON DE VISTA  CON METODO SHOW DETALLE  -->
                                                <a href="/panel/consulta_salida/{{ $salidas->id_salida }}" target="_blank"
                                                    rel="noopener noreferrer" class="btn m-1 btn-primary cb-primary"><i
                                                        class="fas fa-tasks"></i></a>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td style="text-align:right">Total:</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <!-- Se llama archivo css de Datatables y se v a aplicar solamente en el index de los proveedores -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.bootstrap5.min.css" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
@stop

@section('js')
    <script src="{{ mix('js/app.js') }}"></script>

    <!-- SCRIPTS CDN JS PARA DATATABLE -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

    <!-- CDNS para cargar plugin de estilos para excel -->
    <script src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.1.5/js/buttons.html5.styles.min.js">
    </script>
    <script
        src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.1.5/js/buttons.html5.styles.templates.min.js">
    </script>
@stop
