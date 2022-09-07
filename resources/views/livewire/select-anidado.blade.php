<div>
    <div class="row">
        <div class="mb-2 col-4">
            <label for="categorias" class="form-label">Categoría:</label>
            <select wire:change="listarSubcategorias($event.target.value)" name="categoria" id="categorias" class="form-select" required>              
            <option value="" selected disabled>&#187; Seleccione una categoría</option>
            @foreach ($categoria as $categoria)
                <option value="{{$categoria->id_cat_art_alm}}">{{$categoria->nombre}}</option>
            @endforeach
            </select>
        </div>
        <div class="mb-2 col-4">
            <label for="subcategorias" class="form-label">Subcategoría:</label>
            <select class="form-select"  wire:change="mostrarIndice($event.target.value)" name="subcategoria" id="subcategorias" required>
            <option value="" selected disabled>&#187; Seleccione una subcategoría</option>
                @if ($subcategorias)
                @foreach ($subcategorias as $subcategoria)
                <option value="{{$subcategoria->id_subcat_art_alm}}">{{$subcategoria->inicial}}&nbsp;-&nbsp;{{$subcategoria->nombre}}&nbsp;-&nbsp;{{$subcategoria->partida_presupuestal}}</option>
                @endforeach                
            @endif
            </select>            
        </div>
        <div class="mb-2 col-4">
            <label for="claves" class="form-label">Clave del artículo:</label>
            @if ($indice)
                @foreach ($indice as $indice)                
                    <input type="text" class="form-control" name="clave" id="claves" value="{{$indice->inicial}}-" style="text-transform:uppercase" required>
                @endforeach
            @endif

        </div>
    </div>
</div>
