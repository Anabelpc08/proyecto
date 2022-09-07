@extends('adminlte::page')

@section('title', 'SIPA')

@section('content_header')
  <!-- Formulario de registro de proveedor -->
  <h2>Panel de Usuarios</h2>
  <hr class="cb-dark border-2 ">
@stop

@section('content')

<div class="card cb-light">
  <div class="card-body">
    <div class="container px-4">
      <div class="row">

      <!-- Mnesaje de validacion de registro exitoso -->
        @include('usuario.messages')

        <div class="row">
          <form action="/panel/usuario" method="POST">
            @csrf
            <div class="row">
                  <div class="mb-2 col-4">
                    <label for="nombre" class="form-label">Nombre:</label>
                      <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="nombre del usuario" autofocus pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]{1,}" title="El campo no puede contener números o símbolos." autocomplete="off" required>
                  </div>
                  <div class="mb-2 col-4">
                      <label for="apellidoPat" class="form-label">Apellido Paterno:</label>
                      <input type="text" class="form-control" id="apellidoPat" name="apellidoPat" aria-describedby="apellido paterno del usuario" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]{1,}" title="El campo no puede contener números o símbolos."  autocomplete="off" required>
                  </div>
                  <div class="mb-2 col-4">
                      <label for="apellidoMat" class="form-label">Apellido Materno:</label>
                      <input type="text" class="form-control" id="apellidoMat" name="apellidoMat" aria-describedby="apellido materno del usuario" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]{1,}" title="El campo no puede contener números o símbolos." autocomplete="off" required>
                  </div>
            </div>
            <div class="row">
                  <div class="mb-2 col-4">
                      <label for="n_empleado" class="form-label">Número de empleado:</label>
                      <input type="number" class="form-control" id="n_empleado" name="n_empleado" aria-describedby="número de empleado del usuario" pattern="[0-9]{1,}" title="El campo no puede contener letras o símbolos." autocomplete="off">
                  </div>
                  <div class="mb-2 col-4">
                      <label for="email" class="form-label">Correo electrónico:</label>
                      <input type="email" class="form-control" id="email" name="email" aria-describedby="correo electrónico del usuario" title="Ingrese un correo electrónico." autocomplete="off" required>
                  </div>
                  <div class="mb-2 col-4">
                      <label for="rango" class="form-label">Rango:</label>
                      <select class="form-select" name="rango" id="rango" required>
                      <option value="" selected disabled>&#187; Seleccione un rango</option>
                      @foreach($roles as $rol)
                          <option value="{{$rol->id}}">{{$rol->name}}</option>
                        @endforeach
                      </select>
                  </div>

            </div>
            <div class="row">

                  <div class="mb-2 col-4">
                      <label for="user" class="form-label">Usuario:</label>
                      <input type="text" class="form-control" id="user" name="user" aria-describedby="Nombre de usuario" autocomplete="off" required>
                  </div>

                  <div class="mb-2 col-4">
                        <label for="pass" class="form-label">Contraseña:</label>
                          <div class="input-group">
                            <input id="pass" type="text" class="form-control" name="password" aria-describedby="contraseña generada para el usuario" required readonly>
                            <button class="btn btn-secondary" onclick="generar(8)" type="button">Generar</button>
                          </div>
                  </div>


                  {{-- p-rodrigo   6XL#avxz --}}
                  {{-- p-karladiaz dDe90wUB --}}

            </div>
            <div class="row">
                  <div class="d-grid gap-2 mt-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn col-2 btn-primary cb-primary mr-2" tabindex="5" ><i class="fas fa-save mr-2"></i> Guardar</button>
                    <button type="reset" class="btn col-2 boton-outline-primary btn-outline-primary" tabindex="4"><i class="fas fa-eraser mr-2"></i> Limpiar</button>  <!-- type: reset --- limpia el formulario -->
                  </div>
            </div>
          </form>

        </div>

        <div class="row mt-5">
          <table id="usuario" class="table table-sm col-12 table-hover table-striped mt-2">
              <thead class="cb-primary color-light ">
                <tr>
                  {{-- <th scope="col" class="pr-4 py-2">ID</th> --}}
                  <th scope="col" class="pr-4 py-2">N° de Empleado</th>
                  <th scope="col" class="pr-4 py-2">Nombre</th>
                  <th scope="col" class="pr-4 py-2">Apellido Paterno</th>
                  <th scope="col" class="pr-4 py-2">Apellido Materno</th>
                  <th scope="col" class="pr-4 py-2">Rango</th>
                  <th scope="col" class="pr-4 py-2">Usuario</th>
                  <th scope="col" class="pr-4 py-2">Correo</th>
                  <th scope="col" class="pr-4 py-2">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <!-- se recorre lo enviado por la variable proveedor que -->
                <!-- se envia desde el controlador -->
                @foreach($usuario as $usuarios)
                <tr>
                  <!-- Se acceden a cada uno de los campos y se plasman en filas de la tabal
                 se cambio nombre de columna de tabla users a nombre_usuario-->
                  {{-- <td>{{$usuarios->id_usuario}}</td> --}}
                  <td>{{$usuarios->n_empleado}}</td>
                  <td>{{$usuarios->nombre}}</td>
                  <td>{{$usuarios->apellidoPat}}</td>
                  <td>{{$usuarios->apellidoMat}}</td>
                  <td>
                    @foreach ($usuarios->roles as $role)
                      {{$role->name}}
                    @endforeach
                  </td>
                {{-- <td>{{$usuarios->status->nombre}}</td> --}}
                  <td>{{$usuarios->user}}</td>
                  <td>{{$usuarios->email}}</td>
                  <td>
                  <div class="d-grid gap-2 d-md-block">
                    <!-- Se agrupan los botones dentro de un form para ejecutar el método destroy del controlador -->
                    <form action="{{ route ('usuario.destroy', $usuarios->id_usuario)}}" method="POST" class="formulario-eliminar">
                      <a href="/panel/usuario/{{$usuarios->id_usuario}}/edit" class="btn m-1 btn-warning cb-info" rel="noopener noreferrer"><i class="fas fa-edit"></i></a>
                      <!-- Se implementa el metodo delete -->
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger m-1 cb-accent"><i class="fas fa-trash"></i></button>
                    </form>
                  </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


@stop

@section('css')
  <!-- Se llama archivo css de Datatables y se v a aplicar solamente en el index de los proveedores -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css"/>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.bootstrap5.min.css"/>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- Styles -->
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
@stop

@section('js')
  <script src="{{ mix('js/app.js') }}" ></script>

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
  <script src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.1.5/js/buttons.html5.styles.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.1.5/js/buttons.html5.styles.templates.min.js"></script>

  <script type="text/javascript">
  function generar(longitud)
    {
      long=parseInt(longitud);
      const caracteres = "abcdefghjkmnpqrtuvwxyzABCDEFGHJKLMNPQRTUVWXYZ12346789=+?#@";
      var contraseña = "";
      for (i=0; i<long; i++) contraseña += caracteres.charAt(Math.floor(Math.random()*caracteres.length));
      const pass = document.getElementById("pass").setAttribute('value',contraseña);
      return pass;
    }
  </script>

@stop
