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
        <form action="/panel/proveedor/{{$proveedor->id_proveedor}}" method="POST">
            <!-- HTML no pemrite el metodo PUT por lo que se llama a la directiva method con la operacion PUT -->
            @method('PUT')
            @csrf
            <div class="mb-2">
              <label for="nombre" class="form-label">Nombre:</label>
              <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="nombre del proveedor" autocomplete="off" value="{{$proveedor->nombre}}" required>
            </div>

            <div class="mb-2">
              <label for="RFC" class="form-label ">RFC:</label>
              <input type="text" class="form-control" id="RFC" name="RFC" aria-describedby="RFC del proveedor" title="El campo no puede contener símbolos y debe estar conformado de 13 carácteres para personas físicas y 12 para personas morales" pattern="[A-Z0-9]{12,13}" autocomplete="off" maxlength="13" minlength="12" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" autocomplete="off" value="{{$proveedor->RFC}}" required>
            </div>

            <div class="mb-2">
              <label for="telefono" class="form-label ">Teléfono:</label>
              <input type="text" class="form-control" id="telefono" name="telefono" aria-describedby="telefono del proveedor" autocomplete="off" value="{{$proveedor->telefono}}" required>
            </div>

            <div class="mb-2">
              <label for="direccion" class="form-label">Dirección:</label>
              <input type="text" class="form-control" id="direccion" name="direccion" aria-describedby="direccion del proveedor" autocomplete="off" value="{{$proveedor->direccion}}" required>
            </div>

            <div class="mb-2">
              <label for="correo" class="form-label">Correo electrónico:</label>
              <input type="correo" class="form-control" id="correo" name="correo" aria-describedby="correo del proveedor" autocomplete="off" value="{{$proveedor->correo}}" required>
            </div>
            <div class="modal-footer">

                <button type="submit" class="btn btn-primary cb-primary">Modificar</button>
                <a href="/panel/proveedor" class="btn btn-outline-secondary">Regresar</a>

            </div>
        </form>
      </div>
    </div>
  </div>
</div>






@endsection
