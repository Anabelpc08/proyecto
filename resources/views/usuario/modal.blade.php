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
        @include('proveedor.messages')
        <form action="/panel/usuario/{{$usuario->id_usuario}}" method="POST">
            <!-- HTML no pemrite el metodo PUT por lo que se llama a la directiva method con la operacion PUT -->
            @method('PUT')
            @csrf
            <div class="mb-2">
              <label for="nombre" class="form-label">Nombre:</label>
              <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="nombre del proveedor" value="{{$usuario->nombre}}" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]{1,}" title="El campo no puede contener números o símbolos." autocomplete="off" required>
            </div>
            
            <div class="mb-2">      
              <label for="apellidoPat" class="form-label ">Apellido Paterno:</label>
              <input type="text" class="form-control" id="apellidoPat" name="apellidoPat" aria-describedby="apellido paterno del usuario" value="{{$usuario->apellidoPat}}" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]{1,}" title="El campo no puede contener números o símbolos." autocomplete="off" required>
            </div>
            
            <div class="mb-2">
              <label for="apellidoMat" class="form-label ">Apellido Materno:</label>
              <input type="text" class="form-control" id="apellidoMat" name="apellidoMat" aria-describedby="apellido materno del usuario" value="{{$usuario->apellidoMat}}" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]{1,}" title="El campo no puede contener números o símbolos." autocomplete="off" required>
            </div>

            <div class="mb-2">
              <label for="n_empleado" class="form-label">Número de empleado:</label>
              <input type="text" class="form-control" id="n_empleado" name="n_empleado" aria-describedby="número de empleado del usuario" value="{{$usuario->n_empleado}}" pattern="[0-9]{1,}" title="El campo no puede contener letras o símbolos."  autocomplete="off" required>
            </div>
          
            <div class="mb-2">
              <label for="email" class="form-label">Correo electrónico:</label>
              <input type="email" class="form-control" id="email" name="email" aria-describedby="email del usuario" value="{{$usuario->email}}" autocomplete="off" required>
            </div>


            <div class="mb-2 row">
                <div class="col-12">
                  <label for="rango" class="form-label">Rango:</label>
                  <select class="form-select" name="rango" id="rango">
                  @foreach($roles as $id => $role)
                      <!-- auto selecciona rango proveniente de la llave foránea -->
                      <option value="{{$role->id}}" {{($usuario->roles->contains($id+1))?'selected':''}}>
                        {{$role->name}}
                      </option>
                    @endforeach
                  </select>            
                </div>
              </div>

            <div class="mb-2">
              <label for="user" class="form-label">Usuario:</label>
              <input type="text" class="form-control" id="user" name="user" aria-describedby="nombre de usuario" value="{{$usuario->user}}" autocomplete="off" required>
            </div>

            <div class="mb-2">
              <label for="email" class="form-label">Contraseña:</label>
              <div class="input-group">
                <input id="pass" type="text" class="form-control" name="password" aria-describedby="contraseña generada para el usuario" autocomplete="off" required  >
                <button class="btn btn-secondary" onclick="generar(8)" type="button">Generar</button>
              </div>

            </div>



            <div class="modal-footer">
              <button type="submit" class="btn btn-primary cb-primary">Modificar</button>
              <a href="/panel/usuario" class="btn  boton-outline-primary btn-outline-primary">Regresar</a>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
function generar(longitud)
{
  long=parseInt(longitud);
  const caracteres = "abcdefghijkmnpqrtuvwxyzABCDEFGHIJKLMNPQRTUVWXYZ012346789=+?#";
  var contraseña = "";
  for (i=0; i<long; i++) contraseña += caracteres.charAt(Math.floor(Math.random()*caracteres.length));
  const pass = document.getElementById("pass").setAttribute('value',contraseña);
  return pass;
}
</script>

@endsection