@extends('adminlte::page')

@section('title', 'SIPA')

@section('content_header')
    <h2>Consulta De Entradas</h2>
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
                    <!-- La directiva csrf permite proteger el formulario
                                                ante ataques CSRF creando un tokken unico e irrepetible
                                                para mantener la sesion activa del usuario estos atauqe se utilizan para
                                                obtener los datos de un formulario despues de un tiempo
                                                 y dirigirlos a sitios maliciosos, tambien evita el error 419
                                                CODIGO PHP PARA REALIZAR LAS BUSQUEDAS POR FILTROS  -->
                    <form action="{{ route('consulta_entrada.index') }}" method="GET" autocomplete="off">
                        @csrf
                        <div class="row input-group input-group-sm">
                            <div class="mb-3 col-2">
                                <label class="control-label">Folio de Entrada:</label>
                                <input type="text" class="form-control" name="folio_interno" value="{{ $folio_interno }}"
                                    placeholder="Ejemplo: 01234" maxlength="20">
                            </div>
                            <div class="mb-3 col-2">
                                <label class="control-label">Folio de Documento:</label>
                                <input type="text" class="form-control" name="id_contrato" value="{{ $id_contrato }}"
                                    placeholder="Ejemplo: C-241" maxlength="10">
                            </div>
                            <div class="mb-2 col-4">
                                <label for="modo_entrada" class="control-label">Modo de Entrada:</label>
                                <select name="modo_entrada" class="form-select">
                                    <option selected disabled>&#187; Seleccione Modo de Entrada</option>
                                    <option value="COMPLETA">COMPLETA
                                    </option>
                                    <option value="PARCIAL">PARCIAL
                                    </option>
                                </select>
                            </div>
                            <div class="mb-2 col-3">
                                <label for="estado" class="control-label">Status:</label>
                                <select name="estado" class="form-select">
                                    <option selected disabled>&#187; Seleccione Estado</option>
                                    <option value="ABIERTO">ABIERTO
                                    </option>
                                    <option value="CERRADO">CERRADO
                                    </option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row input-group input-group-sm">
                            <div class="mb-3 col-2">
                                <label class="control-label">Fecha Del:</label>
                                <input type="text" name="from" id="datepicker" class="form-control"
                                    placeholder="AÑO-MES-DIA" value="{{ $from }}">
                            </div>
                            <div class="mb-3 col-2">
                                <label class="control-label">Al:</label>
                                <input type="text" name="to" id="fecha" class="form-control" placeholder="AÑO-MES-DIA"
                                    value="{{ $to }}">
                            </div>
                            <div class="mb-3 col-4">
                                <label for="nombre" class="control-label">Proveedor:</label>
                                <select name="nombre" class="form-select" required>
                                    <option selected disabled>&#187; Seleccione una Proveedor</option>
                                    @foreach ($proveedor as $proveedor)
                                        <option value="{{ $proveedor->nombre }}">{{ $proveedor->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-3">
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
                    <table id="consulta_entradas"  class="table table-sm col-12 table-hover table-striped mt-2">
                        <thead class="cb-primary color-light ">
                            <tr>
                                <th scope="col" class="pr-4 py-2">Folio de Entrada</th>
                                <th scope="col" class="pr-4 py-2">Fecha Ingreso</th>
                                <th scope="col" class="pr-4 py-2">Modo de Entrada</th>
                                <th scope="col" class="pr-4 py-2">Tipo de Entrada</th>
                                <th scope="col" class="pr-4 py-2">Status</th>
                                <th scope="col" class="pr-4 py-2">Total</th>
                                <th scope="col" class="pr-4 py-2">Detalle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--?En esta parte Idencitifica si hay resultados, de lo contrario muestra el siguiente texto al usuario-->
                            @if (count($entrada) <= 0)
                                <tr>
                                    <td colspan="7"> No hay Resultados En la Busqueda</td>
                                </tr>
                            @else
                                @foreach ($entrada as $entran)

                                    <tr>
                                        <td>{{ $entran->folio_interno }}</td>
                                        <td>{{ $entran->fecha_ingreso }}</td>
                                        <td>{{ $entran->modo_entrada }}</td>
                                        <td>{{ $entran->nombre }}</td>
                                        <td>{{ $entran->estado }}</td>
                                        <td>$ {{ number_format($entran->total, 2) }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <!-- BOTON DE VISTA  CON METODO SHOW DETALLE  -->
                                                <a href="/panel/consulta_entrada/{{ $entran->id_entrada }}"
                                                    target="_blank" class="btn m-1 btn-primary cb-primary" rel="noopener noreferrer"><i
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
@stop

@section('js')
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
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
    <!-- CDN PARA FORMATO DE FECHA SQL EN INPUT FECHA -->
    <script>
        $(function() {
            $("#datepicker").datepicker();
            $("#datepicker").datepicker("option", "dateFormat", 'yy-mm-dd');
        });
        $(function() {
            $("#fecha").datepicker();
            $("#fecha").datepicker("option", "dateFormat", 'yy-mm-dd');
        });
    </script>

@stop
