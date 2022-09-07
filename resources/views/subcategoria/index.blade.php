@extends('adminlte::page')

@section('title', 'SIPA')

@section('content_header')
  <!-- Crear subcategorias -->
  <h2>Panel de Subcategorias</h2>
  <hr class="cb-dark border-2 ">
@stop

@section('content')
<div class="card cb-light">
  <div class="card-body">
    <div class="container px-4">
      <div class="row">

      <!-- Mnesaje de validacion de registro exitoso -->
        @include('proveedor.messages')
@can('operaciones.categoria_articulos')
        <div class="row">

          <form action="/panel/subcategoria" method="POST">
          @csrf
          <div class="row">
            <div class="mb-2 col-1">
              <label for="inicial" class="form-label">Inicial:</label>
              <input type="text" class="form-control" id="inicial" name="inicial" aria-describedby="Iniciales de las Subcategorias" autofocus pattern="[A-Z]{2,4}"
              maxlength="4" minlength="2"  title="El campo no puede contener números o símbolos y debe tener de 2 a 4 letras." onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" autocomplete="off" required>
            </div>

            <div class="mb-2 col-2">
              <label for="partida_presupuestal" class="form-label">Partida presupuestal:</label>
              <input type="number" class="form-control" id="partida_presupuestal" name="partida_presupuestal" aria-describedby="Iniciales de las Subcategorias" autofocus min="1" pattern="^[0-9]{4}+" title="El campo no puede contener letras o símbolos."  autocomplete="off" required>
            </div>

            <div class="mb-2 col-6">
              <label for="nombre" class="form-label">Nombre:</label>
              <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="Nombre de la subcategoria" pattern="[A-Za-zZñÑáéíóúÁÉÍÓÚ\s]{1,}" title="El campo no puede contener números o símbolos." autocomplete="off" required>
            </div>
            <div class="mb-2 col-3">
              <label for="categoria" class="form-label">Categoria:</label>
              <select name="categoria" id="categoria" class="form-select" required>
              <option value="" selected disabled>&#187; Seleccione una categoría</option>
                @foreach ($categoria as $categoria)
                    <option value="{{$categoria->id_cat_art_alm}}">{{$categoria->nombre}}</option>
                @endforeach
              </select>
            </div>
          </div>
                <div class="d-grid gap-2 mt-2 d-md-flex justify-content-md-end">
                  <button type="submit" class="btn col-2 btn-primary cb-primary mr-2" tabindex="5" ><i class="fas fa-save mr-2"></i> Guardar</button>
                  <button type="reset" class="btn col-2 boton-outline-primary btn-outline-primary" tabindex="4"><i class="fas fa-eraser mr-2"></i> Limpiar</button>

                </div>
            </div>
          </form>
        </div>
@endcan
        <div class="row mt-5">
          <table id="subcategoria" class="table table-sm col-12 table-hover table-striped mt-2">
              <thead class="cb-primary color-light ">
                <tr>
                  <th scope="col" class="pr-4 py-2">Categoria</th>
                  <th scope="col" class="pr-4 py-2">Inicial</th>
                  <th scope="col" class="pr-4 py-2">Nombre</th>
                  <th scope="col" class="pr-4 py-2">Partida presupuestal</th>

                  @can('operaciones.categoria_articulos')
                  <th scope="col" class="pr-4 py-2">Acciones</th>
                  @endcan
                </tr>
              </thead>
              <tbody>
                <!-- se recorre lo enviado por la variable proveedor que -->
                <!-- se envia desde el controlador -->
                @foreach($subcategoria as $subcategoria)
                <tr>
                  <!-- Se acceden a cada uno de los campos y se plasman en filas de la tabal -->
                  <td>{{$subcategoria->categoria->nombre}}</td>
                  <td>{{$subcategoria->inicial}}</td>
                  <td>{{$subcategoria->nombre}}</td>
                  <td>{{$subcategoria->partida_presupuestal}}</td>

                  @can('operaciones.categoria_articulos')
                    <td>
                      <div class="d-flex justify-content-center">
                        <!-- Se agrupan los botones dentro de un form para ejecutar el método destroy del controlador -->
                        <form action="{{ route ('subcategoria.destroy', $subcategoria->id_subcat_art_alm)}}" method="POST" class="formulario-eliminar">
                            <a href="/panel/subcategoria/{{$subcategoria->id_subcat_art_alm}}/edit" class="btn m-1 btn-warning cb-info" rel="noopener noreferrer"><i class="fas fa-edit"></i></a>
                          <!-- Se implementa el metodo delete -->
                          @csrf
                          @method('DELETE')
                            <button type="submit" class="btn btn-danger m-1 cb-accent"><i class="fas fa-trash"></i></button>
                        </form>
                      </div>
                    </td>
                  @endcan
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

@stop
