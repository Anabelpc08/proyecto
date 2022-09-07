<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Categoria;
use App\Models\Subcategoria;

class SelectAnidado extends Component
{

    public $subCategorias = "";
    public $indice = "";


    // public function mount()
    // {
    //     $this->subCategorias = Subcategoria::where('id_cat_art_alm', 1)->get();
        
    // }


    public function render()
    {

        return view('livewire.select-anidado', 
        [
            'categoria' => Categoria::all(),
            'subcategorias' => $this->subCategorias,
            'indice' => $this->indice
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
