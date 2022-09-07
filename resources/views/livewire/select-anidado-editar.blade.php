<div class="">
    <div class="mb-2 row">
        <div class="mb-2 col-12">
            <label for="categorias" class="form-label">Categoría:</label>
            <select wire:change="listarSubcategorias($event.target.value)" name="categoria" id="categorias" class="form-select">              
            <option selected disabled>Seleccione una categoría</option>
            @foreach ($categoria as $categoria)
                <option value="{{$categoria->id_cat_art_alm}}">{{$categoria->nombre}}</option>
            @endforeach
            </select>
        </div>
    </div>
    <div class="mb-2 row">        
        <div class="mb-2 col-7">
            <label for="subcategorias" class="form-label">Subcategoría:</label>
            <select class="form-select"  wire:change="mostrarIndice($event.target.value)" name="subcategoria" id="subcategorias">
            <option selected disabled>Seleccione una subcategoría</option>
                @if ($subcategorias)
                @foreach ($subcategorias as $subcategoria)
                <option value="{{$subcategoria->id_subcat_art_alm}}">{{$subcategoria->inicial}}&nbsp;-&nbsp;{{$subcategoria->nombre}}</option>
                @endforeach                
            @endif
            </select>            
        </div>
        <div class="mb-2 col-5">
            <label for="claves" class="form-label">Clave del artículo:</label>
            {{-- @if ($indice)
                @foreach ($indice as $indice)                
                    <input type="text" class="form-control" name="clave" id="claves" value="{{$clave}}{{$indice->inicial}}-">
                @endforeach
            @endif --}}
            <input type="text" class="form-control" name="clave" id="claves" value="{{$clave}}" style="text-transform:uppercase" required>
        </div>
    </div>
    </div>
</div>
