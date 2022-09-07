@extends('adminlte::page')

@section('title', 'SIPA')

@section('content_header')
    <!-- Formulario de registro de entrada -->
    <h2>Panel De Entradas</h2>
    <hr class="cb-dark border-2">
@stop
@section('content')
    <div class="card cb-light">
        <div class="card-body">
            <div class="container px-4">
                <div class="row">
                    <!--panel de entrada mandar datos a la tabla entrada-->
                    <div class="row">
                        <!-- Mensaje de validacion de registro exitoso -->
                        @include('proveedor.messages')
                        <form action="{{ route('entrada.store') }}" method="POST" autocomplete="off">
                            @csrf
                            <!--PRIMER POST PARA LA TABLA ENTRADA_ALM-->
                            <div class="row">
                                <div class="mb-2 col-2">
                                    <label for="folio_interno" class="form-label">Folio entrada:</label>
                                    <input type="text" name="folio_interno" maxlength="20" class="form-control" required>
                                </div>
                                <div class="mb-1 col-3 form-check">
                                    <label class="form-label">Modo de Entrada:</label>
                                    <div class="mt-2">
                                        <input type="radio" onclick="opcion();" name="modo_entrada" id="inlineRadio1"
                                            value="COMPLETA" required>
                                        <label class="radio-inline" for="inlineRadio1">Completa</label>
                                        <input type="radio" onclick="opcion();" class="ml-3" name="modo_entrada" id="inlineRadio2"
                                            value="PARCIAL" required>
                                        <label class="radio-inline" for="inlineRadio2">Parcial</label>
                                    </div>
                                </div>
                                <div class="mb-2 col-3">
                                    <label class="form-label">Estado:</label>
                                    <div class="mt-2">
                                        <input type="radio" name="estado" id="Radio1" value="abierto" required>
                                        <label class="radio-inline" for="Radio1" class="mr-2">Abierto</label>
                                        <input type="radio" name="estado" class="ml-3"  id="Radio2" value="cerrado" required>
                                        <label class="radio-inline" for="Radio2">Cerrado</label>
                                    </div>
                                </div>
                                <div class="mb-3 col-2">
                                    <label for="fecha_ingreso" class="form-label">Fecha de ingreso:</label>
                                    <input type="date" name="fecha_ingreso" class="form-control" required>
                                </div>
                                <div class="mb-3 col-2">
                                    <label for="hora" class="form-label">Hora:</label>
                                    <input type="time" name="hora" id="hora" class="form-control" readonly required>
                                </div>
                                <div class="mb-2 col-6">
                                    <label for="id_proveedor" class="form-label">Proveedor:</label>
                                    <select name="id_proveedor" class="form-select" required>
                                        <option selected disabled>&#187; Seleccione una Proveedor</option>
                                        @foreach ($proveedor as $proveedor)
                                            <option value="{{ $proveedor->id_proveedor }}">{{ $proveedor->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-2 col-3">
                                    <label for="id_contrato" class="form-label">Folio de documento:</label>
                                    <input type="text" name="id_contrato" maxlength="20" class="form-control" required>
                                </div>
                                <div class="mb-1 col-3">
                                    <label for="id_te" class="form-label">Tipo Entrada:</label>
                                    <select name="id_te" class="form-select" required>
                                        <option selected disabled>&#187; Seleccione Tipo Entrada</option>
                                        @foreach ($tipo as $tipo)
                                            <option value="{{ $tipo->id_te }}">{{ $tipo->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-1 col-1">
                                    <label for="id_usuario" class="form-label visually-hidden">#Usuario:</label>
                                    <input type="text" name="id_usuario" class="form-control visually-hidden"
                                        value="{{ Auth::user()->id_usuario }}" readonly required>
                                </div>
                            </div>
                            <br>

                            <h3 class="mt-2">Lista de artículos a registrar</h3>
                            <hr class="cb-dark border-2">
                            @livewireStyles
                            @livewire('buscar')
                            @livewireScripts
                            <div class="row">
                                <div class="mb-1 col-1">
                                    <label class="form-label">Cantidad:</label>
                                    <input type="text" class="form-control monto" name="cantidad" id="cantidad"
                                        onkeydown="multi(this);" required>
                                </div>
                                <div class="mb-2 col-2">
                                    <label class="form-label">Fecha de caducidad:</label>
                                    <input type="date" class="form-control" name="fecha_cad" id="fecha_cad" placeholder="AÑO-MES-DIA">
                                </div>
                                <div class="mb-2 col-2">
                                    <label class="form-label">Precio Unitario:</label>
                                    <input type="number" class="form-control monto" name="precio_unit" id="precio_unit"
                                        onkeydown="multi(this);" step="0.01" required >
                                </div>
                                <div class="mb-2 col-2">
                                    <label class="form-label">IVA:</label>
                                    <input type="number" class="form-control monto" name="iva" id="iva" onkeydown="sum(this);"
                                        value="0" readonly required >
                                </div>
                                <div class="mb-2 col-2">
                                    <label class="form-label">Precio + IVA:</label>
                                    <input type="number" class="form-control monto" name="precioiva" id="precioiva" required
                                        readonly >
                                </div>
                                <div class="mb-2 col-2">
                                    <label class="form-label">Subtotal:</label>
                                    <input type="number" class="form-control" name="subtotal" id="subtotal" readonly>
                                </div>
                                <div class="mb-2 col-2">
                                    <label class="form-label">Aplica IVA:</label>
                                    <br>
                                    <input type="radio" name="iva" id="radio1" onchange="aplicar();">
                                    <label class="radio-inline mr-3" for="radio1">SI</label>
                                    <input type="radio" name="iva" id="radio2" onchange="aplicar();">
                                    <label class="radio-inline" for="radio2">NO</label>
                                </div>

                                <div class="mb-2 mt-4 col-3">
                                    <a href="javascript:;" id="agregar" style="background: #00A2D2 " rel="noopener noreferrer" class="btn col-10 btn-outline-light mr-2">
                                    <i class="fas fa-plus mr-2"></i>
                                    Añadir a la lista
                                    </a>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <table id='entradas' class="table col-12 table-hover mt-4">
                                    <thead class="cb-primary color-light ">
                                        <tr>
                                            <th scope="col" class="visually-hidden">#entrada</th>
                                            <th scope="col">ID</th>
                                            <th scope="col">Clave</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Unidad de Medida</th>
                                            <th scope="col">Cantidad</th>
                                            <th scope="col">Fecha de caducidad</th>
                                            <th scope="col">Precio Unitario</th>
                                            <th scope="col">IVA</th>
                                            <th scope="col">Precio + IVA</th>
                                            <th scope="col">Sub Total</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="9" style="text-align:right">Total</th>
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
    <!-- Se llama archivo css de Datatables y se v a aplicar solamente en el index de los -->
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

  <!--RADIOBUTTONS DE AUTOMATICOS-->
  <script>
    function opcion() {
        if (document.getElementById("inlineRadio1").checked == true) {
            document.getElementById("Radio2").checked = true;
        } else {
            if (document.getElementById("inlineRadio2").checked == true) document.getElementById("Radio1").checked =
                true;
        }
    }
</script>
<!--INPUT AUTOMATICO DE HORA-->
<script type="text/javascript">
    const date = new Date();
    const time =date.toLocaleTimeString();
    document.getElementById('hora').value = time;
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
        // Si se modifico el valor , retornamos la multiplicaciÃ³n
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
        totales();
    }
</script>
<!--APLICAR IVA AL RADIO BUTTON-->
<script type="text/javascript">
    function aplicar() {
        var radio1 = document.getElementById("radio1");
        var radio2 = document.getElementById("radio2");
        var impuesto = parseFloat(0.16);
        var nuevo = document.getElementById('precio_unit').value;
        var no = parseFloat(0.0);
        var precio = document.getElementById('iva').value;
        var cambio = document.getElementById('iva');
        if (radio1.checked === true) {
            cambio.value = parseFloat(impuesto)*parseFloat(nuevo);
        } else {
            if (radio2.checked === true) {
                cambio.value = parseFloat(no);
            }
        }
    }

    function sum() {
        var suma = 0;
        var precio = document.getElementById('precio_unit').value;
        var iva = document.getElementById('iva').value;
        suma = parseFloat(precio) + parseFloat(iva);
        document.getElementById("precioiva").value = suma.toFixed(2);
    }

    function totales() {
        var sub = 0;
        var cantidad = document.getElementById('cantidad').value;
        var importe = document.getElementById('precioiva').value;
        sub = cantidad * parseFloat(importe);
        document.getElementById('subtotal').value = sub.toFixed(2);
    }
</script>
<!--AGREGAR FILAS A LA TABLA-->
<script type="text/javascript">
    $('#agregar').click(function() {
        agregar();
        deleteRow();
    });

    function agregar() {
        var id_entrada = $('#id_entrada').val();
        var id_articulo = $('#id_articulo').val();
        var clave = $('#clave').val();
        var nombre = $('#descripcion').val();
        var umc = $('#id_umc').val();
        var cantidad = $('#cantidad').val();
        var fecha_cad = $('#fecha_cad').val();
        var precio = $('#precio_unit').val();
        var iva = $('#iva').val();
        var precioiva = $('#precioiva').val();
        var subtotal = $('#subtotal').val();
        var fila = '<tr>' +
            '<td></td>' +
            '<td><input class="form-control-plaintext" type="text" name="id_articulo[]" value="' + id_articulo +
            '" readonly></td>' +
            '<td><input class="form-control-plaintext" type="text" name="clave" value="' + clave + '" readonly></td>' +
            '<td><input class="form-control-plaintext" type="text" name="nombre" value="' + nombre +
            '" readonly></td>' +
            '<td><input class="form-control-plaintext" type="text" name="umc" value="' + umc + '" readonly></td>' +
            '<td><input class="form-control-plaintext" type="text" name="cantidad[]" value="' + cantidad +
            '" readonly></td>' +
            '<td><input class="form-control-plaintext" type="text" name="fecha_cad[]" value="' + fecha_cad +
            '" readonly></td>' +
            '<td><input class="form-control-plaintext" type="text" name="precio[]" value="' + precio +
            '" readonly></td>"' +
            '<td><input class="form-control-plaintext" type="text" name="iva[]" value="' + iva + '" readonly></td>"' +
            '<td><input class="form-control-plaintext" type="text" name="precioiva[]" value="' + precioiva +
            '" readonly></td>"' +
            '<td><input class="form-control-plaintext subtotal" type="text" name="subtotal[]"  value="' + subtotal +
            '" readonly></td>"' +
            '<td><span class="btn btn-danger m-2 cb-accent" onclick = "deleteRow(this)"><i class="fas fa-trash"></i></span></td>'
        '</tr>';
        $('#entradas').append(fila);
        sumar();
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
        document.getElementById('spTotal').innerHTML = '$ ' + total + " MXN";
    }

    function deleteRow(row) {
        var d = row.parentNode.parentNode.rowIndex;
        document.getElementById("entradas").deleteRow(d);
        sumar();
    }
</script>
@stop

