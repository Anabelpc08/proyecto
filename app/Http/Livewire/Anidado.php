<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Categoria;
use App\Models\Subcategoria;

class Anidado extends Component
{

    public $selectedCategoria = null, $selectedSubcategoria = null;

    public $subcategorias = "";

    public function render()
    {
        return view('livewire.anidado', [
            'categorias' => Categoria::all(),
            'subcategorias' => $this->subcategorias

        ]);
    }
    public function tipolista($id_cat_art_alm)
    {
        $this->subcategorias = Subcategoria::where('id_cat_art_alm', $id_cat_art_alm)->get();
    }
}
