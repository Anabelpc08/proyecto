<div>
    <div class="row">
        @error('clave')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-question-circle mr-2"></i>CLAVE NO ENCONTRADA O NO REGISTRADA, VERIFIQUE EN EL CATÁLOGO DE ARTICULOS.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @enderror
        <div class="input-group mb-2 col-2">
            <label for="clave" class="form-label">Clave Articulo</label>
            <div class="input-group-append">
                <input wire:model="clave" type="text" class="form-control" placeholder="Buscar" id="clave" name="clave"
                    maxlength="10" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" required>
                <button class="btn btn-outline-primary formulario-enviar" type="button" id="button-addon2"
                    wire:click="buscar(clave.value)">
                    <i class="fas fa-search"></i></button>
            </div>
        </div>
        <div class="mb-2 col-5">
            @if ($articulo)
                <label for="descripcion" class="form-label">Nombre Articulo</label>
                @foreach ($articulo as $descripcion)
                    <input type="text" class="form-control" id="descripcion" name="descripcion"
                        value="{{ $descripcion->descripcion }}" readonly required>
                @endforeach
        </div>
        <div class=" mb-2 col-2">
            <label for="subcategoria" class="form-label">Subcategoria :</label>
            <select name="id_subcat_art_alm" class="form-control" readonly>
                @foreach ($sub as $sub)
                    <option value="{{ $sub->nombre }}"
                        {{ $sub->id_subcat_art_alm == $descripcion->id_subcat_art_alm ? 'selected' : '' }}>
                        {{ $sub->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-2 col-2">
            <label for="umc" class="form-label">Unidad de Medida:</label>
            <select id="id_umc" name="id_umc" class="form-control" readonly>
                @foreach ($umc as $umc)
                    <option value="{{ $umc->nombre }}" {{ $umc->id_umc == $descripcion->id_umc ? 'selected' : '' }}>
                        {{ $umc->nombre }}
                    </option>
                @endforeach
            </select>
            @endif
        </div>
        {{-- <div class="mb-2">
            <label for="clave" class="form-label visually-hidden">#Entrada</label>
            <input type="text" class="form-control visually-hidden" id="id_entrada" name="id_entrada[]" value="{{$resultado[0]->id_entrada}}" readonly>
             $resultado[0]->id_entrada
        </div> --}}
        <div class="mb-2">
            <label for="id_articulo" class="form-label visually-hidden">#Articulo</label>
            @if ($articulo)
                @foreach ($articulo as $clave)
                    <input type="text" class="form-control visually-hidden" name="id_articulo" id="id_articulo"
                        value="{{ $clave->id_articulo }}" readonly required>
                @endforeach
            @endif
        </div>
    </div>
</div>

