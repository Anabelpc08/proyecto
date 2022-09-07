<div class="">
    <div class="row">
        <div class="mb-2 col-5">
            <label for="categorias" class="form-label">Categoría:</label>
            <select wire:change="tipolista($event.target.value)" name="categorias" class="form-select">
                <option selected disabled>&#187; Seleccione una categoría</option>
                @foreach ($categorias as $tipo)
                <option value="{{$tipo->id_cat_art_alm}}">{{$tipo->nombre}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-2 col-7">
            <label class="form-label">Subcategoría:</label>

            <div class="row g-3">
                <div class="col-8">
                    <select class="form-select" name="subcategoria">
                        <option selected disabled>&#187; Seleccione una subcategoría</option>
                        @if ($subcategorias)
                        @foreach ($subcategorias as $subcategoria)
                        <option value="{{$subcategoria->id_subcat_art_alm}}">{{$subcategoria->inicial}}&nbsp;-&nbsp;{{$subcategoria->nombre}}&nbsp;-&nbsp;{{$subcategoria->partida_presupuestal}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-4">
                    <button type="submit" class="btn btn-success px-3 cb-success"><i class="fas fa-search" title="Buscar"></i><span class="ml-3 mr-3 fw-bold">Buscar</span></button>
                    <!--type: reset --- limpia el formulario -->
                </div>
            </div>
        </div>
    </div>
</div>
