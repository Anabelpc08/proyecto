@extends('adminlte::page')

@section('title', 'SIPA')

@section('content_header')
  <!-- Formulario de registro de proveedor -->
  <h2>Panel de Rangos</h2>
  <hr class="cb-dark border-2 ">
@stop

@section('content')   

<div class="card">
  <div class="card-body cb-light">
    <div class="container px-4">
      <div class="row">
    
      <!-- Mnesaje de validacion de registro exitoso -->
        @include('usuario.messages')
        
        <form action="/panel/roles" method="POST">
          @csrf
          <div class="row">
            <div class="mb-2 col-8">
              <label for="name" class="form-label">Nombre:</label>
              <input type="text" class="form-control" id="name" name="name" autofocus pattern="[A-Za-z\s]{1,}" title="Ingrese un nombre válido para el rango" autocomplete="off" required>
              <input type="hidden" id="guard_name" name="guard_name" value="web">
            </div>
                <h2>Lista de permisos</h2>
                @foreach ($permissions as $permission)
                    <div>
                      <label>
                        {!! Form::checkbox('permissions[]', $permission->id, null, ['class' => 'mr-1']) !!}
                        {{$permission->description}}
                      </label>
                    </div>
                @endforeach

                <div class="mb-2 col-6">
                  <button type="submit" class="btn btn-primary cb-primary btn-block" tabindex="5" ><i class="fas fa-save mr-2"></i> Guardar</button>
                </div>
          </div>
        </form>
    
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