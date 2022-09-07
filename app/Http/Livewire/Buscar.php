<?php

namespace App\Http\Livewire;

use App\Models\Articulo;
use App\Models\Subcategoria;
use App\Models\UnidadMedida;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Buscar extends Component
{

    public $clave = "";
    public $articulo = "";
    public $descripcion = "";

    public function render()
    {
  
        $resultado = DB::table('entrada_alm')->select('id_entrada')->take(1)->skip(1)->get();
        return view(
            'livewire.buscar',
            [
                'umc' => UnidadMedida::all(),
                'sub' => Subcategoria::all(),
                'articulo' => $this->articulo ,
            ]
        )->with('resultado', $resultado);
    }

    public function buscar()
    {
        $this->validate([
            'clave' => 'required|exists:articulo_alm,clave'
        ]);
        $this->articulo = Articulo::where('clave', $this->clave)->get();
        // dd($this->articulo);
    }

}

