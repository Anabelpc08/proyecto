@extends('adminlte::page')

@section('title', 'SIPA')

@section('content_header')
<!-- Formulario de registro de Existencia-->
<h2>Consulta De Existencias</h2>
<hr class="cb-dark border-1 ">
@stop
<?php
header("Cache-Control: no-cache, must-revalidate");
?>
@section('content')
<div class="card cb-light">
    <div class="card-body">
        <div class="container px-3">
            <div class="row">
                <!-- //!La directiva csrf permite proteger el formulario
            //!ante ataques CSRF creando un tokken unico e irrepetible
            //!para mantener la sesion activa del usuario estos atauqe se utilizan para
            //!obtener los datos de un formulario despues de un tiempo
            //!y dirigirlos a sitios maliciosos, tambien evita el error 419
            //?CODIGO PHP PARA REALIZAR LAS BUSQUEDAS POR FILTROS DE ARTICULOS EXISTENCIALES -->
                <form action="{{route('existencia.index')}}" method="GET">
                    @csrf
                    <div class="row input-group input-group-sm">
                        <div class="mb-1 col-2">
                            <label class="control-label">Clave:</label>
                            <input type="text" class="form-control" name="clave" value="{{$clave}}" placeholder="INF-000"
                            title="Ingrese una clave del articulo (articulos fuera de cuadro se identifican con las tres iniciales del subalmacén al que pertenecen seguido de un número y para claves dentro de cuadro digite la clave SIAM )"
                            onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" autocomplete="off">
                        </div>
                        <div class="mb-2 col-10">
                            <label class="control-label">Descripción:</label>
                            <input type="text" class="form-control" name="descripcion" value="{{$descripcion}}" maxlength="50" autocomplete="off">
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-10">
                                    @livewireStyles
                                    @livewire('anidado')
                                    @livewireScripts
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
            <script>
                $('input').val("");
            </script>
        </div>

        <div class="row mt-5">
            <table id="existe" class="table table-hover table-striped">
                <thead class="cb-primary color-light ">
                    <tr>
                        <th scope="col" class="pr-4 py-2">Clave</th>
                        <th scope="col" class="pr-4 py-2">Descripción</th>
                        <th scope="col" class="pr-4 py-2">Unidad de medida</th>
                        <th scope="col" class="pr-4 py-2">Precio unitario promedio</th>
                        <th scope="col" class="pr-4 py-2">Cantidad</th>
                        <th scope="col" class="pr-4 py-2">Importe</th>
                        <th class="pr-4 py2 visually-hidden">categoria articulo almacen</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- //?En esta parte Idencitifica si hay resultados, de lo contrario muestra el siguiente
                //?texto al usuario-->
                    @if(count($existencia)<=0) <tr>
                        <td colspan="7"> No hay Resultados En la Busqueda</td>
                        </tr>
                        @else
                        @foreach ($existencia as $existencias)

                        <tr>
                            <!-- Se acceden a cada uno de los campos y se plasman en filas de la tabal -->
                            <td>{{$existencias->clave}}</td>
                            <td>{{$existencias->descripcion}}</td>
                            <td>{{$existencias->nombre}}</td>
                            <td>$ {{number_format($existencias->precio_unit,2)}}</td>
                            <td>{{$existencias->cantidad}}</td>
                            <td>$ {{number_format($existencias->importe,2)}}</td>
                            <td class="visually-hidden">{{$existencias->id_subcat_art_alm}}</td>
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

@stop

@section('css')
<!-- Se llama archivo css de Datatables y se v a aplicar solamente en el index de los proveedores -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.bootstrap5.min.css" />
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- Styles -->
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
@stop

@section('js')
<script src="{{ mix('js/app.js') }}"></script>

<!-- SCRIPTS CDN JS PARA DATATABLE -->
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
<script src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.1.5/js/buttons.html5.styles.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.1.5/js/buttons.html5.styles.templates.min.js"></script>


@stop
