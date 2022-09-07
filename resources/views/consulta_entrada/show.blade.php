@extends('adminlte::page')

@section('title', 'SIPA')

@section('content_header')
    <h2>Detalle de Entradas</h2>
    <hr class="cb-dark border-2 ">
@stop

@section('content')
    <div class="card cb-light">
        <div class="card-body">
            <div class="container px-3">
                <div class="row">
                    <div class="row mt-5">
                        <table id="detalle" class="table table-sm col-12 table-hover table-striped mt-2">
                            <thead class="cb-primary color-light">
                                <tr>
                                    <th scope="col" class="pr-2 py-1">
                                        Folio de Entrada:
                                    </th>
                                    <td colspan="2">{{ $entrada_detalle->folio_interno }}</td>
                                    <th scope="col" class="pr-2 py-1">
                                        Fecha de Ingreso:
                                    </th>
                                    <td colspan="4">{{ $entrada_detalle->fecha_ingreso }}</td>
                                </tr>
                                <tr>
                                    <th scope="col" class="pr-3 py-1">Tipo de Entrada</th>
                                    <td colspan="2">{{ $entrada_detalle->tipo->nombre }}</td>
                                    <th scope="col" class="pr-3 py-1">
                                        Modo de Entrada:
                                    </th>
                                    <td colspan="2">{{ $entrada_detalle->modo_entrada }}</td>
                                    <th class="pr-3 py-1">
                                        Status:
                                    </th>
                                    <td colspan="2">{{ $entrada_detalle->estado }}</td>
                                </tr>
                                <tr>
                                    <th scope="col" class="pr-2 py-3">
                                        Registro:
                                    </th>
                                    <td colspan="7"> {{ $entrada_detalle->user->nombre }}
                                        {{ $entrada_detalle->user->apellidoPat }}
                                        {{ $entrada_detalle->user->apellidoMat }}</td>
                                </tr>
                                <tr>
                                    <th scope="col" class="pr-2 py-3">
                                        Proveedor:
                                    </th>
                                    <td colspan="7">{{ $entrada_detalle->proveedor->nombre }}</td>
                                </tr>
                                <tr>
                                    <th scope="col" class="pr-4 py-2">
                                        Clave
                                    </th>
                                    <th scope="col" class="pr-4 py-2">
                                        Descripcion
                                    </th>
                                    <th scope="col" class="pr-4 py-2">
                                        Unidad de Medida
                                    </th>
                                    <th scope="col" class="pr-4 py-2">
                                        IVA
                                    </th>
                                    <th scope="col" class="pr-4 py-2">
                                        Precio_IVA
                                    </th>
                                    <th scope="col" class="pr-4 py-2">
                                        Cantidad
                                    </th>
                                    <th scope="col" class="pr-4 py-2">
                                        Precio Unitario Promedio
                                    </th>
                                    <th scope="col" class="pr-4 py-2">
                                        Subtotal
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($item_entrada as $items)

                                        <td>{{ $items->articulo->clave }}</td>
                                        <td>{{ $items->articulo->descripcion }}</td>
                                        <td>{{ $items->articulo->umc->nombre }}</td>
                                        <td>$ {{ number_format($items->IVA, 2, '.', '') }}</td>
                                        <td>$ {{ number_format($items->precio_iva, 2, '.', '') }}</td>
                                        <td>{{ $items->cantidad }}</td>
                                        <td>$ {{ number_format($items->precio_unit, 2) }}</td>
                                        <td>$ {{ number_format($items->subtotal, 2) }}</td>
                                </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
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
    <style>
        #detalle th {
            padding-top: 15px;
            padding-bottom: 15px;
            text-align: left;
            background-color: #00556e;
            color: white;
        }

        #detalle td {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: left;
            background-color: white;
            color: black;
        }

    </style>
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
@stop
