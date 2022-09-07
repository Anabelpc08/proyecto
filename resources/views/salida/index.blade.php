@extends('adminlte::page')

@section('title', 'SIPA')

@section('content_header')
    <h2>Panel De Salidas</h2>
    <hr class="cb-dark border-2">
@stop
@section('content')
    <div class="card cb-light">
        <div class="card-body">
            <div class="container px-4">
                <div class="row">
                    <div class="row">
                        @include('proveedor.messages')
                        <form action="{{ route('salida.store') }}" method="POST" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-3">
                                    <label for="folio_salida" class="form-label">Folio de Salida:</label>
                                    <input type="text" name="folio_salida" maxlength="20" id="folio_salida" class="form-control"   required>
                                </div>
                                <div class="mb-3 col-8">
                                    <label for="id_servicio" class="form-label">Servicio:</label>
                                    <select name="id_servicio" class="form-select" required>
                                        <option selected disabled>&#187; Seleccione un Servicio</option>
                                        @foreach ($servicio as $servicio)
                                            <option value="{{ $servicio->id_servicio }}">{{ $servicio->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-3">
                                    <label for="fecha_ingreso" class="form-label visually-hidden">Fecha de Contrato:</label>
                                    <input type="date" name="fecha" id="fecha" class="form-control visually-hidden" readonly
                                        required>
                                </div>
                                <div class="mb-3 col-3">
                                    <label for="hora" class="form-label visually-hidden">Hora:</label>
                                    <input type="time" name="hora" id="hora" class="form-control visually-hidden" readonly
                                        required>
                                </div>
                                <div class="mb-3 col-2">
                                    <label for="id_usuario" class="form-label visually-hidden">#Usuario:</label>
                                    <input type="text" name="id_usuario" class="form-control visually-hidden"
                                        value="{{ Auth::user()->id_usuario }}" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Observaciones</label>
                                    <textarea type="text" class="form-control" id="observacion" name="observacion"
                                        rows="3" ></textarea>
                                </div>
                                <h3 class="mt-2">Lista de artículos a registrar</h3>
                                <hr class="cb-dark border-2 ">
                                <div class="row">
                                    @livewireStyles()
                                    @livewire('salida')
                                    @livewireScripts()
                                </div>
                            </div>
                            <div class="row mt-5">
                                <table id='salidas' class="table col-12 table-hover mt-4">
                                    <thead class="cb-primary color-light ">
                                        <tr>
                                            <th scope="col" class="visually-hidden">#salida</th>
                                            <th scope="col">ID</th>
                                            <th scope="col">Clave</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Unidad de Medida</th>
                                            <th scope="col">Cantidad</th>
                                            <th scope="col">Precio Unitario Promedio</th>
                                            <th scope="col">SubTotal</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                      <tr>
                                        <th colspan="7" style="text-align:right">Total</th>
                                        <th id="spTotal">$</th>
                                      </tr>
                                    </tfoot>
                                </table>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="submit" class="btn col-2 btn-primary cb-primary mr-2" tabindex="5"><i
                                            class="fas fa-save mr-2"></i> Guardar</button>
                                </div>
                            </div>
                        </form>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.0/css/font-awesome.css"
        integrity="sha512-72McA95q/YhjwmWFMGe8RI3aZIMCTJWPBbV8iQY3jy1z9+bi6+jHnERuNrDPo/WGYEzzNs4WdHNyyEr/yXJ9pA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
@stop

@section('js')
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <!-- SCRIPTS CDN JS PARA DATATABLE -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.bootstrap5.min.js"></script>

    <!--AGREGAR FILAS A LA TABLA-->
    <script type="text/javascript">
        $('#añadir').click(function() {
            integrar();
            deleteRow();
        });

        function integrar() {
            var id_salida = $('#id_salida').val();
            var id_articulo = $('#id_articulo').val();
            var clave = $('#clave').val();
            var nombre = $('#descripcion').val();
            var umc = $('#id_umc').val();
            var cantidad = $('#cantidad').val();
            var precio = $('#precio_unit').val();
            var subtotal = $('#subtotal').val();
            var filas = '<tr>' +
                '<td></td>' +
                '<td><input class="form-control-plaintext" type="text" name="id_articulo[]" value="' + id_articulo +
                '" readonly></td>' +
                '<td><input class="form-control-plaintext" type="text" name="clave" value="' + clave + '" readonly></td>' +
                '<td><input class="form-control-plaintext" type="text" name="nombre" value="' + nombre + '" readonly></td>' +
                '<td><input class="form-control-plaintext" type="text" name="umc" value="' + umc + '" readonly></td>' +
                '<td><input class="form-control-plaintext" type="text" name="cantidad[]" value="' + cantidad + '" readonly></td>' +
                '<td><input class="form-control-plaintext" type="text" name="precio[]" value="' + precio +
                '" readonly></td>' +
                '<td><input class="form-control-plaintext subtotal"  type="text" name="subtotal[]" id="subtotal" value="' + subtotal + '" readonly></td>"' +

                '<td><span class="btn btn-danger m-2 cb-accent" onclick = "deleteRow(this)"><i class="fas fa-trash"></i></span></td>'
            '</tr>';
            $('#salidas').append(filas);
            sumar();
        }

        function sumar_columna() {
            var subtotal = document.getElementById('subtotal');
            var total = document.getElementById('total');
            var suma = 0;
            for (var i = 0; i < subtotal.length; i++) {
                suma = suma + Number(subtotal[i].innerText)
            }

            total.innerText = "$" + parseFloat(suma) + "MXN";
        }


        function sumar() {
            var total = 0;
            $(".subtotal").each(function() {
                if (isNaN(parseFloat($(this).val()))) {
                    total += 0;
                } else {
                    total += parseFloat($(this).val());
                }
            });
            document.getElementById('spTotal').innerHTML = "$ " + total + " MXN";
        }

        function deleteRow(row) {
            var d = row.parentNode.parentNode.rowIndex;
            document.getElementById("salidas").deleteRow(d);
            sumar();
        }
    </script>
    <!--INPUT AUTOMATICO DE HORA-->
    <script type="text/javascript">
        const date = new Date().toISOString();
        const time = date.substr(date.search('T') + 1, 8)
        document.getElementById('hora').value = time

        window.onload = function() {
            var fecha = new Date(); //Fecha actual
            var mes = fecha.getMonth() + 1; //obteniendo mes
            var dia = fecha.getDate(); //obteniendo dia
            var ano = fecha.getFullYear(); //obteniendo año
            if (dia < 10)
                dia = '0' + dia; //agrega cero si el menor de 10
            if (mes < 10)
                mes = '0' + mes //agrega cero si el menor de 10
            document.getElementById('fecha').value = ano + "-" + mes + "-" + dia;
        }
    </script>
    <!--funcion para multiplicar el precio unitario por la cantidad del producto-->
    <script>
        function multi(input) {
            var total = 1;
            var change = false;
            $(".monto").each(function() {
                if (!isNaN(parseFloat($(this).val()))) {
                    change = true;
                    total *= parseFloat($(this).val());
                }
            });
            // Si se modifico el valor , retornamos la multiplicación
            // caso contrario 0
            total = (change) ? total : 0;
            document.getElementById("subtotal").value = total.toFixed(2);
            var num = input.value.replace(/\,/g, '');
            if (!isNaN(num)) {
                input.value = num;
            } else {
                alert('Solo se permiten numeros');
                input.value = input.value.replace(/[^\d\.]*/g, '');
            }
        }
    </script>
@stop
