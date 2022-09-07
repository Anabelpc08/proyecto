@extends('adminlte::page')

@section('title', 'SIPA')

@section('content_header')
  <!-- Formulario de registro de proveedor -->
  <h2>Panel de Rangos</h2>
  <hr class="cb-dark border-2 ">
@stop

@section('content')
<div class="card cb-light">
  <div class="card-body">
    <a href="/panel/roles/create" class="btn btn-primary cb-primary">Crear nuevo rango</a>
    <div class="container px-4">
      <div class="row">

      <!-- Mnesaje de validacion de registro exitoso -->
              <!-- Mnesaje de validacion de registro exitoso -->
              @if(session('borrar'))
              <div class="alert mt-1 alert-danger">
                {{session('borrar')}}<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              </div>
              @elseif(session('success'))
              <div class="alert mt-1 alert-success">
                {{session('success')}}<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              </div>
            @endif

        <div class="row mt-2">
          <table class="table table-sm col-12 table-hover table-striped mt-2">
              <thead class="cb-primary color-light ">
                <tr>
                  <th scope="col" class="pr-4 py-2">Nivel</th>
                  <th scope="col" class="pr-4 py-2">Nombre del rango</th>
                  <th scope="col" class="pr-4 py-2">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <!-- se recorre lo enviado por la variable proveedor que -->
                <!-- se envia desde el controlador -->
                @foreach($roles as $role)
                <tr>
                  <!-- Se acceden a cada uno de los campos y se plasman en filas de la tabal -->
                  <td>{{$role->id}}</td>
                  <td>{{$role->name}}</td>
                  <td width="20px">
                  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <!-- Se agrupan los botones dentro de un form para ejecutar el método destroy del controlador -->
                    <a href="/panel/roles/{{$role->id}}/edit" class="btn btn-warning cb-info" rel="noopener noreferrer"><i class="fas fa-edit"></i></a>
                    <!-- Se implementa el metodo delete -->
                    <form action="{{ route ('roles.destroy', $role->id)}}" method="POST" class="formulario-eliminar">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger cb-accent"><i class="fas fa-trash"></i></button>
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
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- Styles -->
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
@stop

@section('js')
<script src="{{ mix('js/app.js') }}" ></script>

@stop
