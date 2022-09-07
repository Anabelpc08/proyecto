<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Models\Articulo;


class SelectAnidadoEditar extends Component
{

    public $subCategorias = "";
    public $indice = "";
    public $clave = "";


    public function render()
    {
        return view('livewire.select-anidado-editar',
        [
            'categoria' => Categoria::all(),
            'subcategorias' => $this->subCategorias,
            'indice' => $this->indice,
            'clave' => $this->clave
        ]);
    }




    public function listarSubcategorias($id_cat_art_alm)
    {
        $this->subCategorias = Subcategoria::where('id_cat_art_alm', $id_cat_art_alm)->get();
    }

    public function mostrarIndice($id_subcat_art_alm)
    {
        $this->indice = Subcategoria::where('id_subcat_art_alm', $id_subcat_art_alm)->get();
    }
}
