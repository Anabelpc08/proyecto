<!-- Se establece que la plantilla base se extendrá a esta plantilla -->
@extends('layouts.base')

<!-- Se llama al yield para colocar elementos  -->
@section('contenido')

<div class="modal fade" id="modal_editar_proveedor" data-bs-backdrop="static" data-bs-keyboard="false" t tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Modificar registro</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- CUERPO DE LA VENTANA MODAL -->
      <div class="modal-body">
         @include('proveedor.messages')
        <form action="/panel/servicio/{{$servicio->id_servicio}}" method="POST">
            <!-- HTML no pemrite el metodo PUT por lo que se llama a la directiva method con la operacion PUT -->
            @method('PUT')
            @csrf
            <div class="row mb-3">
              <div class="mb-3 col-12">
                <label for="clave" class="form-label">Clave:</label>
                <input type="text" class="form-control" id="clave" name="clave" aria-describedby="Clave del servicio" value="{{$servicio->clave}}" autocomplete="off" required>
              </div>

              <div class="col-12">
                <label for="nombre" class="form-label ">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="Nombre del servicio" value="{{$servicio->nombre}}" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]{1,}" title="El campo no puede contener números o símbolos." autocomplete="off" required>
              </div>
            </div>


            <div class="modal-footer">

                <button type="submit" class="btn btn-primary cb-primary">Modificar</button>
                <a href="/panel/servicio" class="btn boton-outline-primary btn-outline-primary">Regresar</a>

            </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
