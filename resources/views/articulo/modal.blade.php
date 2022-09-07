<!-- Se establece que la plantilla base se extendrá a esta plantilla -->
@extends('layouts.base')

<!-- Se llama al yield para colocar elementos  -->
@section('contenido')


<div class="modal fade" id="modal_editar_usuario" data-bs-backdrop="static" data-bs-keyboard="false" t tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Modificar registro</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- CUERPO DE LA VENTANA MODAL -->
      <div class="modal-body">
        <form action="/panel/articulo/{{$articulo->id_articulo}}" method="POST">
            <!-- HTML no pemrite el metodo PUT por lo que se llama a la directiva method con la operacion PUT -->
            @method('PUT')
            @csrf            
            <div class="mb-2">      
              <label for="descripcion" class="form-label ">Descripción:</label>
              <input type="text" class="form-control" id="descripcion" name="descripcion" aria-describedby="descricpion del articulo" value="{{$articulo->descripcion}}" required>
            </div>
            
            <div class="mb-2">
              <label for="umc" class="form-label ">Unidad de medida:</label>
              <select class="form-select" name="umc" id="umc">
                @foreach($umc as $umc)
                  <option value="{{$umc->id_umc}}" {{($umc->id_umc == $articulo->id_umc)?'selected':''}}>{{$umc->nombre}}</option>
                @endforeach
              </select>  
            </div>


            <div class=" row">
              @livewireStyles
              @livewire('select-anidado-editar', ['clave' => $articulo->clave])
              @livewireScripts
            </div>

            <div class="modal-footer">
              <button type="submit" class="btn btn-primary cb-primary">Modificar</button>
              <a href="/panel/articulo" class="btn boton-outline-primary btn-outline-primary">Regresar</a>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>


@endsection