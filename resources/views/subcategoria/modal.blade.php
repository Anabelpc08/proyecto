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
        <form action="/panel/subcategoria/{{$subcategoria->id_subcat_art_alm}}" method="POST">
            <!-- HTML no pemrite el metodo PUT por lo que se llama a la directiva method con la operacion PUT -->
            @method('PUT')
            @csrf
            <div class="row mb-3">
              <div class="col-5">
                <label for="inicial" class="form-label">Inicial:</label>
                <input type="text" class="form-control" id="inicial" name="inicial" aria-describedby="Inicial de la subcategoria" value="{{$subcategoria->inicial}}" pattern="[A-Z]{2,4}" maxlength="4" minlength="2" title="El campo no puede contener números o símbolos y debe tener de 2 a 3 letras." onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" autocomplete="off" required>
              </div>

              <div class="col-7">
                <label for="partida_presupuestal" class="form-label">Partida presupuestal:</label>
                <input type="text" class="form-control" id="partida_presupuestal" name="partida_presupuestal" aria-describedby="Iniciales de las Subcategorias" value="{{$subcategoria->partida_presupuestal}}" pattern="^[0-9]{4}+" title="El campo no puede contener letras o símbolos."  autocomplete="off" required>
              </div>
            </div>
            <div class="row mb-3">
              <div class="">
                <label for="nombre" class="form-label ">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="Nombre de la subcategoria" value="{{$subcategoria->nombre}}" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]{1,}" title="El campo no puede contener números o símbolos." autocomplete="off" required>
              </div>
            </div>
            
            <div class="mb-2">
              <label for="telefono" class="form-label ">Categoria:</label>
              <select class="form-select" name="categoria" id="categoria">
                @foreach($categoria as $categoria)
                  <option value="{{$categoria->id_cat_art_alm}}" {{($categoria->id_cat_art_alm == $subcategoria->id_cat_art_alm)?'selected':''}}>{{$categoria->nombre}}</option>
                @endforeach
              </select> 
            </div>


            <div class="modal-footer">
              
                <button type="submit" class="btn btn-primary cb-primary">Modificar</button>
                <a href="/panel/subcategoria" class="btn boton-outline-primary btn-outline-primary">Regresar</a>                
              
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection